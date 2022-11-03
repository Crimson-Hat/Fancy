<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
if ($error) {
    ?>
    <div class="alert alert-danger">
        <button data-dismiss="alert" class="close" type="button">×</button>
        <ul class="list-group"><?= $error; ?></ul>
    </div>
    <?php
}
if ($message) {
    ?>
    <div class="alert alert-success">
        <button data-dismiss="alert" class="close" type="button">×</button>
        <ul class="list-group"><?= $message; ?></ul>
    </div>
    <?php
}
?>
<?= form_open('login', 'class="validate"'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php if (!$shop_settings->private) {
    ?>
                <a href="<?= site_url('login#register'); ?>" class="pull-right text-blue"><?= lang('register'); ?></a>
            <?php
} ?>
            <?php $u = mt_rand(); ?>
            <label for="username<?= $u; ?>" class="control-label"><?= lang('identity'); ?></label>
            <input type="text" name="identity" id="username<?= $u; ?>" class="form-control" value="" required placeholder="<?= lang('email'); ?>">
        </div>
        <div class="form-group">
            <a href="#" tabindex="-1" class="forgot-password pull-right text-blue"><?= lang('forgot?'); ?></a>
            <label for="password<?= $u; ?>" class="control-label"><?= lang('password'); ?></label>
            <input type="password" id="password<?= $u; ?>" name="password" class="form-control" placeholder="<?= lang('password'); ?>" value="" required>
        </div>
        <?php
        if ($Settings->captcha) {
            ?>
            <div class="form-group">
            <div class="form-group text-center">
                    <span class="captcha-image"><?= $image; ?></span>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <a href="<?= admin_url('auth/reload_captcha'); ?>" class="reload-captcha text-blue">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </span>
                        <?= form_input($captcha); ?>
                    </div>
                </div>
            </div>
            <?php
        } /* echo $recaptcha_html; */
        ?>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="remember_me"><span> <?= lang('remember_me'); ?></span>
                </label>
            </div>
        </div>
        <button type="submit" value="login" name="login" class="btn btn-block btn-success"><?= lang('login'); ?></button>
    </div>
</div>
<?= form_close(); ?>

<?php
if (!$shop_settings->private) {
            $providers = config_item('providers');
            foreach ($providers as $key => $provider) {
                if ($provider['enabled']) {
                    echo '<div style="margin-top:10px;"><a href="' . site_url('social_auth/login/' . $key) . '" class="btn btn-sm mt btn-default btn-block" title="' . lang('login_with') . ' ' . $key . '">' . lang('login_with') . ' ' . $key . '</a></div>';
                }
            }
        }
?>
