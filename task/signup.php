<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>

<body>
    <header>
        <?php require_once '../header.php'; ?>
    </header>
    
    <main>
        <h2>Sign Up</h2>
        <form action="../backend/tasksController.php" method="POST">
            <input type="hidden" name="action" value="signup">

            <label for="naam">Naam: </label>
            <input type="text" id="naam" name="naam" required>
            <br><br>
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" required>
            <br><br>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" required>
            <br><br>
            <input type="submit" value="Sign Up">
        </form>
    </main>
</body>

</html>