<!doctype html>
<html lang="nl">

<head>
    <title>Aanpassen</title>
    <?php require_once '../head.php'; 
    session_start();
    if(!isset($_SESSION['user_id']))
      {
        $msg = "je moet eerst inloggen!";
        header("location: login.php?msg=$msg");
        exit;
      }
      ?>
</head>

<body>
    <header>
        <?php require_once '../header.php'; ?>
    </header>

    <main>
        <?php 

        if(!isset($_GET['id'])){
            echo "Geef in je aanpaslink op de index.php het id van betreffende item mee achter de URL in je a-element om deze pagina werkend te krijgen na invoer van je vijfstappenplan";
            exit;

        }
        ?>
        <?php
            require_once '../head.php'; ?>

        <div class="container">
            <h1>Taak aanpassen</h1>

            <?php
            $id = $_GET['id'];

            require_once '../config/conn.php';

            $query = "SELECT * FROM taken WHERE id = :id";

            $statement = $conn->prepare($query);

            $statement->execute([
                ':id' => $id,
            ]);

            $taak = $statement->fetch(PDO::FETCH_ASSOC);
            ?>

            <form action="<?php echo $base_url; ?>/backend/tasksController.php" method="POST">
                <input type="hidden" name="action" value="update"> 
                <input type="hidden" name="id" value="<?php echo $taak['id'];?>">


                <div class="form-group"> 
                    <label for="titel">Titel:  </label>
                    <input type="text" name="titel" id="titel" class="form-input" value="<?php echo ($taak['titel']);?>">
                </div>

                <div class="form-group">
                    <label for="beschrijving">beschrijving: </label>
                    <textarea name="beschrijving" id="beschrijving" class="form-input" rows="4" ><?php echo $taak['beschrijving']?></textarea>   
                </div>

                <div class="form-group"> 
                    <label for="afdeling">afdeling: </label>
                    <input type="text" name="afdeling" id="afdeling" class="form-input" value="<?php echo ($taak['afdeling']);?>">
                </div>

                <div class="form-group"> 
                    <label for="status">deadline: </label>
                    <input type="date" name="deadline" id="deadline" class="form-input">          
                </div>
                <input type="submit" value="taak opslaan">

            </form>

            <hr>

            <form action="<?php echo $base_url; ?>/backend/tasksController.php" method="POST">
                <input type="hidden" name="action"value="delete">
                <input type="hidden" name="id"value="<?php echo $id;?>">
                <input type="submit" value="Verwijderen">
            </form>
        </div>
    </main>  

</body>

</html>