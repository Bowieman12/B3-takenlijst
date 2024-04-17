<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    $msg = "je moet eerst inloggen!";
    header("location: login.php?msg=$msg")
    exit;
}
$action = $_POST['action'];
echo $action;

if($action == 'create'){
    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $afdeling = $_POST['afdeling'];
    $deadline = $_POST['deadline'];

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
    $deadline = $_POST['deadline'];
    $id     = $_POST['id'];
    require_once '../config/conn.php';

    $query =    "UPDATE taken 
                SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, deadline = :deadline
                WHERE id = :id";

    $statement = $conn->prepare($query);
    $statement->execute([
        ":titel"             => $titel,
        ":beschrijving"      => $beschrijving,
        ":afdeling"          => $afdeling,
        ":deadline"            => $deadline,
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
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once '../config/conn.php';

    $query = "INSERT INTO users (username, password)
    VALUES (:username, :password)";

    $statement = $conn->prepare($query);
    $statement->execute([
    ":username"      => $username,
    ":password"          => $password
    ]);
    header("location: ../task/index.php");

}
