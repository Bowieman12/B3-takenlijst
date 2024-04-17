<!doctype html>
<html lang="nl">

<head>
    <title>Login</title>
    <?php
      require_once __DIR__ . '/../config/config.php';

    ?>


</head>

<body>
    <header>
        <h1>Inloggen</h1>
    </header>

    <?php
        require_once '../head.php'; ?>
    <div class="container home">
    <form action="../backend/loginController.php" method="POST">
        <input type="text" name="username" placeholder="user">
        <input type="password" name="password" placeholder="pass">
        <input type="submit" value="Submit">
    </form>

        <p>Nog geen account?</p>
        <div class="signup-href">
        <a href ="signup.php">Maak uw persoonlijke account!</a>
        </div>
    </div>



</body>
</html>