<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
    <h2><?php echo lang("msg_changepassword"); ?></h2>
    <hr>
    <form class="form-horizontal" action="<?php echo base_url(); ?>settings/change_password" method="post">
        <fieldset>
            <div class="form-group">
                <label class="col-md-4 control-label" for="password"><?php echo lang("msg_newpassword"); ?></label>
                <div class="col-md-4">
                    <input id="password" name="password" type="password" placeholder="<?php echo lang("msg_enternewpassword"); ?>"
                           class="form-control input-md" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="confirmpassword"><?php echo lang("msg_confirmnewpassword"); ?></label>
                <div class="col-md-4">
                    <input id="confirmpassword" name="confirmpassword" type="password"
                           placeholder="<?php echo lang("msg_enterconfirmnewpassword"); ?>" class="form-control input-md" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="registerbutton"></label>
                <div class="col-md-4">
                <button type="submit"
                        class="btn btn-md btn-default"><?php echo lang("msg_savechanges"); ?></button>
                </div>
            </div>
        </fieldset>
    </form>
</div>


