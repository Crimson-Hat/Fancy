<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 *  ==============================================================================
 *  Author  : Mian Saleem
 *  Email   : saleem@tecdiary.com
 *  For     : SMS Lib
 *  ==============================================================================
 */

class Sms
{
    private $settings;

    private $sms_settings;

    public function __construct()
    {
        $this->sms_settings         = $this->site->getSmsSettings();
        $this->sms_settings->config = json_decode($this->sms_settings->config, true);
        $gateway                    = $this->sms_settings->config['gateway'];
        $this->settings             = $this->sms_settings->config[$gateway] ?? null;
        $this->config               = ['gateway' => $gateway, $gateway => $this->settings];
        if (!empty($gateway) && (!empty($this->settings) || $gateway == 'Log')) {
            $this->lang->admin_load('sms', $this->Settings->language);
            $this->load->library('tec_sms', $this->config);
            $this->load->library('parser');
        }
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function custom($to, $text)
    {
        return $this->send($to, $text);
    }

    public function delivering($sale_id, $reference_no)
    {
        $parse_data = [
            'delivery_reference' => $reference_no,
        ];
        $text = $this->parser->parse_string(lang('delivering'), $parse_data);
        return $this->newSale($sale_id, $text);
    }

    public function newSale($sale_id, $text = null)
    {
        if (!$text) {
            $text = lang('new_sale');
        }
        $sale       = $this->site->getSaleByID($sale_id);
        $customer   = $this->site->getCompanyByID($sale->customer_id);
        $parse_data = [
            'customer'       => $customer->company && $customer->company != '-' ? $customer->company : $customer->name,
            'sale_reference' => $sale->reference_no,
            'grand_total'    => $this->sma->formatMoney($sale->grand_total),
        ];
        $text = $this->parser->parse_string($text, $parse_data);
        return $this->send($customer->phone, $text);
    }

    public function paymentReceived($sale_id, $reference_no, $amount)
    {
        $parse_data = [
            'payment_reference' => $reference_no,
            'amount'            => $this->sma->formatMoney($amount),
        ];
        $text = $this->parser->parse_string(lang('payment_received'), $parse_data);
        return $this->newSale($sale_id, $text);
    }

    public function send($to, $text)
    {
        if (!empty($this->sms_settings->config['gateway']) && (!empty($this->settings) || $this->config['gateway'] == 'Log')) {
            try {
                $result = $this->tec_sms->send($to, $text);
            } catch (Exception $e) {
                $result = ['sending' => false, 'error' => true, 'message' => $e->getMessage()];
            }
            return $result;
        }
        return ['sending' => false, 'error' => true, 'message' => 'Incorrect SMS Settings'];
    }
}
