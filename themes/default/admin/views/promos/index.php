<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
    $(document).ready(function () {
        oTable = $('#SupData').dataTable({
            "aaSorting": [[1, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('promos/getPromos') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [{
                'bVisible': false,
                "bSortable": false,
                "mRender": checkbox
            }, null, null, null, {mRender: fsd}, {mRender: fsd}, {"bSortable": false}]
        }).dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('name');?>]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('product2buy');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('product2get');?>]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[<?=lang('start_date');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('end_date');?>]", filter_type: "text", data: []},
        ], "footer");
    });
</script>
<?php if ($Owner || ($GP && $GP['bulk_actions'])) {
    echo admin_form_open('promos/promo_actions', 'id="action-form"');
} ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-users"></i><?= lang('promos'); ?></h2>

        <div class="box-icon">
            <a href="<?= admin_url('promos/add'); ?>" id="add"><i class="icon fa fa-plus-circle"></i> <!-- <?= lang('add_promo'); ?> --></a>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?= lang('list_results'); ?></p>

                <div class="table-responsive">
                    <table id="SupData" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <tr class="primary">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkth" type="checkbox" name="check"/>
                            </th>
                            <th><?= lang('name'); ?></th>
                            <th><?= lang('product2buy'); ?></th>
                            <th><?= lang('product2get'); ?></th>
                            <th><?= lang('start_date'); ?></th>
                            <th><?= lang('end_date'); ?></th>
                            <th style="max-width:85px;"><?= lang('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="7" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                        </tr>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th></th><th></th><th></th><th></th><th></th>
                            <th style="max-width:85px;" class="text-center"><?= lang('actions'); ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($Owner || ($GP && $GP['bulk_actions'])) {
    ?>
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
    </div>
    <?= form_close() ?>
    <?php
} ?>
<?php if ($action && $action == 'add') {
        echo '<script>$(document).ready(function(){$("#add").trigger("click");});</script>';
}
?>


