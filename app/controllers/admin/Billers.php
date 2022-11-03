<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Billers extends MY_Controller
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
        $this->lang->admin_load('billers', $this->Settings->user_language);
        $this->load->library('form_validation');
        $this->load->admin_model('companies_model');
    }

    public function add()
    {
        $this->sma->checkPermissions(false, true);

        $this->form_validation->set_rules('email', $this->lang->line('email_address'), 'is_unique[companies.email]');

        if ($this->form_validation->run('companies/add') == true) {
            $data = [
                'name'           => $this->input->post('name'),
                'email'          => $this->input->post('email'),
                'group_id'       => null,
                'group_name'     => 'biller',
                'company'        => $this->input->post('company'),
                'address'        => $this->input->post('address'),
                'vat_no'         => $this->input->post('vat_no'),
                'city'           => $this->input->post('city'),
                'state'          => $this->input->post('state'),
                'postal_code'    => $this->input->post('postal_code'),
                'country'        => $this->input->post('country'),
                'phone'          => $this->input->post('phone'),
                'logo'           => $this->input->post('logo'),
                'cf1'            => $this->input->post('cf1'),
                'cf2'            => $this->input->post('cf2'),
                'cf3'            => $this->input->post('cf3'),
                'cf4'            => $this->input->post('cf4'),
                'cf5'            => $this->input->post('cf5'),
                'cf6'            => $this->input->post('cf6'),
                'invoice_footer' => $this->input->post('invoice_footer'),
                'gst_no'         => $this->input->post('gst_no'),
            ];
        } elseif ($this->input->post('add_biller')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('billers');
        }

        if ($this->form_validation->run() == true && $this->companies_model->addCompany($data)) {
            $this->session->set_flashdata('message', $this->lang->line('biller_added'));
            admin_redirect('billers');
        } else {
            $this->data['logos']    = $this->getLogoList();
            $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'billers/add', $this->data);
        }
    }

    public function biller_actions()
    {
        if (!$this->Owner && !$this->GP['bulk_actions']) {
            $this->session->set_flashdata('warning', lang('access_denied'));
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    $this->sma->checkPermissions('delete');
                    $error = false;
                    foreach ($_POST['val'] as $id) {
                        if (!$this->companies_model->deleteBiller($id)) {
                            $error = true;
                        }
                    }
                    if ($error) {
                        $this->session->set_flashdata('warning', lang('billers_x_deleted_have_sales'));
                    } else {
                        $this->session->set_flashdata('message', $this->lang->line('billers_deleted'));
                    }
                    redirect($_SERVER['HTTP_REFERER']);
                }

                if ($this->input->post('form_action') == 'export_excel') {
                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('billers'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('company'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('name'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('phone'));
                    $this->excel->getActiveSheet()->SetCellValue('D1', lang('email'));
                    $this->excel->getActiveSheet()->SetCellValue('E1', lang('city'));

                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $customer = $this->site->getCompanyByID($id);
                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $customer->company);
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $customer->name);
                        $this->excel->getActiveSheet()->SetCellValue('C' . $row, $customer->phone);
                        $this->excel->getActiveSheet()->SetCellValue('D' . $row, $customer->email);
                        $this->excel->getActiveSheet()->SetCellValue('E' . $row, $customer->city);
                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical('center');
                    $filename = 'billers_' . date('Y_m_d_H_i_s');
                    $this->load->helper('excel');
                    create_excel($this->excel, $filename);
                }
            } else {
                $this->session->set_flashdata('error', $this->lang->line('no_biller_selected'));
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id = null)
    {
        $this->sma->checkPermissions(null, true);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }
        if (!$id) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('id_not_found')]);
        }

        if ($this->companies_model->deleteBiller($id)) {
            $this->sma->send_json(['error' => 0, 'msg' => lang('biller_deleted')]);
        } else {
            $this->sma->send_json(['error' => 1, 'msg' => lang('biller_x_deleted_have_sales')]);
        }
    }

    public function edit($id = null)
    {
        $this->sma->checkPermissions(false, true);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        $company_details = $this->companies_model->getCompanyByID($id);
        if ($this->input->post('email') != $company_details->email) {
            $this->form_validation->set_rules('code', lang('email_address'), 'is_unique[companies.email]');
        }

        if ($this->form_validation->run('companies/add') == true) {
            $data = [
                'name'           => $this->input->post('name'),
                'email'          => $this->input->post('email'),
                'group_id'       => null,
                'group_name'     => 'biller',
                'company'        => $this->input->post('company'),
                'address'        => $this->input->post('address'),
                'vat_no'         => $this->input->post('vat_no'),
                'city'           => $this->input->post('city'),
                'state'          => $this->input->post('state'),
                'postal_code'    => $this->input->post('postal_code'),
                'country'        => $this->input->post('country'),
                'phone'          => $this->input->post('phone'),
                'logo'           => $this->input->post('logo'),
                'cf1'            => $this->input->post('cf1'),
                'cf2'            => $this->input->post('cf2'),
                'cf3'            => $this->input->post('cf3'),
                'cf4'            => $this->input->post('cf4'),
                'cf5'            => $this->input->post('cf5'),
                'cf6'            => $this->input->post('cf6'),
                'invoice_footer' => $this->input->post('invoice_footer'),
                'gst_no'         => $this->input->post('gst_no'),
            ];
        } elseif ($this->input->post('edit_biller')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('billers');
        }

        if ($this->form_validation->run() == true && $this->companies_model->updateCompany($id, $data)) {
            $this->session->set_flashdata('message', $this->lang->line('biller_updated'));
            admin_redirect('billers');
        } else {
            $this->data['biller']   = $company_details;
            $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['logos']    = $this->getLogoList();
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'billers/edit', $this->data);
        }
    }

    public function getBiller($id = null)
    {
        $this->sma->checkPermissions('index');

        $row = $this->companies_model->getCompanyByID($id);
        $this->sma->send_json([['id' => $row->id, 'text' => $row->company]]);
    }

    public function getBillers()
    {
        $this->sma->checkPermissions('index');

        $this->load->library('datatables');
        $this->datatables
            ->select('id, company, name, vat_no, phone, email, city, country')
            ->from('companies')
            ->where('group_name', 'biller')
            ->add_column('Actions', "<div class=\"text-center\"><a class=\"tip\" title='" . $this->lang->line('edit_biller') . "' href='" . admin_url('billers/edit/$1') . "' data-toggle='modal' data-target='#myModal'><i class=\"fa fa-edit\"></i></a> <a href='#' class='tip po' title='<b>" . $this->lang->line('delete_biller') . "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('billers/delete/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>", 'id');
        //->unset_column('id');
        echo $this->datatables->generate();
    }

    public function getLogoList()
    {
        $this->load->helper('directory');
        $dirname = 'assets/uploads/logos';
        $ext     = ['jpg', 'png', 'jpeg', 'gif'];
        $files   = [];
        if ($handle = opendir($dirname)) {
            while (false !== ($file = readdir($handle))) {
                for ($i = 0; $i < sizeof($ext); $i++) {
                    if (stristr($file, '.' . $ext[$i])) { //NOT case sensitive: OK with JpeG, JPG, ecc.
                        $files[] = $file;
                    }
                }
            }
            closedir($handle);
        }
        sort($files);
        return $files;
    }

    public function index($action = null)
    {
        $this->sma->checkPermissions();

        $this->data['error']  = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['action'] = $action;
        $bc                   = [['link' => base_url(), 'page' => lang('home')], ['link' => '#', 'page' => lang('billers')]];
        $meta                 = ['page_title' => lang('billers'), 'bc' => $bc];
        $this->page_construct('billers/index', $meta, $this->data);
    }

    public function suggestions($term = null, $limit = null)
    {
        $this->sma->checkPermissions('index');

        if ($this->input->get('term')) {
            $term = $this->input->get('term', true);
        }
        $term            = addslashes($term);
        $limit           = $this->input->get('limit', true);
        $rows['results'] = $this->companies_model->getBillerSuggestions($term, $limit);
        $this->sma->send_json($rows);
    }
}
