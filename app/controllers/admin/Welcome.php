<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }

        if ($this->Customer || $this->Supplier) {
            redirect('/');
        }

        $this->load->library('form_validation');
        $this->load->admin_model('db_model');
    }

    public function delete($id, $file)
    {
        $result = false;
        if ($this->Owner || $this->Admin) {
            $this->db->delete('attachments', ['id' => $id]);
            if (file_exists('./files/' . $file)) {
                unlink('./files/' . $file);
            }
            $result = true;
        }
        if ($this->input->is_ajax_request()) {
            $this->sma->send_json(['success' => $result, 'msg' => $result ? lang('file_deleted') : lang('file_delete_failed')]);
        } else {
            if ($result) {
                $this->session->set_flashdata('message', lang('file_deleted'));
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function download($file)
    {
        if (file_exists('./files/' . $file)) {
            $this->load->helper('download');
            force_download('./files/' . $file, null);
            exit();
        }
        $this->session->set_flashdata('error', lang('file_x_exist'));
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function hideNotification($id = null)
    {
        $this->session->set_userdata('hidden' . $id, 1);
        echo true;
    }

    public function image_upload()
    {
        if (DEMO) {
            $error = ['error' => $this->lang->line('disabled_in_demo')];
            $this->sma->send_json($error);
            exit;
        }
        $this->security->csrf_verify();
        if (isset($_FILES['file'])) {
            $this->load->library('upload');
            $config['upload_path']   = 'assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = '500';
            $config['max_width']     = $this->Settings->iwidth;
            $config['max_height']    = $this->Settings->iheight;
            $config['encrypt_name']  = true;
            $config['overwrite']     = false;
            $config['max_filename']  = 25;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')) {
                $error = $this->upload->display_errors();
                $error = ['error' => $error];
                $this->sma->send_json($error);
                exit;
            }
            $photo = $this->upload->file_name;
            $array = [
                'filelink' => base_url() . 'assets/uploads/images/' . $photo,
            ];
            echo stripslashes(json_encode($array));
            exit;
        }
        $error = ['error' => 'No file selected to upload!'];
        $this->sma->send_json($error);
        exit;
    }

    public function index()
    {
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            admin_redirect('sync');
        }

        $this->data['error']     = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $this->data['sales']     = $this->db_model->getLatestSales();
        $this->data['quotes']    = $this->db_model->getLastestQuotes();
        $this->data['purchases'] = $this->db_model->getLatestPurchases();
        $this->data['transfers'] = $this->db_model->getLatestTransfers();
        $this->data['customers'] = $this->db_model->getLatestCustomers();
        $this->data['suppliers'] = $this->db_model->getLatestSuppliers();
        $this->data['chatData']  = $this->db_model->getChartData();
        $this->data['stock']     = $this->db_model->getStockValue();
        $this->data['bs']        = $this->db_model->getBestSeller();
        $lmsdate                 = date('Y-m-d', strtotime('first day of last month')) . ' 00:00:00';
        $lmedate                 = date('Y-m-d', strtotime('last day of last month')) . ' 23:59:59';
        $this->data['lmbs']      = $this->db_model->getBestSeller($lmsdate, $lmedate);
        $bc                      = [['link' => '#', 'page' => lang('dashboard')]];
        $meta                    = ['page_title' => lang('dashboard'), 'bc' => $bc];
        $this->page_construct('dashboard', $meta, $this->data);
    }

    public function language($lang = false)
    {
        if ($this->input->get('lang')) {
            $lang = $this->input->get('lang');
        }
        //$this->load->helper('cookie');
        $folder        = 'app/language/';
        $languagefiles = scandir($folder);
        if (in_array($lang, $languagefiles)) {
            $cookie = [
                'name'   => 'language',
                'value'  => $lang,
                'expire' => '31536000',
                'prefix' => 'sma_',
                'secure' => false,
            ];
            $this->input->set_cookie($cookie);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function promotions()
    {
        $this->load->view($this->theme . 'promotions', $this->data);
    }

    public function set_data($ud, $value)
    {
        $this->session->set_userdata($ud, $value);
        echo true;
    }

    public function slug()
    {
        echo $this->sma->slug($this->input->get('title', true), $this->input->get('type', true));
        exit();
    }

    public function toggle_rtl()
    {
        $cookie = [
            'name'   => 'rtl_support',
            'value'  => $this->Settings->user_rtl == 1 ? 0 : 1,
            'expire' => '31536000',
            'prefix' => 'sma_',
            'secure' => false,
        ];
        $this->input->set_cookie($cookie);
        redirect($_SERVER['HTTP_REFERER']);
    }
}
