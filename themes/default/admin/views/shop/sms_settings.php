<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header">
        <!--h2 class="blue"><i class="fa-fw fa fa-cog"></i><?= lang('sms_settings'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?= lang('update_info'); ?></p>

                <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'sms-settings'];
                echo admin_form_open('shop_settings/sms_settings', $attrib);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= lang('auto_send', 'auto_send'); ?>
                            <?php $opts = [0 => lang('no'), 1 => lang('yes')]; ?>
                            <?= form_dropdown('auto_send', $opts, set_value('auto_send', $sms_settings->auto_send), 'class="form-control tip" id="auto_send" required="required" style="width:100%;"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('gateway', 'gateway'); ?>
                            <?php
                            $gopts = [
                                'Log'         => 'Log',
                                'Bulksms'     => 'Bulksms',
                                'Clickatell'  => 'Clickatell',
                                'Gupshup'     => 'Gupshup',
                                'Infobip'     => 'Infobip',
                                'Itexmo'      => 'Itexmo',
                                'Mocker'      => 'Mocker',
                                'MVaayoo'     => 'MVaayoo',
                                'Nexmo'       => 'Nexmo',
                                'SmsAchariya' => 'SmsAchariya',
                                'Smsapi'      => 'Smsapi',
                                'SmsCountry'  => 'SmsCountry',
                                'SmsLane'     => 'SmsLane',
                                'Twilio'      => 'Twilio',
                                'Custom'      => 'Custom',
                            ];
                            ?>
                            <?= form_dropdown('gateway', $gopts, set_value('gateway', $sms_settings->config->gateway), 'class="form-control tip" id="gateway" required="required" style="width:100%;"'); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-6">

                    <div class="Custom dn">
                        <div class="form-group">
                            <?= lang('url', 'Custom_url'); ?>
                            <?= form_input('Custom_url', set_value('Custom_url', $sms_settings->config->{$sms_settings->config->gateway}->url ?? ''), 'class="form-control tip" id="Custom_url" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('send_to_name', 'Custom_send_to_name'); ?>
                            <?= form_input('Custom_send_to_name', set_value('Custom_send_to_name', $sms_settings->config->{$sms_settings->config->gateway}->params->send_to_name ?? ''), 'class="form-control tip" id="Custom_send_to_name" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('msg_name', 'Custom_msg_name'); ?>
                            <?= form_input('Custom_msg_name', set_value('Custom_msg_name', $sms_settings->config->{$sms_settings->config->gateway}->params->msg_name ?? ''), 'class="form-control tip" id="Custom_msg_name" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('param1', 'Custom_param1'); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $param1 = $sms_settings->config->{$sms_settings->config->gateway}->params->keys->param1 ?? ''; ?>
                                    <?= form_input('Custom_param1_key', set_value('Custom_param1_key', $param1), 'placeholder="Name" class="form-control tip" id="Custom_param1_key"'); ?>
                                </div>
                                <div class="col-md-6">
                                    <?= form_input('Custom_param1_value', set_value('Custom_param1_value', $param1 ? $sms_settings->config->{$sms_settings->config->gateway}->params->others->{$param1} : ''), 'placeholder="Value" class="form-control tip" id="Custom_param1_value"'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= lang('param2', 'Custom_param2'); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $param2 = $sms_settings->config->{$sms_settings->config->gateway}->params->keys->param2 ?? ''; ?>
                                    <?= form_input('Custom_param2_key', set_value('Custom_param2_key', $param2), 'placeholder="Name" class="form-control tip" id="Custom_param2_key"'); ?>
                                </div>
                                <div class="col-md-6">
                                    <?= form_input('Custom_param2_value', set_value('Custom_param2_value', $param2 ? $sms_settings->config->{$sms_settings->config->gateway}->params->others->{$param2} : ''), 'placeholder="Value" class="form-control tip" id="Custom_param2_value"'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= lang('param3', 'Custom_param3'); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $param3 = $sms_settings->config->{$sms_settings->config->gateway}->params->keys->param3 ?? ''; ?>
                                    <?= form_input('Custom_param3_key', set_value('Custom_param3_key', $param3), 'placeholder="Name" class="form-control tip" id="Custom_param3_key"'); ?>
                                </div>
                                <div class="col-md-6">
                                    <?= form_input('Custom_param3_value', set_value('Custom_param3_value', $param3 ? $sms_settings->config->{$sms_settings->config->gateway}->params->others->{$param3} : ''), 'placeholder="Value" class="form-control tip" id="Custom_param3_value"'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= lang('param4', 'Custom_param4'); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $param4 = $sms_settings->config->{$sms_settings->config->gateway}->params->keys->param4 ?? ''; ?>
                                    <?= form_input('Custom_param4_key', set_value('Custom_param4_key', $param4), 'placeholder="Name" class="form-control tip" id="Custom_param4_key"'); ?>
                                </div>
                                <div class="col-md-6">
                                    <?= form_input('Custom_param4_value', set_value('Custom_param4_value', $param4 ? $sms_settings->config->{$sms_settings->config->gateway}->params->others->{$param4} : ''), 'placeholder="Value" class="form-control tip" id="Custom_param4_value"'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= lang('param5', 'Custom_param5'); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $param5 = $sms_settings->config->{$sms_settings->config->gateway}->params->keys->param5 ?? ''; ?>
                                    <?= form_input('Custom_param5_key', set_value('Custom_param5_key', $param5), 'placeholder="Name" class="form-control tip" id="Custom_param5_key"'); ?>
                                </div>
                                <div class="col-md-6">
                                    <?= form_input('Custom_param5_value', set_value('Custom_param5_value', $param5 ? $sms_settings->config->{$sms_settings->config->gateway}->params->others->{$param5} : ''), 'placeholder="Value" class="form-control tip" id="Custom_param5_value"'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="Clickatell dn">
                        <div class="form-group">
                            <?= lang('apiKey', 'Clickatell_apiKey'); ?>
                            <?= form_input('Clickatell_apiKey', set_value('Clickatell_apiKey', $sms_settings->config->{$sms_settings->config->gateway}->apiKey ?? ''), 'class="form-control tip" id="Clickatell_apiKey" required="required"'); ?>
                        </div>
                    </div>

                    <div class="Smsapi dn">
                        <div class="form-group">
                            <?= lang('access_token', 'Smsapi_access_token'); ?>
                            <?= form_input('Smsapi_access_token', set_value('Smsapi_access_token', $sms_settings->config->{$sms_settings->config->gateway}->access_token ?? ''), 'class="form-control tip" id="Smsapi_access_token" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('from', 'Smsapi_from'); ?>
                            <?= form_input('Smsapi_from', set_value('Smsapi_from', $sms_settings->config->{$sms_settings->config->gateway}->from ?? ''), 'class="form-control tip" id="Smsapi_from" required="required"'); ?>
                        </div>
                    </div>

                    <div class="Bulksms dn">
                        <div class="form-group">
                            <?= lang('eapi_url', 'Bulksms_eapi_url'); ?>
                            <?= form_input('Bulksms_eapi_url', set_value('Bulksms_eapi_url', $sms_settings->config->{$sms_settings->config->gateway}->eapi_url ?? ''), 'class="form-control tip" id="Bulksms_eapi_url" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('username', 'Bulksms_username'); ?>
                            <?= form_input('Bulksms_username', set_value('Bulksms_username', $sms_settings->config->{$sms_settings->config->gateway}->username ?? ''), 'class="form-control tip" id="Bulksms_username" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('password', 'Bulksms_password'); ?>
                            <?= form_input('Bulksms_password', set_value('Bulksms_password', $sms_settings->config->{$sms_settings->config->gateway}->password ?? ''), 'class="form-control tip" id="Bulksms_password" required="required"'); ?>
                        </div>
                    </div>

                    <div class="Infobip dn">
                        <div class="form-group">
                            <?= lang('username', 'Infobip_username'); ?>
                            <?= form_input('Infobip_username', set_value('Infobip_username', $sms_settings->config->{$sms_settings->config->gateway}->username ?? ''), 'class="form-control tip" id="Infobip_username" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('password', 'Infobip_password'); ?>
                            <?= form_input('Infobip_password', set_value('Infobip_password', $sms_settings->config->{$sms_settings->config->gateway}->password ?? ''), 'class="form-control tip" id="Infobip_password" required="required"'); ?>
                        </div>
                    </div>

                    <div class="Mocker dn">
                        <div class="form-group">
                            <?= lang('sender_id', 'Mocker_sender_id'); ?>
                            <?= form_input('Mocker_sender_id', set_value('Mocker_sender_id', $sms_settings->config->{$sms_settings->config->gateway}->sender_id ?? ''), 'class="form-control tip" id="Mocker_sender_id" required="required"'); ?>
                        </div>
                    </div>

                    <div class="Twilio dn">
                        <div class="form-group">
                            <?= lang('account_sid', 'Twilio_account_sid'); ?>
                            <?= form_input('Twilio_account_sid', set_value('Twilio_account_sid', $sms_settings->config->{$sms_settings->config->gateway}->account_sid ?? ''), 'class="form-control tip" id="Twilio_account_sid" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('auth_token', 'Twilio_auth_token'); ?>
                            <?= form_input('Twilio_auth_token', set_value('Twilio_auth_token', $sms_settings->config->{$sms_settings->config->gateway}->auth_token ?? ''), 'class="form-control tip" id="Twilio_auth_token" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('from', 'Twilio_from'); ?>
                            <?= form_input('Twilio_from', set_value('Twilio_from', $sms_settings->config->{$sms_settings->config->gateway}->from ?? ''), 'class="form-control tip" id="Twilio_from" required="required"'); ?>
                        </div>
                    </div>

                    <div class="Nexmo dn">
                        <div class="form-group">
                            <?= lang('api_key', 'Nexmo_api_key'); ?>
                            <?= form_input('Nexmo_api_key', set_value('Nexmo_api_key', $sms_settings->config->{$sms_settings->config->gateway}->api_key ?? ''), 'class="form-control tip" id="Nexmo_api_key" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('api_secret', 'Nexmo_api_secret'); ?>
                            <?= form_input('Nexmo_api_secret', set_value('Nexmo_api_secret', $sms_settings->config->{$sms_settings->config->gateway}->api_secret ?? ''), 'class="form-control tip" id="Nexmo_api_secret" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('from', 'Nexmo_from'); ?>
                            <?= form_input('Nexmo_from', set_value('Nexmo_from', $sms_settings->config->{$sms_settings->config->gateway}->from ?? ''), 'class="form-control tip" id="Nexmo_from" required="required"'); ?>
                        </div>
                    </div>

                    <div class="SmsLane dn">
                        <div class="form-group">
                            <?= lang('user', 'SmsLane_user'); ?>
                            <?= form_input('SmsLane_user', set_value('SmsLane_user', $sms_settings->config->{$sms_settings->config->gateway}->user ?? ''), 'class="form-control tip" id="SmsLane_user" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('password', 'SmsLane_password'); ?>
                            <?= form_input('SmsLane_password', set_value('SmsLane_password', $sms_settings->config->{$sms_settings->config->gateway}->password ?? ''), 'class="form-control tip" id="SmsLane_password" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('sid', 'SmsLane_sid'); ?>
                            <?= form_input('SmsLane_sid', set_value('SmsLane_sid', $sms_settings->config->{$sms_settings->config->gateway}->sid ?? ''), 'class="form-control tip" id="SmsLane_sid" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('gwid', 'SmsLane_gwid'); ?>
                            <?= form_input('SmsLane_gwid', set_value('SmsLane_gwid', $sms_settings->config->{$sms_settings->config->gateway}->gwid ?? ''), 'class="form-control tip" id="SmsLane_gwid" required="required"'); ?>
                        </div>
                    </div>

                    <div class="SmsCountry dn">
                        <div class="form-group">
                            <?= lang('user', 'SmsCountry_user'); ?>
                            <?= form_input('SmsCountry_user', set_value('SmsCountry_user', $sms_settings->config->{$sms_settings->config->gateway}->user ?? ''), 'class="form-control tip" id="SmsCountry_user" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('password', 'SmsCountry_passwd'); ?>
                            <?= form_input('SmsCountry_passwd', set_value('SmsCountry_passwd', $sms_settings->config->{$sms_settings->config->gateway}->passwd ?? ''), 'class="form-control tip" id="SmsCountry_passwd" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('sid', 'SmsCountry_sid'); ?>
                            <?= form_input('SmsCountry_sid', set_value('SmsCountry_sid', $sms_settings->config->{$sms_settings->config->gateway}->sod ?? ''), 'class="form-control tip" id="SmsCountry_sid" required="required"'); ?>
                        </div>
                    </div>

                    <div class="SmsAchariya dn">
                        <div class="form-group">
                            <?= lang('domain', 'SmsAchariya_domain'); ?>
                            <?= form_input('SmsAchariya_domain', set_value('SmsAchariya_domain', $sms_settings->config->{$sms_settings->config->gateway}->domain ?? ''), 'class="form-control tip" id="SmsAchariya_domain" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('uid', 'SmsAchariya_uid'); ?>
                            <?= form_input('SmsAchariya_uid', set_value('SmsAchariya_uid', $sms_settings->config->{$sms_settings->config->gateway}->uid ?? ''), 'class="form-control tip" id="SmsAchariya_uid" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('pin', 'SmsAchariya_pin'); ?>
                            <?= form_input('SmsAchariya_pin', set_value('SmsAchariya_pin', $sms_settings->config->{$sms_settings->config->gateway}->pin ?? ''), 'class="form-control tip" id="SmsAchariya_pin" required="required"'); ?>
                        </div>
                    </div>

                    <div class="MVaayoo dn">
                        <div class="form-group">
                            <?= lang('user', 'MVaayoo_user'); ?>
                            <?= form_input('MVaayoo_user', set_value('MVaayoo_user', $sms_settings->config->{$sms_settings->config->gateway}->user ?? ''), 'class="form-control tip" id="MVaayoo_user" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('api_id', 'MVaayoo_senderID'); ?>
                            <?= form_input('MVaayoo_senderID', set_value('MVaayoo_senderID', $sms_settings->config->{$sms_settings->config->gateway}->senderID ?? ''), 'class="form-control tip" id="MVaayoo_senderID" required="required"'); ?>
                        </div>
                    </div>

                    <div class="Gupshup dn">
                        <div class="form-group">
                            <?= lang('userid', 'Gupshup_userid'); ?>
                            <?= form_input('Gupshup_userid', set_value('Gupshup_userid', $sms_settings->config->{$sms_settings->config->gateway}->userid ?? ''), 'class="form-control tip" id="Gupshup_userid" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('password', 'Gupshup_password'); ?>
                            <?= form_input('Gupshup_password', set_value('Gupshup_password', $sms_settings->config->{$sms_settings->config->gateway}->password ?? ''), 'class="form-control tip" id="Gupshup_password" required="required"'); ?>
                        </div>
                    </div>

                    <div class="Itexmo dn">
                        <div class="form-group">
                            <?= lang('api_code', 'Itexmo_api_code'); ?>
                            <?= form_input('Itexmo_api_code', set_value('Itexmo_api_code', $sms_settings->config->{$sms_settings->config->gateway}->api_code ?? ''), 'class="form-control tip" id="Itexmo_api_code" required="required"'); ?>
                        </div>
                    </div>

                    <?= form_submit('sms_settings', lang('submit'), 'class="btn btn-primary"'); ?>
                    </div>

                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.dn').hide();
        var gw = $('#gateway').val();
        if (gw) {
            $('.'+gw).slideDown();
        }
        $(document).on('change', '#gateway', function() {
            var gw = $(this).val();
            if (gw) {
                $('.dn').slideUp();
                $('.'+gw).slideDown();
            }
            return;
        });
    });
</script>
