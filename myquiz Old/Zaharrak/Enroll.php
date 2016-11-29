<?php
//$connect = mysqli_connect("mysql.hostinger.es", "u218379427_igor", "isanchez127", "u218379427_quiz");
$connect = mysqli_connect("localhost", "root", "", "Quiz");

if ($_POST['department']=='Others') {
	$var1 = $_POST['others'];
} else{
	$var1 = $_POST['department'];
}


$sql="INSERT INTO Erabiltzaile 
VALUES ('$_POST[firstname]', '$_POST[lastname]', '$_POST[email]', '$_POST[password]', '$_POST[phonenumber]', '$var1', '$_POST[text]')";

$ema=mysqli_query($connect, $sql);
if(!$ema){
	die('ERROR in query execution: ' . mysqli_error($connect));
}

echo "Erregistro bat gehitu da!";
echo "<p> <a href='ShowUsers.php'>Erregistroak ikusi</a>";

mysqli_close($connect);

?>