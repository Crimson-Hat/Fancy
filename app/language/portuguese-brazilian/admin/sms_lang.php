<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * Language: English
 * Module: SMS
 *
 * Last edited:
 * 23rd October 2017
 *
 * Package:
 * Stock Manage Advance v3.0
 *
 * You can translate this file to your language.
 * For instruction on new language setup, please visit the documentations.
 * You also can share your language files by emailing to saleem@tecdiary.com
 * Thank you
 */

// Please keep the translation  line length below 150 as only 160 character per sms or it will be multiple sms charges
// Available variable options for sales related sms:
// 1. {customer} for Customer Company/Contact Person
// 2. {sale_reference} for sale reference number
// 3. {grand_total} for sale grand total amount
//
// Payment related sms:
// 1. {payment_reference} for payment reference
// 2. {amount} for payment amount
//
// Delivery related sms:
// 1. {delivery_reference} for deliver reference
// 2. (received_by} for delivery received by field

$lang['sale_added']       = 'Caro(a) {customer}, your order (Ref. {sale_reference}) tenha sido recebido, prossiga para o pagamento no montante {grand_total}. Obrigado';
$lang['payment_received'] = 'Caro(a) {customer}, seu pagamento (Ref. {payment_reference}, Amt: {amount}) foi recebido, processaremos seu pedido em breve. Obrigado';
$lang['delivering']       = 'Caro(a) {customer}, Nós somos a entrega do seu pedido (Ref. {delivery_reference}).';
$lang['delived']          = 'Caro(a) {customer}, Seu pedido (Ref. {sale_reference}) foi recebido por {received_by}.';
