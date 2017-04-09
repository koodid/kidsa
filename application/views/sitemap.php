<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
    <div class="col-xs-4 col-sm-offset-4">
        <h2><?php echo lang("msg_sitemap"); ?></h2>
        <hr>
        <div class="row">
            <div class="col-xs-12">
                <ul class="sitemap">
                    <li><h2><a href="<?php echo base_url(); ?>"><?php echo lang("msg_home"); ?></a></h2></li>
                    <li><h2><a href="<?php echo base_url(); ?>about"><?php echo lang("msg_about"); ?></a></h2></li>
                    <?php
                    if ($this->session->userdata('logged_in')) { ?>
                        <li><h2><a href="<?php echo base_url(); ?>home"><?php echo lang("msg_userhome"); ?></a></h2>
                        </li>
                        <li><h2><?php echo lang("msg_account"); ?></h2></li>
                        <ul>
                            <li><h3>
                                    <a href="<?php echo base_url(); ?>children"><?php echo lang("msg_addchildren"); ?></a>
                                </h3></li>
                            <li><h3><a href="<?php echo base_url(); ?>settings"><?php echo lang("msg_settings"); ?></a>
                                </h3></li>
                        </ul>
                        <?php
                    } else { ?>
                        <li><h2><a href="<?php echo base_url(); ?>login"><?php echo lang("msg_login"); ?></a></h2></li>
                        <li><h2><a href="<?php echo base_url(); ?>signup"><?php echo lang("msg_signup"); ?></a></h2>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>