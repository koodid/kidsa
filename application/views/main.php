<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav">
            <p data-img-name="girlr.jpg"></p>
            <div id="newPosts"></div>
        </div>

        <div class="col-sm-9">
            <h1><?php echo lang("msg_kidssay"); ?></h1>
            <h2>
                <small><?php echo lang("msg_recentposts"); ?></small>
            </h2>
            <p id="postPolling"></p>
            <hr>
            <div class="container">
                <div id="load-more" class="col-sm-9">
                    <!--                    --><?php //foreach ($allposts as $post): ?>
                    <!--                        <blockquote class="blockquote">-->
                    <!--                            --><?php //echo html_escape($post['Text']); ?>
                    <!--                            <footer class="blockquote-footer">--><?php //echo html_escape($post['Name']); ?>
                    <!--                                , -->
                    <?php //echo html_escape($post['Birthday']); ?><!--</footer>-->
                    <!--                        </blockquote>-->
                    <!--                    --><?php //endforeach; ?>
                </div>
            </div>
            <button class="btn btn-default" id="load_post_button"><?php echo lang("msg_loadmoreposts"); ?></button>
        </div>
    </div>
</div>