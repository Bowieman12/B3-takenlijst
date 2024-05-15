<?php
session_start();
 
$username = $_POST['username'];
$password = $_POST['password'];
 
if(empty($username))
{
    $msg = "Je moet eerst 'username invullen'";
    header("Location: ../task/register.php?msg=$msg");
    exit;
}
 
if(empty($password))
{
    $msg = "Je moet eerst 'wachtwoord invullen'";
    header("Location: ../task/register.php?msg=$msg");
    exit;
}
 
$hash = password_hash($password, PASSWORD_DEFAULT);
 
require_once("../config/conn.php");
$query = "INSERT INTO users (username, password) VALUES (:username, :password)";
$statement = $conn->prepare($query);
$statement->execute([
    ":username" => $username,
    ":password" => $hash,
]);
 
header("Location: ../task/index.php");
