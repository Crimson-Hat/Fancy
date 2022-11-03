<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="row">
                    <div class="col-sm-9 col-md-10">

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#user" aria-controls="user" role="tab" data-toggle="tab"><?= lang('details'); ?></a></li>
                            <li role="presentation"><a href="#password" aria-controls="password" role="tab" data-toggle="tab"><?= lang('change_password'); ?></a></li>
                        </ul>

                        <div class="tab-content padding-lg white bordered-light" style="margin-top:-1px;">
                            <div role="tabpanel" class="tab-pane fade in active" id="user">

                                <p><?= lang('fill_form'); ?></p>
                                <?= form_open('profile/user', 'class="validate"'); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang('first_name', 'first_name'); ?>
                                            <?= form_input('first_name', set_value('first_name', $user->first_name), 'class="form-control tip" id="first_name" required="required"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang('last_name', 'last_name'); ?>
                                            <?= form_input('last_name', set_value('last_name', $user->last_name), 'class="form-control tip" id="last_name" required="required"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang('phone', 'phone'); ?>
                                            <?= form_input('phone', set_value('phone', $customer->phone), 'class="form-control tip" id="phone" required="required"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang('email', 'email'); ?>
                                            <?= form_input('email', set_value('email', $customer->email), 'class="form-control tip" id="email" required="required"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang('company', 'company'); ?>
                                            <?= form_input('company', set_value('company', $customer->company), 'class="form-control tip" id="company"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang('vat_no', 'vat_no'); ?>
                                            <?= form_input('vat_no', set_value('vat_no', $customer->vat_no), 'class="form-control tip" id="vat_no"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang('billing_address', 'address'); ?>
                                            <?= form_input('address', set_value('address', $customer->address), 'class="form-control tip" id="address" required="required"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang('city', 'city'); ?>
                                            <?= form_input('city', set_value('city', $customer->city), 'class="form-control tip" id="city" required="required"'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang('state', 'state'); ?>
                                            <?php
                                            if ($Settings->indian_gst) {
                                                $states = $this->gst->getIndianStates(true);
                                                echo form_dropdown('state', $states, set_value('state', $customer->state), 'class="form-control selectpicker mobile-device" id="state" required="required"');
                                            } else {
                                                echo form_input('state', set_value('state', $customer->state), 'class="form-control" id="state"');
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang('postal_code', 'postal_code'); ?>
                                            <?= form_input('postal_code', set_value('postal_code', $customer->postal_code), 'class="form-control tip" id="postal_code" required="required"'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang('country', 'country'); ?>
                                            <?= form_input('country', set_value('country', $customer->country), 'class="form-control tip" id="country" required="required"'); ?>
                                        </div>
                                    </div>
                                </div>

                                <?= form_submit('billing', lang('update'), 'class="btn btn-primary"'); ?>
                                <?php echo form_close(); ?>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="password">
                                <p><?= lang('fill_form'); ?></p>
                                <?= form_open('profile/password', 'class="validate"'); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang('current_password', 'old_password'); ?>
                                            <?= form_password('old_password', set_value('old_password'), 'class="form-control tip" id="old_password" required="required"'); ?>
                                        </div>

                                        <div class="form-group">
                                            <?= lang('new_password', 'new_password'); ?>
                                            <?= form_password('new_password', set_value('new_password'), 'class="form-control tip" id="new_password" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" data-fv-regexp-message="' . lang('pasword_hint') . '"'); ?>
                                        </div>

                                        <div class="form-group">
                                            <?= lang('confirm_password', 'new_password_confirm'); ?>
                                            <?= form_password('new_password_confirm', set_value('new_password_confirm'), 'class="form-control tip" id="new_password_confirm" required="required" data-fv-identical="true" data-fv-identical-field="new_password" data-fv-identical-message="' . lang('pw_not_same') . '"'); ?>
                                        </div>

                                        <?= form_submit('change_password', lang('change_password'), 'class="btn btn-primary"'); ?>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-2">
                        <div id="sticky-con">
                        <?php
                        if ($side_featured) {
                            ?>
                            <h4 class="margin-top-md title text-bold">
                                <span><?= lang('featured'); ?></span>
                                <div class="pull-right">
                                    <div class="controls pull-right hidden-xs">
                                        <a class="left fa fa-chevron-left btn btn-xs btn-default" href="#carousel-example"
                                        data-slide="prev"></a>
                                        <a class="right fa fa-chevron-right btn btn-xs btn-default" href="#carousel-example"
                                        data-slide="next"></a>
                                    </div>
                                </div>
                            </h4>

                            <div id="carousel-example" class="carousel slide" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <?php
                                    $r = 0;
                            foreach ($side_featured as $fp) {
                                ?>
                                        <div class="item <?= empty($r) ? 'active' : ''; ?>">
                                            <div class="featured-products">
                                                <div class="product" style="z-index: 1;">
                                                    <div class="details" style="transition: all 100ms ease-out 0s;">
                                                        <?php
                                                        if ($fp->promotion) {
                                                            ?>
                                                            <span class="badge badge-right theme"><?= lang('promo'); ?></span>
                                                            <?php
                                                        } ?>
                                                        <img src="<?= base_url('assets/uploads/' . $fp->image); ?>" alt="">
                                                        <?php if (!$shop_settings->hide_price) {
                                                            ?>
                                                        <div class="image_overlay"></div>
                                                        <div class="btn btn-sm add-to-cart" data-id="<?= $fp->id; ?>"><i class="fa fa-shopping-cart"></i> <?= lang('add_to_cart'); ?></div>
                                                        <?php
                                                        } ?>
                                                        <div class="stats-container">
                                                            <?php if (!$shop_settings->hide_price) {
                                                            ?>
                                                            <span class="product_price">
                                                                <?php
                                                                if ($fp->promotion) {
                                                                    echo '<del class="text-red">' . $this->sma->convertMoney(isset($fp->special_price) && !empty(isset($fp->special_price)) ? $fp->special_price : $fp->price) . '</del><br>';
                                                                    echo $this->sma->convertMoney($fp->promo_price);
                                                                } else {
                                                                    echo $this->sma->convertMoney(isset($fp->special_price) && !empty(isset($fp->special_price)) ? $fp->special_price : $fp->price);
                                                                } ?>
                                                            </span>
                                                            <?php
                                                        } ?>
                                                            <span class="product_name">
                                                                <a href="<?= site_url('product/' . $fp->slug); ?>"><?= $fp->name; ?></a>
                                                            </span>
                                                            <a href="<?= site_url('category/' . $fp->category_slug); ?>" class="link"><?= $fp->category_name; ?></a>
                                                            <?php
                                                            if ($fp->brand_name) {
                                                                ?>
                                                                <span class="link">-</span>
                                                                <a href="<?= site_url('brand/' . $fp->brand_slug); ?>" class="link"><?= $fp->brand_name; ?></a>
                                                                <?php
                                                            } ?>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $r++;
                            } ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
