<div class="container">
    <form id="new-post-form" class="form-horizontal" action="<?php echo base_url(); ?>home/create_new_post"
          method="post">
        <fieldset>
            <div id="postHolder" class="form-group">
                <div class="col-md-8">
                    <label for="newpost"><?php echo lang("msg_newpost"); ?></label>
                    <textarea id="newpost" name="newpost" rows="4" placeholder="<?php echo lang("msg_writenewpost"); ?>"
                              class="form-control" required=""
                              oninvalid="this.setCustomValidity('<?php echo lang("msg_writenewpost") ?>')"></textarea>
                </div>
            </div>
            <div class="form-group">

                <label for="childpicker"><?php echo lang("msg_selectchild"); ?></label>
                <select id="childpicker" class="selectpicker" name="child">
                    <?php foreach ($children as $child): ?>
                        <option value= <?php echo html_escape($child['ID']); ?>><?php echo html_escape($child['Name']); ?></option>
                    <?php endforeach; ?>

                </select>

                <div>
                    <label for="publicpost"><?php echo lang("msg_postprivately"); ?></label>
                    <input type="checkbox" id="publicpost" name="publicpost" value="publicpost">
                </div>

            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="postbutton"></label>
                <div class="col-md-4">
                    <button id="postbutton" name="postbutton" type="submit"
                            class="btn btn-default"><?php echo lang("msg_post"); ?></button>
                </div>
            </div>
        </fieldset>
    </form>
</div>

<div class="container">
    <div class="col-md-8">
        <div class="container">
            <hr>
            <table class="table">
                <thead>
                <tr>
                    <th><?php echo lang("msg_name"); ?></th>
                    <th><?php echo lang("msg_countposts"); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($countposts as $row): ?>
                    <tr>
                        <td class="text-nowrap"><?php echo($row['Child']); ?></td>
                        <td class="text-nowrap"><?php echo($row['Posts']); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <hr>
        </div>
    </div>

    <div class="container">
        <div class="col-md-8">
            <?php foreach ($posts as $post): ?>
                <blockquote class="blockquote">
                    <?php echo html_escape($post['Text']); ?>
                    <footer class="blockquote-footer"><?php echo html_escape($post['Name']); ?>
                        , <?php echo html_escape($post['Birthday']); ?></footer>
                </blockquote>
            <?php endforeach; ?>
        </div>
    </div>
</div>
