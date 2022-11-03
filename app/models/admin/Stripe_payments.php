<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Stripe\Token;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Balance;

class Stripe_payments extends CI_Model
{
    public $code;
    public $error   = false;
    public $message = '';

    protected $private_key;

    public function __construct()
    {
        parent::__construct();
        $this->config->load('payment_gateways');
        $this->private_key = $this->config->item('stripe_secret_key');
        $this->set_api_key();
    }

    public function card_to_array($card)
    {
        $data = [
            'address_country'     => $card->address_country,
            'type'                => $card->type,
            'address_zip_check'   => $card->address_zip_check,
            'fingerprint'         => $card->fingerprint,
            'address_state'       => $card->address_state,
            'exp_month'           => $card->exp_month,
            'address_line1_check' => $card->address_line1_check,
            'country'             => $card->country,
            'last4'               => $card->last4,
            'exp_year'            => $card->exp_year,
            'address_zip'         => $card->address_zip,
            'object'              => $card->object,
            'address_line1'       => $card->address_line1,
            'name'                => $card->name,
            'address_line2'       => $card->address_line2,
            'id'                  => $card->id,
            'cvc_check'           => $card->cvc_check,
        ];
        return $data;
    }

    public function charge($token, $description, $amount, $currency)
    {
        return $this->insert($token, $description, $amount, $currency);
    }

    public function charge_to_array($charge)
    {
        $data = [
            'id'              => $charge->id,
            'invoice'         => $charge->invoice,
            'card'            => $this->card_to_array($charge->card),
            'livemode'        => $charge->livemode,
            'amount'          => $charge->amount,
            'failure_message' => $charge->failure_message,
            'fee'             => $charge->fee,
            'currency'        => $charge->currency,
            'paid'            => $charge->paid,
            'description'     => $charge->description,
            'disputed'        => $charge->disputed,
            'object'          => $charge->object,
            'refunded'        => $charge->refunded,
            'created'         => date('Y-m-d H:i:s', $charge->created),
            'customer'        => $charge->customer,
            'amount_refunded' => $charge->amount_refunded,
        ];
        return $data;
    }

    public function count_all_transactions()
    {
        $charges = $this->get_all_transactions();
        return count($charges);
    }

    public function create_card_token($card_info)
    {
        if (isset($card_info['number'])) {
            $card_info = ['card' => $card_info];
        }
        try {
            $card = Token::create($card_info);
            return $card;
        } catch (Exception $e) {
            $this->error   = true;
            $this->message = $e->getMessage();
            $this->code    = $e->getCode();
            //return FALSE;
            return ['error' => true, 'code' => $this->code, 'message' => $this->message];
        }
    }

    public function get_all_transactions($num_charges = 100, $offset = 0)
    {
        try {
            $ch = Charge::all([
                'count'  => $num_charges,
                'offset' => $offset,
            ]);
            $data['error'] = false;
            $raw_data      = [];
            foreach ($ch->data as $record) {
                $raw_data[] = $this->charge_to_array($record);
            }
            $data['data'] = $raw_data;
            return $data;
        } catch (Exception $e) {
            $this->error   = true;
            $this->message = $e->getMessage();
            $this->code    = $e->getCode();
            return false;
        }
    }

    public function get_balance()
    {
        try {
            $bal = Balance::retrieve();
            return ['mode' => ($bal->livemode ? $bal->livemode : 'Test'), 'pending_amount' => ($bal->pending[0]->amount / 100), 'pending_currency' => strtoupper($bal->pending[0]->currency), 'available_amount' => ($bal->available[0]->amount / 100), 'available_currency' => strtoupper($bal->available[0]->currency)];
        } catch (Exception $e) {
            $this->error   = true;
            $this->message = $e->getMessage();
            $this->code    = $e->getCode();
            //return FALSE;
            return ['error' => true, 'code' => $this->code, 'message' => $this->message];
        }
    }

    public function get_limit($limit, $offset = 0)
    {
        return $this->get_all_transactions($limit, $offset);
    }

    public function get_transaction($transaction_id)
    {
        try {
            $ch = Charge::retrieve($transaction_id);
            return $ch;
        } catch (Exception $e) {
            $this->error   = true;
            $this->message = $e->getMessage();
            $this->code    = $e->getCode();
            return false;
        }
    }

    public function init($config = [])
    {
        if (isset($config['private_key'])) {
            $this->private_key = $config['private_key'];
        }
        $this->set_api_key();
    }

    public function insert($token, $description, $amount, $currency)
    {
        try {
            $charge = Charge::create([
                'amount'      => $amount,
                'currency'    => $currency,
                'card'        => $token,
                'description' => $description,
            ]);
            return $charge;
        } catch (Exception $e) {
            $this->error   = true;
            $this->message = $e->getMessage();
            $this->code    = $e->getCode();
            //return FALSE;
            return ['error' => true, 'code' => $this->code, 'message' => $this->message];
        }
    }

    public function insert_many($data)
    {
        $ids = [];

        foreach ($data as $row) {
            $ids[] = $this->insert($row['token'], $row['description'], $row['amount'], $row['currency']);
        }
        return $ids;
    }

    public function refund($transaction_id, $amount = 'all')
    {
        $transaction = $this->get($transaction_id);
        if ($transaction) {
            if ($amount == 'all') {
                $amount = $transaction['amount'];
            }
            try {
                $response = $transaction->refund(['amount' => $amount]);
                return $response;
            } catch (Exception $e) {
                $this->error   = true;
                $this->message = $e->getMessage();
                $this->code    = $e->getCode();
                return false;
            }
        } else {
            $this->error = true;
            return false;
        }
    }

    public function set_api_key()
    {
        Stripe::setApiKey($this->private_key);
    }
}
