<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class MY_Lang extends CI_Lang
{
    public function __construct()
    {
        parent::__construct();
    }

    public function admin_load($langfile, $idiom = '', $return = false, $add_suffix = true, $alt_path = '')
    {
        return $this->my_load($langfile, $idiom, $return, $add_suffix, $alt_path, 'admin');
    }

    public function line($line, $params = null)
    {
        $return = parent::line($line);
        if ($return === false) {
            return str_replace('_', ' ', $line);
        } else {
            if (!is_null($params)) {
                $return = $this->_ni_line($return, $params);
            }
            return $return;
        }
    }

    public function my_load($langfile, $idiom = '', $return = false, $add_suffix = true, $alt_path = '', $path = null)
    {
        if (is_array($langfile)) {
            foreach ($langfile as $value) {
                $this->load($value, $idiom, $return, $add_suffix, $alt_path);
            }

            return;
        }

        $langfile = str_replace('.php', '', $langfile);

        if ($add_suffix === true) {
            $langfile = preg_replace('/_lang$/', '', $langfile) . '_lang';
        }

        $langfile .= '.php';

        if (empty($idiom) or !preg_match('/^[a-z_-]+$/i', $idiom)) {
            $config = &get_config();
            $idiom  = empty($config['language']) ? 'english' : $config['language'];
        }

        if ($return === false && isset($this->is_loaded[$langfile]) && $this->is_loaded[$langfile] === $idiom) {
            return;
        }

        $basepath = BASEPATH . 'language/' . $idiom . '/' . ($path ? $path . '/' : '') . $langfile;
        if (($found = file_exists($basepath)) === true) {
            include $basepath;
        }

        if ($alt_path !== '') {
            $alt_path .= 'language/' . $idiom . '/' . $langfile;
            if (file_exists($alt_path)) {
                include $alt_path;
                $found = true;
            }
        } else {
            foreach (get_instance()->load->get_package_paths(true) as $package_path) {
                $package_path .= 'language/' . $idiom . '/' . ($path ? $path . '/' : '') . $langfile;
                if ($basepath !== $package_path && file_exists($package_path)) {
                    include $package_path;
                    $found = true;
                    break;
                }
            }
        }

        if ($found !== true) {
            show_error('Unable to load the requested language file: language/' . $idiom . '/' . ($path ? $path . '/' : '') . $langfile);
        }

        if (!isset($lang) or !is_array($lang)) {
            log_message('error', 'Language file contains no data: language/' . $idiom . '/' . ($path ? $path . '/' : '') . $langfile);

            if ($return === true) {
                return [];
            }
            return;
        }

        if ($return === true) {
            return $lang;
        }

        $this->is_loaded[$langfile] = $idiom;
        $this->language             = array_merge($this->language, $lang);

        log_message('info', 'Language file loaded: language/' . $idiom . '/' . ($path ? $path . '/' : '') . $langfile);
        return true;
    }

    public function shop_load($langfile, $idiom = '', $return = false, $add_suffix = true, $alt_path = '')
    {
        return $this->my_load($langfile, $idiom, $return, $add_suffix, $alt_path, 'shop');
    }

    private function _ni_line($str, $params)
    {
        $return = $str;
        $params = is_array($params) ? $params : [$params];
        $search = [];
        $cnt    = 1;
        foreach ($params as $param) {
            $search[$cnt] = "/\\${$cnt}/";
            $cnt++;
        }
        unset($search[0]);
        $return = preg_replace($search, $params, $return);
        return $return;
    }
}
