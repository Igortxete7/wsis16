<?php

session_start();
$email = $_SESSION['user-email'];

include("dataBase.php");

$result1 = mysqli_query($connect,"SELECT COUNT(*) FROM galderak");
$result2 = mysqli_query($connect,"SELECT COUNT(*) FROM galderak INNER JOIN testak ON galderak.TestID = testak.ID WHERE Creator = '$email'");

$row1 = mysqli_fetch_row($result1);
$row2 = mysqli_fetch_row($result2);

echo "$email : &nbsp; User questions / Total questions : &nbsp; $row2[0] / $row1[0]";
echo "";

mysqli_close($connect);

?>