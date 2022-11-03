<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class MY_Security extends CI_Security
{
    public function __construct()
    {
        parent::__construct();
    }

    public function csrf_show_error()
    {
        header('Location: ' . config_item('base_url') . 'errors/csrf', true, 302);
        die();
    }
}
