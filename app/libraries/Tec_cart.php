<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tec_cart
{
    public $cart_id = false;

    public $product_id_rules   = '\.a-z0-9_-';
    public $product_name_rules = '\s\S'; // '\w \-\.\:';
    public $product_name_safe  = true;
    protected $_cart_contents  = [];

    public function __construct($params = [])
    {
        $this->load->helper('cookie');
        if ($cart_id = get_cookie('cart_id', true)) {
            $this->cart_id        = $cart_id;
            $result               = $this->db->get_where('cart', ['id' => $this->cart_id])->row();
            $this->_cart_contents = $result ? json_decode($result->data, true) : null;
        } else {
            $this->_setup();
        }
        if (empty($this->_cart_contents)) {
            $this->_empty();
        }
    }

    protected function _insert($items = [])
    {
        if (!is_array($items) or count($items) === 0) {
            return false;
        }

        $items['name'] = htmlentities($items['name']);

        if (!isset($items['id'], $items['qty'], $items['name'])) {
            return false;
        }

        $items['qty'] = (float) $items['qty'];

        if ($items['qty'] == 0) {
            return false;
        }

        if (!preg_match('/^[' . $this->product_id_rules . ']+$/i', $items['id'])) {
            return false;
        }

        if ($this->product_name_safe && !preg_match('/^[' . $this->product_name_rules . ']+$/i' . (UTF8_ENABLED ? 'u' : ''), $items['name'])) {
            return false;
        }

        $items['price'] = (float) $items['price'];

        if (isset($items['options']) && count($items['options']) > 0) {
            $rowid = md5($items['id'] . serialize((array) $items['options']));
        } else {
            $rowid = md5($items['id']);
        }

        $old_quantity = isset($this->_cart_contents[$rowid]['qty']) ? (int) $this->_cart_contents[$rowid]['qty'] : 0;

        $items['rowid'] = $rowid;
        $items['qty'] += $old_quantity;
        $this->_cart_contents[$rowid] = $items;

        return $rowid;
    }

    protected function _save_cart()
    {
        $this->_cart_contents['cart_total']         = 0;
        $this->_cart_contents['total_items']        = 0;
        $this->_cart_contents['total_item_tax']     = 0;
        $this->_cart_contents['total_unique_items'] = 0;
        foreach ($this->_cart_contents as $key => $val) {
            if (!is_array($val) or !isset($val['price'], $val['qty'])) {
                continue;
            }

            $this->_cart_contents['total_unique_items'] += 1;
            $this->_cart_contents['total_items']        += $val['qty'];
            $this->_cart_contents['cart_total']         += $this->sma->formatDecimal(($val['price'] * $val['qty']), 4);
            $this->_cart_contents['total_item_tax']     += $this->sma->formatDecimal(($val['tax'] * $val['qty']), 4);
            $this->_cart_contents[$key]['row_tax']  = $this->sma->formatDecimal(($this->_cart_contents[$key]['tax'] * $this->_cart_contents[$key]['qty']), 4);
            $this->_cart_contents[$key]['subtotal'] = $this->sma->formatDecimal(($this->_cart_contents[$key]['price'] * $this->_cart_contents[$key]['qty']), 4);
        }

        if (count($this->_cart_contents) <= 4) {
            $this->db->delete('cart', ['id' => $this->cart_id]);
            return false;
        }

        if ($this->db->get_where('cart', ['id' => $this->cart_id])->num_rows() > 0) {
            return $this->db->update('cart', ['time' => time(), 'user_id' => $this->session->userdata('user_id'), 'data' => json_encode($this->_cart_contents)], ['id' => $this->cart_id]);
        } else {
            return $this->db->insert('cart', ['id' => $this->cart_id, 'time' => time(), 'user_id' => $this->session->userdata('user_id'), 'data' => json_encode($this->_cart_contents)]);
        }
    }

    protected function _update($items = [])
    {
        if (!isset($items['rowid'], $this->_cart_contents[$items['rowid']])) {
            return false;
        }

        if (isset($items['qty'])) {
            $items['qty'] = (float) $items['qty'];
            if ($items['qty'] == 0) {
                unset($this->_cart_contents[$items['rowid']]);
                return true;
            }
        }

        $keys = array_intersect(array_keys($this->_cart_contents[$items['rowid']]), array_keys($items));
        if (isset($items['price'])) {
            $items['price'] = (float) $items['price'];
        }

        foreach (array_diff($keys, ['id', 'name']) as $key) {
            $this->_cart_contents[$items['rowid']][$key] = $items[$key];
        }

        return true;
    }

    // Get cart with currency conversion
    public function cart_data($re = false)
    {
        $citems = $this->contents();
        foreach ($citems as &$value) {
            $value['price']    = $this->sma->convertMoney($value['price']);
            $value['subtotal'] = $this->sma->convertMoney($value['subtotal']);
            if ($this->has_options($value['rowid'])) {
                $value['options'] = $this->product_options($value['rowid']);
                foreach ($value['options'] as &$opt_value) {
                    $opt_value['price'] = $this->sma->convertMoney($opt_value['price']);
                }
            }
        }
        $total     = $this->sma->convertMoney($this->total(), false, false);
        $shipping  = $this->sma->convertMoney($this->shipping(), false, false);
        $order_tax = $this->sma->convertMoney($this->order_tax(), false, false);
        $cart      = [
            'total_items'        => $this->total_items(),
            'total_unique_items' => $this->total_items(true),
            'contents'           => $citems,
            'total_item_tax'     => $this->sma->convertMoney($this->total_item_tax()),
            'subtotal'           => $this->sma->convertMoney($this->total() - $this->total_item_tax()),
            'total'              => $this->sma->formatMoney($total, $this->selected_currency->symbol),
            'shipping'           => $this->sma->formatMoney($shipping, $this->selected_currency->symbol),
            'order_tax'          => $this->sma->formatMoney($order_tax, $this->selected_currency->symbol),
            'grand_total'        => $this->sma->formatMoney(($this->sma->formatDecimal($total) + $this->sma->formatDecimal($order_tax) + $this->sma->formatDecimal($shipping)), $this->selected_currency->symbol),
        ];

        if ($re) {
            return $cart;
        }

        $this->sma->send_json($cart);
    }

    public function cart_id()
    {
        return $this->cart_id;
    }

    public function contents($newest_first = false)
    {
        $cart = ($newest_first) ? array_reverse($this->_cart_contents) : $this->_cart_contents;
        unset($cart['total_items'], $cart['total_item_tax'], $cart['total_unique_items'], $cart['cart_total']);

        return $cart;
    }

    public function destroy()
    {
        $this->_empty();
        return $this->db->delete('cart', ['id' => $this->cart_id]);
    }

    public function get_item($row_id)
    {
        return (in_array($row_id, ['total_items', 'cart_total'], true) or !isset($this->_cart_contents[$row_id]))
        ? false
        : $this->_cart_contents[$row_id];
    }

    public function has_options($row_id = '')
    {
        return (isset($this->_cart_contents[$row_id]['options']) && count($this->_cart_contents[$row_id]['options']) !== 0);
    }

    public function insert($items = [])
    {
        if (!is_array($items) or count($items) === 0) {
            return false;
        }

        $save_cart = false;
        if (isset($items['id'])) {
            if (($rowid = $this->_insert($items))) {
                $save_cart = true;
            }
        } else {
            foreach ($items as $val) {
                if (is_array($val) && isset($val['id'])) {
                    if ($this->_insert($val)) {
                        $save_cart = true;
                    }
                }
            }
        }

        if ($save_cart === true) {
            $this->_save_cart();
            return isset($rowid) ? $rowid : true;
        }

        return false;
    }

    public function order_tax()
    {
        if (!empty($this->Settings->tax2)) {
            if ($order_tax_details = $this->site->getTaxRateByID($this->Settings->default_tax_rate2)) {
                if ($order_tax_details->type == 2 || $order_tax_details->rate == 0) {
                    $order_tax = $this->sma->formatDecimal($order_tax_details->rate, 4);
                } elseif ($order_tax_details->type == 1) {
                    $order_tax = $this->sma->formatDecimal(((($this->total()) * $order_tax_details->rate) / 100), 4);
                }
                return $order_tax;
            }
        }
        return 0;
    }

    public function product_options($row_id = '')
    {
        return isset($this->_cart_contents[$row_id]['options']) ? $this->_cart_contents[$row_id]['options'] : [];
    }

    public function remove($rowid)
    {
        unset($this->_cart_contents[$rowid]);
        $this->_save_cart();
        return true;
    }

    public function shipping()
    {
        return $this->sma->formatDecimal($this->shop_settings->shipping, 4);
    }

    public function total()
    {
        return $this->sma->formatDecimal($this->_cart_contents['cart_total'], 4);
    }

    public function total_item_tax()
    {
        return $this->sma->formatDecimal($this->_cart_contents['total_item_tax'], 4);
    }

    public function total_items($unique = false)
    {
        return $unique ? $this->_cart_contents['total_unique_items'] : $this->_cart_contents['total_items'];
    }

    public function update($items = [])
    {
        if (!is_array($items) or count($items) === 0) {
            return false;
        }

        $save_cart = false;
        if (isset($items['rowid'])) {
            if ($this->_update($items) === true) {
                $save_cart = true;
            }
        } else {
            foreach ($items as $val) {
                if (is_array($val) && isset($val['rowid'])) {
                    if ($this->_update($val) === true) {
                        $save_cart = true;
                    }
                }
            }
        }

        if ($save_cart === true) {
            $this->_save_cart();
            return true;
        }

        return false;
    }

    private function _empty()
    {
        $this->_cart_contents = ['cart_total' => 0, 'total_item_tax' => 0, 'total_items' => 0, 'total_unique_items' => 0];
    }

    private function _setup()
    {
        $this->load->helper('string');
        $val = md5(random_string('alnum', 16) . microtime());
        set_cookie('cart_id', $val, 2592000);
        return $this->cart_id = $val;
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }
}
