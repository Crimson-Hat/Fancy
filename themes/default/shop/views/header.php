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
    <link href="<?= base_url('assets/custom/shop.css') ?>" rel="stylesheet"/>
    <meta property="og:url" content="<?= isset($product) && !empty($product) ? site_url('product/' . $product->slug) : site_url(); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= $page_title; ?>" />
    <meta property="og:description" content="<?= $page_desc; ?>" />
    <meta property="og:image" content="<?= isset($product) && !empty($product) ? base_url('assets/uploads/' . $product->image) : base_url('assets/uploads/logos/' . $shop_settings->logo); ?>" />
</head>
<body>
    <section id="wrapper" class="blue">
        <header>
            <!-- Top Header -->
            <section class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                        <?php
                        if (!empty($pages)) {
                            echo '<ul class="list-inline nav pull-left hidden-xs">';
                            foreach ($pages as $page) {
                                echo '<li><a href="' . site_url('page/' . $page->slug) . '">' . $page->name . '</a></li>';
                            }
                            echo '</ul>';
                        }
                        ?>

                            <ul class="list-inline nav pull-right">
                                <?php
                                if (DEMO) {
                                    echo '<li class="hidden-xs hidden-sm"><a href="https://codecanyon.net/item/stock-manager-advance-with-all-modules/23045302?ref=Tecdiary" class="green" target="_blank"><i class="fa fa-shopping-cart"></i> Buy Now!</a></li>';
                                    echo '<li class="hidden-xs hidden-sm"><a href="' . admin_url() . '" class="green" target="_blank"><i class="fa fa-user"></i> Admin demo</a></li>';
                                }
                                ?>
                                <?= $loggedIn && $Staff ? '<li class="hidden-xs"><a href="' . admin_url() . '"><i class="fa fa-dashboard"></i> ' . lang('admin_area') . '</a></li>' : ''; ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <img src="<?= base_url('assets/images/' . $Settings->user_language . '.png'); ?>" alt="">
                                    <span class="hidden-xs">&nbsp;&nbsp;<?= ucwords($Settings->user_language); ?></span>
                                 </a>
                                 <ul class="dropdown-menu dropdown-menu-right">
                                    <?php $scanned_lang_dir = array_map(function ($path) {
                                    return basename($path);
                                }, glob(APPPATH . 'language/*', GLOB_ONLYDIR));
                                    foreach ($scanned_lang_dir as $entry) {
                                        if (file_exists(APPPATH . 'language' . DIRECTORY_SEPARATOR . $entry . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . 'shop_lang.php')) {
                                            ?>
                                    <li>
                                        <a href="<?= site_url('main/language/' . $entry); ?>">
                                            <img src="<?= base_url('assets/images/' . $entry . '.png'); ?>" class="language-img">
                                            &nbsp;&nbsp;<?= ucwords($entry); ?>
                                        </a>
                                    </li>
                                    <?php
                                        }
                                    } ?>
                                </ul>
                            </li>
                            <?php if (!$shop_settings->hide_price && !empty($currencies)) {
                                        ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <?= $selected_currency->symbol . ' ' . $selected_currency->code; ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <?php
                                    foreach ($currencies as $currency) {
                                        echo '<li><a href="' . site_url('main/currency/' . $currency->code) . '">' . $currency->symbol . ' ' . $currency->code . '</a></li>';
                                    } ?>
                                </ul>
                            </li>
                            <?php
                                    } ?>
                                <?php
                                if ($loggedIn) {
                                    ?>
                                    <?php if (!$shop_settings->hide_price) {
                                        ?>
                                    <li><a href="<?= shop_url('wishlist'); ?>"><i class="fa fa-heart"></i> <span class="hidden-xs"><?= lang('wishlist'); ?></span> (<span id="total-wishlist"><?= $wishlist; ?></span>)</a></li>
                                    <?php
                                    } ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <?= lang('hi') . ' ' . $loggedInUser->first_name; ?> <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class=""><a href="<?= site_url('profile'); ?>"><i class="mi fa fa-user"></i> <?= lang('profile'); ?></a></li>
                                            <li class=""><a href="<?= shop_url('orders'); ?>"><i class="mi fa fa-heart"></i> <?= lang('orders'); ?></a></li>
                                            <li class=""><a href="<?= shop_url('quotes'); ?>"><i class="mi fa fa-heart-o"></i> <?= lang('quotes'); ?></a></li>
                                            <li class=""><a href="<?= shop_url('downloads'); ?>"><i class="mi fa fa-download"></i> <?= lang('downloads'); ?></a></li>
                                            <li class=""><a href="<?= shop_url('addresses'); ?>"><i class="mi fa fa-building"></i> <?= lang('addresses'); ?></a></li>
                                            <li class="divider"></li>
                                            <li class=""><a href="<?= site_url('logout'); ?>"><i class="mi fa fa-sign-out"></i> <?= lang('logout'); ?></a></li>
                                        </ul>
                                    </li>
                                    <?php
                                } else {
                                    ?>
                                    <li>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownLogin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fa fa-sign-in"></i> <?= lang('login'); ?> <span class="caret"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-login" aria-labelledby="dropdownLogin" data-dropdown-in="zoomIn" data-dropdown-out="fadeOut">
                                                <?php  include FCPATH . 'themes' . DIRECTORY_SEPARATOR . $Settings->theme . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'login_form.php'; ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Top Header -->

            <!-- Main Header -->
            <section class="main-header">
                <div class="container padding-y-md">
                    <div class="row">

                        <div class="col-sm-4 col-md-3 logo">
                            <a href="<?= site_url(); ?>">
                                <img alt="<?= $shop_settings->shop_name; ?>" src="<?= base_url('assets/uploads/logos/' . $shop_settings->logo); ?>" class="img-responsive" />
                            </a>
                        </div>

                        <div class="col-sm-8 col-md-9 margin-top-lg">
                            <div class="row">
                                <div class="<?= (!$shop_settings->hide_price) ? 'col-sm-8 col-md-6 col-md-offset-3' : 'col-md-6 col-md-offset-6'; ?> search-box">
                                    <?= shop_form_open('products', 'id="product-search-form"'); ?>
                                    <div class="input-group">
                                        <input name="query" type="text" class="form-control" id="product-search" aria-label="Search..." placeholder="<?= lang('search'); ?>">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default btn-search"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    <?= form_close(); ?>
                                </div>

                                <?php if (!$shop_settings->hide_price) {
                                    ?>
                                <div class="col-sm-4 col-md-3 cart-btn hidden-xs">
                                    <button type="button" class="btn btn-theme btn-block dropdown-toggle shopping-cart" id="dropdown-cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fa fa-shopping-cart margin-right-md"></i>
                                        <span class="cart-total-items"></span>
                                        <!-- <i class="fa fa-caret-down margin-left-md"></i> -->
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-cart">
                                        <div id="cart-contents">
                                            <table class="table table-condensed table-striped table-cart" id="cart-items"></table>
                                            <div id="cart-links" class="text-center margin-bottom-md">
                                                <div class="btn-group btn-group-justified" role="group" aria-label="View Cart and Checkout Button">
                                                    <div class="btn-group">
                                                        <a class="btn btn-default btn-sm" href="<?= site_url('cart'); ?>"><i class="fa fa-shopping-cart"></i> <?= lang('view_cart'); ?></a>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a class="btn btn-default btn-sm" href="<?= site_url('cart/checkout'); ?>"><i class="fa fa-check"></i> <?= lang('checkout'); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="cart-empty"><?= lang('please_add_item_to_cart'); ?></div>
                                    </div>
                                </div>
                                <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Main Header -->

            <!-- Nav Bar -->
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-ex1-collapse">
                            <?= lang('navigation'); ?>
                        </button>
                        <a href="<?= site_url('cart'); ?>" class="btn btn-default btn-cart-xs visible-xs pull-right shopping-cart">
                            <i class="fa fa-shopping-cart"></i> <span class="cart-total-items"></span>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <li class="<?= $m == 'main' && $v == 'index' ? 'active' : ''; ?>"><a href="<?= base_url(); ?>"><?= lang('home'); ?></a></li>
                            <?php if ($isPromo) {
                                    ?>
                            <li class="<?= $m == 'shop' && $v == 'products' && $this->input->get('promo') == 'yes' ? 'active' : ''; ?>"><a href="<?= shop_url('products?promo=yes'); ?>"><?= lang('promotions'); ?></a></li>
                            <?php
                                } ?>
                            <li class="<?= $m == 'shop' && $v == 'products' && $this->input->get('promo') != 'yes' ? 'active' : ''; ?>"><a href="<?= shop_url('products'); ?>"><?= lang('products'); ?></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <?= lang('categories'); ?> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    foreach ($categories as $pc) {
                                        echo '<li class="' . ($pc->subcategories ? 'dropdown dropdown-submenu' : '') . '">';
                                        echo '<a ' . ($pc->subcategories ? 'class="dropdown-toggle" data-toggle="dropdown"' : '') . ' href="' . site_url('category/' . $pc->slug) . '">' . $pc->name . '</a>';
                                        if ($pc->subcategories) {
                                            echo '<ul class="dropdown-menu">';
                                            foreach ($pc->subcategories as $sc) {
                                                echo '<li><a href="' . site_url('category/' . $pc->slug . '/' . $sc->slug) . '">' . $sc->name . '</a></li>';
                                            }
                                            echo '<li class="divider"></li>';
                                            echo '<li><a href="' . site_url('category/' . $pc->slug) . '">' . lang('all_products') . '</a></li>';
                                            echo '</ul>';
                                        }
                                        echo '</li>';
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="dropdown<?= (count($brands) > 20) ? ' mega-menu' : ''; ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <?= lang('brands'); ?> <span class="caret"></span>
                                </a>
                                <?php
                                if (count($brands) <= 10) {
                                    ?>
                                    <ul class="dropdown-menu">
                                        <?php
                                        foreach ($brands as $brand) {
                                            echo '<li><a href="' . site_url('brand/' . $brand->slug) . '" class="line-height-lg">' . $brand->name . '</a></li>';
                                        } ?>
                                    </ul>
                                    <?php
                                } elseif (count($brands) <= 20) {
                                    ?>
                                    <div class="dropdown-menu dropdown-menu-2x">
                                        <div class="dropdown-menu-content">
                                            <?php
                                            $brands_chunks = array_chunk($brands, 10);
                                    foreach ($brands_chunks as $brands) {
                                        ?>
                                                <div class="col-xs-6 padding-x-no line-height-md">
                                                    <ul class="nav">
                                                        <?php
                                                        foreach ($brands as $brand) {
                                                            echo '<li><a href="' . site_url('brand/' . $brand->slug) . '" class="line-height-lg">' . $brand->name . '</a></li>';
                                                        } ?>
                                                    </ul>
                                                </div>
                                                <?php
                                    } ?>
                                        </div>
                                    </div>
                                    <?php
                                } elseif (count($brands) > 20) {
                                    ?>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="mega-menu-content">
                                                <div class="row">
                                                    <?php
                                                    $brands_chunks = array_chunk($brands, ceil(count($brands) / 4));
                                    foreach ($brands_chunks as $brands) {
                                        ?>
                                                        <div class="col-sm-3">
                                                            <ul class="list-unstyled">
                                                                <?php
                                                                foreach ($brands as $brand) {
                                                                    echo '<li><a href="' . site_url('brand/' . $brand->slug) . '" class="line-height-lg">' . $brand->name . '</a></li>';
                                                                } ?>
                                                            </ul>
                                                        </div>
                                                        <?php
                                    } ?>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <?php
                                }
                                ?>
                            </li>
                            <?php if (!$shop_settings->hide_price) {
                                    ?>
                            <li class="<?= $m == 'cart_ajax' && $v == 'index' ? 'active' : ''; ?>"><a href="<?= site_url('cart'); ?>"><?= lang('shopping_cart'); ?></a></li>
                            <li class="<?= $m == 'cart_ajax' && $v == 'checout' ? 'active' : ''; ?>"><a href="<?= site_url('cart/checkout'); ?>"><?= lang('checkout'); ?></a></li>
                            <?php
                                } ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Nav Bar -->
        </header>
        <?php if (DEMO && ($m != 'main' || $v != 'index')) {
                                    ?>
        <div class="page-contents padding-bottom-no">
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
