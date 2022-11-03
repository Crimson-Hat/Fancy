<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart_ajax extends MY_Shop_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->Settings->mmode) {
            redirect('notify/offline');
        }
        if ($this->shop_settings->hide_price) {
            redirect('/');
        }
        if ($this->shop_settings->private && !$this->loggedIn) {
            redirect('/login');
        }
    }

    public function add($product_id)
    {
        if ($this->input->is_ajax_request() || $this->input->post('quantity')) {
            $product = $this->shop_model->getProductForCart($product_id);
            $options = $this->shop_model->getProductVariants($product_id);
            $price   = $this->sma->setCustomerGroupPrice((isset($product->special_price) && !empty($product->special_price) ? $product->special_price : $product->price), $this->customer_group);
            $price   = $this->sma->isPromo($product) ? $product->promo_price : $price;
            $option  = false;
            if (!empty($options)) {
                if ($this->input->post('option')) {
                    foreach ($options as $op) {
                        if ($op['id'] == $this->input->post('option')) {
                            $option = $op;
                        }
                    }
                } else {
                    $option = array_values($options)[0];
                }
                $price = $option['price'] + $price;
            }
            $selected = $option ? $option['id'] : false;
            if (!$this->Settings->overselling && $this->checkProductStock($product, 1, $selected)) {
                if ($this->input->is_ajax_request()) {
                    $this->sma->send_json(['error' => 1, 'message' => lang('item_out_of_stock')]);
                } else {
                    $this->session->set_flashdata('error', lang('item_out_of_stock'));
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
            $tax_rate   = $this->site->getTaxRateByID($product->tax_rate);
            $ctax       = $this->site->calculateTax($product, $tax_rate, $price);
            $tax        = $this->sma->formatDecimal($ctax['amount']);
            $price      = $this->sma->formatDecimal($price);
            $unit_price = $this->sma->formatDecimal($product->tax_method ? $price + $tax : $price);
            $id         = $this->Settings->item_addition ? md5($product->id) : md5(microtime());

            $data = [
                'id'         => $id,
                'product_id' => $product->id,
                'qty'        => ($this->input->get('qty') ? $this->input->get('qty') : ($this->input->post('quantity') ? $this->input->post('quantity') : 1)),
                'name'       => $product->name,
                'slug'       => $product->slug,
                'code'       => $product->code,
                'price'      => $unit_price,
                'tax'        => $tax,
                'image'      => $product->image,
                'option'     => $selected,
                'options'    => !empty($options) ? $options : null,
            ];
            if ($this->cart->insert($data)) {
                if ($this->input->post('quantity')) {
                    $this->session->set_flashdata('message', lang('item_added_to_cart'));
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->cart->cart_data();
                }
            }
            $this->session->set_flashdata('error', lang('unable_to_add_item_to_cart'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function add_wishlist($product_id)
    {
        $this->session->set_userdata('requested_page', $_SERVER['HTTP_REFERER']);
        if (!$this->loggedIn) {
            $this->sma->send_json(['redirect' => site_url('login')]);
        }
        if ($this->shop_model->getWishlist(true) >= 10) {
            $this->sma->send_json(['status' => lang('warning'), 'message' => lang('max_wishlist'), 'level' => 'warning']);
        }
        if ($this->shop_model->addWishlist($product_id)) {
            $total = $this->shop_model->getWishlist(true);
            $this->sma->send_json(['status' => lang('success'), 'message' => lang('added_wishlist'), 'total' => $total]);
        } else {
            $this->sma->send_json(['status' => lang('info'), 'message' => lang('product_exists_in_wishlist'), 'level' => 'info']);
        }
    }

    public function checkout()
    {
        $this->session->set_userdata('requested_page', $this->uri->uri_string());
        if ($this->cart->total_items() < 1) {
            $this->session->set_flashdata('reminder', lang('cart_is_empty'));
            shop_redirect('products');
        }
        $this->data['paypal']     = $this->shop_model->getPaypalSettings();
        $this->data['skrill']     = $this->shop_model->getSkrillSettings();
        $this->data['addresses']  = $this->loggedIn ? $this->shop_model->getAddresses() : false;
        $this->data['page_title'] = lang('checkout');
        $this->page_construct('pages/checkout', $this->data);
    }

    public function destroy()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->cart->destroy()) {
                $this->session->set_flashdata('message', lang('cart_items_deleted'));
                $this->sma->send_json(['redirect' => base_url()]);
            } else {
                $this->sma->send_json(['status' => lang('error'), 'message' => lang('error_occured')]);
            }
        }
    }

    public function index()
    {
        $this->session->set_userdata('requested_page', $this->uri->uri_string());
        if ($this->cart->total_items() < 1) {
            $this->session->set_flashdata('reminder', lang('cart_is_empty'));
            shop_redirect('products');
        }
        $this->data['page_title'] = lang('shopping_cart');
        $this->page_construct('pages/cart', $this->data);
    }

    public function remove($rowid = null)
    {
        if ($rowid) {
            return $this->cart->remove($rowid);
        }
        if ($this->input->is_ajax_request()) {
            if ($rowid = $this->input->post('rowid', true)) {
                if ($this->cart->remove($rowid)) {
                    $this->sma->send_json(['cart' => $this->cart->cart_data(true), 'status' => lang('success'), 'message' => lang('cart_item_deleted')]);
                }
            }
        }
    }

    public function remove_wishlist($product_id)
    {
        $this->session->set_userdata('requested_page', $_SERVER['HTTP_REFERER']);
        if (!$this->loggedIn) {
            $this->sma->send_json(['redirect' => site_url('login')]);
        }
        if ($this->shop_model->removeWishlist($product_id)) {
            $total = $this->shop_model->getWishlist(true);
            $this->sma->send_json(['status' => lang('success'), 'message' => lang('removed_wishlist'), 'total' => $total]);
        } else {
            $this->sma->send_json(['status' => lang('error'), 'message' => lang('error_occured'), 'level' => 'error']);
        }
    }

    public function update($data = null)
    {
        if (is_array($data)) {
            return $this->cart->update($data);
        }
        if ($this->input->is_ajax_request()) {
            if ($rowid = $this->input->post('rowid', true)) {
                $item = $this->cart->get_item($rowid);
                // $product = $this->site->getProductByID($item['product_id']);
                $product = $this->shop_model->getProductForCart($item['product_id']);
                $options = $this->shop_model->getProductVariants($product->id);
                $price   = $this->sma->setCustomerGroupPrice((isset($product->special_price) ? $product->special_price : $product->price), $this->customer_group);
                $price   = $this->sma->isPromo($product) ? $product->promo_price : $price;
                // $price = $this->sma->isPromo($product) ? $product->promo_price : $product->price;
                if ($option = $this->input->post('option')) {
                    foreach ($options as $op) {
                        if ($op['id'] == $option) {
                            $price = $price + $op['price'];
                        }
                    }
                }
                $selected = $this->input->post('option') ? $this->input->post('option', true) : false;
                if ($this->checkProductStock($product, $this->input->post('qty', true), $selected)) {
                    if ($this->input->is_ajax_request()) {
                        $this->sma->send_json(['error' => 1, 'message' => lang('item_stock_is_less_then_order_qty')]);
                    } else {
                        $this->session->set_flashdata('error', lang('item_stock_is_less_then_order_qty'));
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }

                $tax_rate   = $this->site->getTaxRateByID($product->tax_rate);
                $ctax       = $this->site->calculateTax($product, $tax_rate, $price);
                $tax        = $this->sma->formatDecimal($ctax['amount']);
                $price      = $this->sma->formatDecimal($price);
                $unit_price = $this->sma->formatDecimal($product->tax_method ? $price + $tax : $price);

                $data = [
                    'rowid'  => $rowid,
                    'price'  => $price,
                    'tax'    => $tax,
                    'qty'    => $this->input->post('qty', true),
                    'option' => $selected,
                ];
                if ($this->cart->update($data)) {
                    $this->sma->send_json(['cart' => $this->cart->cart_data(true), 'status' => lang('success'), 'message' => lang('cart_updated')]);
                }
            }
        }
    }

    private function checkProductStock($product, $qty, $option_id = null)
    {
        if ($product->type == 'service' || $product->type == 'digital') {
            return false;
        }
        $chcek = [];
        if ($product->type == 'standard') {
            $quantity = 0;
            if ($pis = $this->site->getPurchasedItems($product->id, $this->shop_settings->warehouse, $option_id)) {
                foreach ($pis as $pi) {
                    $quantity += $pi->quantity_balance;
                }
            }
            $chcek[] = ($qty <= $quantity);
        } elseif ($product->type == 'combo') {
            $combo_items = $this->site->getProductComboItems($product->id, $this->shop_settings->warehouse);
            foreach ($combo_items as $combo_item) {
                if ($combo_item->type == 'standard') {
                    $quantity = 0;
                    if ($pis = $this->site->getPurchasedItems($combo_item->id, $this->shop_settings->warehouse, $option_id)) {
                        foreach ($pis as $pi) {
                            $quantity += $pi->quantity_balance;
                        }
                    }
                    $chcek[] = (($combo_item->qty * $qty) <= $quantity);
                }
            }
        }
        return empty($chcek) || in_array(false, $chcek);
    }
}
