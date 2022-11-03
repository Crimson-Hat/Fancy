<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sales_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addDelivery($data = [])
    {
        if ($this->db->insert('deliveries', $data)) {
            if ($this->site->getReference('do') == $data['do_reference_no']) {
                $this->site->updateReference('do');
            }
            return true;
        }
        return false;
    }

    /* ----------------- Gift Cards --------------------- */

    public function addGiftCard($data = [], $ca_data = [], $sa_data = [])
    {
        if ($this->db->insert('gift_cards', $data)) {
            if (!empty($ca_data)) {
                $this->db->update('companies', ['award_points' => $ca_data['points']], ['id' => $ca_data['customer']]);
            } elseif (!empty($sa_data)) {
                $this->db->update('users', ['award_points' => $sa_data['points']], ['id' => $sa_data['user']]);
            }
            return true;
        }
        return false;
    }

    public function addOptionQuantity($option_id, $quantity)
    {
        if ($option = $this->getProductOptionByID($option_id)) {
            $nq = $option->quantity + $quantity;
            if ($this->db->update('product_variants', ['quantity' => $nq], ['id' => $option_id])) {
                return true;
            }
        }
        return false;
    }

    public function addPayment($data = [], $customer_id = null)
    {
        if ($this->db->insert('payments', $data)) {
            if ($this->site->getReference('pay') == $data['reference_no']) {
                $this->site->updateReference('pay');
            }
            $this->site->syncSalePayments($data['sale_id']);
            if ($data['paid_by'] == 'gift_card') {
                $gc = $this->site->getGiftCardByNO($data['cc_no']);
                $this->db->update('gift_cards', ['balance' => ($gc->balance - $data['amount'])], ['card_no' => $data['cc_no']]);
            } elseif ($customer_id && $data['paid_by'] == 'deposit') {
                $customer = $this->site->getCompanyByID($customer_id);
                $this->db->update('companies', ['deposit_amount' => ($customer->deposit_amount - $data['amount'])], ['id' => $customer_id]);
            }
            return true;
        }
        return false;
    }

    public function addSale($data = [], $items = [], $payment = [], $si_return = [], $attachments = [])
    {
        if (empty($si_return)) {
            $cost = $this->site->costing($items);
            // $this->sma->print_arrays($cost);
        }

        $this->db->trans_start();
        if ($this->db->insert('sales', $data)) {
            $sale_id = $this->db->insert_id();
            if ($this->site->getReference('so') == $data['reference_no']) {
                $this->site->updateReference('so');
            }
            foreach ($items as $item) {
                $item['sale_id'] = $sale_id;
                $this->db->insert('sale_items', $item);
                $sale_item_id = $this->db->insert_id();
                if ($data['sale_status'] == 'completed' && empty($si_return)) {
                    $item_costs = $this->site->item_costing($item);
                    foreach ($item_costs as $item_cost) {
                        if (isset($item_cost['date']) || isset($item_cost['pi_overselling'])) {
                            $item_cost['sale_item_id'] = $sale_item_id;
                            $item_cost['sale_id']      = $sale_id;
                            $item_cost['date']         = date('Y-m-d', strtotime($data['date']));
                            if (!isset($item_cost['pi_overselling'])) {
                                $this->db->insert('costing', $item_cost);
                            }
                        } else {
                            foreach ($item_cost as $ic) {
                                $ic['sale_item_id'] = $sale_item_id;
                                $ic['sale_id']      = $sale_id;
                                $ic['date']         = date('Y-m-d', strtotime($data['date']));
                                if (!isset($ic['pi_overselling'])) {
                                    $this->db->insert('costing', $ic);
                                }
                            }
                        }
                    }
                }
            }

            if (!empty($attachments)) {
                foreach ($attachments as $attachment) {
                    $attachment['subject_id']   = $sale_id;
                    $attachment['subject_type'] = 'sale';
                    $this->db->insert('attachments', $attachment);
                }
            }

            if ($data['sale_status'] == 'completed') {
                $this->site->syncPurchaseItems($cost);
            }

            if (!empty($si_return)) {
                foreach ($si_return as $return_item) {
                    $product = $this->site->getProductByID($return_item['product_id']);
                    if ($product->type == 'combo') {
                        $combo_items = $this->site->getProductComboItems($return_item['product_id'], $return_item['warehouse_id']);
                        foreach ($combo_items as $combo_item) {
                            $this->updateCostingAndPurchaseItem($return_item, $combo_item->id, ($return_item['quantity'] * $combo_item->qty));
                        }
                    } elseif ($product->type != 'service') {
                        $this->updateCostingAndPurchaseItem($return_item, $return_item['product_id'], $return_item['quantity']);
                    }
                }
                $this->db->update('sales', ['return_sale_ref' => $data['return_sale_ref'], 'surcharge' => $data['surcharge'], 'return_sale_total' => $data['grand_total'], 'return_id' => $sale_id], ['id' => $data['sale_id']]);
            }

            if ($data['payment_status'] == 'partial' || $data['payment_status'] == 'paid' && !empty($payment)) {
                if (empty($payment['reference_no'])) {
                    $payment['reference_no'] = $this->site->getReference('pay');
                }
                $payment['sale_id'] = $sale_id;
                if ($payment['paid_by'] == 'gift_card') {
                    $this->db->update('gift_cards', ['balance' => $payment['gc_balance']], ['card_no' => $payment['cc_no']]);
                    unset($payment['gc_balance']);
                    $this->db->insert('payments', $payment);
                } else {
                    if ($payment['paid_by'] == 'deposit') {
                        $customer = $this->site->getCompanyByID($data['customer_id']);
                        $this->db->update('companies', ['deposit_amount' => ($customer->deposit_amount - $payment['amount'])], ['id' => $customer->id]);
                    }
                    $this->db->insert('payments', $payment);
                }
                if ($this->site->getReference('pay') == $payment['reference_no']) {
                    $this->site->updateReference('pay');
                }
                $this->site->syncSalePayments($sale_id);
            }

            $this->site->syncQuantity($sale_id);
            $this->sma->update_award_points($data['grand_total'], $data['customer_id'], $data['created_by']);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            log_message('error', 'An errors has been occurred while adding the sale (Add:Sales_model.php)');
        } else {
            return $sale_id;
        }

        return false;
    }

    public function deleteDelivery($id)
    {
        $this->site->log('Delivery', ['model' => $this->getDeliveryByID($id)]);
        if ($this->db->delete('deliveries', ['id' => $id])) {
            return true;
        }
        return false;
    }

    public function deleteGiftCard($id)
    {
        $this->site->log('Gift card', ['model' => $this->site->getGiftCardByID($id)]);
        if ($this->db->delete('gift_cards', ['id' => $id])) {
            return true;
        }
        return false;
    }

    public function deletePayment($id)
    {
        $opay = $this->getPaymentByID($id);
        $this->site->log('Payment', ['model' => $opay]);
        if ($this->db->delete('payments', ['id' => $id])) {
            $this->site->syncSalePayments($opay->sale_id);
            if ($opay->paid_by == 'gift_card') {
                $gc = $this->site->getGiftCardByNO($opay->cc_no);
                $this->db->update('gift_cards', ['balance' => ($gc->balance + $opay->amount)], ['card_no' => $opay->cc_no]);
            } elseif ($opay->paid_by == 'deposit') {
                $sale     = $this->getInvoiceByID($opay->sale_id);
                $customer = $this->site->getCompanyByID($sale->customer_id);
                $this->db->update('companies', ['deposit_amount' => ($customer->deposit_amount + $opay->amount)], ['id' => $customer->id]);
            }
            return true;
        }
        return false;
    }

    public function deleteSale($id)
    {
        $this->db->trans_start();
        $sale_items = $this->resetSaleActions($id);
        $this->site->log('Sale', ['model' => $this->getInvoiceByID($id), 'items' => $sale_items]);
        if ($this->db->delete('sale_items', ['sale_id' => $id]) && $this->db->delete('sales', ['id' => $id]) && $this->db->delete('costing', ['sale_id' => $id])) {
            $this->db->delete('sales', ['sale_id' => $id]);
            $this->db->delete('payments', ['sale_id' => $id]);
            $this->site->syncQuantity(null, null, $sale_items);
        }
        $this->db->delete('attachments', ['subject_id' => $id, 'subject_type' => 'sale']);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            log_message('error', 'An errors has been occurred while adding the sale (Delete:Sales_model.php)');
        } else {
            return true;
        }
        return false;
    }

    public function getAllGCTopups($card_id)
    {
        $this->db->select("{$this->db->dbprefix('gift_card_topups')}.*, {$this->db->dbprefix('users')}.first_name, {$this->db->dbprefix('users')}.last_name, {$this->db->dbprefix('users')}.email")
        ->join('users', 'users.id=gift_card_topups.created_by', 'left')
        ->order_by('id', 'desc')->limit(10);
        $q = $this->db->get_where('gift_card_topups', ['card_id' => $card_id]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getAllInvoiceItems($sale_id, $return_id = null)
    {
        $this->db->select('sale_items.*, tax_rates.code as tax_code, tax_rates.name as tax_name, tax_rates.rate as tax_rate, products.image, products.details as details, product_variants.name as variant, products.hsn_code as hsn_code, products.second_name as second_name, products.unit as base_unit_id, units.code as base_unit_code')
            ->join('products', 'products.id=sale_items.product_id', 'left')
            ->join('product_variants', 'product_variants.id=sale_items.option_id', 'left')
            ->join('tax_rates', 'tax_rates.id=sale_items.tax_rate_id', 'left')
            ->join('units', 'units.id=products.unit', 'left')
            ->group_by('sale_items.id')
            ->order_by('id', 'asc');
        if ($sale_id && !$return_id) {
            $this->db->where('sale_id', $sale_id);
        } elseif ($return_id) {
            $this->db->where('sale_id', $return_id);
        }
        $q = $this->db->get('sale_items');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getAllInvoiceItemsWithDetails($sale_id)
    {
        $this->db->select('sale_items.*, products.details, product_variants.name as variant');
        $this->db->join('products', 'products.id=sale_items.product_id', 'left')
        ->join('product_variants', 'product_variants.id=sale_items.option_id', 'left')
        ->group_by('sale_items.id');
        $this->db->order_by('id', 'asc');
        $q = $this->db->get_where('sale_items', ['sale_id' => $sale_id]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getAllQuoteItems($quote_id)
    {
        $q = $this->db->get_where('quote_items', ['quote_id' => $quote_id]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getCostingLines($sale_item_id, $product_id, $sale_id = null)
    {
        if ($sale_id) {
            $this->db->where('sale_id', $sale_id);
        }
        $orderby = ($this->Settings->accounting_method == 1) ? 'asc' : 'desc';
        $this->db->order_by('id', $orderby);
        $q = $this->db->get_where('costing', ['sale_item_id' => $sale_item_id, 'product_id' => $product_id]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getDeliveryByID($id)
    {
        $q = $this->db->get_where('deliveries', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getDeliveryBySaleID($sale_id)
    {
        $q = $this->db->get_where('deliveries', ['sale_id' => $sale_id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getInvoiceByID($id)
    {
        $q = $this->db->get_where('sales', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getInvoicePayments($sale_id)
    {
        $this->db->order_by('id', 'asc');
        $q = $this->db->get_where('payments', ['sale_id' => $sale_id]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getItemByID($id)
    {
        $q = $this->db->get_where('sale_items', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }

        return false;
    }

    public function getItemRack($product_id, $warehouse_id)
    {
        $q = $this->db->get_where('warehouses_products', ['product_id' => $product_id, 'warehouse_id' => $warehouse_id], 1);
        if ($q->num_rows() > 0) {
            $wh = $q->row();
            return $wh->rack;
        }
        return false;
    }

    public function getPaymentByID($id)
    {
        $q = $this->db->get_where('payments', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getPaymentsForSale($sale_id)
    {
        $this->db->select('payments.date, payments.paid_by, payments.amount, payments.cc_no, payments.cheque_no, payments.reference_no, users.first_name, users.last_name, type')
            ->join('users', 'users.id=payments.created_by', 'left');
        $q = $this->db->get_where('payments', ['sale_id' => $sale_id]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getPaypalSettings()
    {
        $q = $this->db->get_where('paypal', ['id' => 1]);
        if ($q->num_rows() > 0) {
            return $q->row();
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

    public function getProductComboItems($pid, $warehouse_id = null)
    {
        $this->db->select('products.id as id, combo_items.item_code as code, combo_items.quantity as qty, products.name as name,products.type as type, warehouses_products.quantity as quantity')
            ->join('products', 'products.code=combo_items.item_code', 'left')
            ->join('warehouses_products', 'warehouses_products.product_id=products.id', 'left')
            ->group_by('combo_items.id');
        if ($warehouse_id) {
            $this->db->where('warehouses_products.warehouse_id', $warehouse_id);
        }
        $q = $this->db->get_where('combo_items', ['combo_items.product_id' => $pid]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }

    public function getProductNames($term, $warehouse_id, $pos = false, $limit = 5)
    {
        $wp = "( SELECT product_id, warehouse_id, quantity as quantity from {$this->db->dbprefix('warehouses_products')} ) FWP";

        $this->db->select('products.*, FWP.quantity as quantity, categories.id as category_id, categories.name as category_name', false)
            ->join($wp, 'FWP.product_id=products.id', 'left')
            // ->join('warehouses_products FWP', 'FWP.product_id=products.id', 'left')
            ->join('categories', 'categories.id=products.category_id', 'left')
            ->group_by('products.id');
        if ($this->Settings->overselling) {
            $this->db->where("({$this->db->dbprefix('products')}.name LIKE '%" . $term . "%' OR {$this->db->dbprefix('products')}.code LIKE '%" . $term . "%' OR  concat({$this->db->dbprefix('products')}.name, ' (', {$this->db->dbprefix('products')}.code, ')') LIKE '%" . $term . "%')");
        } else {
            $this->db->where("(products.track_quantity = 0 OR FWP.quantity > 0) AND FWP.warehouse_id = '" . $warehouse_id . "' AND "
                . "({$this->db->dbprefix('products')}.name LIKE '%" . $term . "%' OR {$this->db->dbprefix('products')}.code LIKE '%" . $term . "%' OR  concat({$this->db->dbprefix('products')}.name, ' (', {$this->db->dbprefix('products')}.code, ')') LIKE '%" . $term . "%')");
        }
        // $this->db->order_by('products.name ASC');
        if ($pos) {
            $this->db->where('hide_pos !=', 1);
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

    public function getProductOptions($product_id, $warehouse_id, $all = null)
    {
        $wpv = "( SELECT option_id, warehouse_id, quantity from {$this->db->dbprefix('warehouses_products_variants')} WHERE product_id = {$product_id}) FWPV";
        $this->db->select('product_variants.id as id, product_variants.name as name, product_variants.price as price, product_variants.quantity as total_quantity, FWPV.quantity as quantity', false)
            ->join($wpv, 'FWPV.option_id=product_variants.id', 'left')
            //->join('warehouses', 'warehouses.id=product_variants.warehouse_id', 'left')
            ->where('product_variants.product_id', $product_id)
            ->group_by('product_variants.id');

        if (!$this->Settings->overselling && !$all) {
            $this->db->where('FWPV.warehouse_id', $warehouse_id);
            $this->db->where('FWPV.quantity >', 0);
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

    public function getProductQuantity($product_id, $warehouse)
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

    public function getProductVariants($product_id)
    {
        $q = $this->db->get_where('product_variants', ['product_id' => $product_id]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
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

    public function getPurchaseItemByID($id)
    {
        $q = $this->db->get_where('purchase_items', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getPurchaseItems($purchase_id)
    {
        return $this->db->get_where('purchase_items', ['purchase_id' => $purchase_id])->result();
    }

    public function getTransferItems($transfer_id)
    {
        return $this->db->get_where('purchase_items', ['transfer_id' => $transfer_id])->result();
    }

    public function getQuoteByID($id)
    {
        $q = $this->db->get_where('quotes', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getReturnByID($id)
    {
        $q = $this->db->get_where('sales', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getReturnBySID($sale_id)
    {
        $q = $this->db->get_where('sales', ['sale_id' => $sale_id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getSaleCosting($sale_id)
    {
        $q = $this->db->get_where('costing', ['sale_id' => $sale_id]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getSaleItemByID($id)
    {
        $q = $this->db->get_where('sale_items', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getSkrillSettings()
    {
        $q = $this->db->get_where('skrill', ['id' => 1]);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getStaff()
    {
        if (!$this->Owner) {
            $this->db->where('group_id !=', 1);
        }
        $this->db->where('group_id !=', 3)->where('group_id !=', 4);
        $q = $this->db->get('users');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getTaxRateByName($name)
    {
        $q = $this->db->get_where('tax_rates', ['name' => $name], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getWarehouseProduct($pid, $wid)
    {
        $this->db->select($this->db->dbprefix('products') . '.*, ' . $this->db->dbprefix('warehouses_products') . '.quantity as quantity')
            ->join('warehouses_products', 'warehouses_products.product_id=products.id', 'left');
        $q = $this->db->get_where('products', ['warehouses_products.product_id' => $pid, 'warehouses_products.id' => $wid]);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getWarehouseProductQuantity($warehouse_id, $product_id)
    {
        $q = $this->db->get_where('warehouses_products', ['warehouse_id' => $warehouse_id, 'product_id' => $product_id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function resetSaleActions($id, $return_id = null, $check_return = null)
    {
        if ($sale = $this->getInvoiceByID($id)) {
            if ($check_return && $sale->sale_status == 'returned') {
                $this->session->set_flashdata('warning', lang('sale_x_action'));
                redirect($_SERVER['HTTP_REFERER'] ?? 'welcome');
            }
            if ($sale->sale_status == 'completed') {
                if ($costings = $this->getSaleCosting($id)) {
                    foreach ($costings as $costing) {
                        $pi = null;
                        if ($costing->purchase_id) {
                            $purchase_items = $this->getPurchaseItems($costing->purchase_id);
                            foreach ($purchase_items as $row) {
                                if ($row->product_id == $costing->product_id && $row->option_id == $costing->option_id) {
                                    $pi = $row;
                                }
                            }
                        } else if ($costing->transfer_id) {
                            $purchase_items = $this->getTransferItems($costing->transfer_id);
                            foreach ($purchase_items as $row) {
                                if ($row->product_id == $costing->product_id && $row->option_id == $costing->option_id) {
                                    $pi = $row;
                                }
                            }
                        }
                        if ($pi) {
                            $this->site->setPurchaseItem(['id' => $pi->id, 'product_id' => $pi->product_id, 'option_id' => $pi->option_id], $costing->quantity);
                        } else {
                            $pi = $this->site->getPurchasedItem(['product_id' => $costing->product_id, 'option_id' => $costing->option_id ? $costing->option_id : null, 'purchase_id' => null, 'transfer_id' => null, 'warehouse_id' => $sale->warehouse_id]);
                            $this->site->setPurchaseItem(['id' => $pi->id, 'product_id' => $pi->product_id, 'option_id' => $pi->option_id], $costing->quantity);
                        }
                    }
                    $this->db->delete('costing', ['id' => $costing->id]);
                }
                $items = $this->getAllInvoiceItems($id);
                $this->site->syncQuantity(null, null, $items);
                $this->sma->update_award_points($sale->grand_total, $sale->customer_id, $sale->created_by, true);
                return $items;
            }
        }
    }

    public function getPurchaseItemByPurchaseItemId($purchase_item_id)
    {
        return $this->db->get_where('purchase_items', ['id' => $purchase_item_id])->result();
    }

    public function getPurchaseItemsByPurchaseIdAndWarehouseId($purchase_id, $warehouse_id)
    {
        return $this->db->get_where('purchase_items', ['purchase_id' => $purchase_id, 'warehouse_id' => $warehouse_id])->result();
    }

    public function syncQuantity($sale_id)
    {
        if ($sale_items = $this->getAllInvoiceItems($sale_id)) {
            foreach ($sale_items as $item) {
                $this->site->syncProductQty($item->product_id, $item->warehouse_id);
                if (isset($item->option_id) && !empty($item->option_id)) {
                    $this->site->syncVariantQty($item->option_id, $item->warehouse_id);
                }
            }
        }
    }

    public function topupGiftCard($data = [], $card_data = null)
    {
        if ($this->db->insert('gift_card_topups', $data)) {
            $this->db->update('gift_cards', $card_data, ['id' => $data['card_id']]);
            return true;
        }
        return false;
    }

    public function updateCostingAndPurchaseItem($return_item, $product_id, $quantity)
    {
        $bln_quantity = $quantity;
        if ($costings = $this->getCostingLines($return_item['id'], $product_id)) {
            foreach ($costings as $costing) {
                if ($costing->quantity > $bln_quantity && $bln_quantity != 0) {
                    $qty = $costing->quantity                                                                                     - $bln_quantity;
                    $bln = $costing->quantity_balance && $costing->quantity_balance >= $bln_quantity ? $costing->quantity_balance - $bln_quantity : 0;
                    $this->db->update('costing', ['quantity' => $qty, 'quantity_balance' => $bln], ['id' => $costing->id]);
                    $bln_quantity = 0;
                    break;
                } elseif ($costing->quantity <= $bln_quantity && $bln_quantity != 0) {
                    $this->db->delete('costing', ['id' => $costing->id]);
                    $bln_quantity = ($bln_quantity - $costing->quantity);
                }
            }
        }
        $clause = ['product_id' => $product_id, 'warehouse_id' => $return_item['warehouse_id'], 'purchase_id' => null, 'transfer_id' => null, 'option_id' => $return_item['option_id']];
        $this->site->setPurchaseItem($clause, $quantity);
        $this->site->syncQuantity(null, null, null, $product_id);
    }

    public function updateDelivery($id, $data = [])
    {
        if ($this->db->update('deliveries', $data, ['id' => $id])) {
            return true;
        }
        return false;
    }

    public function updateGiftCard($id, $data = [])
    {
        $this->db->where('id', $id);
        if ($this->db->update('gift_cards', $data)) {
            return true;
        }
        return false;
    }

    public function updateOptionQuantity($option_id, $quantity)
    {
        if ($option = $this->getProductOptionByID($option_id)) {
            $nq = $option->quantity - $quantity;
            if ($this->db->update('product_variants', ['quantity' => $nq], ['id' => $option_id])) {
                return true;
            }
        }
        return false;
    }

    public function updatePayment($id, $data = [], $customer_id = null)
    {
        $opay = $this->getPaymentByID($id);
        if ($this->db->update('payments', $data, ['id' => $id])) {
            $this->site->syncSalePayments($data['sale_id']);
            if ($opay->paid_by == 'gift_card') {
                $gc = $this->site->getGiftCardByNO($opay->cc_no);
                $this->db->update('gift_cards', ['balance' => ($gc->balance + $opay->amount)], ['card_no' => $opay->cc_no]);
            } elseif ($opay->paid_by == 'deposit') {
                if (!$customer_id) {
                    $sale        = $this->getInvoiceByID($opay->sale_id);
                    $customer_id = $sale->customer_id;
                }
                $customer = $this->site->getCompanyByID($customer_id);
                $this->db->update('companies', ['deposit_amount' => ($customer->deposit_amount + $opay->amount)], ['id' => $customer->id]);
            }
            if ($data['paid_by'] == 'gift_card') {
                $gc = $this->site->getGiftCardByNO($data['cc_no']);
                $this->db->update('gift_cards', ['balance' => ($gc->balance - $data['amount'])], ['card_no' => $data['cc_no']]);
            } elseif ($customer_id && $data['paid_by'] == 'deposit') {
                $customer = $this->site->getCompanyByID($customer_id);
                $this->db->update('companies', ['deposit_amount' => ($customer->deposit_amount - $data['amount'])], ['id' => $customer_id]);
            }
            return true;
        }
        return false;
    }

    public function updateProductOptionQuantity($option_id, $warehouse_id, $quantity, $product_id)
    {
        if ($option = $this->getProductWarehouseOptionQty($option_id, $warehouse_id)) {
            $nq = $option->quantity - $quantity;
            if ($this->db->update('warehouses_products_variants', ['quantity' => $nq], ['option_id' => $option_id, 'warehouse_id' => $warehouse_id])) {
                $this->site->syncVariantQty($option_id, $warehouse_id);
                return true;
            }
        } else {
            $nq = 0 - $quantity;
            if ($this->db->insert('warehouses_products_variants', ['option_id' => $option_id, 'product_id' => $product_id, 'warehouse_id' => $warehouse_id, 'quantity' => $nq])) {
                $this->site->syncVariantQty($option_id, $warehouse_id);
                return true;
            }
        }
        return false;
    }

    public function updateSale($id, $data, $items = [], $attachments = [])
    {
        $this->db->trans_start();
        $this->resetSaleActions($id, false, true);
        if ($data['sale_status'] == 'completed') {
            $this->Settings->overselling = true;
            $cost                        = $this->site->costing($items, true);
        }
        // $this->sma->print_arrays($cost);

        if ($this->db->update('sales', $data, ['id' => $id]) && $this->db->delete('sale_items', ['sale_id' => $id]) && $this->db->delete('costing', ['sale_id' => $id])) {
            foreach ($items as $item) {
                $item['sale_id'] = $id;
                $this->db->insert('sale_items', $item);
                $sale_item_id = $this->db->insert_id();
                if ($data['sale_status'] == 'completed' && $this->site->getProductByID($item['product_id'])) {
                    $item_costs = $this->site->item_costing($item);
                    foreach ($item_costs as $item_cost) {
                        if (isset($item_cost['date']) || isset($item_cost['pi_overselling'])) {
                            $item_cost['sale_item_id'] = $sale_item_id;
                            $item_cost['sale_id']      = $id;
                            $item_cost['date']         = date('Y-m-d', strtotime($data['date']));
                            if (!isset($item_cost['pi_overselling'])) {
                                $this->db->insert('costing', $item_cost);
                            }
                        } else {
                            foreach ($item_cost as $ic) {
                                $ic['sale_item_id'] = $sale_item_id;
                                $ic['sale_id']      = $id;
                                $item_cost['date']  = date('Y-m-d', strtotime($data['date']));
                                if (!isset($ic['pi_overselling'])) {
                                    $this->db->insert('costing', $ic);
                                }
                            }
                        }
                    }
                }
            }

            if (!empty($attachments)) {
                foreach ($attachments as $attachment) {
                    $attachment['subject_id']   = $id;
                    $attachment['subject_type'] = 'sale';
                    $this->db->insert('attachments', $attachment);
                }
            }

            if ($data['sale_status'] == 'completed') {
                $this->site->syncPurchaseItems($cost);
            }

            $this->site->syncSalePayments($id);
            $this->site->syncQuantity($id);
            $sale = $this->getInvoiceByID($id);
            $this->sma->update_award_points($data['grand_total'], $data['customer_id'], $sale->created_by);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            log_message('error', 'An errors has been occurred while adding the sale (Update:Sales_model.php)');
        } else {
            return true;
        }
        return false;
    }

    public function updateStatus($id, $status, $note)
    {
        $this->db->trans_start();
        $sale  = $this->getInvoiceByID($id);
        $items = $this->getAllInvoiceItems($id);
        $cost  = [];

        if ($status == 'completed' && $sale->sale_status != 'completed') {
            foreach ($items as $item) {
                $items_array[] = (array) $item;
            }
            $cost = $this->site->costing($items_array);
        }
        if ($status != 'completed' && $sale->sale_status == 'completed') {
            $this->resetSaleActions($id);
        }

        if ($this->db->update('sales', ['sale_status' => $status, 'note' => $note], ['id' => $id])) {
            if ($status == 'completed' && $sale->sale_status != 'completed') {
                $this->db->delete('costing', ['sale_id' => $id]);
                foreach ($items as $item) {
                    $item = (array) $item;
                    if ($this->site->getProductByID($item['product_id'])) {
                        $item_costs = $this->site->item_costing($item);
                        foreach ($item_costs as $item_cost) {
                            if (isset($item_cost['date']) || isset($item_cost['pi_overselling'])) {
                                $item_cost['sale_item_id'] = $item['id'];
                                $item_cost['sale_id']      = $id;
                                $item_cost['date']         = date('Y-m-d', strtotime($sale->date));
                                if (!isset($item_cost['pi_overselling'])) {
                                    $this->db->insert('costing', $item_cost);
                                }
                            } else {
                                foreach ($item_cost as $ic) {
                                    $ic['sale_item_id'] = $item['id'];
                                    $ic['sale_id']      = $id;
                                    $ic['date']         = date('Y-m-d', strtotime($sale->date));
                                    if (!isset($ic['pi_overselling'])) {
                                        $this->db->insert('costing', $ic);
                                    }
                                }
                            }
                        }
                    }
                }
                if (!empty($cost)) {
                    $this->site->syncPurchaseItems($cost);
                }
                $this->site->syncQuantity($id);
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            log_message('error', 'An errors has been occurred while adding the sale (UpdataStatus:Sales_model.php)');
        } else {
            return true;
        }
        return false;
    }
}
