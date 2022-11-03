<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Warehouses_api extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function countWarehouses($filters = [])
    {
        $this->db->from('warehouses');
        return $this->db->count_all_results();
    }

    public function getPriceGroupByID($id)
    {
        return $this->db->get_where('price_groups', ['id' => $id], 1)->row();
    }

    public function getWarehouse($filters)
    {
        if (!empty($warehouses = $this->getWarehouses($filters))) {
            return array_values($warehouses)[0];
        }
        return false;
    }

    public function getWarehouses($filters = [])
    {
        $uploads_url = base_url('assets/uploads/');
        $this->db->select("id, code, name, address, email, phone, CONCAT('{$uploads_url}', map) as map_url, price_group_id");

        if ($filters['code']) {
            $this->db->where('code', $filters['code']);
        } else {
            $this->db->order_by($filters['order_by'][0], $filters['order_by'][1] ? $filters['order_by'][1] : 'asc');
            $this->db->limit($filters['limit'], ($filters['start'] - 1));
        }

        return $this->db->get('warehouses')->result();
    }
}
