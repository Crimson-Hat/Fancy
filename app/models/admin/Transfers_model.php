<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transfers_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addTransfer($data = [], $items = [], $attachments = [])
    {
        $this->db->trans_start();
        $status = $data['status'];
        if ($this->db->insert('transfers', $data)) {
            $transfer_id = $this->db->insert_id();
            if ($this->site->getReference('to') == $data['transfer_no']) {
                $this->site->updateReference('to');
            }
            foreach ($items as $item) {
                $item['transfer_id'] = $transfer_id;
                $item['option_id']   = !empty($item['option_id']) && is_numeric($item['option_id']) ? $item['option_id'] : null;
                if ($status == 'completed') {
                    $item['date']         = date('Y-m-d');
                    $item['warehouse_id'] = $data['to_warehouse_id'];
                    $item['status']       = 'received';
                    $this->db->insert('purchase_items', $item);
                } else {
                    $this->db->insert('transfer_items', $item);
                }

                if (!empty($attachments)) {
                    foreach ($attachments as $attachment) {
                        $attachment['subject_id']   = $transfer_id;
                        $attachment['subject_type'] = 'transfer';
                        $this->db->insert('attachments', $attachment);
                    }
                }

                if ($status == 'sent' || $status == 'completed') {
                    $this->syncTransderdItem($item['product_id'], $data['from_warehouse_id'], $item['quantity'], $item['option_id']);
                }
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            log_message('error', 'An errors has been occurred while adding the sale (Add:Transfers_model.php)');
        } else {
            return true;
        }
        return false;
    }

    public function deleteTransfer($id)
    {
        $this->db->trans_start();
        $ostatus = $this->resetTransferActions($id, 1);
        $oitems  = $this->getAllTransferItems($id, $ostatus);
        $this->site->log('Transfer', ['model' => $this->getTransferByID($id), 'items' => $oitems]);
        $tbl = $ostatus == 'completed' ? 'purchase_items' : 'transfer_items';
        if ($this->db->delete('transfers', ['id' => $id]) && $this->db->delete($tbl, ['transfer_id' => $id])) {
            foreach ($oitems as $item) {
                $this->site->syncQuantity(null, null, null, $item->product_id);
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            log_message('error', 'An errors has been occurred while adding the sale (Delete:Transfers_model.php)');
        } else {
            return true;
        }
        return false;
    }

    public function getAllTransferItems($transfer_id, $status)
    {
        if ($status == 'completed') {
            $this->db->select('purchase_items.*, product_variants.name as variant, products.unit, products.hsn_code as hsn_code, products.second_name as second_name')
                ->from('purchase_items')
                ->join('products', 'products.id=purchase_items.product_id', 'left')
                ->join('product_variants', 'product_variants.id=purchase_items.option_id', 'left')
                ->group_by('purchase_items.id')
                ->where('transfer_id', $transfer_id);
        } else {
            $this->db->select('transfer_items.*, product_variants.name as variant, products.unit, products.hsn_code as hsn_code, products.second_name as second_name')
                ->from('transfer_items')
                ->join('products', 'products.id=transfer_items.product_id', 'left')
                ->join('product_variants', 'product_variants.id=transfer_items.option_id', 'left')
                ->group_by('transfer_items.id')
                ->where('transfer_id', $transfer_id);
        }
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getProductByCategoryID($id)
    {
        $q = $this->db->get_where('products', ['category_id' => $id], 1);
        if ($q->num_rows() > 0) {
            return true;
        }

        return false;
    }

    public function getProductByCode($code)
    {
        $q = $this->db->get_where('products', ['code' => $code], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }

        return false;
    }

    public function getProductByName($name)
    {
        $q = $this->db->get_where('products', ['name' => $name], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }

        return false;
    }

    public function getProductComboItems($pid, $warehouse_id)
    {
        $this->db->select('products.id as id, combo_items.item_code as code, combo_items.quantity as qty, products.name as name, warehouses_products.quantity as quantity')
            ->join('products', 'products.code=combo_items.item_code', 'left')
            ->join('warehouses_products', 'warehouses_products.product_id=products.id', 'left')
            ->where('warehouses_products.warehouse_id', $warehouse_id)
            ->group_by('combo_items.id');
        $q = $this->db->get_where('combo_items', ['combo_items.product_id' => $pid]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }

    public function getProductNames($term, $warehouse_id, $limit = 5)
    {
        $this->db->select('products.id, code, name, warehouses_products.quantity, cost, tax_rate, type, unit, purchase_unit, tax_method')
            ->join('warehouses_products', 'warehouses_products.product_id=products.id', 'left')
            ->group_by('products.id');
        if ($this->Settings->overselling) {
            $this->db->where("type = 'standard' AND (name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR  concat(name, ' (', code, ')') LIKE '%" . $term . "%')");
        } else {
            $this->db->where("type = 'standard' AND warehouses_products.warehouse_id = '" . $warehouse_id . "' AND warehouses_products.quantity > 0 AND "
                . "(name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR  concat(name, ' (', code, ')') LIKE '%" . $term . "%')");
        }
        $this->db->limit($limit);
        $q = $this->db->get('products');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getProductOptionByID($id)
    {
        $q = $this->db->get_where('product_variants', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getProductOptions($product_id, $warehouse_id, $zero_check = true)
    {
        $this->db->select('product_variants.id as id, product_variants.name as name, product_variants.cost as cost, product_variants.quantity as total_quantity, warehouses_products_variants.quantity as quantity')
            ->join('warehouses_products_variants', 'warehouses_products_variants.option_id=product_variants.id', 'left')
            ->where('product_variants.product_id', $product_id)
            ->where('warehouses_products_variants.warehouse_id', $warehouse_id)
            ->group_by('product_variants.id');
        if ($zero_check) {
            $this->db->where('warehouses_products_variants.quantity >', 0);
        }
        $q = $this->db->get('product_variants');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getProductQuantity($product_id, $warehouse = DEFAULT_WAREHOUSE)
    {
        $q = $this->db->get_where('warehouses_products', ['product_id' => $product_id, 'warehouse_id' => $warehouse], 1);
        if ($q->num_rows() > 0) {
            return $q->row_array(); //$q->row();
        }
        return false;
    }

    public function getProductVariantByName($name, $product_id)
    {
        $q = $this->db->get_where('product_variants', ['name' => $name, 'product_id' => $product_id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getProductWarehouseOptionQty($option_id, $warehouse_id)
    {
        $q = $this->db->get_where('warehouses_products_variants', ['option_id' => $option_id, 'warehouse_id' => $warehouse_id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getTransferByID($id)
    {
        $q = $this->db->get_where('transfers', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }

        return false;
    }

    public function getWarehouseProduct($warehouse_id, $product_id, $variant_id)
    {
        if ($variant_id) {
            return $this->getProductWarehouseOptionQty($variant_id, $warehouse_id);
        }
        return $this->getWarehouseProductQuantity($warehouse_id, $product_id);
    }

    public function getWarehouseProductQuantity($warehouse_id, $product_id)
    {
        $q = $this->db->get_where('warehouses_products', ['warehouse_id' => $warehouse_id, 'product_id' => $product_id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getWHProduct($id)
    {
        $this->db->select('products.id, code, name, warehouses_products.quantity, cost, tax_rate')
            ->join('warehouses_products', 'warehouses_products.product_id=products.id', 'left')
            ->group_by('products.id');
        $q = $this->db->get_where('products', ['warehouses_products.product_id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }

        return false;
    }

    public function insertQuantity($product_id, $warehouse_id, $quantity)
    {
        if ($this->db->insert('warehouses_products', ['product_id' => $product_id, 'warehouse_id' => $warehouse_id, 'quantity' => $quantity])) {
            $this->site->syncProductQty($product_id, $warehouse_id);
            return true;
        }
        return false;
    }

    public function resetTransferActions($id, $delete = null)
    {
        $otransfer = $this->getTransferByID($id);
        $oitems    = $this->getAllTransferItems($id, $otransfer->status);
        $ostatus   = $otransfer->status;
        if ($ostatus == 'sent' || $ostatus == 'completed') {
            foreach ($oitems as $item) {
                $option_id = (isset($item->option_id) && !empty($item->option_id)) ? $item->option_id : null;
                $clause    = ['purchase_id' => null, 'transfer_id' => null, 'product_id' => $item->product_id, 'warehouse_id' => $otransfer->from_warehouse_id, 'option_id' => $option_id];
                $this->site->setPurchaseItem($clause, $item->quantity);
                if ($delete) {
                    $option_id = (isset($item->option_id) && !empty($item->option_id)) ? $item->option_id : null;
                    $clause    = ['purchase_id' => null, 'transfer_id' => null, 'product_id' => $item->product_id, 'warehouse_id' => $otransfer->to_warehouse_id, 'option_id' => $option_id];
                    $this->site->setPurchaseItem($clause, ($item->quantity_balance - $item->quantity));
                }
            }
        }
        return $ostatus;
    }

    public function syncTransderdItem($product_id, $warehouse_id, $quantity, $option_id = null)
    {
        if ($pis = $this->site->getPurchasedItems($product_id, $warehouse_id, $option_id)) {
            $balance_qty = $quantity;
            foreach ($pis as $pi) {
                if ($balance_qty <= $quantity && $quantity > 0) {
                    if ($pi->quantity_balance >= $quantity) {
                        $balance_qty = $pi->quantity_balance - $quantity;
                        $this->db->update('purchase_items', ['quantity_balance' => $balance_qty], ['id' => $pi->id]);
                        $quantity = 0;
                    } elseif ($quantity > 0) {
                        $quantity    = $quantity - $pi->quantity_balance;
                        $balance_qty = $quantity;
                        $this->db->update('purchase_items', ['quantity_balance' => 0], ['id' => $pi->id]);
                    }
                }
                if ($quantity == 0) {
                    break;
                }
            }
        } else {
            $clause = ['purchase_id' => null, 'transfer_id' => null, 'product_id' => $product_id, 'warehouse_id' => $warehouse_id, 'option_id' => $option_id];
            $this->site->setPurchaseItem($clause, (0 - $quantity));
        }
        $this->site->syncQuantity(null, null, null, $product_id);
    }

    public function updateQuantity($product_id, $warehouse_id, $quantity)
    {
        if ($this->db->update('warehouses_products', ['quantity' => $quantity], ['product_id' => $product_id, 'warehouse_id' => $warehouse_id])) {
            $this->site->syncProductQty($product_id, $warehouse_id);
            return true;
        }
        return false;
    }

    public function updateStatus($id, $status, $note)
    {
        $this->db->trans_start();
        $ostatus  = $this->resetTransferActions($id);
        $transfer = $this->getTransferByID($id);
        $items    = $this->getAllTransferItems($id, $transfer->status);
        if ($this->db->update('transfers', ['status' => $status, 'note' => $note], ['id' => $id])) {
            $tbl = $ostatus == 'completed' ? 'purchase_items' : 'transfer_items';
            $this->db->delete($tbl, ['transfer_id' => $id]);

            foreach ($items as $item) {
                $item                = (array) $item;
                $item['transfer_id'] = $id;
                $item['option_id']   = !empty($item['option_id']) && is_numeric($item['option_id']) ? $item['option_id'] : null;
                unset($item['id'], $item['variant'], $item['unit'], $item['hsn_code'], $item['second_name']);
                if ($status == 'completed') {
                    $item['date']         = date('Y-m-d');
                    $item['warehouse_id'] = $transfer->to_warehouse_id;
                    $item['status']       = 'received';
                    $this->db->insert('purchase_items', $item);
                } else {
                    $this->db->insert('transfer_items', $item);
                }

                if ($status == 'sent' || $status == 'completed') {
                    $this->syncTransderdItem($item['product_id'], $transfer->from_warehouse_id, $item['quantity'], $item['option_id']);
                } else {
                    $this->site->syncQuantity(null, null, null, $item['product_id']);
                }
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            log_message('error', 'An errors has been occurred while adding the sale (UpdateStatus:Transfers_model.php)');
        } else {
            return true;
        }
        return false;
    }

    public function updateTransfer($id, $data = [], $items = [], $attachments = [])
    {
        $this->db->trans_start();
        $ostatus = $this->resetTransferActions($id);
        $status  = $data['status'];
        if ($this->db->update('transfers', $data, ['id' => $id])) {
            $tbl = $ostatus == 'completed' ? 'purchase_items' : 'transfer_items';
            $this->db->delete($tbl, ['transfer_id' => $id]);

            foreach ($items as $item) {
                $item['transfer_id'] = $id;
                $item['option_id']   = !empty($item['option_id']) && is_numeric($item['option_id']) ? $item['option_id'] : null;
                if ($status == 'completed') {
                    $item['date']         = date('Y-m-d');
                    $item['warehouse_id'] = $data['to_warehouse_id'];
                    $item['status']       = 'received';
                    $this->db->insert('purchase_items', $item);
                } else {
                    $this->db->insert('transfer_items', $item);
                }

                if ($data['status'] == 'sent' || $data['status'] == 'completed') {
                    $this->syncTransderdItem($item['product_id'], $data['from_warehouse_id'], $item['quantity'], $item['option_id']);
                }
            }

            if (!empty($attachments)) {
                foreach ($attachments as $attachment) {
                    $attachment['subject_id']   = $id;
                    $attachment['subject_type'] = 'transfer';
                    $this->db->insert('attachments', $attachment);
                }
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            log_message('error', 'An errors has been occurred while adding the sale (Update:Transfers_model.php)');
        } else {
            return true;
        }

        return false;
    }
}
