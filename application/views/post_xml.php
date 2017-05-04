<posts>
    <?php foreach ($posts as $row) : ?>
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
        </post>
    <?php endforeach; ?>
</posts>