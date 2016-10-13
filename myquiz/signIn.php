<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign in</title>
	<style>
	p#name  {font-size: 250%; text-align: center; font-weight: 100;}
	p#sur	{text-align: center;}
	input 	{font-size:100%;}
	p#space	{font-size: 10%;}
	body	{font-family: 'Helvetica Neue'}
	button {width:400px; height:35px; background-color: rgb(19,122,212); font-size: 100%; border:none; color:white;}

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
		<img src="https://auth.gfx.ms/16.000.26614.00/AppCentipede/AppCentipede_Microsoft.svg">
	</div>
	<form action="layout.html">
		<input type="submit" value="Go back">
	</form>
	<div align='center'>
		<p id='name'> Sign In </p>
		<p id='sur'>Use your work or school, or personal Google account.</p>
		<form id="login" name="login" method="post" action="signIn.php">
			<input type="email" name="user" id="User" size=40 placeholder="Email"><br>
			<p id='space'></p>
			<input type="password" name="pass" id="Pass" size=40 placeholder="Password"><br>
			<p id='space'></p>
			<input type="checkbox"> Keep me signed in <br>
			<p id='space'></p>
			<button class="button button2" id='hover' type="submit" value="Submit" size=40 onmousedown="changeBack(this,'gray')" onmouseup="changeBack(this,'rgb(19,122,212)')"> Sign in </button>
			<br>
			<br>
		</form>
		<p>No account? <a href='signUp.html'>Create one!</a></p>
	</div>

</body>
</html>

<?php

?>








