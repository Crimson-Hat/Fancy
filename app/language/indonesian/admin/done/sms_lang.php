<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * Package:
 * Stock Manage Advance v3.0
 * Language: Indonesia
 * Module: SMS
 *
 * Last edited:
 * 8th November 2018
 *
 * Package:
 * Stock Manage Advance v3.0
 *
 * Translated by:
 * Bram Andrian (barulaku) bram.andrian@gmail.com
 *
 * Translated & willing to share? please email to support@tecdiary.com
 */

/* ****************************************************************************
    Please keep the translation line length below 140 as only 160 character per sms
    otherwise there could be multiple sms charges

    Available variable options for sales related sms:
        1. {customer} for Customer Company/Contact Person
        2. {sale_reference} for sale reference number
        3. {grand_total} for sale grand total amount

    Payment related sms as sale with:
        1. {payment_reference} for payment reference
        2. {amount} for payment amount

    Delivery related sms as sale with:
        1. {delivery_reference} for deliver reference
        2. (received_by} for delivery received by field
**************************************************************************** */

$lang['new_sale']         = 'Dear {customer}, pesanan Anda (Ref. {sale_reference}) telah diterima,silahkan melakukan pembayaran {grand_total}. Terima kasih';
$lang['payment_received'] = 'Dear {customer}, pembayaran Anda (Ref. {payment_reference}, Amt: {amount}) telah diterima, Kami akan proses pesanan Anda secepatnya. Terima kasih';
$lang['delivering']       = 'Dear {customer}, Kami mengirimkan pesanan Anda (Ref. {delivery_reference}). Mohon periksa kembali jika belom menerima pesanan selama 5 hari.';
