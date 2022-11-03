<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shop_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addCustomer($data)
    {
        if ($this->db->insert('companies', $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function addSale($data, $items, $customer, $address)
    {
        $cost = $this->site->costing($items);
        // $this->sma->print_arrays($cost);

        if (is_array($customer) && !empty($customer)) {
            $this->db->insert('companies', $customer);
            $data['customer_id'] = $this->db->insert_id();
        }

        if (is_array($address) && !empty($address)) {
            $address['company_id'] = $data['customer_id'];
            $this->db->insert('addresses', $address);
            $data['address_id'] = $this->db->insert_id();
        }

        $this->db->trans_start();
        if ($this->db->insert('sales', $data)) {
            $sale_id = $this->db->insert_id();
            $this->site->updateReference('so');

            foreach ($items as $item) {
                $item['sale_id'] = $sale_id;
                $this->db->insert('sale_items', $item);
                $sale_item_id = $this->db->insert_id();
                if ($data['sale_status'] == 'completed') {
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

            // $this->site->syncQuantity($sale_id);
            $this->sma->update_award_points($data['grand_total'], $data['customer_id'], $data['created_by']);
            // return $sale_id;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            log_message('error', 'An errors has been occurred while adding the sale (Shop_model.php)');
        } else {
            return $sale_id;
        }

        return false;
    }

    public function addWishlist($product_id)
    {
        $user_id = $this->session->userdata('user_id');
        if (!$this->getWishlistItem($product_id, $user_id)) {
            return $this->db->insert('wishlist', ['product_id' => $product_id, 'user_id' => $user_id]);
        }
        return false;
    }

    public function getAddressByID($id)
    {
        return $this->db->get_where('addresses', ['id' => $id], 1)->row();
    }

    public function getAddresses()
    {
        return $this->db->get_where('addresses', ['company_id' => $this->session->userdata('company_id')])->result();
    }

    public function getAllBrands()
    {
        if ($this->shop_settings->hide0) {
            $pc = "(SELECT count(*) FROM {$this->db->dbprefix('products')} WHERE {$this->db->dbprefix('products')}.brand = {$this->db->dbprefix('brands')}.id)";
            $this->db->select("{$this->db->dbprefix('brands')}.*, {$pc} AS product_count", false)->order_by('name');
            $this->db->having('product_count >', 0);
        }
        return $this->db->get('brands')->result();
    }

    public function getAllCategories()
    {
        if ($this->shop_settings->hide0) {
            $pc = "(SELECT count(*) FROM {$this->db->dbprefix('products')} WHERE {$this->db->dbprefix('products')}.category_id = {$this->db->dbprefix('categories')}.id)";
            $this->db->select("{$this->db->dbprefix('categories')}.*, {$pc} AS product_count", false);
            $this->db->having('product_count >', 0);
        }
        $this->db->group_start()->where('parent_id', null)->or_where('parent_id', 0)->group_end()->order_by('name');
        return $this->db->get('categories')->result();
    }

    public function getAllCurrencies()
    {
        return $this->db->get('currencies')->result();
    }

    public function getAllPages()
    {
        $this->db->select('name, slug')->order_by('order_no asc');
        return $this->db->get_where('pages', ['active' => 1])->result();
    }

    public function getAllWarehouseWithPQ($product_id, $warehouse_id = null)
    {
        if (!$warehouse_id) {
            $warehouse_id = $this->shop_settings->warehouse;
        }
        $this->db->select('' . $this->db->dbprefix('warehouses') . '.*, ' . $this->db->dbprefix('warehouses_products') . '.quantity, ' . $this->db->dbprefix('warehouses_products') . '.rack')
            ->join('warehouses_products', 'warehouses_products.warehouse_id=warehouses.id', 'left')
            ->where('warehouses_products.product_id', $product_id)
            ->where('warehouses_products.warehouse_id', $warehouse_id)
            ->group_by('warehouses.id');
        return $this->db->get('warehouses')->row();
    }

    public function getBrandBySlug($slug)
    {
        return $this->db->get_where('brands', ['slug' => $slug], 1)->row();
    }

    public function getCategoryBySlug($slug)
    {
        return $this->db->get_where('categories', ['slug' => $slug], 1)->row();
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
        return $this->db->get_where('companies', ['id' => $id])->row();
    }

    public function getCurrencyByCode($code)
    {
        return $this->db->get_where('currencies', ['code' => $code], 1)->row();
    }

    public function getCustomerGroup($id)
    {
        return $this->db->get_where('customer_groups', ['id' => $id])->row();
    }

    public function getDateFormat($id)
    {
        return $this->db->get_where('date_format', ['id' => $id], 1)->row();
    }

    public function getDownloads($limit, $offset, $product_id = null)
    {
        if ($this->loggedIn) {
            $this->db->select("{$this->db->dbprefix('sale_items')}.product_id, {$this->db->dbprefix('sale_items')}.product_code, {$this->db->dbprefix('sale_items')}.product_name, {$this->db->dbprefix('sale_items')}.product_type")
            ->distinct()
            ->join('sale_items', 'sales.id=sale_items.sale_id', 'left')
            ->where('sales.sale_status', 'completed')->where('sales.payment_status', 'paid')
            ->where('sales.customer_id', $this->session->userdata('company_id'))
            ->where('sale_items.product_type', 'digital')
            ->order_by('sales.id', 'desc')->limit($limit, $offset);
            if ($product_id) {
                $this->db->where('sale_items.product_id', $product_id);
            }
            return $this->db->get('sales')->result();
        }
        return false;
    }

    public function getDownloadsCount()
    {
        $this->db->select("{$this->db->dbprefix('sale_items')}.product_id, {$this->db->dbprefix('sale_items')}.product_code, {$this->db->dbprefix('sale_items')}.product_name, {$this->db->dbprefix('sale_items')}.product_type")
        ->distinct()
            ->join('sale_items', 'sales.id=sale_items.sale_id', 'left')
            ->where('sales.sale_status', 'completed')->where('sales.payment_status', 'paid')
            ->where('sales.customer_id', $this->session->userdata('company_id'))
            ->where('sale_items.product_type', 'digital');
        return $this->db->count_all_results('sales');
    }

    public function getFeaturedProducts($limit = 16, $promo = true)
    {
        $this->db->select("{$this->db->dbprefix('products')}.id as id, {$this->db->dbprefix('products')}.name as name, {$this->db->dbprefix('products')}.code as code, {$this->db->dbprefix('products')}.image as image, {$this->db->dbprefix('products')}.slug as slug, {$this->db->dbprefix('products')}.price, quantity, type, promotion, promo_price, start_date, end_date, b.name as brand_name, b.slug as brand_slug, c.name as category_name, c.slug as category_slug")
        ->join('brands b', 'products.brand=b.id', 'left')
        ->join('categories c', 'products.category_id=c.id', 'left')
        ->where('products.featured', 1)
        ->where('hide !=', 1)
        ->limit($limit);

        $sp = $this->getSpecialPrice();
        if ($sp->cgp) {
            $this->db->select('cgp.price as special_price', false)->join($sp->cgp, 'products.id=cgp.product_id', 'left');
        } elseif ($sp->wgp) {
            $this->db->select('wgp.price as special_price', false)->join($sp->wgp, 'products.id=wgp.product_id', 'left');
        }

        if ($promo) {
            $this->db->order_by('promotion desc');
        }
        $this->db->order_by('RAND()');
        return $this->db->get('products')->result();
    }

    public function getNotifications()
    {
        $date = date('Y-m-d H:i:s', time());
        $this->db->where('from_date <=', $date)
        ->where('till_date >=', $date)->where('scope !=', 2);
        return $this->db->get('notifications')->result();
    }

    public function getOrder($clause)
    {
        if ($this->loggedIn) {
            $this->db->order_by('id desc');
            $sale = $this->db->get_where('sales', ['id' => $clause['id']], 1)->row();
            return ($sale->customer_id == $this->session->userdata('company_id')) ? $sale : false;
        } elseif (!empty($clause['hash'])) {
            return $this->db->get_where('sales', $clause, 1)->row();
        }
        return false;
    }

    public function getOrderItems($sale_id)
    {
        $this->db->select('sale_items.*, tax_rates.code as tax_code, tax_rates.name as tax_name, tax_rates.rate as tax_rate, products.image, products.details as details, product_variants.name as variant, products.hsn_code as hsn_code,  products.second_name as second_name')
            ->join('products', 'products.id=sale_items.product_id', 'left')
            ->join('product_variants', 'product_variants.id=sale_items.option_id', 'left')
            ->join('tax_rates', 'tax_rates.id=sale_items.tax_rate_id', 'left')
            ->group_by('sale_items.id')
            ->order_by('id', 'asc');

        return $this->db->get_where('sale_items', ['sale_id' => $sale_id])->result();
    }

    public function getOrders($limit, $offset)
    {
        if ($this->loggedIn) {
            $this->db->select('sales.*, deliveries.status as delivery_status')
            ->join('deliveries', 'deliveries.sale_id=sales.id', 'left')
            ->order_by('id', 'desc')->limit($limit, $offset);
            return $this->db->get_where('sales', ['customer_id' => $this->session->userdata('company_id')])->result();
        }
        return false;
    }

    public function getOrdersCount()
    {
        $this->db->where('customer_id', $this->session->userdata('company_id'));
        return $this->db->count_all_results('sales');
    }

    public function getOtherProducts($id, $category_id, $brand)
    {
        $this->db->select("{$this->db->dbprefix('products')}.id as id, {$this->db->dbprefix('products')}.name as name, {$this->db->dbprefix('products')}.code as code, {$this->db->dbprefix('products')}.image as image, {$this->db->dbprefix('products')}.slug as slug, {$this->db->dbprefix('products')}.price, quantity, type, promotion, promo_price, start_date, end_date, b.name as brand_name, b.slug as brand_slug, c.name as category_name, c.slug as category_slug")
        ->join('brands b', 'products.brand=b.id', 'left')
        ->join('categories c', 'products.category_id=c.id', 'left')
        ->where('category_id', $category_id)->where('brand', $brand)
        ->where('products.id !=', $id)->where('hide !=', 1)
        ->order_by('rand()')->limit(4);

        $sp = $this->getSpecialPrice();
        if ($sp->cgp) {
            $this->db->select('cgp.price as special_price', false)->join($sp->cgp, 'products.id=cgp.product_id', 'left');
        } elseif ($sp->wgp) {
            $this->db->select('wgp.price as special_price', false)->join($sp->wgp, 'products.id=wgp.product_id', 'left');
        }
        return $this->db->get('products')->result();
    }

    public function getPageBySlug($slug)
    {
        return $this->db->get_where('pages', ['slug' => $slug], 1)->row();
    }

    public function getPaypalSettings()
    {
        return $this->db->get_where('paypal', ['id' => 1])->row();
    }

    public function getPriceGroup($id)
    {
        return $this->db->get_where('price_groups', ['id' => $id])->row();
    }

    public function getProductByID($id)
    {
        $this->db->select("{$this->db->dbprefix('products')}.id as id, {$this->db->dbprefix('products')}.name as name, {$this->db->dbprefix('products')}.code as code, {$this->db->dbprefix('products')}.image as image, {$this->db->dbprefix('products')}.slug as slug, price, quantity, type, promotion, promo_price, start_date, end_date, product_details as details");
        return $this->db->get_where('products', ['id' => $id], 1)->row();
    }

    public function getProductBySlug($slug)
    {
        $this->db->select("{$this->db->dbprefix('products')}.*");
        $sp = $this->getSpecialPrice();
        if ($sp->cgp) {
            $this->db->select('cgp.price as special_price', false)->join($sp->cgp, 'products.id=cgp.product_id', 'left');
        } elseif ($sp->wgp) {
            $this->db->select('wgp.price as special_price', false)->join($sp->wgp, 'products.id=wgp.product_id', 'left');
        }
        return $this->db->get_where('products', ['slug' => $slug, 'hide !=' => 1], 1)->row();
    }

    public function getProductComboItems($pid)
    {
        $this->db->select($this->db->dbprefix('products') . '.id as id, ' . $this->db->dbprefix('products') . '.code as code, ' . $this->db->dbprefix('combo_items') . '.quantity as qty, ' . $this->db->dbprefix('products') . '.name as name, ' . $this->db->dbprefix('combo_items') . '.unit_price as price')->join('products', 'products.code=combo_items.item_code', 'left')->group_by('combo_items.id');
        $q = $this->db->get_where('combo_items', ['product_id' => $pid]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }

    public function getProductForCart($id)
    {
        $this->db->select("{$this->db->dbprefix('products')}.*")->where('products.id', $id);
        $sp = $this->getSpecialPrice();
        if ($sp->cgp) {
            $this->db->select('cgp.price as special_price', false)->join($sp->cgp, 'products.id=cgp.product_id', 'left');
        } elseif ($sp->wgp) {
            $this->db->select('wgp.price as special_price', false)->join($sp->wgp, 'products.id=wgp.product_id', 'left');
        }
        $q = $this->db->get('products', 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getProductOptions($product_id)
    {
        return $this->db->get_where('product_variants', ['product_id' => $product_id])->result();
    }

    public function getProductOptionsWithWH($product_id, $warehouse_id = null)
    {
        if (!$warehouse_id) {
            $warehouse_id = $this->shop_settings->warehouse;
        }
        $this->db->select($this->db->dbprefix('product_variants') . '.*, ' . $this->db->dbprefix('warehouses') . '.name as wh_name, ' . $this->db->dbprefix('warehouses') . '.id as warehouse_id, ' . $this->db->dbprefix('warehouses_products_variants') . '.quantity as wh_qty')
            ->join('warehouses_products_variants', 'warehouses_products_variants.option_id=product_variants.id', 'left')
            ->join('warehouses', 'warehouses.id=warehouses_products_variants.warehouse_id', 'left')
            ->group_by(['' . $this->db->dbprefix('product_variants') . '.id', '' . $this->db->dbprefix('warehouses_products_variants') . '.warehouse_id'])
            ->order_by('product_variants.id');
        return $this->db->get_where('product_variants', ['product_variants.product_id' => $product_id, 'warehouses.id' => $warehouse_id, 'warehouses_products_variants.quantity !=' => null])->result();
    }

    public function getProductPhotos($id)
    {
        $q = $this->db->get_where('product_photos', ['product_id' => $id]);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getProducts($filters = [])
    {
        $this->db->select("{$this->db->dbprefix('products')}.id as id, {$this->db->dbprefix('products')}.name as name, {$this->db->dbprefix('products')}.code as code, {$this->db->dbprefix('products')}.image as image, {$this->db->dbprefix('products')}.slug as slug, {$this->db->dbprefix('products')}.price, {$this->db->dbprefix('warehouses_products')}.quantity as quantity, type, promotion, promo_price, start_date, end_date, product_details as details")
        ->from('products')
        ->join('warehouses_products', 'products.id=warehouses_products.product_id', 'left')
        ->where('warehouses_products.warehouse_id', $this->shop_settings->warehouse)
        ->group_by('products.id');

        $sp = $this->getSpecialPrice();
        if ($sp->cgp) {
            $this->db->select('cgp.price as special_price', false)->join($sp->cgp, 'products.id=cgp.product_id', 'left');
        } elseif ($sp->wgp) {
            $this->db->select('wgp.price as special_price', false)->join($sp->wgp, 'products.id=wgp.product_id', 'left');
        }

        if ($this->shop_settings->hide0) {
            $this->db->where('warehouses_products.quantity >', 0);
        }
        $this->db->where('hide !=', 1)
        ->limit($filters['limit'], $filters['offset']);
        if (!empty($filters)) {
            if (!empty($filters['promo'])) {
                $today = date('Y-m-d');
                $this->db->where('promotion', 1)->where('start_date <=', $today)->where('end_date >=', $today);
            }
            if (!empty($filters['featured'])) {
                $this->db->where('featured', 1);
            }
            if (!empty($filters['query'])) {
                $this->db->group_start()->like('name', $filters['query'], 'both')->or_like('code', $filters['query'], 'both')->group_end();
            }
            if (!empty($filters['category'])) {
                $this->db->where('category_id', $filters['category']['id']);
            }
            if (!empty($filters['subcategory'])) {
                $this->db->where('subcategory_id', $filters['subcategory']['id']);
            }
            if (!empty($filters['brand'])) {
                $this->db->where('brand', $filters['brand']['id']);
            }
            if (!empty($filters['min_price'])) {
                $this->db->where('products.price >=', $filters['min_price']);
            }
            if (!empty($filters['max_price'])) {
                $this->db->where('products.price <=', $filters['max_price']);
            }
            if (!empty($filters['in_stock'])) {
                $this->db->group_start()->where('warehouses_products.quantity >=', 1)->or_where('type !=', 'standard')->group_end();
            }
            if (!empty($filters['sorting'])) {
                $sort = explode('-', $filters['sorting']);
                $this->db->order_by($sort[0], $this->db->escape_str($sort[1]));
            } else {
                $this->db->order_by('name asc');
            }
        } else {
            $this->db->order_by('name asc');
        }
        return $this->db->get()->result_array();
    }

    public function getProductsCount($filters = [])
    {
        $this->db->select("{$this->db->dbprefix('products')}.id as id")
        ->join('warehouses_products', 'products.id=warehouses_products.product_id', 'left')
        ->where('warehouses_products.warehouse_id', $this->shop_settings->warehouse)
        ->group_by('products.id');

        $sp = $this->getSpecialPrice();
        if ($sp->cgp) {
            $this->db->select('cgp.price as special_price', false)->join($sp->cgp, 'products.id=cgp.product_id', 'left');
        } elseif ($sp->wgp) {
            $this->db->select('wgp.price as special_price', false)->join($sp->wgp, 'products.id=wgp.product_id', 'left');
        }

        if (!empty($filters)) {
            if (!empty($filters['promo'])) {
                $today = date('Y-m-d');
                $this->db->where('promotion', 1)->where('start_date <=', $today)->where('end_date >=', $today);
            }
            if (!empty($filters['featured'])) {
                $this->db->where('featured', 1);
            }
            if (!empty($filters['query'])) {
                $this->db->group_start()->like('name', $filters['query'], 'both')->or_like('code', $filters['query'], 'both')->group_end();
            }
            if (!empty($filters['category'])) {
                $this->db->where('category_id', $filters['category']['id']);
            }
            if (!empty($filters['subcategory'])) {
                $this->db->where('subcategory_id', $filters['subcategory']['id']);
            }
            if (!empty($filters['brand'])) {
                $this->db->where('brand', $filters['brand']['id']);
            }
            if (!empty($filters['min_price'])) {
                $this->db->where('products.price >=', $filters['min_price']);
            }
            if (!empty($filters['max_price'])) {
                $this->db->where('products.price <=', $filters['max_price']);
            }
            if (!empty($filters['in_stock'])) {
                $this->db->group_start()->where('warehouses_products.quantity >=', 1)->or_where('type !=', 'standard')->group_end();
            }
        }

        if ($this->shop_settings->hide0) {
            $this->db->where('warehouses_products.quantity >', 0);
        }
        $this->db->where('hide !=', 1);
        return $this->db->count_all_results('products');
    }

    public function getProductVariantByID($id)
    {
        return $this->db->get_where('product_variants', ['id' => $id])->row();
    }

    public function getProductVariants($product_id, $warehouse_id = null, $all = null)
    {
        if (!$warehouse_id) {
            $warehouse_id = $this->shop_settings->warehouse;
        }
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
        return $this->db->get('product_variants')->result_array();
    }

    public function getProductVariantWarehouseQty($option_id, $warehouse_id)
    {
        return $this->db->get_where('warehouses_products_variants', ['option_id' => $option_id, 'warehouse_id' => $warehouse_id], 1)->row();
    }

    public function getQuote($clause)
    {
        if ($this->loggedIn) {
            $this->db->order_by('id desc');
            $sale = $this->db->get_where('quotes', ['id' => $clause['id']], 1)->row();
            return ($sale->customer_id == $this->session->userdata('company_id')) ? $sale : false;
        } elseif (!empty($clause['hash'])) {
            return $this->db->get_where('quotes', $clause, 1)->row();
        }
        return false;
    }

    public function getQuoteItems($quote_id)
    {
        $this->db->select('quote_items.*, tax_rates.code as tax_code, tax_rates.name as tax_name, tax_rates.rate as tax_rate, products.image, products.details as details, product_variants.name as variant, products.hsn_code as hsn_code,  products.second_name as second_name')
            ->join('products', 'products.id=quote_items.product_id', 'left')
            ->join('product_variants', 'product_variants.id=quote_items.option_id', 'left')
            ->join('tax_rates', 'tax_rates.id=quote_items.tax_rate_id', 'left')
            ->group_by('quote_items.id')
            ->order_by('id', 'asc');
        return $this->db->get_where('quote_items', ['quote_id' => $quote_id])->result();
    }

    public function getQuotes($limit, $offset)
    {
        if ($this->loggedIn) {
            $this->db->order_by('id', 'desc')->limit($limit, $offset);
            return $this->db->get_where('quotes', ['customer_id' => $this->session->userdata('company_id')])->result();
        }
        return false;
    }

    public function getQuotesCount()
    {
        $this->db->where('customer_id', $this->session->userdata('company_id'));
        return $this->db->count_all_results('quotes');
    }

    public function getSaleByID($id)
    {
        return $this->db->get_where('sales', ['id' => $id])->row();
    }

    public function getSettings()
    {
        return $this->db->get('settings')->row();
    }

    public function getShopSettings()
    {
        return $this->db->get('shop_settings')->row();
    }

    public function getSkrillSettings()
    {
        return $this->db->get_where('skrill', ['id' => 1])->row();
    }

    public function getSpecialPrice()
    {
        $sp      = new stdClass();
        $sp->cgp = ($this->customer && $this->customer->price_group_id) ? "( SELECT {$this->db->dbprefix('product_prices')}.price as price, {$this->db->dbprefix('product_prices')}.product_id as product_id, {$this->db->dbprefix('product_prices')}.price_group_id as price_group_id from {$this->db->dbprefix('product_prices')} WHERE {$this->db->dbprefix('product_prices')}.price_group_id = {$this->customer->price_group_id} ) cgp" : null;

        $sp->wgp = ($this->warehouse && $this->warehouse->price_group_id && !$this->customer) ? "( SELECT {$this->db->dbprefix('product_prices')}.price as price, {$this->db->dbprefix('product_prices')}.product_id as product_id, {$this->db->dbprefix('product_prices')}.price_group_id as price_group_id from {$this->db->dbprefix('product_prices')} WHERE {$this->db->dbprefix('product_prices')}.price_group_id = {$this->warehouse->price_group_id} ) wgp" : null;

        return $sp;
    }

    public function getSubCategories($parent_id)
    {
        $this->db->where('parent_id', $parent_id)->order_by('name');
        return $this->db->get('categories')->result();
    }

    public function getUserByEmail($email)
    {
        return $this->db->get_where('users', ['email' => $email], 1)->row();
    }

    public function getWishlist($no = null)
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        return $no ? $this->db->count_all_results('wishlist') : $this->db->get('wishlist')->result();
    }

    public function getWishlistItem($product_id, $user_id)
    {
        return $this->db->get_where('wishlist', ['product_id' => $product_id, 'user_id' => $user_id])->row();
    }

    public function isPromo()
    {
        $today = date('Y-m-d');
        $this->db->where('promotion', 1)->where('start_date <=', $today)->where('end_date >=', $today);
        return $this->db->count_all_results('products');
    }

    public function removeWishlist($product_id)
    {
        $user_id = $this->session->userdata('user_id');
        return $this->db->delete('wishlist', ['product_id' => $product_id, 'user_id' => $user_id]);
    }

    public function updateCompany($id, $data = [])
    {
        return $this->db->update('companies', $data, ['id' => $id]);
    }

    public function updateProductViews($id, $views)
    {
        $views = is_numeric($views) ? ($views + 1) : 1;
        return $this->db->update('products', ['views' => $views], ['id' => $id]);
    }
}
