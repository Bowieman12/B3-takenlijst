<?php
    require_once '../config/conn.php';

    $afdeling = $_POST['afdeling'];

    $query  = "SELECT * FROM taken WHERE afdeling = :afdeling";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":afdeling" => $afdeling
    ]);
    $taken = $statement->fetchAll(PDO::FETCH_ASSOC);


    // header("location: ../task/index.php?");

 ?>