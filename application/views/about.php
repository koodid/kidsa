<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav">
            <img src="/images/children-p.jpg" class="img-responsive hidden-xs" alt="Children">
        </div>

        <div class="col-sm-9">

            <h1><?php echo lang("msg_aboutkidsa"); ?></h1>

            <p><?php echo lang("msg_abouttext1"); ?></p>

            <p><?php echo lang("msg_abouttext2"); ?></p>
            <br>
            <br>

            <blockquote class="blockquote-reverse">
                <p class="mb-0">
                    “Grown-ups never understand anything by themselves, and it is tiresome for children to be always
                    and forever explaining things to them.”</p>
                <footer class="blockquote-footer"> Antoine de Saint-Exupéry, The Little Prince</footer>
            </blockquote>

            <strong><?php echo lang("msg_aboutlocation"); ?></strong>
            <div id="googleMap"></div>
        </div>
    </div>
</div>
