<!doctype html>
<html lang="nl">

<head>
    <title>Login</title>
    <?php
      require_once __DIR__ . '/../config/config.php';

    ?>


</head>

<body>
    <div class="header-h1">
        <header>
            <div class="inlog-h1">
                <h1>Inloggen</h1>

            </div>
        </header>
    </div>


    <div class="blok-inlog">
        <?php
            require_once '../head.php'; ?>
        <div class="container home">
        <form action="../backend/loginController.php" method="POST">
            <div class="user-pass">
                <input type="text" name="username" placeholder="user">
                <input type="password" name="password" placeholder="pass">
            </div>
            <div class="submit-inlog">
                <input type="submit" value="Submit">
            </div>
        </form>

            <div class="p-login">
                <p>Nog geen account?</p>
            </div>
            <div class="signup-href">
            <a href ="register.php">Maak uw persoonlijke account!</a>
            </div>
        </div>
    </div>



</body>
</html>