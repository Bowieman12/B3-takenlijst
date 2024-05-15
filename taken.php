<?php

session_start();
if(!isset($_SESSION['user_id']))

{
    $msg="Je moet eerst inloggen!";
    header("Location: task/login.php?msg=$msg");
    exit;
}



if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = null;
}

?>

<?php require_once __DIR__.'/config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>Taken</title>
    <?php require_once __DIR__.'/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/header.php'; ?>

    <div class="container">
        <h1>Taak</h1>

        <?php
            require_once 'config/conn.php'; 
            $query = "SELECT * FROM taken WHERE id = :id";
            $statement = $conn->prepare($query);
            $statement->execute([
                ':id' => $id,
            ]);
            $taken = $statement->fetchAll(PDO::FETCH_ASSOC);

            
        ?>
    </div>
        <table class="container2">
            <tr>
                <th>Titel</th>
                <th>Beschrijving</th>
                <th>Afdeling</th>
                <th>Status</th>
                <th>Deadline</th>
                
            </tr>
            <?php foreach($taken as $taak): ?>
                <tr>
                    <td><?php echo $taak['titel']; ?></td>
                    <td><?php echo $taak['beschrijving']; ?></td>
                    <td><?php echo $taak['afdeling']; ?></td>
                    <td><?php echo $taak['status']; ?></td>
                    <td><?php echo $taak['deadline']; ?></td>
                    
                </tr>
            <?php endforeach; ?>
        </table>

</body>

</html>