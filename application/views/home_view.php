<div class="container">
    <form class="form-horizontal" action="<?php echo base_url(); ?>home/create_new_post" method="post">
        <fieldset>
            <div id="postHolder" class="form-group">
                <div class="col-md-8">
                    <textarea id="newpost" name="newpost" rows="4" type="text" placeholder="Write a new post..."
                           class="form-control" required=""></textarea>
                </div>
            </div>
            <div class="form-group">
               
                <label for="select">Select the children who said..</label>
                <select class="selectpicker" id="select">
                    <!--TODO get all children and create options for each-->
                    <option>Child 1</option>
                    <option>Child 2</option>
                </select>
           
                
                <div class="checkbox">
                    <label><input id="publicpost" name="publicpost" type="checkbox" value="">Post as private post</label>                
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
                <?php echo $post['Text']; ?>
                <!--TODO: add children info when children are set-->
            </blockquote>
        <?php endforeach; ?>
    </div>
</div>
