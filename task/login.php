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
        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="user">
            <input type="password" name="password" placeholder="pass">
            <input type="submit" value="Submit">
        </form>

        <?php
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Establish database connection
                $host = 'takenlijst';
                $user = 'your_username';
                $password = 'your_password';
                $database = 'your_database';

                $connection = mysqli_connect($host, $user, $password, $database);

                if (!$connection) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Query to check if the user exists
                $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
                $result = mysqli_query($connection, $query);

                if (mysqli_num_rows($result) > 0) {
                    // User exists, log them in
                    session_start();
                    $_SESSION['username'] = $username;
                    echo "Welcome back, $username!";
                } else {
                    // User doesn't exist, create a new user
                    echo "User not found. Please register.";
                }

                // Close the database connection
                mysqli_close($connection);
            } else {
                // Handle the case when username or password is not provided
                echo "Username and password are required.";
            }

        ?>
        <p>Nog geen account?</p>
        <div class="signup-href">
        <a href ="signup.php">Maak uw persoonlijke account!</a>
        </div>
    </div>

</body>
</html>