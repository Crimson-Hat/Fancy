<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="row">
                    <div class="col-sm-9 col-md-10">

                        <div class="panel panel-default margin-top-lg">
                            <div class="panel-heading text-bold">
                                <i class="fa fa-map margin-right-sm"></i> <?= lang('my_addresses'); ?>
                            </div>
                            <div class="panel-body">
                                <?php
                                if ($this->Settings->indian_gst) {
                                    $istates = $this->gst->getIndianStates();
                                }
                                if (!empty($addresses)) {
                                    echo '<div class="row">';
                                    echo '<div class="col-sm-12 text-bold">' . lang('select_address_to_edit') . '</div>';
                                    $r = 1;
                                    foreach ($addresses as $address) {
                                        ?>
                                        <div class="col-sm-6">
                                            <a href="#" class="link-address edit-address" data-id="<?= $address->id; ?>">
                                                    <?= $address->line1; ?><br>
                                                    <?= $address->line2; ?><br>
                                                    <?= $address->city; ?>
                                                    <?= $this->Settings->indian_gst && isset($istates[$address->state]) ? $istates[$address->state] . ' - ' . $address->state : $address->state; ?><br>
                                                    <?= $address->postal_code; ?> <?= $address->country; ?><br>
                                                    <?= lang('phone') . ': ' . $address->phone; ?>
                                                    <span class="count"><i><?= $r; ?></i></span>
                                                    <span class="edit"><i class="fa fa-edit"></i></span>
                                                </a>
                                        </div>
                                        <?php
                                        $r++;
                                    }
                                    echo '</div>';
                                }
                                if (count($addresses) < 6) {
                                    echo '<div class="row margin-top-lg">';
                                    echo '<div class="col-sm-12"><a href="#" id="add-address" class="btn btn-primary btn-sm">' . lang('add_address') . '</a></div>';
                                    echo '</div>';
                                }
                                if ($this->Settings->indian_gst) {
                                    ?>
                                <script>
                                    var istates = <?= json_encode($istates); ?>
                                </script>
                                <?php
                                } else {
                                    echo '<script>var istates = false; </script>';
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
