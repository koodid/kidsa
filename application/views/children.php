<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">

    <h2><?php echo lang("msg_addchildren"); ?></h2>

    <?php if(validation_errors() != false): ?>
        <div class="alert alert-info">
            <strong><?php echo lang("msg_error"); ?></strong> <?php echo validation_errors();?>
        </div>
    <?php endif; ?>

    <h3><?php echo lang("msg_addchild"); ?></h3>
    <hr>
    <?php echo form_open('children'); ?>
        <div class="form-group col-md-4 col-lg-offset-4">
            <label for="childname"><?php echo lang("msg_name"); ?></label>
            <input type="text" class="form-control" id="childname" name="childname"
                   placeholder="<?php echo lang("msg_entername"); ?>">
        </div>
        <div class="form-group col-md-4 col-lg-offset-4">
            <label for="birthday"><?php echo lang("msg_birthday"); ?></label>
            <input type="text" class="form-control" id="birthday" name="birthday"
                   placeholder="<?php echo lang("msg_dateformat"); ?>">
        </div>

        <div class="col-md-4 col-lg-offset-4">
            <button type="submit"
                    class="btn btn-md btn-default"><?php echo lang("msg_addchild"); ?></button>
        </div>
    <?php echo form_close(); ?>
</div>
