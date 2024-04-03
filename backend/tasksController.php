<?php

$action = $_POST['action'];
echo $action;

if($action == 'create'){
    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $afdeling = $_POST['afdeling'];

    require_once '../config/conn.php';

    $query = "INSERT INTO taken (titel, beschrijving, afdeling)
    VALUES (:titel, :beschrijving, :afdeling)";

    $statement = $conn->prepare($query);

    $statement->execute([
    ":titel"             => $titel,
    ":beschrijving"      => $beschrijving,
    ":afdeling"          => $afdeling,
    ]);

    $msg = "Je melding is verwijderd.";
    header("location:../../../task/index.php?msg=$msg");

}
if($action == 'update'){
    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $afdeling = $_POST['afdeling'];
    $status = $_POST['status'];
    require_once '../config/conn.php';

    $query =    "UPDATE taken 
                SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, status = :status
                WHERE id = :id";

    $statement = $conn->prepare($query);
    $statement->execute([
        ":titel"             => $titel,
        ":beschrijving"      => $beschrijving,
        ":afdeling"          => $afdeling,
        ":status"            => $status
    ]);
    head("location: ../task/index.php?msg=$msg");

}
if($action == 'delete'){
    $id = $_POST['id'];

    require_once '../config/conn.php';
    $query = "DELETE FROM taken  
              WHERE id = :id;";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":id"        => $id,
    ]);

    $msg = "Je melding is verwijderd.";
    head("location: ../task/index.php?msg=$msg");

}