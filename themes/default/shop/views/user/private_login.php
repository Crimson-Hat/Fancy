<?php defined('BASEPATH') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">if (parent.frames.length !== 0) { top.location = '<?= site_url(); ?>'; }</script>
    <title><?= $page_title; ?></title>
    <meta name="description" content="<?= $page_desc; ?>">
    <link rel="shortcut icon" href="<?= $assets; ?>images/icon.png">
    <link href="<?= $assets; ?>css/libs.min.css" rel="stylesheet">
    <link href="<?= $assets; ?>css/styles.min.css" rel="stylesheet">
    <style>
    html, body { height: 100%; }
    body { display: flex; align-items: center; justify-content: center; padding: 40px 0; background-color: #f5f5f5; min-height: 450px; }
    .container { width: 100%; max-width: 330px; }
    .login { padding: 15px; margin: 0 auto; background: #FFF; text-align: left; border: 1px solid #ccc; border-radius: 4px; }
</style>
</head>
<body class="text-center">

    <div class="container">
        <?php
        if ($shop_settings->logo) {
            echo '<img alt="' . $shop_settings->shop_name . '" src="' . base_url('assets/uploads/logos/' . $shop_settings->logo) . '" style="margin-bottom:10px;max-width:100%;" />';
        } else {
            echo '<h1 style="text-transform:uppercase;">' . $shop_settings->shop_name . '</h1>';
        }
        ?>
        <div class="login">
            <h4 class="text-primary" style="margin: 0 0 20px 0;"><?= lang('login_to_your_account') ?></h4>
            <?php include 'login_form.php'; ?>
        </div>
    </div>

    <script type="text/javascript">
        var m, v, shop_color, shop_grid, sorting;
        var cart = products = filters = lang = {};
        var site = {base_url: '<?= base_url(); ?>', site_url: '<?= site_url('/'); ?>', shop_url: '<?= shop_url(); ?>', csrf_token: '<?= $this->security->get_csrf_token_name() ?>', csrf_token_value: '<?= $this->security->get_csrf_hash() ?>'};
        lang.error = '<?= lang('error'); ?>';
        lang.submit = '<?= lang('submit'); ?>';
        lang.reset_pw = '<?= lang('forgot_password?'); ?>';
        lang.type_email = '<?= lang('type_email_to_reset'); ?>';

    </script>
    <script src="<?= $assets; ?>js/libs.min.js"></script>
    <script src="<?= $assets; ?>js/scripts.min.js"></script>
    <script type="text/javascript">
        <?php
        if ($message || $warning || $error || $reminder) {
            ?>
            $(document).ready(function() {
                <?php if ($message) {
                ?>
                    sa_alert('<?=lang('success'); ?>', '<?= trim(str_replace(["\r", "\n", "\r\n"], '', addslashes($message))); ?>');
                    <?php
            }
            if ($warning) {
                ?>
                        sa_alert('<?=lang('warning'); ?>', '<?= trim(str_replace(["\r", "\n", "\r\n"], '', addslashes($warning))); ?>', 'warning');
                        <?php
            }
            if ($error) {
                ?>
                            sa_alert('<?=lang('error'); ?>', '<?= trim(str_replace(["\r", "\n", "\r\n"], '', addslashes($error))); ?>', 'error', 1);
                            <?php
            }
            if ($reminder) {
                ?>
                                sa_alert('<?=lang('reminder'); ?>', '<?= trim(str_replace(["\r", "\n", "\r\n"], '', addslashes($reminder))); ?>', 'info');
                                <?php
            } ?>
                            });
            <?php
        }
        ?>
    </script>
</body>
</html>
