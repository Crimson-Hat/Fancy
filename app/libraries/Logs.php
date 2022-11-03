<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 *  ==============================================================================
 *  Author  : Mian Saleem
 *  Email   : saleem@tecdiary.com
 *  For     : Stock Manager Advance
 *  Web     : http://tecdiary.com
 *  ==============================================================================
 */

class Logs
{
    protected $_date_fmt = 'Y-m-d H:i:s';
    protected $_enabled  = true;
    protected $_file_ext;
    protected $_file_permissions = 0644;

    protected $_log_path;

    public function __construct()
    {
        $this->config->load('config');
        $this->_log_path = ($this->config->item('log_path') !== '') ? $this->config->item('log_path') : APPPATH . 'logs/';
        $this->_file_ext = ($this->config->item('log_file_extension') !== '') ? ltrim($this->config->item('log_file_extension'), '.') : 'php';
        file_exists($this->_log_path) or mkdir($this->_log_path, 0755, true);
        if (!is_dir($this->_log_path) or !is_really_writable($this->_log_path)) {
            $this->_enabled = false;
        }
        if ($this->config->item('log_date_format')) {
            $this->_date_fmt = $this->config->item('log_date_format');
        }
        if ($this->config->item('log_file_permissions') && is_int($this->config->item('log_file_permissions'))) {
            $this->_file_permissions = $this->config->item('log_file_permissions');
        }
    }

    public function delete($type = null, $date = null)
    {
        if (!$type || $this->_enabled === false) {
            return false;
        }
        if (!$date) {
            $date = date('Y-m-d', strtotime('-1 month'));
        }
        $deleted = 0;
        $kept    = 0;

        $files = glob($this->_log_path . $type . '*.php');

        foreach ($files as $file) {
            if (filemtime($file) < strtotime($date)) {
                unlink($file);
                $deleted++;
            } else {
                $kept++;
            }
        }
        $total = $deleted + $kept;

        $res = ['total' => $total, 'deleted' => $deleted, 'kept' => $kept];
        return $res;
    }

    public function write($type, $msg, $val = null)
    {
        if ($this->_enabled === false) {
            return false;
        }

        $filepath = $this->_log_path . 'payments-' . date('Y-m-d') . '.' . $this->_file_ext;
        $message  = '';

        if (!file_exists($filepath)) {
            $newfile = true;
            if ($this->_file_ext === 'php') {
                $message .= "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n";
            }
        }
        if (!$fp = @fopen($filepath, 'ab')) {
            return false;
        }

        $message .= $type . ' - ' . date($this->_date_fmt) . ' --> ' . $msg . ' (' . $this->input->ip_address() . ') ' . ($val ? $val : '') . "\n";
        flock($fp, LOCK_EX);
        for ($written = 0, $length = strlen($message); $written < $length; $written += $result) {
            if (($result = fwrite($fp, substr($message, $written))) === false) {
                break;
            }
        }
        flock($fp, LOCK_UN);
        fclose($fp);
        if (isset($newfile) && $newfile === true) {
            chmod($filepath, $this->_file_permissions);
        }

        return is_int($result);
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }
}
