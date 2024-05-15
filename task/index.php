<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Takenlijst</title>
    <?php 
    require_once '../head.php'; 
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
        <div class="kanban">
            <a href="create.php">Nieuwe taak &gt;</a>
            
            <?php if(isset($_GET['msg']))
            { 
                echo "<div class='msg'>" . $_GET['msg'] . "</div>";
            } ?>

            <?php
                require_once '../config/conn.php';
 
                if (empty($_POST['afdeling']))
                {
                    $query  = "SELECT * FROM taken ORDER BY deadline ASC";
                    $statement = $conn->prepare($query);
                    $statement->execute();
                    $taken = $statement->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $query  = "SELECT * FROM taken WHERE afdeling = :afdeling ORDER BY deadline ASC";
                    $statement = $conn->prepare($query);
                    $statement->execute([
                        ":afdeling" => $_POST['afdeling']
                    ]);
                    $taken = $statement->fetchAll(PDO::FETCH_ASSOC);
                }
            ?>
                        
            <form action="<?php echo $base_url; ?>task/index.php" method="POST">                
                <select  name="afdeling" id="afdeling">
                    <option value="">-ALLE-</option>
                    <option value="Personeel">-Personeel-</option>
                    <option value="Horeca">-Horeca-</option>
                    <option value="Techniek">-Techniek-</option>
                    <option value="Inkoop">-Inkoop-</option>
                    <option value="Groen">-Groen-</option>
                    <option value="Klateservice">-Klateservice-</option>
                </select>
                <input type="submit" value="filter">
            </form>
        </div>



        <div class="taken-h1">
            <h1>To-Do</h1>
            <h1>Doing</h1>
            <h1>Done</h1>
        </div> 

        <div class="container-placement">
            <div class="container-index" id="container1" ondrop="drop(event)" ondragover="allowDrop(event)">
                <?php $i = 0; ?> 
                <?php foreach($taken as $taak): ?>
                    <div class="item" id="item<?php echo $i++; ?>" draggable="true" ondragstart="drag(event)">
                        <a href="../taken.php?id=<?php echo $taak['id']; ?>"><?php echo $taak['titel']; ?></a>
                        <?php echo $taak['afdeling'];?>
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

        // Append the dragged item to the destination container
        destinationContainer.appendChild(draggedItem);
        
        // Save item positions within containers
        saveItemPositions();
    }

    function saveItemPositions() {
        var container1Items = document.getElementById('container1').innerHTML;
        var container2Items = document.getElementById('container2').innerHTML;
        var container3Items = document.getElementById('container3').innerHTML;

        // Here you can perform any action to save the items within containers,
        // such as sending them to the server for processing or updating a database.
        // For this example, let's just log the items for demonstration.
        console.log("Container 1 items:", container1Items);
        console.log("Container 2 items:", container2Items);
        console.log("Container 3 items:", container3Items);
    }

</script>
</body>
</html>