<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">

    <h2><?php echo lang("msg_addchildren"); ?></h2>
    <hr>

    <div class="col-md-12">
        <div class="container">
            <?php foreach ($children as $child): ?>
                <div class="row">
                    <div class="col-sm-offset-4 col-sm-2 col-xs-12"><?php echo($child['Name']); ?></div>
                    <div class="col-sm-2 col-xs-12"><?php echo($child['Birthday']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="container">
    <h3><?php echo lang("msg_addchild"); ?></h3>
    <hr>
    <?php if (validation_errors() != false): ?>
        <div class="alert alert-info">
            <strong><?php echo lang("msg_error"); ?></strong> <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
    <?php echo form_open('children'); ?>
    <div class="form-group col-sm-5 col-sm-offset-3">
        <label for="childname"><?php echo lang("msg_name"); ?></label>
        <input type="text" class="form-control" id="childname" name="childname"
               placeholder="<?php echo lang("msg_entername"); ?>">
    </div>
    <div class="form-group col-sm-9 col-md-9 col-sm-offset-3">
        <p><strong><?php echo lang("msg_birthday"); ?></strong></p>
        <div class="form-inline">
            <label for="cday"><?php echo lang("msg_day"); ?></label>
            <select class="form-control" id="cday" name="cday">
                <option>...</option>
                <?php for ($x = 1; $x <= 31; $x++) { ?>
                    <option><?php echo $x; ?></option>
                <?php } ?>
            </select>

            <label for="cmonth"><?php echo lang("msg_month"); ?></label>
            <select class="form-control" id="cmonth" name="cmonth">
                <option>...</option>
                <?php for ($x = 1; $x <= 12; $x++) { ?>
                    <option><?php echo $x; ?></option>
                <?php } ?>
            </select>

            <label for="cyear"><?php echo lang("msg_year"); ?></label>
            <select class="form-control" id="cyear" name="cyear">
                <option>...</option>
                <?php for ($x = (int)date("Y"); $x >= ((int)date("Y") - 20); $x--) { ?>
                    <option><?php echo $x; ?></option>
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
