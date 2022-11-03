<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Companies extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->methods['index_get']['limit'] = 500;
        $this->load->api_model('companies_api');
    }

    protected function setCompany($company)
    {
        $company->company = !empty($company->company) && $company->company != '-' ? $company->company : null;
        $company->person  = $company->name;
        if ($company->group_name == 'customer') {
            unset($company->id, $company->group_id, $company->group_name, $company->invoice_footer, $company->logo, $company->name);
        } elseif ($company->group_name == 'supplier') {
            unset($company->id, $company->group_id, $company->group_name, $company->invoice_footer, $company->logo, $company->customer_group_id, $company->customer_group_name, $company->deposit_amount, $company->payment_term, $company->price_group_id, $company->price_group_name, $company->award_points, $company->name);
        } elseif ($company->group_name == 'biller') {
            $company->logo = base_url('assets/uploads/logos/' . $company->logo);
            unset($company->id, $company->group_id, $company->group_name, $company->customer_group_id, $company->customer_group_name, $company->deposit_amount, $company->payment_term, $company->price_group_id, $company->price_group_name, $company->award_points, $company->name);
        }
        $company = (array) $company;
        ksort($company);
        return $company;
    }

    public function index_get()
    {
        $name = $this->get('name');

        $filters = [
            'name'     => $name,
            'include'  => $this->get('include') ? explode(',', $this->get('include')) : null,
            'group'    => $this->get('group') ? $this->get('group') : 'customer',
            'start'    => $this->get('start') && is_numeric($this->get('start')) ? $this->get('start') : 1,
            'limit'    => $this->get('limit') && is_numeric($this->get('limit')) ? $this->get('limit') : 10,
            'order_by' => $this->get('order_by') ? explode(',', $this->get('order_by')) : ['company', 'acs'],
        ];

        if ($name === null) {
            if ($companies = $this->companies_api->getCompanies($filters)) {
                $pr_data = [];
                foreach ($companies as $company) {
                    if (!empty($filters['include'])) {
                        foreach ($filters['include'] as $include) {
                            if ($include == 'user') {
                                $company->users = $this->companies_api->getCompanyUser($company->id);
                            }
                        }
                    }

                    $pr_data[] = $this->setCompany($company);
                }

                $data = [
                    'data'  => $pr_data,
                    'limit' => $filters['limit'],
                    'start' => $filters['start'],
                    'total' => $this->companies_api->countCompanies($filters),
                ];
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'message' => 'No company were found.',
                    'status'  => false,
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            if ($company = $this->companies_api->getCompany($filters)) {
                if (!empty($filters['include'])) {
                    foreach ($filters['include'] as $include) {
                        if ($include == 'user') {
                            $company->users = $this->companies_api->getCompanyUser($company->id);
                        }
                    }
                }

                $company = $this->setCompany($company);
                $this->set_response($company, REST_Controller::HTTP_OK);
            } else {
                $this->set_response([
                    'message' => 'Company could not be found for name ' . $name . '.',
                    'status'  => false,
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
}
