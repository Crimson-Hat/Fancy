<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Hybridauth\Hybridauth;

class HybridAuthLib extends Hybridauth
{
    public function __construct($config = [])
    {
        $ci           = &get_instance();
        $this->config = $config;
        $provider     = $ci->config->item('provider');

        $this->config['callback'] = base_url($this->config['callback']) . ($provider ? '?hauth_done=' . $provider : '');
        parent::__construct($this->config);
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function providerEnabled($provider)
    {
        return isset($this->config['providers'][$provider]) && $this->config['providers'][$provider]['enabled'];
    }

    public function serviceEnabled($service)
    {
        return $this->providerEnabled($service);
    }
}
