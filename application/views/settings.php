<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
    <?php echo form_open('settings'); ?>

    <h2><?php echo lang("msg_changepassword"); ?></h2>
    <hr>

    <?php if (validation_errors() != false): ?>
        <div class="alert alert-info">
            <strong><?php echo lang("msg_error"); ?></strong> <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
        <div class="form-group col-md-4 col-lg-offset-4">
            <label for="newpassword"><?php echo lang("msg_newpassword"); ?> <?php echo lang("msg_min_length"); ?></label>
            <input type="password" class="form-control" id="newpassword" name="newpassword"
                   placeholder="<?php echo lang("msg_enternewpassword"); ?>">
        </div>
        <div class="form-group col-md-4 col-lg-offset-4">
            <label for="confirmnewpassword"><?php echo lang("msg_confirmnewpassword"); ?></label>
            <input type="password" class="form-control" id="confirmnewpassword" name="confirmnewpassword"
                   placeholder="<?php echo lang("msg_enterconfirmnewpassword"); ?>">
        </div>
        <div class="col-md-4 col-lg-offset-4">
            <button type="submit" class="btn btn-md btn-default"><?php echo lang("msg_savechanges"); ?></button>
        </div>
    <?php echo form_close(); ?>
</div>
<div class="container">
    <h2><?php echo lang("msg_deleteaccount"); ?></h2>
    <div class="form-group col-md-4 col-lg-offset-4">
        <a href="<?php echo base_url() . "settings/delete/" . $id; ?>"><button class="btn btn-md btn-default"><?php echo lang("msg_deleteaccountbutton"); ?></button></a>
    </div>
</div>

