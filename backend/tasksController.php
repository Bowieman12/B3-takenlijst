<?php

$action = $_POST['action'];
echo $action;

if($action == 'create'){
    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $afdeling = $_POST['afdeling'];
    $status = $_POST['deadline'];

    require_once '../config/conn.php';

    $query = "INSERT INTO taken (titel, beschrijving, afdeling, deadline)
    VALUES (:titel, :beschrijving, :afdeling, :deadline)";

    $statement = $conn->prepare($query);
    $status = 'To-Do';
    $statement->execute([
    ":titel"             => $titel,
    ":beschrijving"      => $beschrijving,
    ":afdeling"          => $afdeling,
    ":deadline"            => $deadline
    ]);

    $msg = "Je melding is verwijderd.";
    header("location: ../task/index.php?msg=$msg");

}
if($action == 'update'){
    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $afdeling = $_POST['afdeling'];
    $status = $_POST['status'];
    $id     = $_POST['id'];
    require_once '../config/conn.php';

    $query =    "UPDATE taken 
                SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, status = :status
                WHERE id = :id";

    $statement = $conn->prepare($query);
    $statement->execute([
        ":titel"             => $titel,
        ":beschrijving"      => $beschrijving,
        ":afdeling"          => $afdeling,
        ":status"            => $status,
        ":id"                => $id
    ]);
    header("location: ../task/index.php?msg=$msg");

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
    header("location: ../task/index.php?msg=$msg");

}
if($action == 'signup'){
    $naam = $_POST['naam'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once '../config/conn.php';

    $query = "INSERT INTO users (naam, username, password)
    VALUES (:naam, :username, :password)";

    $statement = $conn->prepare($query);
    $statement->execute([
    ":naam"             => $naam,
    ":username"      => $username,
    ":password"          => $password
    ]);
    header("location: ../task/index.php");

}
