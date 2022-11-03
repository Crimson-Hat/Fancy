<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Quotes_api extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function countQuotes($filters = [], $ref = null)
    {
        if ($filters['customer']) {
            $this->db->where('customer', $filters['customer']);
        }
        if ($filters['customer_id']) {
            $this->db->where('customer_id', $filters['customer_id']);
        }
        if ($filters['start_date']) {
            $this->db->where('date >=', $filters['start_date']);
        }
        if ($filters['end_date']) {
            $this->db->where('date <=', $filters['end_date']);
        }
        $this->db->from('quotes');
        return $this->db->count_all_results();
    }

    public function getProductVariantByID($id)
    {
        return $this->db->get_where('product_variants', ['id' => $id], 1)->row();
    }

    public function getQuote($filters)
    {
        if (!empty($quotes = $this->getQuotes($filters))) {
            return array_values($quotes)[0];
        }
        return false;
    }

    public function getQuoteItems($quote_id)
    {
        return $this->db->get_where('quote_items', ['quote_id' => $quote_id])->result();
    }

    public function getQuotes($filters = [])
    {
        if ($filters['customer']) {
            $this->db->where('customer', $filters['customer']);
        }
        if ($filters['customer_id']) {
            $this->db->where('customer_id', $filters['customer_id']);
        }
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

        return $this->db->get('quotes')->result();
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
