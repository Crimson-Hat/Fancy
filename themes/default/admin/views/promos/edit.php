<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('edit_promo'); ?></h2>
    </div>
    <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo admin_form_open('promos/edit/' . $promo->id, $attrib); ?>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?= lang('enter_info'); ?></p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= lang('name', 'name'); ?>
                            <?php echo form_input('name', $promo->name, 'class="form-control tip" id="name" data-bv-notempty="true"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('start_date', 'start_date'); ?>
                            <?php echo form_input('start_date', $promo->start_date ? $this->sma->hrsd($promo->start_date) : '', 'class="form-control tip date" id="start_date"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('end_date', 'end_date'); ?>
                            <?php echo form_input('end_date', $promo->end_date ? $this->sma->hrsd($promo->end_date) : '', 'class="form-control tip date" id="end_date"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('product2buy', 'suggest_product'); ?>
                            <?php echo form_input('sproduct', (isset($_POST['sproduct']) ? $_POST['sproduct'] : $promo->p2b), 'class="form-control" id="suggest_product" data-bv-notempty="true"'); ?>
                            <input type="hidden" name="product2buy" value="<?= isset($_POST['product2buy']) ? $_POST['product2buy'] : $promo->product2buy ?>" id="report_product_id"/>
                        </div>
                        <div class="form-group">
                            <?= lang('product2get', 'suggest_product2'); ?>
                            <?php echo form_input('sgproduct', (isset($_POST['sgproduct']) ? $_POST['sgproduct'] : $promo->p2g), 'class="form-control" id="suggest_product2" data-bv-notempty="true"'); ?>
                            <input type="hidden" name="product2get" value="<?= isset($_POST['product2get']) ? $_POST['product2get'] : $promo->product2get ?>" id="report_product_id2"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= lang('description', 'description'); ?>
                            <?php echo form_textarea('description', $promo->description, 'class="form-control skip" id="description" style="height:100px;"'); ?>
                        </div>
                        <?php echo form_submit('edit_promo', lang('edit_promo'), 'class="btn btn-primary"'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>

