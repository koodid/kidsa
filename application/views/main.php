<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav">
            <p data-img-name="girlr.jpg"></p>

            <h2 id="newPostsTitel" class="hidden">
                <small><?php echo lang("msg_newposts"); ?></small>
            </h2>
            <div id="newPosts"></div>
        </div>

        <div id="main-posts" class="col-sm-9">
            <h1><?php echo lang("msg_kidssay"); ?></h1>
            <h2>
                <small><?php echo lang("msg_recentposts"); ?></small>
            </h2>
            <p id="postPolling"></p>
            <hr>
            <div class="container no-padding">
                <div id="load-all" class="col-sm-9 no-padding"></div>
                <div id="load-more" class="col-sm-9 no-padding"></div>
            </div>
            <button class="btn btn-default" id="load_post_button"><?php echo lang("msg_loadmoreposts"); ?></button>
        </div>
    </div>
</div>