<?php if($noResults == 0):?>
<div class="container">
    <div class="col-md-8">
        <?php foreach ($search_results as $post): ?>
            <blockquote class="blockquote">
                <?php echo html_escape($post['Text']); ?>
                <footer class="blockquote-footer"><?php echo html_escape($post['Name']); ?>
                    , <?php echo html_escape($post['Age']); ?></footer>
            </blockquote>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
<?php if($noResults == 1):?>
<div class="alert alert-danger">
    <strong><?php echo lang("msg_nosearchresults"); ?></strong>
</div>
<?php endif; ?>



