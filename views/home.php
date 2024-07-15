<h1><?php echo $title; ?></h1>

<ul>
    <?php foreach ($users as $user): ?>
        <li><?php echo $user['name']; ?></li>
        <li><?php echo $user['email']; ?></li>
    <?php endforeach; ?>
</ul>