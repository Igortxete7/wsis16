<?php
session_start();
include('security.php');
include('dataBase.php');
$test = mysqli_real_escape_string($connect,$_POST['test']);
$question = mysqli_real_escape_string($connect,$_POST['question']);
$answer = mysqli_real_escape_string($connect,$_POST['answer']);
$email = mysqli_real_escape_string($connect,$_SESSION['user-email']);
$testsql = "SELECT ID FROM testak WHERE Name = '$test'";
$testquery = mysqli_query($connect,$testsql);
$testresult = mysqli_fetch_array($testquery,MYSQLI_ASSOC);
$testid = $testresult['ID'];
if($_POST['difficulty']!==''){
  $difficulty = $_POST['difficulty'];
  $sql = "INSERT INTO galderak (TestID,Question,Answer,Difficulty)
  VALUES ('$testid','$question','$answer','$difficulty')";

} else{
  $difficulty = "";
  $sql = "INSERT INTO galderak (TestID,Question,Answer,Difficulty)
  VALUES ('$testid','$question','$answer',NULL)";
}
$query = mysqli_query($connect,$sql);
if (!$query){
  die('ERROR at query execution:' . mysqli_error($connect));
}
echo '<div class="alert alert-success alert-dismissable fade in centerFix">
<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
<strong align="center">The question was added successfully.</strong>
<a href="Questions.php" class="alert-link">See all questions.</a>
</div>';
  // EKINTZA
$connection = (int)$_SESSION['konex-id'];
$type = "Insert question";
$date = date ("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
$sql2 = "INSERT INTO ekintzak VALUES(0, $connection, '$email', '$type', '$date', '$ip')";
$query2 = mysqli_query($connect,$sql2);
if (!$query2){
  die('ERROR at query execution:' . mysqli_error($connect));
}
mysqli_close($connect);
exit;
?>