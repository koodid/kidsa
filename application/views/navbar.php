<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename(strtok($_SERVER['REQUEST_URI'], '?'), ".php");

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

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/super.min.css">


    <script type="text/javascript" src="/js/fallback.min.js"></script>
    <script type="text/javascript" src="/js/fallback-load.js"></script>
    <link rel="shortcut icon" href="/images/faviconG.ico"/>
    <script async type="text/javascript" src="/js/delaycontent.js"></script>
    <script async type="text/javascript" src="/js/tooltip.js"></script>

    <?php
    if (isset($extra_scripts)) {
        foreach ($extra_scripts as $value) {
            echo "<script async type=\"text/javascript\" src=\"" . $value . "\"></script>";
        }
    }
    if (isset($extra_style)) {
        foreach ($extra_style as $value) {
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $value . "\">";
        }
    }
    ?>
</head>

<body id="body">

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
                    <a href="<?php echo base_url(); ?>about"><?php echo lang("msg_about"); ?></a>
                </li>
            </ul>
            <form class="navbar-form navbar-left" id="search" action="<?php echo base_url(); ?>search" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" id="searchField" placeholder="<?php echo lang("msg_search"); ?>"
                        data-toggle="tooltip" data-placement="auto bottom"
                        title="<?php echo lang("msg_search_tooltip_long"); ?>">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"
                                data-toggle="tooltip" data-placement="auto bottom"
                                title="<?php echo lang("msg_search_tooltip"); ?>">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if ($this->session->userdata('logged_in')) {
                    $this->load->view('navbar_authenticated.php');
                } else {
                    $this->load->view('navbar_unauthenticated.php');
                }
                ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo lang("msg_language"); ?><span
                                class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url(); ?>langswitch/switchLanguage/english?uri=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>"
                               data-toggle="tooltip" data-placement="auto bottom"
                               title="<?php echo lang("msg_english"); ?>">English </a></li>
                        <li>
                            <a href="<?php echo base_url(); ?>langswitch/switchLanguage/estonian?uri=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>"
                               data-toggle="tooltip" data-placement="auto bottom"
                               title="<?php echo lang("msg_estonian"); ?>">Eesti</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
