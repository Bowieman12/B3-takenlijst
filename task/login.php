<!doctype html>
<html lang="nl">

<head>
    <title>Login</title>
    <?php
      require_once __DIR__ . '/../config/config.php';
      session_start();
    ?>


</head>

<body>
    <header>
        <h1>Inloggen</h1>
    </header>

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
                $host = 'localhost';
                $user = 'root';
                $password = 'your_password';
                $database = 'Takenlijst';

                $connection = mysqli_connect($host, $user, $password, $database);

                if (!$connection) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Query to check if the user exists
                $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
                $result = mysqli_query($connection, $query);
                
            }

        ?>
        <p>Nog geen account?</p>
        <div class="signup-href">
        <a href ="signup.php">Maak uw persoonlijke account!</a>
        </div>
    </div>


</body>
</html>