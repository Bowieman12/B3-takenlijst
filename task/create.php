<!doctype html>
<html lang="nl">

<head>
    <title>Document</title>
    <?php require_once '../head.php'; 
          session_start();
          if(!isset($_SESSION['user_id']))
          {
            $msg = "Je moet eerst inloggen!";
            header("location: login.php?msg=$msg");
            exit;
          }
    ?>
</head>

<body>

    <div class="container">
        <h1>Formulier</h1>

        <form action="../backend/tasksController.php" method="POST">
            <input type="hidden" name="action" value="create">

            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

            <div class="form-group">
                <label for="naam">Titel:</label>
                <input type="text" name="titel" id="titel" class="form-input">
            </div>

            <div class="form-group">
                <label for="afdeling">Afdeling:</label>
                <select name="afdeling" id="afdeling">
                    <option value="">-Maak een keuze-</option>
                    <option value="Personeel">Personeel</option>
                    <option value="Horeca">Horeca</option>
                    <option value="Techniek">Techniek</option>
                    <option value="Inkoop">Inkoop</option>
                    <option value="Groen">Groen</option>
                    <option value="Klateservice">Klateservice</option>
                </select> 
            </div>
            
            <div class="form-group">
                <label for="extra">Beschrijving:</label>
                <textarea name="beschrijving" id="beschrijving" class="form-input" rows="4"></textarea>
            </div>
            
            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" name="deadline" id="deadline" class="form-input">
            </div>

            <input type="submit" value="Verstuur melding">

        </form>
    </div>

</body>

</html>
