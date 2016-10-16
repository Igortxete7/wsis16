<?php
session_start();
if(isset($_SESSION['user-email'])){
  echo "<p align='right'style='position: absolute; top: 0px; right: 10px;'>Hello, ".$_SESSION['user-firstname']." ".$_SESSION['user-lastname']." | <a href='logOut.php'>Logout</a></p>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Credits</title>
  <style>
  p#name  {font-size: 250%; text-align: center; font-weight: 100;}
  body  {font-family: 'Helvetica Neue'}
  img {border-radius:50px;}
  input {font-size: 100%}
  </style>
</head>
<body>
  <div align='center'>
    <img src="https://auth.gfx.ms/16.000.26614.00/AppCentipede/AppCentipede_Microsoft.svg">
  </div>
  <form action="layout.html" style="position: absolute; top: 25px; left: 25px;" method="post">
    <input type="submit" value="Home">
  </form>
  <div align='center'>
    <p id='name'>Credits</h1>
      <p> Eneko Ortiz de Zarate &amp; Igor Sanchez </p>
      <p> <strong>Speciality:</strong> Software Engineering.</p>
      <img width=720 src="http://media.meltybuzz.es/article-2618826-fb-f1437502963/willyrex-vegetta-wigetta-fanpics-relatos.jpg">
    </div>
  </body>
  </html>
