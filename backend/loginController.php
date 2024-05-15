<?php
session_start();
require_once '../config/conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute([":username" => $username]);

if($statement->rowCount() < 1) {
    die("error: account bestaat niet");
}

$user = $statement->fetch(PDO::FETCH_ASSOC);

if(password_verify($password, $user['password'])) {
    die("error: wachtwoord is niet juist!");
}

$_SESSION['user_id'] = $user['id'];


// Redirect to index.php after successful login
header("Location: ../index.php");
exit;