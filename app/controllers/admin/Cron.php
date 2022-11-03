<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->admin_load('cron');
        $this->load->admin_model('cron_model');
        $this->Settings = $this->cron_model->getSettings();
    }

    public function index()
    {
        show_404();
    }

    public function run()
    {
        if ($m = $this->cron_model->run_cron()) {
            if ($this->input->is_cli_request()) {
                foreach ($m as $msg) {
                    echo $msg . "\n";
                }
            } else {
                echo '<!doctype html><html><head><title>Cron Job</title><style>p{background:#F5F5F5;border:1px solid #EEE; padding:15px;}</style></head><body>';
                echo '<p>' . lang('cron_finished') . '</p>';
                foreach ($m as $msg) {
                    echo '<p>' . $msg . '</p>';
                }
                echo '</body></html>';
            }
        }
    }
}
