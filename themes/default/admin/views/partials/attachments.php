<?php
if ($attachments || (isset($inv) && $inv->attachment)) {
    ?>
    <ul class="list-group no-print">
        <?php
    if (isset($inv) && $inv->attachment && strlen($inv->attachment) > 1) {
        ?>
        <li class="list-group-item">
            <a href="<?= admin_url('welcome/download/' . $inv->attachment) ?>" class="tip" title="<?= lang('download') ?>">
                <i class="fa fa-chain"></i>
                <span class="hidden-sm hidden-xs"><?= lang('attachment') ?></span>
            </a>
        </li>
        <?php
    }
    foreach ($attachments as $key => $attachment) {
        ?>
        <li class="list-group-item">
            <a href="<?= admin_url('welcome/download/' . $attachment->file_name) ?>" class="tip" title="<?= lang('download') ?>">
                <i class="fa fa-chain"></i>
                <span class="hidden-sm hidden-xs"><?= $attachment->orig_name ?: lang('attachment') . ' ' . ($key + 1) ?></span>
            </a>
            <?php
            if ($Owner || $Admin) {
                ?>
            <a id="delete-attachment" class="badge btn btn-danger tip" style="background-color:#d9534f;" href="<?= admin_url('welcome/delete/' . $attachment->id . '/' . $attachment->file_name) ?>" title="<?= lang('delete') ?>">
                <i class="fa fa-times"></i>
            </a>
            <?php
            } ?>
        </li>
        <?php
    } ?>
    </ul>
    <?php
} ?>
