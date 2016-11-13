<?php
session_start();
include ("securityH.php");
?>
<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
	<title>Sign in</title>
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

</head>

<body hspace="50">

	<div align='center'>
		<img src="https://auth.gfx.ms/16.000.26614.00/AppCentipede/AppCentipede_Microsoft.svg" >
		<form action="layout.html" style="position: absolute; top: 25px; left: 25px;" method="post">
			<input type="submit" value="Home">
		</form>
		<p id='name'> Sign In </p>
		<p id='sur'>Use your work or school, or personal Google account.</p>
		<div id="container" name="container">
		</div>
		<form id="login" name="login" method="post" action="signIn.php">
			<input type="email" name="user" id="user" size=40 placeholder="Email" required onfocus="del()">
			<p id='space'></p>
			<input type="password" name="pass" id="Pass" size=40 placeholder="Password" required><br>
			<p id='space'></p>
			<input type="checkbox"> Keep me signed in <br>
			<p id='space'></p>
			<button class="button button2" id='hover' type="submit" value="Submit" name="submit" size=40 onmousedown="changeBack(this,'gray')" onmouseup="changeBack(this,'rgb(19,122,212)')"> Sign in </button>
			<br>
			<br>
		</form>
		<p>No account? <a href='signUp.html'>Create one!</a></p>
	</div>

</body>
</html>

<?php

if(isset($_POST["submit"])){

	$email = $_POST['user'];
	$password = $_POST['pass'];

	if(empty($email) || empty($password)){
		?>
		<script>
		var container = document.getElementById("container");
		container.appendChild(document.createTextNode("You need to introduce your credentials."));
		container.appendChild(document.createElement("br"));
		container.appendChild(document.createElement("br"));

		</script>
		<?php
	}
	else{

		include("dataBase.php");

		$sql = "SELECT * FROM Erabiltzaile WHERE eMail = '$email' AND Password = '$password'";
		$query = mysqli_query($connect,$sql);
		$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
		$count = mysqli_num_rows($query);

		if($count == 1){
			$_SESSION['user-email'] = $email;
			$_SESSION['user-firstname'] = $row['First Name'];
			$_SESSION['user-lastname'] =  $row['Last Names'];
			$_SESSION['auth'] = "YES";

			$date = date ("Y-m-d H:i:sa");
			$sql2 = "INSERT INTO Konexioak (User,Data)
			VALUES ('$email','$date')";
			$ema2=mysqli_query($connect, $sql2);

			if(!$ema2)
				die('ERROR in insert konnexion: ' . mysqli_error($connect));

			$sql3 = "SELECT MAX(ID) FROM Konexioak WHERE eMail = '$email'"; //OJO QUE LO HE CAMBIADO
			$result = mysqli_query($connect,$sql3);
			$row = mysqli_fetch_row($result);

			$_SESSION['konex-id'] = $row[0];


			// IKASLE ETA IRAKASLEEN KONTROLA

			if($email == "web000@ehu.es"){
				header('Location: reviewingQuizes.php');
			} else {
				header('Location: handlingQuizes.php');
			}
			
			
		}
		else{
			?>
			<script>
			var container = document.getElementById("container");
			container.appendChild(document.createTextNode("Your account or password is incorrect."));
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








