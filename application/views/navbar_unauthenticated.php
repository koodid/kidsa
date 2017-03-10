<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<li <?php echoActiveClassIfRequestMatches("login") ?>>
    <a href="login" data-toggle="tooltip" data-placement="auto bottom"
       title="<?php echo lang("msg_login"); ?>"><span class="glyphicon glyphicon-log-in"></span>
        <?php echo lang("msg_login"); ?></a></li>
<li <?php echoActiveClassIfRequestMatches("signup") ?>>
    <a href="signup" data-toggle="tooltip" data-placement="auto bottom"
       title="<?php echo lang("msg_signup"); ?>">
        <span class="glyphicon glyphicon-user"></span>
        <?php echo lang("msg_signup"); ?>
    </a>
</li>