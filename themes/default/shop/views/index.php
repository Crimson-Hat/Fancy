<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if (!empty($slider) && !empty($slider[0]->image) && !empty($slider[0]->link)) {
    ?>
<section class="slider-container">
    <div class="container-fluid">
        <div class="row">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators margin-bottom-sm">
                    <?php
                    $sr = 0;
    foreach ($slider as $slide) {
        if (!empty($slide->image)) {
            echo '<li data-target="#carousel-example-generic" data-slide-to="' . $sr . '" class="' . ($sr == 0 ? 'active' : '') . '"></li> ';
        }
        $sr++;
    } ?>
                </ol>

                <div class="carousel-inner" role="listbox">
                    <?php
                    $sr = 0;
    foreach ($slider as $slide) {
        if (!empty($slide->image)) {
            echo '<div class="item' . ($sr == 0 ? ' active' : '') . '">';
            if (!empty($slide->link)) {
                echo '<a href="' . $slide->link . '">';
            }
            echo '<img src="' . base_url('assets/uploads/' . $slide->image) . '" alt="" style="max-height:600px;object-fit:contain;">';
            if (!empty($slide->caption)) {
                echo '<div class="carousel-caption">' . $slide->caption . '</div>';
            }
            if (!empty($slide->link)) {
                echo '</a>';
            }
            echo '</div>';
        }
        $sr++;
    } ?>
                </div>

                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="fa fa-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only"><?= lang('prev'); ?></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="fa fa-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only"><?= lang('next'); ?></span>
                </a>
            </div>
        </div>
    </div>
</section>
<?php
} ?>

<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="row">
                    <div class="col-xs-9">
                        <h3 class="margin-top-no text-size-lg">
                            <?= lang('featured_products'); ?>
                        </h3>
                    </div>
                    <?php
                    if (count($featured_products) > 8) {
                        ?>
                        <div class="col-xs-3">
                            <div class="controls pull-right hidden-xs">
                                <a class="left fa fa-chevron-left btn btn-xs btn-default" href="#carousel-example"
                                data-slide="prev"></a>
                                <a class="right fa fa-chevron-right btn btn-xs btn-default" href="#carousel-example"
                                data-slide="next"></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php
                        $r = 0;
                        foreach (array_chunk($featured_products, 8) as $fps) {
                            ?>
                            <div class="item row <?= empty($r) ? 'active' : ''; ?>">
                                <div class="featured-products">
                                    <?php
                                    foreach ($fps as $fp) {
                                        ?>
                                        <div class="col-sm-6 col-md-3">
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
                                                    <div class="btn add-to-cart" data-id="<?= $fp->id; ?>"><i class="fa fa-shopping-cart"></i> <?= lang('add_to_cart'); ?></div>
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
                                        <?php
                                    } ?>
                                </div>
                            </div>
                            <?php
                            $r++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
