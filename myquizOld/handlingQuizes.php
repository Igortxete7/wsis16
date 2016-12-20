<?php
session_start();
include ("securityH.php");
?>

<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
	<title>Handling Quizes</title>
	<style>
	p#name  {font-size: 250%; text-align: center; font-weight: 100;}
	p#sur	{text-align: center;}
	input 	{font-size:100%;}
	p#space	{font-size: 10%; }
	body	{font-family: 'Roboto', sans-serif;}
	.button 	{width:200px; height:35px; background-color: rgb(19,122,212); font-size: 100%; border:none; color:white;}

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

	xhttp = new XMLHttpRequest();
	xhttp1 = new XMLHttpRequest();

	xhttp.onreadystatechange = function(){
		if (xhttp.readyState==4){
			var obj = document.getElementById('insert'); 
			obj.innerHTML = xhttp.responseText;
		}
	}

	function datuakEskatu(){
		xhttp.open("GET",'insertQuestionHandling.php');
		xhttp.send(null);
	} 

	function datuakEskatu2(){
		xhttp.open("GET",'showUserQuestionsHandling.php');
		xhttp.send(null);
	}

	function datuakEskatu3(){
		xhttp.open("GET",'showQuestionsHandling.php');
		xhttp.send(null);
	} 

	function dbShowData(){
		xhttp1.onreadystatechange = function(){
			if((xhttp1.readyState==4) && (xhttp1.status==200)){
				document.getElementById("info").innerHTML=xhttp1.responseText;
			}
		}
		xhttp1.open("GET","userInfo.php");
		xhttp1.send(null);

	}

	function refresh(){
		dbShowData();
		setInterval(dbShowData,5000);
	}

	</script>

</head>

<body hspace="50" onload="refresh()">
	<div align='center'>
		<img src="https://auth.gfx.ms/16.000.26614.00/AppCentipede/AppCentipede_Microsoft.svg">
		<p id='name'> Handling Quizes </p>
		<form action="layout.html" style="position: absolute; top: 25px; left: 25px;" method="post">
			<input type="submit" value="Home">
		</form>
		<div align="center" id="info">
		</div>
		<br>
		<div>
			<!--<button class="button button2" id='hover' type="submit" size=40 onmousedown="changeBack(this,'gray')" onmouseup="changeBack(this,'rgb(19,122,212)')" onclick="location.href='layout.html'"> Home </button>-->
			<button class="button button2" id='hover' type="submit" size=40 onmousedown="changeBack(this,'gray')" onmouseup="changeBack(this,'rgb(19,122,212)')" onclick="datuakEskatu3()"> Show questions </button>
			<button class="button button2" id='hover' type="submit" size=40 onmousedown="changeBack(this,'gray')" onmouseup="changeBack(this,'rgb(19,122,212)')" onclick="datuakEskatu()"> Insert question </button>
			<button class="button button2" id='hover' type="submit" size=40 onmousedown="changeBack(this,'gray')" onmouseup="changeBack(this,'rgb(19,122,212)')" onclick="datuakEskatu2()"> Show my questions </button>
		</div>
		<br>
		<div align="center" id="answer" name="answer">
		</div>
		<br>
		<div align="center" id="insert" name="insert">
		</div>
		
	</div>
	<br><br><br>

</body>
</html>