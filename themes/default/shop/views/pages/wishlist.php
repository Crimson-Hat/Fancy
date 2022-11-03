
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="row">
                    <div class="col-sm-9 col-md-10">

                        <div class="panel panel-default margin-top-lg">
                            <div class="panel-heading text-bold">
                                <i class="fa fa-bars margin-right-sm"></i> <?= lang('wishlist'); ?>
                            </div>
                            <div class="panel-body">
                                <?php
                                if (!empty($items)) {
                                    echo '<table class="table table-striped table-hover table-va-middle">';
                                    echo '<thead><tr><th>' . lang('photo') . '</th><th>' . lang('description') . '</th><th>' . lang('price') . '</th><th>' . lang('in_stock') . '</th><th>' . lang('actions') . '</th></tr></thead>';
                                    $r = 1;
                                    foreach ($items as $item) {
                                        ?>
                                        <tr class="product">
                                            <td class="col-xs-1">
                                            <a href="#<?= $item->id; ?>">
                                            <img src="<?= base_url('assets/uploads/thumbs/' . $item->image); ?>" alt="" class="img-responsive">
                                            </a>
                                            </td>
                                            <td class="col-xs-7"><?= '<a href="#">' . $item->name . '</a><br>' . $item->details; ?></td>
                                            <td class="col-xs-1">
                                            <?php
                                            if ($item->promotion) {
                                                echo '<del class="text-red">' . $this->sma->convertMoney($item->price) . '</del><br>';
                                                echo $this->sma->convertMoney($item->promo_price);
                                            } else {
                                                echo $this->sma->convertMoney($item->price);
                                            } ?>
                                            </td>
                                            <td class="col-xs-1"><?= $item->quantity > 0 ? lang('yes') : lang('no'); ?></td>
                                            <td class="col-xs-2">
                                                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                                  <div class="btn-group" role="group">
                                                    <button type="button" class="tip btn btn-sm btn-theme add-to-cart" data-id="<?= $item->id; ?>" title="<?= lang('add_to_cart'); ?>"><i class="fa fa-shopping-cart"></i></button>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-danger remove-wishlist" data-id="<?= $item->id; ?>"><i class="fa fa-trash-o"></i></button>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $r++;
                                    }
                                    echo '</table>';
                                } else {
                                    echo '<strong>' . lang('wishlist_empty') . '</strong>';
                                }
                                ?>

                                
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-2">
                        <?php include 'sidebar1.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
var addresses = <?= !empty($addresses) ? json_encode($addresses) : 'false'; ?>;
</script>
