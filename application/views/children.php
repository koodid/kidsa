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
    <div class="form-group col-md-4 col-sm-offset-4">
        <label for="childname"><?php echo lang("msg_name"); ?></label>
        <input type="text" class="form-control" id="childname" name="childname"
               placeholder="<?php echo lang("msg_entername"); ?>">
    </div>
    <div class="form-group col-md-4 col-sm-offset-4">
        <label for="birthday"><?php echo lang("msg_birthday"); ?></label>
        <input type="text" class="form-control" id="birthday" name="birthday"
               placeholder="<?php echo lang("msg_dateformat"); ?>">
    </div>

    <div class="col-md-4 col-sm-offset-4">
        <button type="submit"
                class="btn btn-md btn-default"><?php echo lang("msg_addchild"); ?></button>
    </div>
    <?php echo form_close(); ?>
</div>
