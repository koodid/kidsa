<h1>Simple Login with CodeIgniter</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('login'); ?>
<label for="username">Username:</label>
<input type="text" size="20" id="username" name="username"/>
<br/>
<label for="password">Password:</label>
<input type="password" size="20" id="password" name="password"/>
<br/>
<input type="submit" value="Login"/>
