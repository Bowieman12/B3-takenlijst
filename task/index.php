<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Takenlijst</title>
    <style>
        .container {
            width: 300px;
            height: 1000px;
            border: 2px solid #ccc;
            margin: 20px;
            float: left;
        }
        .item {
            width: 400px;
            height: 50px;
            background-color: #009688;
            color: #fff;
            text-align: center;
            line-height: 50px;
            margin: 10px;
            cursor: grab;
        }
        .container-placement {
            display: flex;
            justify-content: center;
        }

    </style>
</head>

<body>
    <div class="kanban">
    <h1>Taken</h1>
        <a href="create.php">Nieuwe taak &gt;</a>
        <?php if(isset($_GET['msg']))
        { 
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <?php
            require_once '../config/conn.php';
            $query  = "SELECT * FROM taken";
            $statement = $conn->prepare($query);
            $statement->execute();
            $taken = $statement->fetchAll(PDO::FETCH_ASSOC);
            
        ?>
        <table>
            <tr>
                <th>Titel</th>
                <th>Afdeling</th>
                <th>Beschrijving</th>
                <th>Status</th>
                <th>Aanpassen</th>
            </tr>
            <?php foreach($taken as $taak): ?>
                <tr>
                    <td><p><?php echo $taak['titel']; ?></p></td>
                    <td><p><?php echo $taak['afdeling']; ?></p></td>
                    <td><p><?php echo $taak['beschrijving']; ?></p></td>
                    <td><a href="edit.php?id=<?php echo $taak['id']; ?>">aanpassen</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="container-placement">
        <!-- <div class="container" id="container1" ondrop="drop(event)" ondragover="allowDrop(event)">
            <?php $i = 0; ?> 
            <?php foreach($taken as $taak): ?>
                <div class="item" id="item<?php echo $i++; ?>" draggable="true" ondragstart="drag(event)">
                    <?php
                        echo $taak['titel'];
                        echo $taak['afdeling'];
                        echo $taak['beschrijving'];
                    ?>
                </div>
            <?php endforeach; ?>
        </div> -->

        <div class="container" id="container1" ondrop="drop(event)" ondragover="allowDrop(event)">
            <?php $i = 0; ?> 
            <?php foreach($taken as $taak): ?>
                <div class="item" id="item<?php echo $i++; ?>" draggable="true" ondragstart="drag(event)">
                    <a href="example.com?id=<?php echo $taak['id']; ?>">
                        <?php echo $taak['titel']; ?>
                    </a>
                    <?php echo $taak['afdeling']; ?>
                    <?php echo $taak['beschrijving']; ?>
                </div>
            <?php endforeach; ?>
        </div>
    

        <div class="container" id="container2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    

        <div class="container" id="container3" ondrop="drop(event)" ondragover="allowDrop(event)"></div>

    </div>

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
    event.target.appendChild(document.getElementById(data));
    }
    </script>

</body>
</html>