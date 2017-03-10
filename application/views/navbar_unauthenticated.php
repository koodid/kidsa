<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function echoUriIfNotSelf($self)
{
    echo $self;
    $uri = strtok($_SERVER["REQUEST_URI"], '?');
    if (trim($uri, "/") === $self)
        return;

    if (isset($_GET['uri'])) {
        if (trim(urldecode($_GET['uri']), "/") !== trim($uri, "/")) {
            echo "?uri=" . urlencode(trim($uri, "/"));
        }
    } else {
        if (trim($uri, "/") !== '')
            echo "?uri=" . urlencode(trim($uri, "/"));
    }
}

?>
<li><a href="<?php echoUriIfNotSelf('login'); ?>" data-toggle="tooltip" data-placement="auto bottom"
       title="<?php echo lang("msg_login"); ?>"><span class="glyphicon glyphicon-log-in"></span>
        <?php echo lang("msg_login"); ?></a></li>
<li <?php echoActiveClassIfRequestMatches("signup") ?>>
    <a href="<?php echoUriIfNotSelf('signup'); ?>" data-toggle="tooltip"
       data-placement="auto bottom"
       title="<?php echo lang("msg_signup"); ?>">
        <span class="glyphicon glyphicon-user"></span>
        <?php echo lang("msg_signup"); ?>
    </a>
</li>