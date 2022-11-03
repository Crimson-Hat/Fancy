<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Misc extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function barcode($product_code = null, $bcs = 'code128', $height = 40, $text = true, $encoded = false)
    {
        $product_code = $encoded ? $this->sma->base64url_decode($product_code) : $product_code;
        if ($this->Settings->barcode_img) {
            header('Content-Type: image/png');
        } else {
            header('Content-type: image/svg+xml');
        }
        echo $this->sma->barcode($product_code, $bcs, $height, $text, false, true);
    }

    public function index()
    {
        show_404();
    }
}
