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
                                                echo '<del class="text-red">' . $this->sma->convertMoney(isset($fp->special_price) && !empty($fp->special_price) ? $fp->special_price : $fp->price) . '</del><br>';
                                                echo $this->sma->convertMoney($fp->promo_price);
                                            } else {
                                                echo $this->sma->convertMoney(isset($fp->special_price) && !empty($fp->special_price) ? $fp->special_price : $fp->price);
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
