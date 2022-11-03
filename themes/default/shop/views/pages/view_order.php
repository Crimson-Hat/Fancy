<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="row">
                    <div class="col-sm-9 col-md-10">

                        <div class="panel panel-default margin-top-lg">
                            <div class="panel-heading text-bold">
                            <i class="fa fa-list-alt margin-right-sm"></i> <?= lang('view_order') . ($inv ? ' (' . $inv->reference_no . ')' : ''); ?>
                            <?= $this->loggedIn ? '<a href="' . shop_url('orders') . '" class="pull-right"><i class="fa fa-share"></i> ' . lang('my_orders') . '</a>' : ''; ?>
                            <a href="<?= shop_url('orders?download=' . $inv->id . ($this->loggedIn ? '' : '&hash=' . $inv->hash)); ?>" class="pull-right" style="margin-right:10px;"><i class="fa fa-download"></i> <?= lang('download'); ?></a>
                            </div>
                            <div class="panel-body mprint">

                                <div class="text-center biller-header print" style="margin-bottom:20px;">
                                    <img src="<?= base_url() . 'assets/uploads/logos/' . $biller->logo; ?>"
                                    alt="<?= $biller->company                         && $biller->company != '-' ? $biller->company : $biller->name; ?>">
                                    <h2 style="margin-top:10px;"><?= $biller->company && $biller->company != '-' ? $biller->company : $biller->name; ?></h2>
                                    <?= $biller->company ? '' : 'Attn: ' . $biller->name ?>

                                    <?php
                                    echo $biller->address . ' ' . $biller->city . ' ' . $biller->postal_code . ' ' . $biller->state . ' ' . $biller->country;

                                    echo '<br>';

                                    if ($biller->vat_no != '-' && $biller->vat_no != '') {
                                        echo lang('vat_no') . ': ' . $biller->vat_no;
                                    }
                                    if ($biller->cf1 != '-' && $biller->cf1 != '') {
                                        echo ', ' . lang('bcf1') . ': ' . $biller->cf1;
                                    }
                                    if ($biller->cf2 != '-' && $biller->cf2 != '') {
                                        echo ', ' . lang('bcf2') . ': ' . $biller->cf2;
                                    }
                                    if ($biller->cf3 != '-' && $biller->cf3 != '') {
                                        echo ', ' . lang('bcf3') . ': ' . $biller->cf3;
                                    }
                                    if ($biller->cf4 != '-' && $biller->cf4 != '') {
                                        echo ', ' . lang('bcf4') . ': ' . $biller->cf4;
                                    }
                                    if ($biller->cf5 != '-' && $biller->cf5 != '') {
                                        echo ', ' . lang('bcf5') . ': ' . $biller->cf5;
                                    }
                                    if ($biller->cf6 != '-' && $biller->cf6 != '') {
                                        echo ', ' . lang('bcf6') . ': ' . $biller->cf6;
                                    }

                                    echo '<br>';
                                    echo lang('tel') . ': ' . $biller->phone . ' ' . lang('email') . ': ' . $biller->email;
                                    ?>
                                </div>

                                <div class="well well-sm">
                                    <div class="row bold">
                                        <div class="col-xs-5">
                                            <p style="margin-bottom:0;">
                                                <?= lang('date'); ?>: <?= $this->sma->hrld($inv->date); ?><br>
                                                <?= lang('ref'); ?>: <?= $inv->reference_no; ?><br>
                                                <?php if (!empty($inv->return_sale_ref)) {
                                        echo lang('return_ref') . ': ' . $inv->return_sale_ref;
                                        if ($inv->return_id) {
                                            echo ' <a data-target="#myModal2" data-toggle="modal" href="' . admin_url('sales/modal_view/' . $inv->return_id) . '"><i class="fa fa-external-link no-print"></i></a><br>';
                                        } else {
                                            echo '<br>';
                                        }
                                    } ?>
                                                <?= lang('sale_status'); ?>: <?= lang($inv->sale_status); ?><br>
                                                <?= lang('payment_status'); ?>: <?= lang($inv->payment_status); ?><br>
                                                <?= lang('payment_method'); ?>: <?= lang($inv->payment_method); ?>
                                            </p>
                                        </div>
                                        <div class="col-xs-7 text-right order_barcodes">
                                            <img src="<?= admin_url('misc/barcode/' . $this->sma->base64url_encode($inv->reference_no) . '/code128/74/0/1'); ?>" alt="<?= $inv->reference_no; ?>" class="bcimg" />
                                            <?= $this->sma->qrcode('link', urlencode(shop_url('orders/' . $inv->id)), 2); ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="row" style="margin-bottom:15px;">

                                    <div class="col-xs-6">
                                        <?php echo $this->lang->line('billing'); ?>:<br/>
                                        <h2 style="margin-top:10px;"><?= $customer->company && $customer->company != '-' ? $customer->company : $customer->name; ?></h2>
                                        <?= $customer->company ? '' : 'Attn: ' . $customer->name ?>

                                        <?php
                                        echo $customer->address . '<br>' . $customer->city . ' ' . $customer->postal_code . ' ' . $customer->state . '<br>' . $customer->country;

                                        echo '<p>';

                                        if ($customer->vat_no != '-' && $customer->vat_no != '') {
                                            echo '<br>' . lang('vat_no') . ': ' . $customer->vat_no;
                                        }
                                        if ($customer->cf1 != '-' && $customer->cf1 != '') {
                                            echo '<br>' . lang('ccf1') . ': ' . $customer->cf1;
                                        }
                                        if ($customer->cf2 != '-' && $customer->cf2 != '') {
                                            echo '<br>' . lang('ccf2') . ': ' . $customer->cf2;
                                        }
                                        if ($customer->cf3 != '-' && $customer->cf3 != '') {
                                            echo '<br>' . lang('ccf3') . ': ' . $customer->cf3;
                                        }
                                        if ($customer->cf4 != '-' && $customer->cf4 != '') {
                                            echo '<br>' . lang('ccf4') . ': ' . $customer->cf4;
                                        }
                                        if ($customer->cf5 != '-' && $customer->cf5 != '') {
                                            echo '<br>' . lang('ccf5') . ': ' . $customer->cf5;
                                        }
                                        if ($customer->cf6 != '-' && $customer->cf6 != '') {
                                            echo '<br>' . lang('ccf6') . ': ' . $customer->cf6;
                                        }

                                        echo '</p>';
                                        echo lang('tel') . ': ' . $customer->phone . '<br>' . lang('email') . ': ' . $customer->email;
                                        ?>
                                    </div>
                                    <?php if ($address) {
                                            ?>
                                    <div class="col-xs-6">
                                        <?php echo $this->lang->line('shipping'); ?>:
                                        <h2 style="margin-top:10px;"><?= $customer->company && $customer->company != '-' ? $customer->company : $customer->name; ?></h2>
                                        <?= $customer->company ? '' : 'Attn: ' . $customer->name ?>
                                        <p>
                                            <?= $address->line1; ?><br>
                                            <?= $address->line2; ?><br>
                                            <?= $address->city; ?> <?= $address->state; ?><br>
                                            <?= $address->postal_code; ?> <?= $address->country; ?><br>
                                            <?= lang('phone') . ': ' . $address->phone; ?>
                                        </p>
                                    </div>
                                    <?php
                                        } ?>

                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped print-table order-table">

                                        <thead>

                                            <tr>
                                                <th><?= lang('no'); ?></th>
                                                <th><?= lang('description'); ?></th>
                                                <?php if ($Settings->indian_gst) {
                                            ?>
                                                    <th><?= lang('hsn_code'); ?></th>
                                                <?php
                                        } ?>
                                                <th><?= lang('quantity'); ?></th>
                                                <th><?= lang('unit_price'); ?></th>
                                                <?php
                                                if ($Settings->tax1 && $inv->product_tax > 0) {
                                                    echo '<th>' . lang('tax') . '</th>';
                                                }
                                                if ($Settings->product_discount && $inv->product_discount != 0) {
                                                    echo '<th>' . lang('discount') . '</th>';
                                                }
                                                ?>
                                                <th><?= lang('subtotal'); ?></th>
                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php $r     = 1;
                                            $tax_summary = [];
                                            foreach ($rows as $row):
                                                ?>
                                            <tr>
                                                <td style="text-align:center; width:40px; vertical-align:middle;"><?= $r; ?></td>
                                                <td style="vertical-align:middle;">
                                                    <?= $row->product_code . ' - ' . $row->product_name . ($row->variant ? ' (' . $row->variant . ')' : ''); ?>
                                                    <?= $row->second_name ? '<br>' . $row->second_name : ''; ?>
                                                    <?= $row->details ? '<br>' . $row->details : ''; ?>
                                                    <?= $row->serial_no ? '<br>' . $row->serial_no : ''; ?>
                                                </td>
                                                <?php if ($Settings->indian_gst) {
                                                    ?>
                                                <td style="width: 85px; text-align:center; vertical-align:middle;"><?= $row->hsn_code; ?></td>
                                                <?php
                                                } ?>
                                                <td style="width: 80px; text-align:center; vertical-align:middle;"><?= $this->sma->formatQuantity($row->unit_quantity) . ' ' . $row->product_unit_code; ?></td>
                                                <td style="text-align:right; width:100px;"><?= $this->sma->formatMoney($row->real_unit_price); ?></td>
                                                <?php
                                                if ($Settings->tax1 && $inv->product_tax > 0) {
                                                    echo '<td style="width: 100px; text-align:right; vertical-align:middle;">' . ($row->item_tax != 0 && $row->tax_code ? '<small>(' . $row->tax_code . ')</small>' : '') . ' ' . $this->sma->formatMoney($row->item_tax) . '</td>';
                                                }
                                                if ($Settings->product_discount && $inv->product_discount != 0) {
                                                    echo '<td style="width: 100px; text-align:right; vertical-align:middle;">' . ($row->discount != 0 ? '<small>(' . $row->discount . ')</small> ' : '') . $this->sma->formatMoney($row->item_discount) . '</td>';
                                                }
                                                ?>
                                                <td style="text-align:right; width:120px;"><?= $this->sma->formatMoney($row->subtotal); ?></td>
                                            </tr>
                                            <?php
                                            $r++;
                                            endforeach;
                                            if ($return_rows) {
                                                echo '<tr class="warning"><td colspan="100%" class="no-border"><strong>' . lang('returned_items') . '</strong></td></tr>';
                                                foreach ($return_rows as $row):
                                                    ?>
                                                <tr class="warning">
                                                    <td style="text-align:center; width:40px; vertical-align:middle;"><?= $r; ?></td>
                                                    <td style="vertical-align:middle;">
                                                        <?= $row->product_code . ' - ' . $row->product_name . ($row->variant ? ' (' . $row->variant . ')' : ''); ?>
                                                        <?= $row->details ? '<br>' . $row->details : ''; ?>
                                                        <?= $row->serial_no ? '<br>' . $row->serial_no : ''; ?>
                                                    </td>
                                                    <?php if ($Settings->indian_gst) {
                                                        ?>
                                                    <td style="width: 85px; text-align:center; vertical-align:middle;"><?= $row->hsn_code; ?></td>
                                                    <?php
                                                    } ?>
                                                    <td style="width: 80px; text-align:center; vertical-align:middle;"><?= $this->sma->formatQuantity($row->quantity) . ' ' . $row->product_unit_code; ?></td>
                                                    <td style="text-align:right; width:100px;"><?= $this->sma->formatMoney($row->real_unit_price); ?></td>
                                                    <?php
                                                    if ($Settings->tax1 && $inv->product_tax > 0) {
                                                        echo '<td style="width: 100px; text-align:right; vertical-align:middle;">' . ($row->item_tax != 0 && $row->tax_code ? '<small>(' . $row->tax_code . ')</small>' : '') . ' ' . $this->sma->formatMoney($row->item_tax) . '</td>';
                                                    }
                                                if ($Settings->product_discount && $inv->product_discount != 0) {
                                                    echo '<td style="width: 100px; text-align:right; vertical-align:middle;">' . ($row->discount != 0 ? '<small>(' . $row->discount . ')</small> ' : '') . $this->sma->formatMoney($row->item_discount) . '</td>';
                                                } ?>
                                                    <td style="text-align:right; width:120px;"><?= $this->sma->formatMoney($row->subtotal); ?></td>
                                                </tr>
                                                <?php
                                                $r++;
                                                endforeach;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <?php
                                            $col = $Settings->indian_gst ? 5 : 4;
                                            if ($Settings->product_discount && $inv->product_discount != 0) {
                                                $col++;
                                            }
                                            if ($Settings->tax1 && $inv->product_tax > 0) {
                                                $col++;
                                            }
                                            if ($Settings->product_discount && $inv->product_discount != 0 && $Settings->tax1 && $inv->product_tax > 0) {
                                                $tcol = $col - 2;
                                            } elseif ($Settings->product_discount && $inv->product_discount != 0) {
                                                $tcol = $col - 1;
                                            } elseif ($Settings->tax1 && $inv->product_tax > 0) {
                                                $tcol = $col - 1;
                                            } else {
                                                $tcol = $col;
                                            }
                                            ?>
                                            <?php if ($inv->grand_total != $inv->total) {
                                                ?>
                                            <tr>
                                                <td colspan="<?= $tcol; ?>"
                                                    style="text-align:right; padding-right:10px;"><?= lang('total'); ?>
                                                    (<?= $default_currency->code; ?>)
                                                </td>
                                                <?php
                                                if ($Settings->tax1 && $inv->product_tax > 0) {
                                                    echo '<td style="text-align:right;">' . $this->sma->formatMoney($return_sale ? ($inv->product_tax + $return_sale->product_tax) : $inv->product_tax) . '</td>';
                                                }
                                                if ($Settings->product_discount && $inv->product_discount != 0) {
                                                    echo '<td style="text-align:right;">' . $this->sma->formatMoney($return_sale ? ($inv->product_discount + $return_sale->product_discount) : $inv->product_discount) . '</td>';
                                                } ?>
                                                <td style="text-align:right; padding-right:10px;"><?= $this->sma->formatMoney($return_sale ? (($inv->total + $inv->product_tax) + ($return_sale->total + $return_sale->product_tax)) : ($inv->total + $inv->product_tax)); ?></td>
                                            </tr>
                                            <?php
                                            } ?>
                                            <?php if ($Settings->indian_gst) {
                                                if ($inv->cgst > 0) {
                                                    $cgst = $return_sale ? $inv->cgst + $return_sale->cgst : $inv->cgst;
                                                    echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px; font-weight:bold;">' . lang('cgst') . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px; font-weight:bold;">' . ($Settings->format_gst ? $this->sma->formatMoney($cgst) : $cgst) . '</td></tr>';
                                                }
                                                if ($inv->sgst > 0) {
                                                    $sgst = $return_sale ? $inv->sgst + $return_sale->sgst : $inv->sgst;
                                                    echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px; font-weight:bold;">' . lang('sgst') . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px; font-weight:bold;">' . ($Settings->format_gst ? $this->sma->formatMoney($sgst) : $sgst) . '</td></tr>';
                                                }
                                                if ($inv->igst > 0) {
                                                    $igst = $return_sale ? $inv->igst + $return_sale->igst : $inv->igst;
                                                    echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px; font-weight:bold;">' . lang('igst') . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px; font-weight:bold;">' . ($Settings->format_gst ? $this->sma->formatMoney($igst) : $igst) . '</td></tr>';
                                                }
                                            } ?>
                                            <?php
                                            if ($return_sale) {
                                                echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;;">' . lang('return_total') . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">' . $this->sma->formatMoney($return_sale->grand_total) . '</td></tr>';
                                            }
                                            if ($inv->surcharge != 0) {
                                                echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;;">' . lang('return_surcharge') . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">' . $this->sma->formatMoney($inv->surcharge) . '</td></tr>';
                                            }
                                            ?>
                                            <?php if ($inv->order_discount != 0) {
                                                echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;;">' . lang('order_discount') . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">' . ($inv->order_discount_id ? '<small>(' . $inv->order_discount_id . ')</small> ' : '') . $this->sma->formatMoney($return_sale ? ($inv->order_discount + $return_sale->order_discount) : $inv->order_discount) . '</td></tr>';
                                            }
                                            ?>
                                            <?php if ($Settings->tax2 && $inv->order_tax != 0) {
                                                echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;">' . lang('order_tax') . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">' . $this->sma->formatMoney($return_sale ? ($inv->order_tax + $return_sale->order_tax) : $inv->order_tax) . '</td></tr>';
                                            }
                                            ?>
                                            <?php if ($inv->shipping != 0) {
                                                echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;;">' . lang('shipping') . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">' . $this->sma->formatMoney($inv->shipping) . '</td></tr>';
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="<?= $col; ?>"
                                                    style="text-align:right; font-weight:bold;"><?= lang('total_amount'); ?>
                                                    (<?= $default_currency->code; ?>)
                                                </td>
                                                <td style="text-align:right; padding-right:10px; font-weight:bold;"><?= $this->sma->formatMoney($return_sale ? ($inv->grand_total + $return_sale->grand_total) : $inv->grand_total); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="<?= $col; ?>"
                                                    style="text-align:right; font-weight:bold;"><?= lang('paid'); ?>
                                                    (<?= $default_currency->code; ?>)
                                                </td>
                                                <td style="text-align:right; font-weight:bold;"><?= $this->sma->formatMoney($return_sale ? ($inv->paid + $return_sale->paid) : $inv->paid); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="<?= $col; ?>"
                                                    style="text-align:right; font-weight:bold;"><?= lang('balance'); ?>
                                                    (<?= $default_currency->code; ?>)
                                                </td>
                                                <td style="text-align:right; font-weight:bold;"><?= $this->sma->formatMoney(($return_sale ? ($inv->grand_total + $return_sale->grand_total) : $inv->grand_total) - ($return_sale ? ($inv->paid + $return_sale->paid) : $inv->paid)); ?></td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <?php
                                        if ($inv->note || $inv->note != '') {
                                            ?>
                                        <div class="well well-sm" style="margin-bottom:0;">
                                            <p class="bold"><?= lang('note'); ?>:</p>
                                            <div><?= $this->sma->decode_html($inv->note); ?></div>
                                        </div>
                                        <?php
                                        } ?>
                                    </div>

                                    <?php if ($customer->award_points != 0 && $Settings->each_spent > 0) {
                                            ?>
                                    <div class="col-xs-5 pull-left">
                                        <div class="well well-sm" style="margin-bottom:0;">
                                            <?=
                                            '<p>' . lang('this_sale') . ': ' . floor(($inv->grand_total / $Settings->each_spent) * $Settings->ca_point)
                                            . '<br>' .
                                            lang('total') . ' ' . lang('award_points') . ': ' . $customer->award_points . '</p>'; ?>
                                        </div>
                                    </div>
                                    <?php
                                        } ?>
                                </div>
                                <?php
                                if ($inv->grand_total > $inv->paid && !$inv->attachment) {
                                    echo '<div class="no-print well well-sm" style="margin:20px 0 0 0;">';
                                    if (!empty($shop_settings->bank_details)) {
                                        echo '<div class="text-center">';
                                        echo $shop_settings->bank_details;
                                        echo shop_form_open_multipart('manual_payment/' . $inv->id);
                                        echo '<input type="file" name="payment_receipt" id="file" class="file" />';
                                        echo '<label for="file" class="btn btn-default"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>' . lang('select_file') . '&hellip;</span></label>';
                                        echo '<span id="submit-container">' . form_submit('upload', lang('upload'), 'id="upload-file" class="btn btn-theme"') . '</span>';
                                        echo form_close();
                                        echo '</div><hr class="divider or">';
                                    }
                                    echo '<div class="payment_buttons">';
                                    $btn_code = '<div id="payment_buttons" class="text-center margin010">';
                                    if ($paypal->active == '1' && $inv->grand_total != '0.00') {
                                        $btn_code .= '<a href="' . site_url('pay/paypal/' . $inv->id) . '"><img src="' . base_url('assets/images/btn-paypal.png') . '" alt="Pay by PayPal"></a> ';
                                    }
                                    if ($skrill->active == '1' && $inv->grand_total != '0.00') {
                                        $btn_code .= ' <a href="' . site_url('pay/skrill/' . $inv->id) . '"><img src="' . base_url('assets/images/btn-skrill.png') . '" alt="Pay by Skrill"></a>';
                                    }

                                    if ($shop_settings->stripe == 1 && $stripe_publishable_key) {
                                        ?>
                                <div style="width:185px;display:inline-block;">
                                    <?= form_open('pay/stripe/' . $inv->id); ?>
                                    <script
                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                        data-key="<?= $stripe_publishable_key; ?>"
                                        data-amount="<?= ($inv->grand_total - $inv->paid) * 100; ?>"
                                        data-currency="<?= $default_currency->code; ?>"
                                        data-name="<?= $shop_settings->shop_name; ?>"
                                        data-description="<?= lang('cc_pay'); ?>"
                                        data-email="<?= $customer->email; ?>"
                                        data-image="<?= $assets . 'images/cc2.png'; ?>"
                                        data-label="<?= lang('pay_with_cc'); ?>"
                                        data-allow-remember-me="false"
                                        data-locale="auto"
                                        data-zip-code="true">
                                    </script>
                                    <?= form_close(); ?>
                                </div>
                                <?php
                                    }
                                    $btn_code .= '<div class="clearfix"></div></div>';
                                    echo $btn_code;
                                    echo '</div>';
                                    echo '</div>';
                                }
                                if ($inv->payment_status != 'paid' && $inv->attachment) {
                                    echo '<div class="alert alert-info" style="margin-top:15px;">' . lang('payment_under_review') . '</div>';
                                }
                                ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-2">
                        <?php include 'sidebar2.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
