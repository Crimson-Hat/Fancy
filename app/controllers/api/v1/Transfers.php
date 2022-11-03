<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Transfers extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->methods['index_get']['limit'] = 500;
        $this->load->api_model('transfers_api');
    }

    protected function setTransfer($transfer)
    {
        $transfer->reference_no = $transfer->transfer_no;
        unset($transfer->attachment, $transfer->updated_at, $transfer->transfer_no, $transfer->from_warehouse_code, $transfer->from_warehouse_id, $transfer->from_warehouse_name, $transfer->to_warehouse_code, $transfer->to_warehouse_id, $transfer->to_warehouse_name);
        if (isset($transfer->items) && !empty($transfer->items)) {
            foreach ($transfer->items as &$item) {
                if (isset($item->option_id) && !empty($item->option_id)) {
                    if ($variant = $this->transfers_api->getProductVariantByID($item->option_id)) {
                        $item->product_variant_id   = $variant->id;
                        $item->product_variant_name = $variant->name;
                    }
                }
                $item->product_unit_quantity = $item->unit_quantity;
                unset($item->id, $item->date, $item->transfer_id, $item->purchase_id, $item->warehouse_id, $item->transfer_item_id, $item->purchase_item_id, $item->option_id, $item->unit_quantity, $item->real_unit_cost, $item->supplier_part_no, $item->quantity_balance, $item->quantity_received);
                $item = (array) $item;
                ksort($item);
            }
        }
        $transfer = (array) $transfer;
        ksort($transfer);
        return $transfer;
    }

    public function index_get()
    {
        $reference = $this->get('reference');

        $filters = [
            'reference'   => $reference,
            'include'     => $this->get('include') ? explode(',', $this->get('include')) : null,
            'start'       => $this->get('start') && is_numeric($this->get('start')) ? $this->get('start') : 1,
            'limit'       => $this->get('limit') && is_numeric($this->get('limit')) ? $this->get('limit') : 10,
            'start_date'  => $this->get('start_date') && is_numeric($this->get('start_date')) ? $this->get('start_date') : null,
            'end_date'    => $this->get('end_date') && is_numeric($this->get('end_date')) ? $this->get('end_date') : null,
            'order_by'    => $this->get('order_by') ? explode(',', $this->get('order_by')) : ['id', 'decs'],
            'supplier_id' => $this->get('supplier_id') ? $this->get('supplier_id') : null,
            'customer'    => $this->get('customer') ? $this->get('customer') : null,
        ];

        if ($reference === null) {
            if ($transfers = $this->transfers_api->getTransfers($filters)) {
                $sl_data = [];
                foreach ($transfers as $transfer) {
                    if (!empty($filters['include'])) {
                        foreach ($filters['include'] as $include) {
                            if ($include == 'items') {
                                $transfer->items = $this->transfers_api->getTransferItems($transfer->id, $transfer->status);
                            }
                        }
                    }

                    $transfer->from_warehouse = $this->transfers_api->getWarehouseByID($transfer->from_warehouse_id);
                    $transfer->to_warehouse   = $this->transfers_api->getWarehouseByID($transfer->to_warehouse_id);
                    $transfer->created_by     = $this->transfers_api->getUser($transfer->created_by);
                    $sl_data[]                = $this->setTransfer($transfer);
                }

                $data = [
                    'data'  => $sl_data,
                    'limit' => (int) $filters['limit'],
                    'start' => (int) $filters['start'],
                    'total' => $this->transfers_api->countTransfers($filters),
                ];
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'message' => 'No transfer record found.',
                    'status'  => false,
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            if ($transfer = $this->transfers_api->getTransfer($filters)) {
                if (!empty($filters['include'])) {
                    foreach ($filters['include'] as $include) {
                        if ($include == 'items') {
                            $transfer->items = $this->transfers_api->getTransferItems($transfer->id, $transfer->status);
                        }
                    }
                }

                $transfer->from_warehouse = $this->transfers_api->getWarehouseByID($transfer->from_warehouse_id);
                $transfer->to_warehouse   = $this->transfers_api->getWarehouseByID($transfer->to_warehouse_id);
                $transfer->created_by     = $this->transfers_api->getUser($transfer->created_by);
                $transfer                 = $this->setTransfer($transfer);
                $this->set_response($transfer, REST_Controller::HTTP_OK);
            } else {
                $this->set_response([
                    'message' => 'Transfer could not be found for reference ' . $reference . '.',
                    'status'  => false,
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
}
