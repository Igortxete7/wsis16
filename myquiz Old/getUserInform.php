<?php
session_start();
if($_SESSION['auth'] == "YES"){
	echo "<p align='right'style='position: absolute; top: 0px; right: 10px;'>Hello, ".$_SESSION['user-firstname']." ".$_SESSION['user-lastname']." | <a href='logOut.php'>Logout</a></p>";
}
?>
<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
	<title>Get User Info</title>
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
	<script type="text/javascript">

	function getInfo(){
		var dago = false;
		var xmlDoc = document.getElementById('xml-file').contentDocument;

		var mail = document.getElementById('mail').value;

		var emails = xmlDoc.getElementsByTagName('eposta');
		var firstnames = xmlDoc.getElementsByTagName('izena');
		var lastnames = xmlDoc.getElementsByTagName('abizena');
		var tlfs = xmlDoc.getElementsByTagName('telefonoa');

		for (var i = 0; i < emails.length; i++) {

			if(mail == emails[i].childNodes[0].nodeValue){
				document.getElementById('name').value = firstnames[i].childNodes[0].nodeValue;
				document.getElementById('surname').value = lastnames[i].childNodes[0].nodeValue;
				document.getElementById('tlf').value = tlfs[i].childNodes[0].nodeValue;
				dago = true;
				break;
			}
		}
		if(!dago){
			alert("The e-mail does not exist.");
		}
	}

	</script>

</head>

<body hspace="50">
	<object data="erabiltzaileak.xml" id="xml-file" type="file/xml" style="display:none">
	</object>
	<div align='center'>
		<img src="https://auth.gfx.ms/16.000.26614.00/AppCentipede/AppCentipede_Microsoft.svg" >
		<form action="layout.html" style="position: absolute; top: 25px; left: 25px;" method="post">
			<input type="submit" value="Home">
		</form>
		<p id='name'> Get User Info </p>
		<p id='sur'>Insert an user e-mail to get their personal information.</p>
		<div id="container" name="container">
		</div>
		<form>
			<input type="email" name="mail" id="mail" size=40 placeholder="Email" required><br>
			<br>
			<br>
			<input type="text" name="name" id="name" size=40 placeholder="Name" ><br>
			<p id='space'></p>
			<input type="text" name="surname" id="surname" size=40 placeholder="Surname" ><br>
			<p id='space'></p>
			<input type="text" name="tlf" id="tlf" size=40 placeholder="Telephone" ><br>
			<p id='space'></p>
			<button class="button button2" id='hover' size=40 onmousedown="changeBack(this,'gray')" onmouseup="changeBack(this,'rgb(19,122,212)')" onclick="getInfo()"> Get info </button>
		</form>
		<br>
		<br>

	</div>

</body>
</html>