<?php
include("dataBase.php");

if ($_POST['department']=='Others') {
	$var1 = $_POST['others'];
} else{
	$var1 = $_POST['department'];
}

if(isset($_FILES['picture']) && $_FILES['picture']['size']>0){
	$image = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
}else{
	$image="";
}

//Balioen kontrolak

$name = $_POST['firstname'];

if(filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array( "regexp" => "/[A-ZÁÉÍÓÚÑ][A-Za-z\sáéíóúñ]+/")))){
	echo("$name is a valid username <br>");
} else {
	die("$name is not a valid username!");
}


$surname = $_POST['lastname'];

if(filter_var($surname, FILTER_VALIDATE_REGEXP, array("options" => array( "regexp" => "/[A-ZÁÉÍÓÚÑ][A-Za-z\sáéíóúñ]+/")))){
	echo("$surname is a valid surname <br>");
} else {
	die("$surname is not a valid surname!");
}


$password = $_POST['password'];

if(strlen($password)>5){
	echo("****** is a valid password <br>");
} else {
	die("****** is not a password!");
}


$phonenumber = $_POST['phonenumber'];

if(!filter_var($phonenumber, FILTER_VALIDATE_REGEXP, array("options" => array( "regexp" => "/[0-9]{9}/"))) == false){
	echo("$phonenumber is a valid telephone <br>");
} else {
	die("$phonenumber is not a valid telephone!");
}


$email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[a-zA-Z]+\d{3}@ikasle\.ehu\.e(u?)s/"))) === false) {
	echo("$email is a valid email address <br>");
} else {
	die("$email is not a valid email address!");
}

$enct = sha1($password); //KRIPTOGRAFIATUTA
$sql="INSERT INTO Erabiltzaile VALUES ('$name', '$surname', '$email', '$enct', '$phonenumber', '$var1', '$_POST[text]', '$image')";

$ema=mysqli_query($connect, $sql);
if(!$ema){
	die('ERROR in query execution: ' . mysqli_error($connect));
}

echo "<br>";
echo "The registration was successful!";
echo "<p> <a href='showUsersWithImage.php'>Show registers</a>";

mysqli_close($connect);

?>