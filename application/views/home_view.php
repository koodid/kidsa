<div class="container">
    <form class="form-horizontal" action="<?php echo base_url(); ?>home/create_new_post" method="post">
        <fieldset>
            <div id="postHolder" class="form-group">
                <div class="col-md-8">
                    <label for="newpost">New post:</label>
                    <textarea id="newpost" name="newpost" rows="4" placeholder="Write a new post..."
                              class="form-control" required=""></textarea>
                </div>
            </div>
            <div class="form-group">
               
                <label for="child">Select the children who said..</label>
                <select class="selectpicker" id="child" name="child">
                    <?php foreach ($children as $child): ?>
                        <option value= <?php echo html_escape($child['ID']); ?>><?php echo html_escape($child['Name']); ?></option>
                    <?php endforeach; ?>

                </select>

                <div>
                    <input type="checkbox" id="publicpost" name="publicpost" value="publicpost">
                    <label for="publicpost">Post as private post</label>
                </div>

            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="postbutton"></label>
                <div class="col-md-4">
                    <button id="postbutton" name="postbutton" type="submit" class="btn btn-default">Post</button>
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
                        <td class = "text-nowrap"><?php echo($row['Child']); ?></td>
                        <td class = "text-nowrap"><?php echo ($row['Posts']); ?></td>
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
                    <!--TODO: add children info when children are set-->
                </blockquote>
            <?php endforeach; ?>
        </div>
    </div>
