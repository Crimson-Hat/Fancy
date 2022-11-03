<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Notify extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->admin_load('sma');
    }

    public function csrf($msg = null)
    {
        $data['page_title'] = lang('csrf_error');
        if (!$msg) {
            $msg = lang('cesr_error_msg');
        }
        $this->session->set_flashdata('error', $msg);
        redirect('/', 'location');
    }

    public function error_404()
    {
        $url = $this->session->userdata('requested_page') ?? $_SERVER['HTTP_REFERER'];
        $this->session->set_flashdata('error', lang('error_404_message') . ($url ? $url : ''));
        redirect('/');
    }

    public function offline($msg = null)
    {
        $data['page_title'] = lang('site_offline');
        $data['msg']        = $msg;
        $this->load->view('default/notify', $data);
    }

    public function payment()
    {
        $data['page_title'] = lang('payment');
        $data['msg']        = lang('info');
        $data['msg1']       = lang('payment_processing');
        $this->load->view('default/notify', $data);
    }

    public function payment_failed($msg = null)
    {
        $data['page_title'] = lang('payment');
        $data['msg']        = $msg ? $msg : lang('error');
        $data['msg1']       = lang('payment_failed');
        $this->load->view('default/notify', $data);
    }

    public function payment_success($msg = null)
    {
        $data['page_title'] = lang('payment');
        $data['msg']        = $msg ? $msg : lang('thank_you');
        $data['msg1']       = lang('payment_added');
        $this->load->view('default/notify', $data);
    }
}
