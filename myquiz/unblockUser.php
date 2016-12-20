<?php
  session_start();
  include('security.php');
  if($_SESSION['user-email'] !== 'web000@ehu.es'){
    header("Location: layout.php");
  }
  include('dataBase.php');
  $email = mysqli_real_escape_string($connect,$_POST['email']);
  $sql = "UPDATE erabiltzaile SET Attempts=0 WHERE `eMail`='$email'";
  $query = mysqli_query($connect,$sql);
  echo "unblocked";
?>