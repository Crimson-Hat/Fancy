<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-cog"></i><?= lang('shop_settings'); ?></h2>
        <?php if (isset($shop_settings->purchase_code) && !empty($shop_settings->purchase_code) && $shop_settings->purchase_code != 'purchase_code') {
    ?>
        <div class="box-icon">
            <ul class="btn-tasks">
                <!-- <li class="dropdown"><a href="<?= admin_url('shop_settings/updates') ?>" class="toggle_down"><i
                    class="icon fa fa-upload"></i><span class="padding-right-10"><?= lang('updates'); ?></span></a>
                </li> -->
            </ul>
        </div>
        <?php
} ?>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?= lang('update_info'); ?></p>

                <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo admin_form_open_multipart('shop_settings', $attrib);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= lang('shop_name', 'shop_name'); ?>
                            <?= form_input('shop_name', set_value('shop_name', $shop_settings->shop_name), 'class="form-control tip" id="shop_name" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('description', 'description'); ?>
                            <?= form_input('description', set_value('description', $shop_settings->description), 'class="form-control tip" id="description" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('products_description', 'products_description'); ?>
                            <?= form_input('products_description', set_value('products_description', $shop_settings->products_description), 'class="form-control tip" id="products_description" required="required"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= lang('shipping', 'shipping'); ?>
                            <?= form_input('shipping', set_value('shipping', $shop_settings->shipping), 'class="form-control tip" id="shipping"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('warehouse', 'warehouse'); ?>
                            <?php
                            $wh[''] = lang('select') . ' ' . lang('warehouse');
                            foreach ($warehouses as $warehouse) {
                                $wh[$warehouse->id] = $warehouse->name . ' (' . $warehouse->code . ')';
                            }
                            ?>
                            <?= form_dropdown('warehouse', $wh, set_value('warehouse', $shop_settings->warehouse), 'class="form-control tip" id="warehouse"  required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('biller', 'biller'); ?>
                            <?php
                            $bl[''] = lang('select') . ' ' . lang('biller');
                            foreach ($billers as $biller) {
                                $bl[$biller->id] = $biller->company && $biller->company != '-' ? $biller->company : $biller->name;
                            }
                            ?>
                            <?= form_dropdown('biller', $bl, set_value('biller', $shop_settings->biller), 'class="form-control tip" id="biller"  required="required"'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <?= lang('phone', 'phone'); ?>
                            <?= form_input('phone', set_value('phone', $shop_settings->phone), 'class="form-control tip" id="phone" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('email', 'email'); ?>
                            <?= form_input('email', set_value('email', $shop_settings->email), 'class="form-control tip" id="email" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('products_page', 'products_page'); ?>
                            <?php $popts = [0 => lang('leave_gap'), 1 => lang('re_arrange')]; ?>
                            <?= form_dropdown('products_page', $popts, set_value('products_page', $shop_settings->products_page), 'class="form-control tip" id="products_page" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('about_link', 'about_link'); ?>
                            <?php
                            $pgs[''] = lang('select') . ' ' . lang('page');
                            foreach ($pages as $page) {
                                $pgs[$page->slug] = $page->title;
                            }
                            ?>
                            <?= form_dropdown('about_link', $pgs, set_value('about_link', $shop_settings->about_link), 'class="form-control tip" id="about_link"  required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('terms_link', 'terms_link'); ?>
                            <?= form_dropdown('terms_link', $pgs, set_value('terms_link', $shop_settings->terms_link), 'class="form-control tip" id="terms_link"  required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('privacy_link', 'privacy_link'); ?>
                            <?= form_dropdown('privacy_link', $pgs, set_value('privacy_link', $shop_settings->privacy_link), 'class="form-control tip" id="privacy_link"  required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('contact_link', 'contact_link'); ?>
                            <?= form_dropdown('contact_link', $pgs, set_value('contact_link', $shop_settings->contact_link), 'class="form-control tip" id="contact_link"  required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('payment_text', 'payment_text'); ?>
                            <?= form_input('payment_text', set_value('payment_text', $shop_settings->payment_text), 'class="form-control tip" id="payment_text" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('private_shop', 'private'); ?>
                            <?php $yn = [0 => lang('no'), 1 => lang('yes')]; ?>
                            <?= form_dropdown('private', $yn, set_value('private', $shop_settings->private), 'class="form-control tip" id="private" required="required"'); ?>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <?= lang('follow_text', 'follow_text'); ?>
                            <?= form_input('follow_text', set_value('follow_text', $shop_settings->follow_text), 'class="form-control tip" id="follow_text" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('facebook', 'facebook'); ?>
                            <?= form_input('facebook', set_value('facebook', $shop_settings->facebook), 'class="form-control tip" id="facebook" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('twitter', 'twitter'); ?>
                            <?= form_input('twitter', set_value('twitter', $shop_settings->twitter), 'class="form-control tip" id="twitter"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('google_plus', 'google_plus'); ?>
                            <?= form_input('google_plus', set_value('google_plus', $shop_settings->google_plus), 'class="form-control tip" id="google_plus"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('instagram', 'instagram'); ?>
                            <?= form_input('instagram', set_value('instagram', $shop_settings->instagram), 'class="form-control tip" id="instagram"'); ?>
                        </div>

                        <div class="form-group">
                            <?= lang('cookie_message', 'cookie_message'); ?>
                            <?= form_input('cookie_message', set_value('cookie_message', $shop_settings->cookie_message), 'class="form-control tip" id="cookie_message"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('cookie_link', 'cookie_link'); ?>
                            <?= form_dropdown('cookie_link', $pgs, set_value('cookie_link', $shop_settings->cookie_link), 'class="form-control tip" id="cookie_link"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('hide0', 'hide0'); ?>
                            <?php $yn = [0 => lang('no'), 1 => lang('yes')]; ?>
                            <?= form_dropdown('hide0', $yn, set_value('hide0', $shop_settings->hide0), 'class="form-control tip" id="hide0" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('hide_price', 'hide_price'); ?>
                            <?php $yn = [0 => lang('no'), 1 => lang('yes')]; ?>
                            <?= form_dropdown('hide_price', $yn, set_value('hide_price', $shop_settings->hide_price), 'class="form-control tip" id="hide_price" required="required"'); ?>
                        </div>

                    </div>

                    <?php
                    if (POS) {
                        ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= lang('stripe', 'stripe'); ?>
                            <?= form_dropdown('stripe', $yn, $shop_settings->stripe, 'class="form-control" id="stripe" required="required"'); ?>
                        </div>
                    </div>
                <?php
                    } ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= lang('logo', 'logo'); ?>
                            <input id="logo" type="file" data-browse-label="<?= lang('browse'); ?>" name="logo" data-show-upload="false" data-show-preview="false" class="form-control file">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= lang('bank_details', 'bank_details'); ?> <?= lang('bank_details_tip'); ?>
                            <?= form_textarea('bank_details', $shop_settings->bank_details, 'class="form-control tip" id="bank_details"'); ?>
                        </div>
                    </div>

                <div class="col-md-12">
                    <?php if (!DEMO) {
                        ?>
                    <a href="<?= admin_url('shop_settings/slugify'); ?>" class="btn btn-default pull-right"><?= lang('auto_slugify'); ?></a>
                    <?php
                    } ?>
                    <?= form_submit('update', lang('update'), 'class="btn btn-primary"'); ?>
                </div>
                </div>
                <?= form_close(); ?>
                <?php if (!DEMO) {
                        ?>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-md-12">
                        <div class="form-inline well well-sm">
                            <div class="form-group col-sm-12">
                                <div class="row">
                                    <label for="sitemap" class="col-sm-2 control-label" style="margin-top:8px;"><?= lang('sitemap'); ?></label>
                                    <div class="col-sm-10">
                                        <div class="input-group col-sm-12">
                                            <input type="text" class="form-control" value="<?= base_url('sitemap.xml'); ?>" readonly>
                                            <a href="<?= base_url('sitemap.xml'); ?>" target="_blank" class="input-group-addon btn btn-primary" id="basic-addon2"><?=lang('visit'); ?></a>
                                            <a href="<?= admin_url('shop_settings/sitemap'); ?>" target="_blank" class="input-group-addon btn btn-warning" id="basic-addon2"><?=lang('update'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="well well-sm" style="margin-bottom:0;">
                        <p><?= lang('call_back_heading'); ?></p>
                        <p class="text-info">
                            <code><?= site_url('social_auth/login/XXXXXX'); ?></code><br>
                            <code><?= base_url('index.php/social_auth/login/XXXXXX'); ?></code>
                        </p>
                        <p><?= lang('replace_xxxxxx_with_provider'); ?></p>
                        <p><strong><?= lang('enable_config_file'); ?></strong></p>
                        <p><code>app/config/hybridauthlib.php</code></p>
                        <p><?= lang('documentation_at'); ?>: <a href="http://hybridauth.github.io/hybridauth/userguide.html" target="_blank">http://hybridauth.github.io/hybridauth/userguide.html</a></p>
                    </div>
                </div>
                </div>
                <?php
                    } ?>
            </div>
        </div>
    </div>
</div>
