<!DOCTYPE html>
<html lang="nl">

<head>
<?php require_once '../head.php'; 
  session_start();
  if(!isset($_SESSION['user_id']))
  {
    $msg = "je moet eerst inloggen!";
    header("location: login.php?msg=$msg");
    exit;
  }
?>
</head>
<body>
  <header>
    <?php require_once '../header.php'; ?>
  </header>

  <main>
    
  </main>
</body>
</html>