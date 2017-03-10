<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo validation_errors(); ?>


<div class="container">
    <?php echo form_open('login'); ?>

    <div class="col-md-4 col-lg-offset-4">
        <h2><?php echo lang("msg_login"); ?></h2>
        <hr>

        <form role="form">
            <div class="form-group">
                <label for="username"><?php echo lang("msg_username"); ?></label>
                <input type="text" class="form-control" id="username" name="username"
                       placeholder="<?php echo lang("msg_enterusername"); ?>" autofocus>
            </div>
            <div class="form-group">
                <label for="password"><?php echo lang("msg_password"); ?></label>
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="<?php echo lang("msg_enterpassword"); ?>">
            </div>
            <input type="hidden" name="uri" value="<?php if (isset($_GET['uri'])) echo $_GET['uri']; ?>">
            <div>
                <button type="submit"
                        class="btn btn-md btn-default"><?php echo lang("msg_login"); ?></button>
            </div>
        </form>

        <hr>

        <div>
            <a <?php if (isset($fb_link)){echo "href='$fb_link'";} ?>
                    id="btn-fbsignup" class="btn btn-primary" role="button"><em class="icon-facebook"></em>
                <?php echo lang("msg_FBlogin"); ?></a>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
