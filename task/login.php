<!doctype html>
<html lang="nl">

<head>
    <title>Login</title>
    <?php
      require_once __DIR__ . '/../config/config.php';
      session_start();
    ?>

	<meta charset="utf-8">
	<meta name="description" content="StoringApp voor technische dienst van DeveloperLand">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo $base_url; ?>/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo $base_url; ?>/css/normalize.css">
	<link rel="stylesheet" href="<?php echo $base_url; ?>/css/main.css">
</head>

<body>

    <?php
        require_once '../head.php'; ?>
    <div class="container home">
        <form action="submit.php" method="POST">
            <input type="text" name="username" placeholder="user">
            <input type="password" name="password" placeholder="pass">
            <input type="submit" value="Submit">
        </form>
    </div>

</body>

</html>