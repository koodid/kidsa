<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<li <?php echoActiveClassIfRequestMatches("home") ?>>
    <a href="home" data-toggle="tooltip" data-placement="auto bottom" title="<?php echo lang("msg_userhome"); ?>">
        <?php echo lang("msg_userhome"); ?></a></li>
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo lang("msg_account"); ?><span
                class="caret"></span></a>
    <ul class="dropdown-menu">
        <li>
            <a href="/children"
               data-toggle="tooltip" data-placement="auto bottom"
               title="<?php echo lang("msg_addchildren"); ?>"><?php echo lang("msg_addchildren"); ?></a></li>
        <li>
            <a href="/settings"
               data-toggle="tooltip" data-placement="auto bottom"
               title="<?php echo lang("msg_settings"); ?>"><?php echo lang("msg_settings"); ?></a></li>
        <li><a href="home/logout" data-toggle="tooltip" data-placement="auto bottom" title="<?php echo lang("msg_logout"); ?>">
                <span class="glyphicon glyphicon-log-out"></span><?php echo lang("msg_logout"); ?></a></li>
    </ul>
</li>
