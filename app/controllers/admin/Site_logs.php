<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Site_logs extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            $this->sma->md('login');
        }
        if (!$this->Owner) {
            $this->session->set_flashdata('warning', lang('access_denied'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function getLogs()
    {
        $this->load->library('datatables');
        $this->datatables->select('date, detail, model')->from('logs');
        echo $this->datatables->generate();
    }

    public function index()
    {
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

        $bc   = [['link' => base_url(), 'page' => lang('home')], ['link' => '#', 'page' => lang('logs')]];
        $meta = ['page_title' => lang('site_logs'), 'bc' => $bc];
        $this->page_construct('logs/index', $meta, $this->data);
    }
}
