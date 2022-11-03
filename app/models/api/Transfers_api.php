<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transfers_api extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function countTransfers($filters = [], $ref = null)
    {
        if ($filters['start_date']) {
            $this->db->where('date >=', $filters['start_date']);
        }
        if ($filters['end_date']) {
            $this->db->where('date <=', $filters['end_date']);
        }
        $this->db->from('transfers');
        return $this->db->count_all_results();
    }

    public function getProductVariantByID($id)
    {
        return $this->db->get_where('product_variants', ['id' => $id], 1)->row();
    }

    public function getTransfer($filters)
    {
        if (!empty($transfers = $this->getTransfers($filters))) {
            return array_values($transfers)[0];
        }
        return false;
    }

    public function getTransferItems($transfer_id, $status)
    {
        $table = ($status == 'completed') ? 'purchase_items' : 'transfer_items';
        return $this->db->get_where($table, ['transfer_id' => $transfer_id])->result();
    }

    public function getTransfers($filters = [])
    {
        if ($filters['start_date']) {
            $this->db->where('date >=', $filters['start_date']);
        }
        if ($filters['end_date']) {
            $this->db->where('date <=', $filters['end_date']);
        }
        if ($filters['reference']) {
            $this->db->where('reference_no', $filters['reference']);
        } else {
            $this->db->order_by($filters['order_by'][0], $filters['order_by'][1] ? $filters['order_by'][1] : 'desc');
            $this->db->limit($filters['limit'], ($filters['start'] - 1));
        }

        return $this->db->get('transfers')->result();
    }

    public function getUser($id)
    {
        $uploads_url = base_url('assets/uploads/');
        $this->db->select("CONCAT('{$uploads_url}', avatar) as avatar_url, email, first_name, gender, id, last_name, username");
        return $this->db->get_where('users', ['id' => $id], 1)->row();
    }

    public function getWarehouseByID($id)
    {
        return $this->db->get_where('warehouses', ['id' => $id], 1)->row();
    }
}
