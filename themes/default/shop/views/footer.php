<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if (DEMO && ($m == 'main' && $v == 'index')) {
    ?>
<div class="page-contents padding-top-no">
    <div class="container">
        <div class="alert alert-info margin-bottom-no">
            <p>
                <strong>Shop module is not complete item but add-on to Stock Manager Advance and is available separately.</strong><br>
                This is joint demo for main item (Stock Manager Advance) and add-ons (POS & Shop Module). Please check the item page on codecanyon.net for more info about what's not included in the item and you must read the page there before purchase. Thank you
            </p>
        </div>
    </div>
</div>
<?php
} ?>

<section class="footer">
    <div class="container padding-bottom-md">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title-footer"><span><?= lang('about_us'); ?></span></div>
                <p>
                    <?= $shop_settings->description; ?> <a href="<?= site_url('page/' . $shop_settings->about_link); ?>"><?= lang('read_more'); ?></a>
                </p>
                <p>
                    <i class="fa fa-phone"></i> <span class="margin-left-md"><?= $shop_settings->phone; ?></span>
                    <i class="fa fa-envelope margin-left-xl"></i> <span class="margin-left-md"><?= $shop_settings->email; ?></span>
                </p>
                <ul class="list-inline">
                    <li><a href="<?= site_url('page/' . $shop_settings->privacy_link); ?>"><?= lang('privacy_policy'); ?></a></li>
                    <li><a href="<?= site_url('page/' . $shop_settings->terms_link); ?>"><?= lang('terms_conditions'); ?></a></li>
                    <li><a href="<?= site_url('page/' . $shop_settings->contact_link); ?>"><?= lang('contact_us'); ?></a></li>
                </ul>
            </div>

            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6">
                <div class="title-footer"><span><?= lang('payment_methods'); ?></span></div>
                <p><?= $shop_settings->payment_text; ?></p>
                <img class="img-responsive" src="<?= $assets; ?>/images/payment-methods.png" alt="Payment Methods">
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="title-footer"><span><?= lang('follow_us'); ?></span></div>
                <p><?= $shop_settings->follow_text; ?></p>
                <ul class="follow-us">
                    <?php if (!empty($shop_settings->facebook)) {
        ?>
                    <li><a target="_blank" href="<?= $shop_settings->facebook; ?>"><i class="fa fa-facebook"></i></a></li>
                    <?php
    } if (!empty($shop_settings->twitter)) {
        ?>
                    <li><a target="_blank" href="<?= $shop_settings->twitter; ?>"><i class="fa fa-twitter"></i></a></li>
                    <?php
    } if (!empty($shop_settings->google_plus)) {
        ?>
                    <li><a target="_blank" href="<?= $shop_settings->google_plus; ?>"><i class="fa fa-google-plus"></i></a></li>
                    <?php
    } if (!empty($shop_settings->instagram)) {
        ?>
                    <li><a target="_blank" href="<?= $shop_settings->instagram; ?>"><i class="fa fa-instagram"></i></a></li>
                    <?php
    } ?>
                </ul>
            </div>

        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="copyright line-height-lg">
                &copy; <?= date('Y'); ?> <?= $shop_settings->shop_name; ?>. <?= lang('all_rights_reserved'); ?>
            </div>
            <ul class="list-inline pull-right line-height-md">
                <li class="padding-x-no text-size-lg">
                    <a href="#" class="theme-color text-blue" data-color="blue"><i class="fa fa-square"></i></a>
                </li>
                <li class="padding-x-no text-size-lg">
                    <a href="#" class="theme-color text-blue-grey" data-color="blue-grey"><i class="fa fa-square"></i></a>
                </li>
                <li class="padding-x-no text-size-lg">
                    <a href="#" class="theme-color text-brown" data-color="brown"><i class="fa fa-square"></i></a>
                </li>
                <li class="padding-x-no text-size-lg">
                    <a href="#" class="theme-color text-cyan" data-color="cyan"><i class="fa fa-square"></i></a>
                </li>
                <li class="padding-x-no text-size-lg">
                    <a href="#" class="theme-color text-green" data-color="green"><i class="fa fa-square"></i></a>
                </li>
                <li class="padding-x-no text-size-lg">
                    <a href="#" class="theme-color text-grey" data-color="grey"><i class="fa fa-square"></i></a>
                </li>
                <li class="padding-x-no text-size-lg">
                    <a href="#" class="theme-color text-purple" data-color="purple"><i class="fa fa-square"></i></a>
                </li>
                <li class="padding-x-no text-size-lg">
                    <a href="#" class="theme-color text-orange" data-color="orange"><i class="fa fa-square"></i></a>
                </li>
                <li class="padding-x-no text-size-lg">
                    <a href="#" class="theme-color text-pink" data-color="pink"><i class="fa fa-square"></i></a>
                </li>
                <li class="padding-x-no text-size-lg">
                    <a href="#" class="theme-color text-red" data-color="red"><i class="fa fa-square"></i></a>
                </li>
                <li class="padding-x-no text-size-lg">
                    <a href="#" class="theme-color text-teal" data-color="teal"><i class="fa fa-square"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</section>

