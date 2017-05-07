<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <h3><?php echo lang("msg_edit"); ?></h3>
    <hr>
    <?php if (validation_errors() != false): ?>
        <div class="alert alert-info">
            <strong><?php echo lang("msg_error"); ?></strong> <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
    <?php echo form_open('children/editChild'); ?>
    <div class="form-group col-sm-5 col-sm-offset-3">
        <label for="childname"><?php echo lang("msg_name"); ?></label>
        <input type="text" class="form-control" id="childname" name="childname" value="<?php echo($name); ?>"
               placeholder="<?php echo lang("msg_entername"); ?>">
        <input type="hidden" id="id" name="id" value="<?php echo($id); ?>">
    </div>
    <div class="form-group col-sm-9 col-md-9 col-sm-offset-3">
        <p><strong><?php echo lang("msg_birthday"); ?></strong></p>
        <div class="form-inline">
            <label for="cday"><?php echo lang("msg_day"); ?></label>
            <select class="form-control" id="cday" name="cday">
                <option>...</option>
                <?php for ($x = 1; $x <= 31; $x++) { ?>
                    <?php if ($x == $day): ?>
                        <option selected><?php echo $x; ?></option>
                    <?php else: ?>
                        <option><?php echo $x; ?></option>
                    <?php endif; ?>
                <?php } ?>
            </select>

            <label for="cmonth"><?php echo lang("msg_month"); ?></label>
            <select class="form-control" id="cmonth" name="cmonth">
                <option>...</option>
                <?php for ($x = 1; $x <= 12; $x++) { ?>
                    <?php if ($x == $month): ?>
                        <option selected><?php echo $x; ?></option>
                    <?php else: ?>
                        <option><?php echo $x; ?></option>
                    <?php endif; ?>
                <?php } ?>
            </select>

            <label for="cyear"><?php echo lang("msg_year"); ?></label>
            <select class="form-control" id="cyear" name="cyear">
                <option>...</option>
                <?php for ($x = (int)date("Y"); $x >= ((int)date("Y") - 20); $x--) { ?>
                    <?php if ($x == $year): ?>
                        <option selected><?php echo $x; ?></option>
                    <?php else: ?>
                        <option><?php echo $x; ?></option>
                    <?php endif; ?>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-sm-4 col-sm-offset-7">
        <button type="submit"
                class="btn btn-md btn-default"><?php echo lang("msg_save"); ?></button>
    </div>
    <?php echo form_close(); ?>
</div>