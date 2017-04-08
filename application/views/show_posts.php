<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
    <div class="col-xs-12 col-custom-frontpage col-centered">
        <?php foreach ($all_posts as $npost): ?>
        <blockquote class="blockquote">
            <?php echo html_escape($npost['Text']); ?>
            <footer class="blockquote-footer"><?php echo html_escape($npost['Name']); ?>
                ,
                <?php echo html_escape($npost['Age']); ?></footer>
        </blockquote>
        <?php endforeach; ?>
    </div>
</div>
