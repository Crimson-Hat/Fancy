<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="panel panel-default margin-top-lg">
                            <div class="panel-heading text-bold">
                                <?= sprintf(lang('reset_password_email'), $identity_label); ?>
                            </div>
                            <div class="panel-body">
                                <?= form_open('reset_password/' . $code, 'class="validate"'); ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <?= form_input($new_password); ?>
                                    </div>
                                    <span class="help-block"><?= lang('pasword_hint') ?></span>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <?= form_input($new_password_confirm); ?>
                                    </div>
                                </div>
                                <?= form_input($user_id); ?>

                                <div class="form-action clearfix">
                                    <a class="btn btn-success pull-left login_link text-white" href="<?= site_url('login') ?>">
                                        <i class="fa fa-arrow-left"></i> <?= lang('back_to_login') ?>
                                    </a>
                                    <?= form_submit('reset_password', lang('reset_password'), 'class="btn btn-primary pull-right"'); ?>
                                </div>

                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
