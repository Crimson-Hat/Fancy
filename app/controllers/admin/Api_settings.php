<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api_settings extends MY_Controller
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
            redirect('admin');
        }

        $this->load->admin_model('api_model');
        $this->lang->admin_load('api', $this->Settings->user_language);
        $this->load->library('form_validation');
    }

    public function create_api_key()
    {
        $this->form_validation->set_rules('reference', lang('reference'), 'required|trim');
        $this->form_validation->set_rules('level', lang('level'), 'required|trim');

        if ($this->form_validation->run() == true) {
            $data = [
                'reference'     => $this->input->post('reference'),
                'user_id'       => $this->session->userdata('user_id'),
                'key'           => $this->api_model->generateKey(),
                'level'         => $this->input->post('level'),
                'ignore_limits' => $this->input->post('ignore_limits'),
                'ip_addresses'  => $this->input->post('ip_addresses'),
                'date_created'  => time(),
            ];
        } elseif ($this->input->post('create_api_key')) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER'] ?? 'admin');
        }
        if ($this->form_validation->run() == true && $this->api_model->addApiKey($data)) {
            $this->session->set_flashdata('message', lang('api_key_added'));
            admin_redirect('api_settings');
        } else {
            $this->data['error']      = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['page_title'] = lang('create_api_key');
            $this->load->view($this->theme . 'api/create_api_key', $this->data);
        }
    }

    public function delete($id)
    {
        if (DEMO) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('disabled_in_demo')]);
        }
        if (!$id) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('id_not_found')]);
        }

        if ($this->api_model->deleteApiKey($id)) {
            $this->sma->send_json(['error' => 0, 'msg' => lang('api_key_deleted')]);
        } else {
            $this->sma->send_json(['error' => 1, 'msg' => lang('delete_failed')]);
        }
    }

    public function getApis()
    {
        $this->load->library('datatables');
        $this->datatables
            ->select('id, reference, key, level, ignore_limits, ip_addresses')
            ->from('api_keys')
            ->add_column('Actions', "<div class=\"text-center\"><a href='#' class='tip po' title='<b>" . lang('delete') . "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('api_settings/delete/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>", 'id');

        echo $this->datatables->generate();
    }

    public function index()
    {
        $bc   = [['link' => base_url(), 'page' => lang('home')], ['link' => '#', 'page' => lang('api_keys')]];
        $meta = ['page_title' => lang('api_keys'), 'bc' => $bc];
        $this->page_construct('api/index', $meta, $this->data);
    }
}
