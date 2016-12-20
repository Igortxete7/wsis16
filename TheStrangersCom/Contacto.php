<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="general/style.css">
	<title>Contacto</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript">

	$(document).ready(function(){
		$("#footer").load("general/footer.html");
		$("#menu").load("general/menu.html");

	});
	</script>
	<style>
	input		{background-color:  rgb(61,61,61); color: rgb(200,200,200); padding: 10px; font-size: 100%; border: none;}
	textarea 	{background-color:  rgb(61,61,61); color: rgb(200,200,200); padding: 10px; font-size: 100%; border: none;}

	div#left 	{float:left; width:40%;}
	div#right 	{float:right; width:60%;}

	button 	{width:400px; height:35px; background-color: rgb(61,61,61); font-size: 100%; border:none; color:white;}
	.button {
		-webkit-transition-duration: 0.4s; /* Safari */
		transition-duration: 0.4s;
	}

	.button2:hover {
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
		border:solid;
		border-color:black;
	}
	</style>
	
</head>

<body background="images/stressed_linen.png">

	<div id="menu">

	</div>
	<br>
	<br>
	<p class="title">CONTACTO</p>
	<hr>
	<br>
	<div id="left">
		<p> Para más información no dudes en enviarnos un mensaje ;)</p>
	</div>
	<div id="right">
		<form method="post" align="left" action="Contacto.php">
			Nombre <font color="red"> * </font><br>
			<input type="text" name="name" id="Name" size=81 required><br><br><br>
			E-mail <font color="red"> * </font><br>
			<input type="email" name="mail" id="Mail" size=81 required><br><br><br>
			Mensaje <br>
			<textarea name="text" id="Text" rows="10" cols="79"></textarea><br><br><br>
			<button class="button button2" id='hover' type="submit" value="Submit" name="submit" size=40> Enviar </button>

		</form> 
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<div id="footer">

	</div>
</body>
</html>

<?php

if(isset($_POST["submit"])){

	include("dataBase.php");
  //Email information
	$admin_email = "thestrangerdjs@gmail.com";
	$name = $_POST['name'];
	$email = $_POST['mail'];
	$message = $_POST['text'];
  //send email
	mail($admin_email, $email, $message);

	$sql = "INSERT INTO Mails VALUES ('$$name','$email','$message')";
	$ema=mysqli_query($connect, $sql);

	if(!$ema)
		die('ERROR in query execution: ' . mysqli_error($connect));

  //Email response
	echo '<script type="text/javascript">
	var container = document.getElementById("left");
	container.appendChild(document.createTextNode("Gracias por enviarnos el mensaje!"));
	</script>';

}
?>
