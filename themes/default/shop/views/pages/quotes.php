<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="row">
                    <div class="col-sm-9 col-md-10">

                        <div class="panel panel-default margin-top-lg">
                            <div class="panel-heading text-bold">
                                <i class="fa fa-list-alt margin-right-sm"></i> <?= lang('my_quotes'); ?>
                            </div>
                            <div class="panel-body">
                                <?php
                                if (!empty($orders)) {
                                    echo '<div class="row">';
                                    echo '<div class="col-sm-12 text-bold">' . lang('click_to_view') . '</div>';
                                    echo '<div class="clearfix"></div>';
                                    $r = 1;
                                    foreach ($orders as $order) {
                                        ?>
                                        <div class="col-md-6">
                                            <a href="<?= shop_url('quotes/' . $order->id); ?>" class="link-address">
                                            <table class="table table-borderless table-condensed" style="margin-bottom:0;">
                                                <?= '<tr><td>' . lang('date') . '</td><td>' . $this->sma->hrld($order->date) . '</td></tr>'; ?>
                                                <?= '<tr><td>' . lang('ref') . '</td><td>' . $order->reference_no . '</td></tr>'; ?>
                                                <?= '<tr><td>' . lang('status') . '</td><td>' . $order->status . '</td></tr>'; ?>
                                                <?= '<tr><td>' . lang('amount') . '</td><td>' . $this->sma->formatMoney($order->grand_total, $this->default_currency->symbol) . '</td></tr>'; ?>
                                                <?= '<tr><td>' . lang('comment') . '</td><td>' . $this->sma->decode_html($order->note) . '</td></tr>'; ?>
                                                </table>
                                                <span class="count"><i><?= $order->id; ?></i></span>
                                                <span class="edit"><i class="fa fa-eye"></i></span>
                                            </a>
                                        </div>
                                        <?php
                                        $r++;
                                    }
                                    echo '</div>'; ?>
                                    <div class="row" style="margin-top:15px;">
                                        <div class="col-md-6">
                                            <span class="page-info line-height-xl hidden-xs hidden-sm">
                                                <?= str_replace(['_page_', '_total_'], [$page_info['page'], $page_info['total']], lang('page_info')); ?>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                        <div id="pagination" class="pagination-right"><?= $pagination; ?></div>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    echo '<strong>' . lang('no_data_to_display') . '</strong>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-2">
                        <?php include 'sidebar1.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
