<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Takenlijst</title>
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
                    <td><p><?php echo $taak['status']; ?></p></td>
                    <td><a href="edit.php?id=<?php echo $taak['id']; ?>">aanpassen</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>

</html>