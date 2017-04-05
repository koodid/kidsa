<posts>
    <?php foreach ($posts as $row) : ?>
        <post>
            <id><?php echo $row['ID']; ?></id>
            <birthday><?php echo $row['Birthday']; ?></birthday>
            <userid><?php echo $row['User']; ?></userid>
            <language><?php echo $row['Language']; ?></language>
            <data><?php echo $row['Text']; ?></data>
            <date><?php echo $row['Date']; ?></date>
            <childname><?php echo $row['Name']; ?></childname>
            <age><?php echo $row['Age']; ?></age>
            <public><?php echo $row['Public']; ?></public>
        </post>
    <?php endforeach; ?>
</posts>