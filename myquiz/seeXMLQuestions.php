<?php
session_start();

include("dataBase.php");

if(isset($_SESSION['user-email']))
	echo "<p align='right'style='position: absolute; top: 0px; right: 10px;'>Hello, ".$_SESSION['user-firstname']." ".$_SESSION['user-lastname']." | <a href='logOut.php'>Logout</a></p>";

?>

<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
	<title>Questions XML</title>
	<style>
	p#name  {font-size: 250%; text-align: center; font-weight: 100;}
	body	{font-family: 'Roboto', sans-serif;}
	input   {font-size: 100%;}
	table	{border-collapse: collapse; width: 50%; }
	th		{text-align: center;padding: 8px; border-bottom: 1px solid #ddd;}
	td 		{padding: 8px; text-align: left; border-bottom: 1px solid #ddd;}
	tr:hover{background-color:#f5f5f5}

	</style>
</head>
<body>
	<div align='center'>
		<img src="https://auth.gfx.ms/16.000.26614.00/AppCentipede/AppCentipede_Microsoft.svg">
	</div>
	<form action="layout.html" style="position: absolute; top: 25px; left: 25px;" method="post">
		<input type="submit" value="Home">
	</form>
	<p id='name' align='center'> Questions XML </p>
</body>
</html>


<?php

//XML Fitxategia atzitu eta galderak bistaratu

$galderak = simplexml_load_file('galderak.xml');

echo '<table align="center" cellpadding="5"> <tr><th> Question </th><th> Difficulty </th><th> Subject </th></tr>';


foreach($galderak->xpath('//assessmentItem') as $galdera){
	
	echo '<tr align="center"><td>';
	foreach ($galdera->children() as $itemBody) {
		echo utf8_decode("$itemBody->p");
	}
	echo '</td><td>';
	echo utf8_decode("$galdera[complexity]");
	echo '</td><td>';
	echo utf8_decode("$galdera[subject]");
	echo '</td></tr>';
}

echo '</table>';
?>