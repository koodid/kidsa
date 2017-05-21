<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
    <?php echo form_open('signup'); ?>
    <div class="col-md-4 col-lg-offset-4">
        <h2><?php echo lang("msg_signup"); ?></h2>
        <hr>

        <?php if (validation_errors() != false): ?>
            <div class="alert alert-info">
                <strong><?php echo lang("msg_error"); ?></strong> <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

        <div id="usernameHolder" class="form-group">
            <label for="set_username"><?php echo lang("msg_username"); ?></label>
            <input type="text" class="form-control input-md" id="set_username" name="set_username"
                   placeholder="<?php echo lang("msg_enterusername"); ?>">
        </div>

        <div id="passwordHolder" class="form-group">
            <label for="set_password"><?php echo lang("msg_password"); ?> <?php echo lang("msg_min_length"); ?></label>
            <input type="password" class="form-control input-md" id="set_password" name="set_password"
                   placeholder="<?php echo lang("msg_enterpassword"); ?>">
        </div>

        <div id="confirmpasswordHolder" class="form-group">
            <label for="set_confirmpassword"><?php echo lang("msg_confirmpassword"); ?></label>
            <input type="password" class="form-control input-md" id="set_confirmpassword" name="set_confirmpassword"
                   placeholder="<?php echo lang("msg_enterconfirmpassword"); ?>">
        </div>

        <div id="emailHolder" class="form-group">
            <label for="set_email"><?php echo lang("msg_email"); ?></label>
            <input type="text" class="form-control input-md" id="set_email" name="set_email"
                   placeholder="<?php echo lang("msg_enteremail"); ?>">
        </div>

        <div>
            <button id="registerbutton" name="registerbutton" type="submit"
                    class="btn btn-md btn-default"><?php echo lang("msg_register"); ?>
            </button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>