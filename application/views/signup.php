<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">

    <h2><?php echo lang("msg_signup"); ?></h2>
    <form class="form-horizontal" action="<?php echo base_url(); ?>signup/create_new_user" method="post">
        <fieldset>
            <div id="usernameHolder" class="form-group">
                <label class="col-md-4 control-label" for="username"><?php echo lang("msg_username"); ?></label>
                <div class="col-md-4">
                    <input id="username" name="username" type="text" placeholder="<?php echo lang("msg_enterusername"); ?>"
                           class="form-control input-md" required="">
                </div>
            </div>
            <div id="passwordHolder" class="form-group">
                <label class="col-md-4 control-label" for="password"><?php echo lang("msg_password"); ?></label>
                <div class="col-md-4">
                    <input id="password" name="password" type="password" placeholder="<?php echo lang("msg_enterpassword"); ?>"
                           class="form-control input-md" required="">
                </div>
            </div>
            <div id="confirmpasswordHolder" class="form-group">
                <label class="col-md-4 control-label" for="confirmpassword"><?php echo lang("msg_confirmpassword"); ?></label>
                <div class="col-md-4">
                    <input id="confirmpassword" name="confirmpassword" type="password"
                           placeholder="<?php echo lang("msg_etnerconfirmpassword"); ?>" class="form-control input-md" required="">
                </div>
            </div>
            <div id="emailHolder" class="form-group">
                <label class="col-md-4 control-label" for="email"><?php echo lang("msg_email"); ?></label>
                <div class="col-md-4">
                    <input id="email" name="email" type="text" placeholder="<?php echo lang("msg_enteremail"); ?>"
                           class="form-control input-md" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="registerbutton"></label>
                <div class="col-md-4">
                    <button id="registerbutton" name="registerbutton" type="submit" class="btn btn-default"><?php echo lang("msg_register"); ?>
                    </button>
                </div>
            </div>

        </fieldset>
    </form>
</div>