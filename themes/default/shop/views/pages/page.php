<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="row">
                    <div class="col-sm-9 col-md-10">
                        <div class="panel panel-default margin-top-lg">
                            <div class="panel-heading text-bold">
                                <?= $page->title; ?>
                            </div>
                            <div class="panel-body">
                                <?= $this->sma->decode_html($page->body); ?>
                                <?php
                                if ($page->slug == $shop_settings->contact_link) {
                                    echo '<p><button type="button" class="btn btn-primary email-modal">Send us email</button></p>';
                                }
                                ?>
                            </div>
                            <div id="cart-helper" class="panel panel-footer margin-bottom-no">
                                <?= lang('updated_at') . ': ' . $this->sma->hrld($page->updated_at); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-2">
                        <?php include 'sidebar2.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
