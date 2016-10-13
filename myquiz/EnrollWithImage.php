<?php
//$connect = mysqli_connect("mysql.hostinger.es", "u218379427_igor", "isanchez127", "u218379427_quiz");
$connect = mysqli_connect("localhost", "root", "", "Quiz");

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

$email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[a-zA-Z]+\d{3}@ikasle\.ehu\.e(u?)s/"))) === false) {
  echo("$email is a valid email address");
  $sql="INSERT INTO Erabiltzaile VALUES ('$_POST[firstname]', '$_POST[lastname]', '$email', '$_POST[password]', '$_POST[phonenumber]', '$var1', '$_POST[text]', '$image')";
} else {
  echo("$email is not a valid email address");
}

$ema=mysqli_query($connect, $sql);
if(!$ema){
	die('ERROR in query execution: ' . mysqli_error($connect));
}

echo "<br>";
echo "The registration was successful!";
echo "<p> <a href='ShowUsersWithImage.php'>Erregistroak ikusi</a>";

mysqli_close($connect);

?>