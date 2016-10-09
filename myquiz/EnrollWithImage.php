<?php
$connect = mysqli_connect("mysql.hostinger.es", "u218379427_igor", "isanchez127", "u218379427_quiz");
//$connect = mysqli_connect("localhost", "root", "", "Quiz");

if ($_POST['department']=='Others') {
	$var1 = $_POST['others'];
} else{
	$var1 = $_POST['department'];
}

$image = addslashes(file_get_contents($_FILES['picture']['tmp_name']));

$sql="INSERT INTO Erabiltzaile 
VALUES ('$_POST[firstname]', '$_POST[lastname]', '$_POST[email]', '$_POST[password]', '$_POST[phonenumber]', '$var1', '$_POST[text]', '$image')";

$ema=mysqli_query($connect, $sql);
if(!$ema){
	die('ERROR in query execution: ' . mysqli_error($connect));
}

echo "The registration was successful!";
echo "<p> <a href='ShowUsersWithImage.php'>Erregistroak ikusi</a>";

mysqli_close($connect);

?>