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
}