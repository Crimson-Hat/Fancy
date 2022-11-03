<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-send"></i><?= lang('send_sms'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?= lang('send_sms_heading'); ?></p>
                <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'send-sms', 'autocomplete' => 'off'];
                echo admin_form_open('shop_settings/send_sms', $attrib);
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= form_input('customer', '', 'id="ncustomer" placeholder="' . lang('search_phone_by_customer') . '" class="form-control" style="width:100%;" autocomplete="off"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('mobile', 'mobile'); ?>
                            <?= form_input('mobile', set_value('mobile'), 'class="form-control tip" id="mobile" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('message', 'message'); ?>
                            <?= form_textarea('message', set_value('message'), 'class="form-control skip" rows="3" style="height:80px;" id="message" required="required"'); ?>
                        </div>
                        <?= form_submit('send_sms', lang('send_sms'), 'class="btn btn-primary"'); ?>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#ncustomer').autocomplete({
        minLength: 1,
        source: site.base_url+"customers/suggestions/0/0/1",
        response: function (event, ui) {
            if (ui.content.length == 1) {
                ui.item = ui.content[0];
                $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                $(this).autocomplete('close');
            }
            $(this).removeClass('ui-autocomplete-loading');
            $(this).val('');
        },
        select: function (event, ui) {
            event.preventDefault();
            var mobile = $('#mobile').val();
            if (mobile.indexOf(ui.item.phone) == -1) {
                $('#mobile').val(mobile+ui.item.phone+', ')
            }
        }
    });
});
</script>
