<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Promos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addPromo($data = [])
    {
        if ($this->db->insert('promos', $data)) {
            $cid = $this->db->insert_id();
            return $cid;
        }
        return false;
    }

    public function addPromos($data = [])
    {
        if ($this->db->insert_batch('promos', $data)) {
            return true;
        }
        return false;
    }

    public function deletePromo($id)
    {
        if ($this->db->delete('promos', ['id' => $id])) {
            return true;
        }
        return false;
    }

    public function getAllPromos()
    {
        $q = $this->db->get('promos');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getPromoByID($id)
    {
        $q = $this->db->get_where('promos', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getPromosByProduct($pId)
    {
        $today = date('Y-m-d');
        $this->db
        ->group_start()->where('start_date <=', $today)->or_where('start_date IS NULL')->group_end()
        ->group_start()->where('end_date >=', $today)->or_where('end_date IS NULL')->group_end();
        $q = $this->db->get_where('promos', ['product2buy' => $pId]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function updatePromo($id, $data = [])
    {
        $this->db->where('id', $id);
        if ($this->db->update('promos', $data)) {
            return true;
        }
        return false;
    }
}
