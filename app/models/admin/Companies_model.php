<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Companies_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addAddress($data)
    {
        if ($this->db->insert('addresses', $data)) {
            return true;
        }
        return false;
    }

    public function addCompanies($data = [])
    {
        if ($this->db->insert_batch('companies', $data)) {
            return true;
        }
        return false;
    }

    public function addCompany($data = [])
    {
        if ($this->db->insert('companies', $data)) {
            $cid = $this->db->insert_id();
            return $cid;
        }
        return false;
    }

    public function addDeposit($data, $cdata)
    {
        if ($this->db->insert('deposits', $data) && $this->db->update('companies', $cdata, ['id' => $data['company_id']])) {
            return true;
        }
        return false;
    }

    public function deleteAddress($id)
    {
        if ($this->db->delete('addresses', ['id' => $id])) {
            return true;
        }
        return false;
    }

    public function deleteBiller($id)
    {
        if ($this->getBillerSales($id)) {
            return false;
        }
        $this->site->log('Biller', ['model' => $this->getCompanyByID($id)]);
        if ($this->db->delete('companies', ['id' => $id, 'group_name' => 'biller'])) {
            return true;
        }
        return false;
    }

    public function deleteCustomer($id)
    {
        if ($this->getCustomerSales($id)) {
            return false;
        }
        $this->site->log('Customer', ['model' => $this->getCompanyByID($id)]);
        if ($this->db->delete('companies', ['id' => $id, 'group_name' => 'customer']) && $this->db->delete('users', ['company_id' => $id])) {
            return true;
        }
        return false;
    }

    public function deleteDeposit($id)
    {
        $deposit = $this->getDepositByID($id);
        $company = $this->getCompanyByID($deposit->company_id);
        $cdata   = [
            'deposit_amount' => ($company->deposit_amount - $deposit->amount),
        ];
        if ($this->db->update('companies', $cdata, ['id' => $deposit->company_id]) && $this->db->delete('deposits', ['id' => $id])) {
            return true;
        }
        return false;
    }

    public function deleteSupplier($id)
    {
        if ($this->getSupplierPurchases($id)) {
            return false;
        }
        $this->site->log('Supplier', ['model' => $this->getCompanyByID($id)]);
        if ($this->db->delete('companies', ['id' => $id, 'group_name' => 'supplier']) && $this->db->delete('users', ['company_id' => $id])) {
            return true;
        }
        return false;
    }

    public function getAddressByID($id)
    {
        $q = $this->db->get_where('addresses', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getAllBillerCompanies()
    {
        $q = $this->db->get_where('companies', ['group_name' => 'biller']);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getAllCustomerCompanies()
    {
        $q = $this->db->get_where('companies', ['group_name' => 'customer']);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getAllCustomerGroups()
    {
        $q = $this->db->get('customer_groups');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getAllPriceGroups()
    {
        $q = $this->db->get('price_groups');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getAllSupplierCompanies()
    {
        $q = $this->db->get_where('companies', ['group_name' => 'supplier']);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getBillerSales($id)
    {
        $this->db->where('biller_id', $id)->from('sales');
        return $this->db->count_all_results();
    }

    public function getBillerSuggestions($term, $limit = 10)
    {
        $this->db->select('id, company as text');
        $this->db->where(" (id LIKE '%" . $term . "%' OR name LIKE '%" . $term . "%' OR company LIKE '%" . $term . "%') ");
        $q = $this->db->get_where('companies', ['group_name' => 'biller'], $limit);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
    }

    public function getCompanyAddresses($company_id)
    {
        $q = $this->db->get_where('addresses', ['company_id' => $company_id]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getCompanyByEmail($email)
    {
        $q = $this->db->get_where('companies', ['email' => $email], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getCompanyByID($id)
    {
        $q = $this->db->get_where('companies', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getCompanyUsers($company_id)
    {
        $q = $this->db->get_where('users', ['company_id' => $company_id]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getCustomerSales($id)
    {
        $this->db->where('customer_id', $id)->from('sales');
        return $this->db->count_all_results();
    }

    public function getCustomerSuggestions($term, $limit = 10)
    {
        $this->db->select("id, (CASE WHEN company = '-' THEN name ELSE CONCAT(company, ' (', name, ')') END) as text, (CASE WHEN company = '-' THEN name ELSE CONCAT(company, ' (', name, ')') END) as value, phone", false);
        $this->db->where(" (id LIKE '%" . $term . "%' OR name LIKE '%" . $term . "%' OR company LIKE '%" . $term . "%' OR email LIKE '%" . $term . "%' OR phone LIKE '%" . $term . "%' OR vat_no LIKE '%" . $term . "%') ");
        $q = $this->db->get_where('companies', ['group_name' => 'customer'], $limit);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
    }

    public function getDepositByID($id)
    {
        $q = $this->db->get_where('deposits', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getSupplierPurchases($id)
    {
        $this->db->where('supplier_id', $id)->from('purchases');
        return $this->db->count_all_results();
    }

    public function getSupplierSuggestions($term, $limit = 10)
    {
        $this->db->select("id, (CASE WHEN company = '-' THEN name ELSE CONCAT(company, ' (', name, ')') END) as text", false);
        $this->db->where(" (id LIKE '%" . $term . "%' OR name LIKE '%" . $term . "%' OR company LIKE '%" . $term . "%' OR email LIKE '%" . $term . "%' OR phone LIKE '%" . $term . "%' OR vat_no LIKE '%" . $term . "%') ");
        $q = $this->db->get_where('companies', ['group_name' => 'supplier'], $limit);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
    }

    public function updateAddress($id, $data)
    {
        if ($this->db->update('addresses', $data, ['id' => $id])) {
            return true;
        }
        return false;
    }

    public function updateCompany($id, $data = [])
    {
        $this->db->where('id', $id);
        if ($this->db->update('companies', $data)) {
            return true;
        }
        return false;
    }

    public function updateDeposit($id, $data, $cdata)
    {
        if ($this->db->update('deposits', $data, ['id' => $id]) && $this->db->update('companies', $cdata, ['id' => $data['company_id']])) {
            return true;
        }
        return false;
    }
}
