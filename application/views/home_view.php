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
        <?php foreach ($posts as $post): ?>
            <blockquote class="blockquote">
                <?php echo html_escape($post['Text']); ?>
                
                    <footer class="blockquote-footer"><?php echo html_escape($post['Name']); ?>, <?php echo html_escape($post['Birthday']); ?></footer>
            </blockquote>
        <?php endforeach; ?>
    </div>
</div>
