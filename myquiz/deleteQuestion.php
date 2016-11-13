<?php
session_start();
include('security.php');
if($_SESSION['user-email'] !== 'web000@ehu.es'){
  header("Location: layout.html");
}

include('dataBase.php');
$id = $_POST['idIN'];

$update = "DELETE FROM Galderak WHERE `ID`='$id'";
$ans = mysqli_query($connect,$update);

echo"OK";
?>