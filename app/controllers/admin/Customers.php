<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customers extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            $this->sma->md('login');
        }
        if ($this->Customer || $this->Supplier) {
            $this->session->set_flashdata('warning', lang('access_denied'));
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->lang->admin_load('customers', $this->Settings->user_language);
        $this->load->library('form_validation');
        $this->load->admin_model('companies_model');
    }

    public function add()
    {
        $this->sma->checkPermissions(false, true);

        $this->form_validation->set_rules('email', lang('email_address'), 'is_unique[companies.email]');

        if ($this->form_validation->run('companies/add') == true) {
            $cg   = $this->site->getCustomerGroupByID($this->input->post('customer_group'));
            $pg   = $this->site->getPriceGroupByID($this->input->post('price_group'));
            $data = [
                'name'                => $this->input->post('name'),
                'email'               => $this->input->post('email'),
                'group_id'            => '3',
                'group_name'          => 'customer',
                'customer_group_id'   => $this->input->post('customer_group'),
                'customer_group_name' => $cg->name,
                'price_group_id'      => $this->input->post('price_group') ? $this->input->post('price_group') : null,
                'price_group_name'    => $this->input->post('price_group') ? $pg->name : null,
                'company'             => $this->input->post('company'),
                'address'             => $this->input->post('address'),
                'vat_no'              => $this->input->post('vat_no'),
                'city'                => $this->input->post('city'),
                'state'               => $this->input->post('state'),
                'postal_code'         => $this->input->post('postal_code'),
                'country'             => $this->input->post('country'),
                'phone'               => $this->input->post('phone'),
                'cf1'                 => $this->input->post('cf1'),
                'cf2'                 => $this->input->post('cf2'),
                'cf3'                 => $this->input->post('cf3'),
                'cf4'                 => $this->input->post('cf4'),
                'cf5'                 => $this->input->post('cf5'),
                'cf6'                 => $this->input->post('cf6'),
                'gst_no'              => $this->input->post('gst_no'),
            ];
        } elseif ($this->input->post('add_customer')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('customers');
        }

        if ($this->form_validation->run() == true && $cid = $this->companies_model->addCompany($data)) {
            $this->session->set_flashdata('message', lang('customer_added'));
            $ref = isset($_SERVER['HTTP_REFERER']) ? explode('?', $_SERVER['HTTP_REFERER']) : null;
            admin_redirect($ref[0] . '?customer=' . $cid);
        } else {
            $this->data['error']           = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['modal_js']        = $this->site->modal_js();
            $this->data['customer_groups'] = $this->companies_model->getAllCustomerGroups();
            $this->data['price_groups']    = $this->companies_model->getAllPriceGroups();
            $this->load->view($this->theme . 'customers/add', $this->data);
        }
    }

    public function add_address($company_id = null)
    {
        $this->sma->checkPermissions('add', true);
        $company = $this->companies_model->getCompanyByID($company_id);

        $this->form_validation->set_rules('line1', lang('line1'), 'required');
        $this->form_validation->set_rules('city', lang('city'), 'required');
        $this->form_validation->set_rules('state', lang('state'), 'required');
        $this->form_validation->set_rules('country', lang('country'), 'required');
        $this->form_validation->set_rules('phone', lang('phone'), 'required');

        if ($this->form_validation->run() == true) {
            $data = [
                'line1'       => $this->input->post('line1'),
                'line2'       => $this->input->post('line2'),
                'city'        => $this->input->post('city'),
                'postal_code' => $this->input->post('postal_code'),
                'state'       => $this->input->post('state'),
                'country'     => $this->input->post('country'),
                'phone'       => $this->input->post('phone'),
                'company_id'  => $company->id,
            ];
        } elseif ($this->input->post('add_address')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('customers');
        }

        if ($this->form_validation->run() == true && $this->companies_model->addAddress($data)) {
            $this->session->set_flashdata('message', lang('address_added'));
            admin_redirect('customers');
        } else {
            $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['company']  = $company;
            $this->load->view($this->theme . 'customers/add_address', $this->data);
        }
    }

    public function add_deposit($company_id = null)
    {
        $this->sma->checkPermissions('deposits', true);

        if ($this->input->get('id')) {
            $company_id = $this->input->get('id');
        }
        $company = $this->companies_model->getCompanyByID($company_id);

        if ($this->Owner || $this->Admin) {
            $this->form_validation->set_rules('date', lang('date'), 'required');
        }
        $this->form_validation->set_rules('amount', lang('amount'), 'required|numeric');

        if ($this->form_validation->run() == true) {
            if ($this->Owner || $this->Admin) {
                $date = $this->sma->fld(trim($this->input->post('date')));
            } else {
                $date = date('Y-m-d H:i:s');
            }
            $data = [
                'date'       => $date,
                'amount'     => $this->input->post('amount'),
                'paid_by'    => $this->input->post('paid_by'),
                'note'       => $this->input->post('note'),
                'company_id' => $company->id,
                'created_by' => $this->session->userdata('user_id'),
            ];

            $cdata = [
                'deposit_amount' => ($company->deposit_amount + $this->input->post('amount')),
            ];
        } elseif ($this->input->post('add_deposit')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('customers');
        }

        if ($this->form_validation->run() == true && $this->companies_model->addDeposit($data, $cdata)) {
            $this->session->set_flashdata('message', lang('deposit_added'));
            admin_redirect('customers');
        } else {
            $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['company']  = $company;
            $this->load->view($this->theme . 'customers/add_deposit', $this->data);
        }
    }

    public function add_user($company_id = null)
    {
        $this->sma->checkPermissions(false, true);

        if ($this->input->get('id')) {
            $company_id = $this->input->get('id');
        }
        $company = $this->companies_model->getCompanyByID($company_id);

        $this->form_validation->set_rules('email', lang('email_address'), 'is_unique[users.email]');
        $this->form_validation->set_rules('password', lang('password'), 'required|min_length[8]|max_length[20]|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', lang('confirm_password'), 'required');

        if ($this->form_validation->run('companies/add_user') == true) {
            $active                  = $this->input->post('status');
            $notify                  = $this->input->post('notify');
            list($username, $domain) = explode('@', $this->input->post('email'));
            $email                   = strtolower($this->input->post('email'));
            $password                = $this->input->post('password');
            $additional_data         = [
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'phone'      => $this->input->post('phone'),
                'gender'     => $this->input->post('gender'),
                'company_id' => $company->id,
                'company'    => $company->company,
                'group_id'   => 3,
            ];
            $this->load->library('ion_auth');
        } elseif ($this->input->post('add_user')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('customers');
        }

        if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data, $active, $notify)) {
            $this->session->set_flashdata('message', lang('user_added'));
            admin_redirect('customers');
        } else {
            $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['company']  = $company;
            $this->load->view($this->theme . 'customers/add_user', $this->data);
        }
    }

    public function addresses($company_id = null)
    {
        $this->sma->checkPermissions('index', true);
        $this->data['modal_js']  = $this->site->modal_js();
        $this->data['company']   = $this->companies_model->getCompanyByID($company_id);
        $this->data['addresses'] = $this->companies_model->getCompanyAddresses($company_id);
        $this->load->view($this->theme . 'customers/addresses', $this->data);
    }

    public function customer_actions()
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
                        if (!$this->companies_model->deleteCustomer($id)) {
                            $error = true;
                        }
                    }
                    if ($error) {
                        $this->session->set_flashdata('warning', lang('customers_x_deleted_have_sales'));
                    } else {
                        $this->session->set_flashdata('message', lang('customers_deleted'));
                    }
                    redirect($_SERVER['HTTP_REFERER']);
                }

                if ($this->input->post('form_action') == 'export_excel') {
                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('customer'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('company'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('name'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('email'));
                    $this->excel->getActiveSheet()->SetCellValue('D1', lang('phone'));
                    $this->excel->getActiveSheet()->SetCellValue('E1', lang('address'));
                    $this->excel->getActiveSheet()->SetCellValue('F1', lang('city'));
                    $this->excel->getActiveSheet()->SetCellValue('G1', lang('state'));
                    $this->excel->getActiveSheet()->SetCellValue('H1', lang('postal_code'));
                    $this->excel->getActiveSheet()->SetCellValue('I1', lang('country'));
                    $this->excel->getActiveSheet()->SetCellValue('J1', lang('vat_no'));
                    $this->excel->getActiveSheet()->SetCellValue('K1', lang('gst_no'));
                    $this->excel->getActiveSheet()->SetCellValue('L1', lang('scf1'));
                    $this->excel->getActiveSheet()->SetCellValue('M1', lang('scf2'));
                    $this->excel->getActiveSheet()->SetCellValue('N1', lang('scf3'));
                    $this->excel->getActiveSheet()->SetCellValue('O1', lang('scf4'));
                    $this->excel->getActiveSheet()->SetCellValue('P1', lang('scf5'));
                    $this->excel->getActiveSheet()->SetCellValue('Q1', lang('scf6'));
                    $this->excel->getActiveSheet()->SetCellValue('R1', lang('deposit_amount'));

                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $customer = $this->site->getCompanyByID($id);
                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $customer->company);
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $customer->name);
                        $this->excel->getActiveSheet()->SetCellValue('C' . $row, $customer->email);
                        $this->excel->getActiveSheet()->SetCellValue('D' . $row, $customer->phone);
                        $this->excel->getActiveSheet()->SetCellValue('E' . $row, $customer->address);
                        $this->excel->getActiveSheet()->SetCellValue('F' . $row, $customer->city);
                        $this->excel->getActiveSheet()->SetCellValue('G' . $row, $customer->state);
                        $this->excel->getActiveSheet()->SetCellValue('H' . $row, $customer->postal_code);
                        $this->excel->getActiveSheet()->SetCellValue('I' . $row, $customer->country);
                        $this->excel->getActiveSheet()->SetCellValue('J' . $row, $customer->vat_no);
                        $this->excel->getActiveSheet()->SetCellValue('K' . $row, $customer->gst_no);
                        $this->excel->getActiveSheet()->SetCellValue('L' . $row, $customer->cf1);
                        $this->excel->getActiveSheet()->SetCellValue('M' . $row, $customer->cf2);
                        $this->excel->getActiveSheet()->SetCellValue('N' . $row, $customer->cf3);
                        $this->excel->getActiveSheet()->SetCellValue('O' . $row, $customer->cf4);
                        $this->excel->getActiveSheet()->SetCellValue('P' . $row, $customer->cf5);
                        $this->excel->getActiveSheet()->SetCellValue('Q' . $row, $customer->cf6);
                        $this->excel->getActiveSheet()->SetCellValue('R' . $row, $customer->deposit_amount);
                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical('center');
                    $filename = 'customers_' . date('Y_m_d_H_i_s');
                    $this->load->helper('excel');
                    create_excel($this->excel, $filename);
                }
            } else {
                $this->session->set_flashdata('error', lang('no_customer_selected'));
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

        if ($this->input->get('id') == 1 || $id == 1) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('customer_x_deleted')]);
        }

        if ($this->companies_model->deleteCustomer($id)) {
            $this->sma->send_json(['error' => 0, 'msg' => lang('customer_deleted')]);
        } else {
            $this->sma->send_json(['error' => 1, 'msg' => lang('customer_x_deleted_have_sales')]);
        }
    }

    public function delete_address($id)
    {
        $this->sma->checkPermissions('delete', true);
        if (!$id) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('id_not_found')]);
        }

        if ($this->companies_model->deleteAddress($id)) {
            $this->session->set_flashdata('message', lang('address_deleted'));
            admin_redirect('customers');
        }
    }

    public function delete_deposit($id)
    {
        $this->sma->checkPermissions(null, true);
        if (!$id) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('id_not_found')]);
        }
        if ($this->companies_model->deleteDeposit($id)) {
            $this->sma->send_json(['error' => 0, 'msg' => lang('deposit_deleted')]);
        }
    }

    public function deposit_note($id = null)
    {
        $this->sma->checkPermissions('deposits', true);
        $deposit                  = $this->companies_model->getDepositByID($id);
        $this->data['customer']   = $this->companies_model->getCompanyByID($deposit->company_id);
        $this->data['deposit']    = $deposit;
        $this->data['page_title'] = $this->lang->line('deposit_note');
        $this->load->view($this->theme . 'customers/deposit_note', $this->data);
    }

    public function deposits($company_id = null)
    {
        $this->sma->checkPermissions(false, true);

        if ($this->input->get('id')) {
            $company_id = $this->input->get('id');
        }

        $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $this->data['modal_js'] = $this->site->modal_js();
        $this->data['company']  = $this->companies_model->getCompanyByID($company_id);
        $this->load->view($this->theme . 'customers/deposits', $this->data);
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
            $cg   = $this->site->getCustomerGroupByID($this->input->post('customer_group'));
            $pg   = $this->site->getPriceGroupByID($this->input->post('price_group'));
            $data = [
                'name'                => $this->input->post('name'),
                'email'               => $this->input->post('email'),
                'group_id'            => '3',
                'group_name'          => 'customer',
                'customer_group_id'   => $this->input->post('customer_group'),
                'customer_group_name' => $cg->name,
                'price_group_id'      => $this->input->post('price_group') ? $this->input->post('price_group') : null,
                'price_group_name'    => $this->input->post('price_group') ? $pg->name : null,
                'company'             => $this->input->post('company'),
                'address'             => $this->input->post('address'),
                'vat_no'              => $this->input->post('vat_no'),
                'city'                => $this->input->post('city'),
                'state'               => $this->input->post('state'),
                'postal_code'         => $this->input->post('postal_code'),
                'country'             => $this->input->post('country'),
                'phone'               => $this->input->post('phone'),
                'cf1'                 => $this->input->post('cf1'),
                'cf2'                 => $this->input->post('cf2'),
                'cf3'                 => $this->input->post('cf3'),
                'cf4'                 => $this->input->post('cf4'),
                'cf5'                 => $this->input->post('cf5'),
                'cf6'                 => $this->input->post('cf6'),
                'award_points'        => $this->input->post('award_points'),
                'gst_no'              => $this->input->post('gst_no'),
            ];
        } elseif ($this->input->post('edit_customer')) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }

        if ($this->form_validation->run() == true && $this->companies_model->updateCompany($id, $data)) {
            $this->session->set_flashdata('message', lang('customer_updated'));
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->data['customer']        = $company_details;
            $this->data['error']           = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['modal_js']        = $this->site->modal_js();
            $this->data['customer_groups'] = $this->companies_model->getAllCustomerGroups();
            $this->data['price_groups']    = $this->companies_model->getAllPriceGroups();
            $this->load->view($this->theme . 'customers/edit', $this->data);
        }
    }

    public function edit_address($id = null)
    {
        $this->sma->checkPermissions('edit', true);

        $this->form_validation->set_rules('line1', lang('line1'), 'required');
        $this->form_validation->set_rules('city', lang('city'), 'required');
        $this->form_validation->set_rules('state', lang('state'), 'required');
        $this->form_validation->set_rules('country', lang('country'), 'required');
        $this->form_validation->set_rules('phone', lang('phone'), 'required');

        if ($this->form_validation->run() == true) {
            $data = [
                'line1'       => $this->input->post('line1'),
                'line2'       => $this->input->post('line2'),
                'city'        => $this->input->post('city'),
                'postal_code' => $this->input->post('postal_code'),
                'state'       => $this->input->post('state'),
                'country'     => $this->input->post('country'),
                'phone'       => $this->input->post('phone'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];
        } elseif ($this->input->post('edit_address')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('customers');
        }

        if ($this->form_validation->run() == true && $this->companies_model->updateAddress($id, $data)) {
            $this->session->set_flashdata('message', lang('address_updated'));
            admin_redirect('customers');
        } else {
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['address']  = $this->companies_model->getAddressByID($id);
            $this->load->view($this->theme . 'customers/edit_address', $this->data);
        }
    }

    public function edit_deposit($id = null)
    {
        $this->sma->checkPermissions('deposits', true);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }
        $deposit = $this->companies_model->getDepositByID($id);
        $company = $this->companies_model->getCompanyByID($deposit->company_id);

        if ($this->Owner || $this->Admin) {
            $this->form_validation->set_rules('date', lang('date'), 'required');
        }
        $this->form_validation->set_rules('amount', lang('amount'), 'required|numeric');

        if ($this->form_validation->run() == true) {
            if ($this->Owner || $this->Admin) {
                $date = $this->sma->fld(trim($this->input->post('date')));
            } else {
                $date = $deposit->date;
            }
            $data = [
                'date'       => $date,
                'amount'     => $this->input->post('amount'),
                'paid_by'    => $this->input->post('paid_by'),
                'note'       => $this->input->post('note'),
                'company_id' => $deposit->company_id,
                'updated_by' => $this->session->userdata('user_id'),
                'updated_at' => $date = date('Y-m-d H:i:s'),
            ];

            $cdata = [
                'deposit_amount' => (($company->deposit_amount - $deposit->amount) + $this->input->post('amount')),
            ];
        } elseif ($this->input->post('edit_deposit')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('customers');
        }

        if ($this->form_validation->run() == true && $this->companies_model->updateDeposit($id, $data, $cdata)) {
            $this->session->set_flashdata('message', lang('deposit_updated'));
            admin_redirect('customers');
        } else {
            $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['company']  = $company;
            $this->data['deposit']  = $deposit;
            $this->load->view($this->theme . 'customers/edit_deposit', $this->data);
        }
    }

    public function get_award_points($id = null)
    {
        $this->sma->checkPermissions('index');
        $row = $this->companies_model->getCompanyByID($id);
        $this->sma->send_json(['ca_points' => $row->award_points]);
    }

    public function get_customer_details($id = null)
    {
        $this->sma->send_json($this->companies_model->getCompanyByID($id));
    }

    public function get_deposits($company_id = null)
    {
        $this->sma->checkPermissions('deposits');
        $this->load->library('datatables');
        $this->datatables
            ->select("deposits.id as id, date, amount, paid_by, CONCAT({$this->db->dbprefix('users')}.first_name, ' ', {$this->db->dbprefix('users')}.last_name) as created_by", false)
            ->from('deposits')
            ->join('users', 'users.id=deposits.created_by', 'left')
            ->where($this->db->dbprefix('deposits') . '.company_id', $company_id)
            ->add_column('Actions', "<div class=\"text-center\"><a class=\"tip\" title='" . lang('deposit_note') . "' href='" . admin_url('customers/deposit_note/$1') . "' data-toggle='modal' data-target='#myModal2'><i class=\"fa fa-file-text-o\"></i></a> <a class=\"tip\" title='" . lang('edit_deposit') . "' href='" . admin_url('customers/edit_deposit/$1') . "' data-toggle='modal' data-target='#myModal2'><i class=\"fa fa-edit\"></i></a> <a href='#' class='tip po' title='<b>" . lang('delete_deposit') . "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('customers/delete_deposit/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>", 'id')
        ->unset_column('id');
        echo $this->datatables->generate();
    }

    public function getCustomer($id = null)
    {
        // $this->sma->checkPermissions('index');
        $row = $this->companies_model->getCompanyByID($id);
        $this->sma->send_json([['id' => $row->id, 'text' => ($row->company && $row->company != '-' ? $row->company : $row->name)]]);
    }

    public function getCustomers()
    {
        $this->sma->checkPermissions('index');
        $this->load->library('datatables');
        $this->datatables
            ->select('id, company, name, email, phone, price_group_name, customer_group_name, vat_no, gst_no, deposit_amount, award_points')
            ->from('companies')
            ->where('group_name', 'customer')
            ->add_column('Actions', "<div class=\"text-center\"><a class=\"tip\" title='" . lang('list_deposits') . "' href='" . admin_url('customers/deposits/$1') . "' data-toggle='modal' data-target='#myModal'><i class=\"fa fa-money\"></i></a> <a class=\"tip\" title='" . lang('add_deposit') . "' href='" . admin_url('customers/add_deposit/$1') . "' data-toggle='modal' data-target='#myModal'><i class=\"fa fa-plus\"></i></a> <a class=\"tip\" title='" . lang('list_addresses') . "' href='" . admin_url('customers/addresses/$1') . "' data-toggle='modal' data-target='#myModal'><i class=\"fa fa-location-arrow\"></i></a> <a class=\"tip\" title='" . lang('list_users') . "' href='" . admin_url('customers/users/$1') . "' data-toggle='modal' data-target='#myModal'><i class=\"fa fa-users\"></i></a> <a class=\"tip\" title='" . lang('add_user') . "' href='" . admin_url('customers/add_user/$1') . "' data-toggle='modal' data-target='#myModal'><i class=\"fa fa-user-plus\"></i></a> <a class=\"tip\" title='" . lang('edit_customer') . "' href='" . admin_url('customers/edit/$1') . "' data-toggle='modal' data-target='#myModal'><i class=\"fa fa-edit\"></i></a> <a href='#' class='tip po' title='<b>" . lang('delete_customer') . "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('customers/delete/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>", 'id');
        //->unset_column('id');
        echo $this->datatables->generate();
    }

    public function import_csv()
    {
        $this->sma->checkPermissions('add', true);
        $this->load->helper('security');
        $this->form_validation->set_rules('csv_file', lang('upload_file'), 'xss_clean');

        if ($this->form_validation->run() == true) {
            if (DEMO) {
                $this->session->set_flashdata('warning', lang('disabled_in_demo'));
                redirect($_SERVER['HTTP_REFERER']);
            }

            if (isset($_FILES['csv_file'])) {
                $this->load->library('upload');

                $config['upload_path']   = 'files/';
                $config['allowed_types'] = 'csv';
                $config['max_size']      = '2000';
                $config['overwrite']     = false;
                $config['encrypt_name']  = true;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('csv_file')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect('customers');
                }

                $csv = $this->upload->file_name;

                $arrResult = [];
                $handle    = fopen('files/' . $csv, 'r');
                if ($handle) {
                    while (($row = fgetcsv($handle, 5001, ',')) !== false) {
                        $arrResult[] = $row;
                    }
                    fclose($handle);
                }
                $titles         = array_shift($arrResult);
                $rw             = 2;
                $updated        = '';
                $data           = [];
                $customer_group = $this->site->getCustomerGroupByID($this->Settings->customer_group);
                $price_group    = $this->site->getPriceGroupByID($this->Settings->price_group);
                foreach ($arrResult as $key => $value) {
                    $customer = [
                        'company'             => isset($value[0]) ? trim($value[0]) : '',
                        'name'                => isset($value[1]) ? trim($value[1]) : '',
                        'email'               => isset($value[2]) ? trim($value[2]) : '',
                        'phone'               => isset($value[3]) ? trim($value[3]) : '',
                        'address'             => isset($value[4]) ? trim($value[4]) : '',
                        'city'                => isset($value[5]) ? trim($value[5]) : '',
                        'state'               => isset($value[6]) ? trim($value[6]) : '',
                        'postal_code'         => isset($value[7]) ? trim($value[7]) : '',
                        'country'             => isset($value[8]) ? trim($value[8]) : '',
                        'vat_no'              => isset($value[9]) ? trim($value[9]) : '',
                        'gst_no'              => isset($value[10]) ? trim($value[10]) : '',
                        'cf1'                 => isset($value[11]) ? trim($value[11]) : '',
                        'cf2'                 => isset($value[12]) ? trim($value[12]) : '',
                        'cf3'                 => isset($value[13]) ? trim($value[13]) : '',
                        'cf4'                 => isset($value[14]) ? trim($value[14]) : '',
                        'cf5'                 => isset($value[15]) ? trim($value[15]) : '',
                        'cf6'                 => isset($value[16]) ? trim($value[16]) : '',
                        'group_id'            => 3,
                        'group_name'          => 'customer',
                        'customer_group_id'   => (!empty($customer_group)) ? $customer_group->id : null,
                        'customer_group_name' => (!empty($customer_group)) ? $customer_group->name : null,
                        'price_group_id'      => (!empty($price_group)) ? $price_group->id : null,
                        'price_group_name'    => (!empty($price_group)) ? $price_group->name : null,
                    ];
                    if (empty($customer['company']) || empty($customer['name']) || empty($customer['email'])) {
                        $this->session->set_flashdata('error', lang('company') . ', ' . lang('name') . ', ' . lang('email') . ' ' . lang('are_required') . ' (' . lang('line_no') . ' ' . $rw . ')');
                        admin_redirect('customers');
                    } else {
                        if ($this->Settings->indian_gst && empty($customer['state'])) {
                            $this->session->set_flashdata('error', lang('state') . ' ' . lang('is_required') . ' (' . lang('line_no') . ' ' . $rw . ')');
                            admin_redirect('customers');
                        }
                        if ($customer_details = $this->companies_model->getCompanyByEmail($customer['email'])) {
                            if ($customer_details->group_id == 3) {
                                $updated .= '<p>' . lang('customer_updated') . ' (' . $customer['email'] . ')</p>';
                                $this->companies_model->updateCompany($customer_details->id, $customer);
                            }
                        } else {
                            $data[] = $customer;
                        }
                        $rw++;
                    }
                }

                // $this->sma->print_arrays($data, $updated);
            }
        } elseif ($this->input->post('import')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('customers');
        }

        if ($this->form_validation->run() == true && !empty($data)) {
            if ($this->companies_model->addCompanies($data)) {
                $this->session->set_flashdata('message', lang('customers_added') . $updated);
                admin_redirect('customers');
            }
        } else {
            if (isset($data) && empty($data)) {
                if ($updated) {
                    $this->session->set_flashdata('message', $updated);
                } else {
                    $this->session->set_flashdata('warning', lang('data_x_customers'));
                }
                admin_redirect('customers');
            }

            $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'customers/import', $this->data);
        }
    }

    public function index($action = null)
    {
        $this->sma->checkPermissions();

        $this->data['error']  = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['action'] = $action;
        $bc                   = [['link' => base_url(), 'page' => lang('home')], ['link' => '#', 'page' => lang('customers')]];
        $meta                 = ['page_title' => lang('customers'), 'bc' => $bc];
        $this->page_construct('customers/index', $meta, $this->data);
    }

    public function suggestions($term = null, $limit = null, $a = null)
    {
        // $this->sma->checkPermissions('index');
        if ($this->input->get('term')) {
            $term = $this->input->get('term', true);
        }
        if (strlen($term) < 1) {
            return false;
        }
        $term   = addslashes($term);
        $limit  = $this->input->get('limit', true);
        $result = $this->companies_model->getCustomerSuggestions($term, $limit);
        if ($a) {
            $this->sma->send_json($result);
        }
        $rows['results'] = $result;
        $this->sma->send_json($rows);
    }

    public function users($company_id = null)
    {
        $this->sma->checkPermissions(false, true);

        if ($this->input->get('id')) {
            $company_id = $this->input->get('id');
        }

        $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $this->data['modal_js'] = $this->site->modal_js();
        $this->data['company']  = $this->companies_model->getCompanyByID($company_id);
        $this->data['users']    = $this->companies_model->getCompanyUsers($company_id);
        $this->load->view($this->theme . 'customers/users', $this->data);
    }

    public function view($id = null)
    {
        $this->sma->checkPermissions('index', true);
        $this->data['error']    = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['customer'] = $this->companies_model->getCompanyByID($id);
        $this->load->view($this->theme . 'customers/view', $this->data);
    }
}
