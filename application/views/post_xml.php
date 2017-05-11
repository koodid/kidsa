<posts>
    <?php $this->load->model('Post'); ?>
    <?php foreach ($posts as $row) : ?>
        <?php
        $myLike = 0;
        if (isset($this->session->userdata('logged_in')['id'])) {
            $has_my_like = $this->Post->has_my_like($row['ID']);
            if ($has_my_like > 0) {
                $myLike = 1;
            }
        }
        ?>
        <post>
            <id><?php echo $row['ID']; ?></id>
            <birthday><?php echo $row['Birthday']; ?></birthday>
            <userid><?php echo $row['User']; ?></userid>
            <language><?php echo $row['Language']; ?></language>
            <data><?php echo htmlspecialchars($row['Text'], ENT_XML1, 'UTF-8'); ?></data>
            <date><?php echo $row['Date']; ?></date>
            <childname><?php echo htmlspecialchars($row['Name'], ENT_XML1, 'UTF-8'); ?></childname>
            <age><?php echo $row['Age']; ?></age>
            <public><?php echo $row['Public']; ?></public>
            <likes><?php if (strlen($row['Likes']) > 0) echo $row['Likes']; else echo 0; ?></likes>
            <mylike><?php echo $myLike; ?></mylike>
        </post>
    <?php endforeach; ?>
</posts>