<a href="#" class="back-to-top text-center" onclick="$('body,html').animate({scrollTop:0},500); return false">
    <i class="fa fa-angle-double-up"></i>
</a>
</section>
<?php if (!get_cookie('shop_use_cookie') && get_cookie('shop_use_cookie') != 'accepted' && !empty($shop_settings->cookie_message)) {
        ?>
<div class="cookie-warning">
    <div class="bounceInLeft alert alert-info">
        <!-- <a href="<?= site_url('main/cookie/accepted'); ?>" class="close">&times;</a> -->
        <a href="<?= site_url('main/cookie/accepted'); ?>" class="btn btn-sm btn-primary" style="float: right;"><?= lang('i_accept'); ?></a>
        <p>
            <?= $shop_settings->cookie_message; ?>
            <?php if (!empty($shop_settings->cookie_link)) {
            ?>
            <a href="<?= site_url('page/' . $shop_settings->cookie_link); ?>"><?= lang('read_more'); ?></a>
            <?php
        } ?>
        </p>
    </div>
</div>
<?php
    } ?>
<script src="<?= $assets; ?>js/libs.min.js"></script>
<script src="<?= $assets; ?>js/scripts.min.js"></script>
<script type="text/javascript">
    var m = '<?= $m; ?>', v = '<?= $v; ?>', products = {}, filters = <?= isset($filters) && !empty($filters) ? json_encode($filters) : '{}'; ?>, shop_color, shop_grid, sorting;

    var cart = <?= isset($cart) && !empty($cart) ? json_encode($cart) : '{}' ?>;
    var site = {base_url: '<?= base_url(); ?>', site_url: '<?= site_url('/'); ?>', shop_url: '<?= shop_url(); ?>', csrf_token: '<?= $this->security->get_csrf_token_name() ?>', csrf_token_value: '<?= $this->security->get_csrf_hash() ?>', settings: {display_symbol: '<?= $Settings->display_symbol; ?>', symbol: '<?= $Settings->symbol; ?>', decimals: <?= $Settings->decimals; ?>, thousands_sep: '<?= $Settings->thousands_sep; ?>', decimals_sep: '<?= $Settings->decimals_sep; ?>', order_tax_rate: false, products_page: <?= $shop_settings->products_page ? 1 : 0; ?>}, shop_settings: {private: <?= $shop_settings->private ? 1 : 0; ?>, hide_price: <?= $shop_settings->hide_price ? 1 : 0; ?>}}

    var lang = {};
    lang.page_info = '<?= lang('page_info'); ?>';
    lang.cart_empty = '<?= lang('empty_cart'); ?>';
    lang.item = '<?= lang('item'); ?>';
    lang.items = '<?= lang('items'); ?>';
    lang.unique = '<?= lang('unique'); ?>';
    lang.total_items = '<?= lang('total_items'); ?>';
    lang.total_unique_items = '<?= lang('total_unique_items'); ?>';
    lang.tax = '<?= lang('tax'); ?>';
    lang.shipping = '<?= lang('shipping'); ?>';
    lang.total_w_o_tax = '<?= lang('total_w_o_tax'); ?>';
    lang.product_tax = '<?= lang('product_tax'); ?>';
    lang.order_tax = '<?= lang('order_tax'); ?>';
    lang.total = '<?= lang('total'); ?>';
    lang.grand_total = '<?= lang('grand_total'); ?>';
    lang.reset_pw = '<?= lang('forgot_password?'); ?>';
    lang.type_email = '<?= lang('type_email_to_reset'); ?>';
    lang.submit = '<?= lang('submit'); ?>';
    lang.error = '<?= lang('error'); ?>';
    lang.add_address = '<?= lang('add_address'); ?>';
    lang.update_address = '<?= lang('update_address'); ?>';
    lang.fill_form = '<?= lang('fill_form'); ?>';
    lang.already_have_max_addresses = '<?= lang('already_have_max_addresses'); ?>';
    lang.send_email_title = '<?= lang('send_email_title'); ?>';
    lang.message_sent = '<?= lang('message_sent'); ?>';
    lang.add_to_cart = '<?= lang('add_to_cart'); ?>';
    lang.out_of_stock = '<?= lang('out_of_stock'); ?>';
    lang.x_product = '<?= lang('x_product'); ?>';
    lang.r_u_sure = '<?= lang('r_u_sure'); ?>';
    lang.x_reverted_back = "<?= lang('x_reverted_back'); ?>";
    lang.delete = '<?= lang('delete'); ?>';
    lang.line_1 = '<?= lang('line1'); ?>';
    lang.line_2 = '<?= lang('line2'); ?>';
    lang.city = '<?= lang('city'); ?>';
    lang.state = '<?= lang('state'); ?>';
    lang.postal_code = '<?= lang('postal_code'); ?>';
    lang.country = '<?= lang('country'); ?>';
    lang.phone = '<?= lang('phone'); ?>';
    lang.is_required = '<?= lang('is_required'); ?>';
    lang.okay = '<?= lang('okay'); ?>';
    lang.cancel = '<?= lang('cancel'); ?>';
    lang.email_is_invalid = '<?= lang('email_is_invalid'); ?>';
    lang.name = '<?= lang('name'); ?>';
    lang.full_name = '<?= lang('full_name'); ?>';
    lang.email = '<?= lang('email'); ?>';
    lang.subject = '<?= lang('subject'); ?>';
    lang.message = '<?= lang('message'); ?>';
    lang.required_invalid = '<?= lang('required_invalid'); ?>';

    update_mini_cart(cart);
</script>

<?php if ($m == 'shop' && $v == 'product') {
        ?>
<script type="text/javascript">
$(document).ready(function ($) {
  $('.rrssb-buttons').rrssb({
    title: '<?= $product->code . ' - ' . $product->name; ?>',
    url: '<?= site_url('product/' . $product->slug); ?>',
    image: '<?= base_url('assets/uploads/' . $product->image); ?>',
    description: '<?= $page_desc; ?>',
    // emailSubject: '',
    // emailBody: '',
  });
});
</script>
<?php
    } ?>
<script type="text/javascript">
<?php if ($message || $warning || $error || $reminder) {
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
    } ?>
</script>
<script type="text/javascript" src="<?= base_url('assets/custom/shop.js') ?>"></script>
<!-- <script>
    if(!get('shop_grid')) {
        store('shop_grid', '.three-col');
    }
</script> -->
</body>
</html>
