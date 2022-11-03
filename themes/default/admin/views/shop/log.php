<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>$(document).ready(function () {
        CURI = '<?= admin_url('shop_settings/sms_log'); ?>';
    });</script>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-file-text-o"></i><?= lang('sms_log'); ?></h2>
        <div class="box-icon">
            <div class="form-group choose-date hidden-xs">
                <div class="controls">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" value="<?= $date; ?>" id="log-date" class="form-control">
                        <span class="input-group-addon"><i class="fa fa-chevron-down"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?= lang('sms_log_heading'); ?></p>
                <div class="row">
                    <div class="col-md-12">
                        <pre><?php echo $log; ?></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
