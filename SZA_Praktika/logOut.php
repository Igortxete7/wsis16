<?php
//Sesioa egina badago, hau da erabiltzailea logeatuta badago, sesioa itxiko du. Bestela orri nagusira bideratuko du ezer egin gabe.
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