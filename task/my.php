<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Mijn Takenlijst</title>
    <?php 
    require_once '../head.php'; 
    session_start();
    if(!isset($_SESSION['user_id'])) {
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
        <div class="kanban">
            <a href="create.php">Nieuwe taak &gt;</a>
            
            <?php if(isset($_GET['msg'])) { 
                echo "<div class='msg'>" . $_GET['msg'] . "</div>";
            } ?>

            <?php
                require_once '../config/conn.php';

                $query = "SELECT * FROM taken";
                $params = [];

                if (isset($_GET['id'])) {
                    $query .= " WHERE id = :id";
                    $params[':id'] = $_GET['id'];
                }

                if (!empty($_POST['afdeling'])) {
                    $query .= (strpos($query, 'WHERE') !== false ? " AND" : " WHERE") . " afdeling = :afdeling";
                    $params[':afdeling'] = $_POST['afdeling'];
                }

                $query .= " ORDER BY deadline ASC";
                $statement = $conn->prepare($query);
                $statement->execute($params);
                $taken = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>
                        
            <form action="<?php echo $base_url; ?>task/my.php?id=<?php echo $_GET['id']; ?>" method="POST">                
                <select name="afdeling" id="afdeling">
                    <option value="">-ALLE-</option>
                    <option value="Personeel">-Personeel-</option>
                    <option value="Horeca">-Horeca-</option>
                    <option value="Techniek">-Techniek-</option>
                    <option value="Inkoop">-Inkoop-</option>
                    <option value="Groen">-Groen-</option>
                    <option value="Klanteservice">-Klanteservice-</option>
                </select>
                <input type="submit" value="filter">
            </form>
        </div>

        <div class="taken-h1">
            <h1>To-Do</h1>
            <h1>Doing</h1>
            <h1>Done</h1>
        </div>
        <div class="taken-h1">
            <a href="index.php">Terug naar takenlijst &gt;</a>
        </div>

        <div class="container-placement">
            <div class="container-index" id="container1" ondrop="drop(event)" ondragover="allowDrop(event)">
                <?php $i = 0; ?> 
                <?php foreach($taken as $taak): ?>
                    <div class="item" id="item<?php echo $i++; ?>" draggable="true" ondragstart="drag(event)">
                        <a href="../taken.php?id=<?php echo $taak['id']; ?>"><?php echo $taak['titel']; ?></a>
                        <?php echo $taak['afdeling']; ?>
                        <?php echo $taak['deadline']; ?>
                        <a href="edit.php?id=<?php echo $taak['id']; ?>">aanpassen </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="container-index" id="container2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
            <div class="container-index" id="container3" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        </div>
    </main>

    <script>
        function allowDrop(event) {
            event.preventDefault();
        }

        function drag(event) {
            event.dataTransfer.setData("text", event.target.id);
        }

        function drop(event) {
            event.preventDefault();
            var data = event.dataTransfer.getData("text");
            var draggedItem = document.getElementById(data);
            var destinationContainer = event.target;

            destinationContainer.appendChild(draggedItem);
            saveItemPositions();
        }

        function saveItemPositions() {
            var container1Items = document.getElementById('container1').innerHTML;
            var container2Items = document.getElementById('container2').innerHTML;
            var container3Items = document.getElementById('container3').innerHTML;

            console.log("Container 1 items:", container1Items);
            console.log("Container 2 items:", container2Items);
            console.log("Container 3 items:", container3Items);
        }
    </script>
</body>
</html>
