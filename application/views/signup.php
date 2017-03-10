<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">

    <h2>Create an account</h2>
    <form class="form-horizontal" action="<?php echo base_url(); ?>signup/create_new_user" method="post">
        <fieldset>
            <div id="usernameHolder" class="form-group">
                <label class="col-md-4 control-label" for="username">Username</label>
                <div class="col-md-4">
                    <input id="username" name="username" type="text" placeholder="Enter your username"
                           class="form-control input-md" required="">
                </div>
            </div>
            <div id="passwordHolder" class="form-group">
                <label class="col-md-4 control-label" for="password">Password</label>
                <div class="col-md-4">
                    <input id="password" name="password" type="password" placeholder="Enter your password"
                           class="form-control input-md" required="">
                </div>
            </div>
            <div id="confirmpasswordHolder" class="form-group">
                <label class="col-md-4 control-label" for="confirmpassword">Confirm Password</label>
                <div class="col-md-4">
                    <input id="confirmpassword" name="confirmpassword" type="password"
                           placeholder="Confirm your password" class="form-control input-md" required="">
                </div>
            </div>
            <div id="emailHolder" class="form-group">
                <label class="col-md-4 control-label" for="email">Email</label>
                <div class="col-md-4">
                    <input id="email" name="email" type="text" placeholder="Enter your email address"
                           class="form-control input-md" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="registerbutton"></label>
                <div class="col-md-4">
                    <button id="registerbutton" name="registerbutton" type="submit" class="btn btn-default">Register
                    </button>
                </div>
            </div>

        </fieldset>
    </form>
</div>