<?php
session_start();
if(isset($_SESSION['user'])){
  session_unset();
  session_destroy();
  header("Location: logIn.php");
  exit;
} else{
  header("Location: logIn.php");
  exit;
}
?>