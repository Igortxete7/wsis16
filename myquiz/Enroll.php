<?php
$connect = mysqli_connect("mysql.hostinger.es", "u218379427_igor", "isanchez127", "u218379427_quiz");
//$connect = mysqli_connect("localhost", "root", "", "Quiz");

$sql="INSERT INTO Erabiltzaile 
VALUES ('$_POST[firstname]', '$_POST[lastname]', '$_POST[email]', '$_POST[password]', '$_POST[phonenumber]', '$_POST[department]', '$_POST[text]')";

$ema=mysqli_query($connect, $sql);
if(!$ema){
	die('Errorea query-a gauzatzerakoan: ' . msqli_error($connect));
}

echo "Erregistro bat gehitu da!";
echo "<p> <a href='ShowUsers.php'>Erregistroak ikusi</a>";

mysqli_close($connect);


?>