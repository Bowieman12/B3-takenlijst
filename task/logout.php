<?php
require_once __DIR__ . '/../config/config.php';
session_start();
session_start();
session_destroy();
header("Location: ../index.php");
exit;
?>