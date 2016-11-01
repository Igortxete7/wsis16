<?php

session_start();
$email = $_SESSION['user-email'];

include("dataBase.php");

$total = "SELECT COUNT(*) FROM Galderak";
$user  = "SELECT COUNT(*) FROM Galderak WHERE eMail = '$email'";

$result1 = mysqli_query($connect,$total);
$result2 = mysqli_query($connect,$user);

$row1 = mysqli_fetch_row($result1);
$row2 = mysqli_fetch_row($result2);

echo "$email : &nbsp; User questions / Total questions : &nbsp; $row2[0] / $row1[0]";
echo "";

mysqli_close($connect);

?>