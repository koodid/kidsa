<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/custom.css">
    <link rel="shortcut icon" href="/images/faviconG.ico"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/js/tooltip.js"></script>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">KIDSA</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li <?php echoActiveClassIfRequestMatches("") ?>>
                    <a href="/"><?php echo lang("msg_home"); ?></a>
                </li>
                <li <?php echoActiveClassIfRequestMatches("about") ?>>
                    <a href="/about"><?php echo lang("msg_about"); ?></a>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="<?php echo lang("msg_search"); ?>"
                           data-toggle="tooltip" data-placement="auto"
                           title="<?php echo lang("msg_search_tooltip_long"); ?>">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"
                                data-toggle="tooltip" data-placement="auto"
                                title="<?php echo lang("msg_search_tooltip"); ?>">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo base_url(); ?>langswitch/switchLanguage/english?uri=<?php echo $_SERVER['REQUEST_URI']; ?>"
                       data-toggle="tooltip" data-placement="auto"
                       title="<?php echo lang("msg_english"); ?>">English</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>langswitch/switchLanguage/estonian?uri=<?php echo $_SERVER['REQUEST_URI']; ?>"
                       data-toggle="tooltip" data-placement="auto"
                       title="<?php echo lang("msg_estonian"); ?>">Eesti</a>
                </li>
                <li><a href="#" data-toggle="tooltip" data-placement="auto"
                       title="<?php echo lang("msg_login"); ?>"><span class="glyphicon glyphicon-log-in"></span>
                        <?php echo lang("msg_login"); ?></a></li>
                <li <?php echoActiveClassIfRequestMatches("signup") ?>>
                    <a href="/signup" data-toggle="tooltip" data-placement="auto"
                       title="<?php echo lang("msg_signup"); ?>">
                        <span class="glyphicon glyphicon-user"></span>
                        <?php echo lang("msg_signup"); ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
