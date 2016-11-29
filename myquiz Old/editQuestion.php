<?php
session_start();
include('security.php');
if($_SESSION['user-email'] !== 'web000@ehu.es'){
  header("Location: layout.html");
}

include('dataBase.php');
$id = $_POST['idIN'];
$email = $_POST['emailIN'];
$question = $_POST['questionIN'];
$answer = $_POST['answerIN'];
$subject = $_POST['subjectIN'];
$difficulty = "";

if($_POST['difficultyIN'] !== "-")
  $difficulty = $_POST['difficultyIN'];

$update = "UPDATE Galderak SET Question='$question', Answer='$answer', Subject='$subject', Difficulty='$difficulty' WHERE `ID`='$id'";
$ans = mysqli_query($connect,$update);

echo"OK";

?>