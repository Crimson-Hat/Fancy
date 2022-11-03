<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="row">
                    <div class="col-sm-9 col-md-10">

                        <div class="panel panel-default margin-top-lg">
                            <div class="panel-heading text-bold">
                                <i class="fa fa-list-alt margin-right-sm"></i> <?= lang('downloads'); ?>
                            </div>
                            <div class="panel-body">
                                <?php
                                if (!empty($downloads)) {
                                    echo '<table class="table table-striped table-hover table-va-middle">';
                                    echo '<thead><tr><th>' . lang('description') . '</th><th class="text-center">' . lang('actions') . '</th></tr></thead>';
                                    $r = 1;
                                    foreach ($downloads as $download) {
                                        ?>
                                        <tr class="product">
                                            <td class="col-xs-9"><?= $download->product_code . ' - ' . $download->product_name; ?></td>
                                            <td class="col-xs-3 text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="<?= shop_url('shop/downloads/' . $download->product_id . '/' . md5($download->product_id)); ?>" class="btn btn-sm btn-theme"><i class="fa fa-shopping-cart"></i> <?= lang('download'); ?></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $r++;
                                    }
                                    echo '</table>'; ?>
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
