<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-sm-8">
                        <div class="panel panel-default margin-top-lg">
                            <div class="panel-heading text-bold">
                                <i class="fa fa-shopping-cart margin-right-sm"></i> <?= lang('shopping_cart'); ?>
                                [ <?= lang('items'); ?>: <span id="total-items"></span> ]
                                <a href="<?= shop_url('products'); ?>" class="pull-right hidden-xs">
                                    <i class="fa fa-share"></i>
                                    <?= lang('continue_shopping'); ?>
                                </a>
                            </div>
                            <div class="panel-body" style="padding:0;">
                                <div class="cart-empty-msg <?=($this->cart->total_items() > 1) ? 'hide' : '';?>">
                                    <?= '<h4 class="text-bold">' . lang('empty_cart') . '</h4>'; ?>
                                </div>
                                <div class="cart-contents">
                                    <div class="table-responsive">
                                        <table id="cart-table" class="table table-condensed table-striped table-cart margin-bottom-no">
                                            <thead>
                                                <tr>
                                                    <th><i class="text-grey fa fa-trash-o"></i></th>
                                                    <th>#</th>
                                                    <th class="col-xs-4" colspan="2"><?= lang('product'); ?></th>
                                                    <th class="col-xs-3"><?= lang('option'); ?></th>
                                                    <th class="col-xs-1"><?= lang('qty'); ?></th>
                                                    <th class="col-xs-2"><?= lang('price'); ?></th>
                                                    <th class="col-xs-2"><?= lang('subtotal'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-contents">
                                <div id="cart-helper" class="panel panel-footer margin-bottom-no">
                                    <a href="<?= site_url('cart/destroy'); ?>" id="empty-cart" class="btn btn-danger btn-sm">
                                        <?= lang('empty_cart'); ?>
                                    </a>
                                    <a href="<?= shop_url('products'); ?>" class="btn btn-primary btn-sm pull-right">
                                        <i class="fa fa-share"></i>
                                        <?= lang('continue_shopping'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-contents">
                        <div class="col-sm-4">
                            <div id="sticky-con" class="margin-top-lg">
                                <div class="panel panel-default">
                                    <div class="panel-heading text-bold">
                                        <i class="fa fa-calculator margin-right-sm"></i> <?= lang('cart_totals'); ?>
                                    </div>
                                    <div class="panel-body">
                                        <table id="cart-totals" class="table table-borderless table-striped cart-totals"></table>
                                        <a href="<?= site_url('cart/checkout'); ?>" class="btn btn-primary btn-lg btn-block"><?= lang('checkout'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <code class="text-muted">* <?= lang('shipping_rate_info'); ?></code>
            </div>
        </div>
    </div>
</section>
