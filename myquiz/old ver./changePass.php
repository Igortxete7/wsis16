<?php
session_start();
include ("securityH.php");
?>
<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
	<title>Change Password</title>
	<style>
	p#name  {font-size: 250%; text-align: center; font-weight: 100;}
	p#sur	{text-align: center;}
	input 	{font-size:100%;}
	p#space	{font-size: 10%;}
	body	{font-family: 'Roboto', sans-serif;}
	button 	{width:400px; height:35px; background-color: rgb(19,122,212); font-size: 100%; border:none; color:white;}
	div#container {color: red;}

	.button {
		-webkit-transition-duration: 0.4s; /* Safari */
		transition-duration: 0.4s;
	}

	.button2:hover {
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
		border:solid;
		border-color:rgb(8,79,138);
	}

	</style>

	<script src="functions.js"></script>
	<script>
	function equals() {

		if(document.getElementById("pass").value!=""){
			if(document.getElementById("pass").value.length >5){
				if (document.getElementById("pass").value !== document.getElementById("pass2").value){
				alert("The passwords are NOT equal.");
				document.getElementById("pass").value = "";
				document.getElementById("pass2").value = "";
				return false;
			}
			}else{
				alert("New password is too short!");
				document.getElementById("pass").value = "";
				document.getElementById("pass2").value = "";
				return false;
			}
			
		}
	}
	</script>

</head>

<body hspace="50">

	<div align='center'>
		<img src="https://auth.gfx.ms/16.000.26614.00/AppCentipede/AppCentipede_Microsoft.svg" >
		<form action="layout.html" style="position: absolute; top: 25px; left: 25px;" method="post">
			<input type="submit" value="Home">
		</form>
		<p id='name'> Change Password </p>
		<p id='sur'>Introduce your old and new passwords.</p>
		<div id="container" name="container">
		</div>
		<form id="login" name="login" method="post" action="changePass.php" onsubmit="return equals()">
			<input type="password" name="old" id="old" size=40 placeholder="Old password" required>
			<p id='space'></p>
			<input type="password" name="pass" id="pass" size=40 placeholder="New password" required><br>
			<p id='space'></p>
			<input type="password" name="pass2" id="pass2" size=40 placeholder="Repeat" required onchange="equals()"><br>
			<p id='space'></p>
			<button class="button button2" id='hover' type="submit" value="Submit" name="submit" size=40> Change </button>
			<br>
			<br>
		</form>
	</div>

</body>
</html>

<?php

if(isset($_POST["submit"])){

	$old = $_POST['old'];
	$pass = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	$email = $_SESSION['user-email'];

	$encOld = sha1($old);
	$encNew = sha1($pass);

	if(empty($old) || empty($pass2) || empty($pass)){
		?>
		<script>
		var container = document.getElementById("container");
		container.appendChild(document.createTextNode("You need to fill all boxes."));
		container.appendChild(document.createElement("br"));
		container.appendChild(document.createElement("br"));

		</script>
		<?php
	}
	else{

		include("dataBase.php");

		$sql = "SELECT * FROM Erabiltzaile WHERE eMail = '$email' AND Password = '$encOld'";
		$query = mysqli_query($connect,$sql);
		$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
		$count = mysqli_num_rows($query);

		if($count == 1){

			$sql2 = "UPDATE Erabiltzaile
			SET Password = '$encNew'
			WHERE eMail = '$email'";
			$ema2=mysqli_query($connect, $sql2);

			if(!$ema2)
				die('ERROR in insert konnexion: ' . mysqli_error($connect));	

					?>
		<script>
		var container = document.getElementById("container");
		container.style.color = "green";
		container.appendChild(document.createTextNode("Password changed!"));
		container.appendChild(document.createElement("br"));
		container.appendChild(document.createElement("br"));

		</script>
		<?php
		}
		mysqli_free_result($query);
		mysqli_close($connect);
	}
}
?>