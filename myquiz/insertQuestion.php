<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Insert Question</title>
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
		<p id='name'> Insert Question </p>
		<p id='sur'>Insert any kind of question in the first field and the answer in the other. If you want you can specify the difficulty.</p>
		<br>
		<form id="question" name="question" method="post">
			<table border=0 align="center">
				<tr>
					<td>Question: </td>
					<td><input type="text" name="user" id="User" size=40 placeholder="Question"></td>
					<td><p id='space'></p></td>
				</tr>
				<tr>
					<td>Answer: </td>
					<td><input type="text" name="pass" id="Pass" size=40 placeholder="Answer"></td>
					<td><p id='space'></p></td>
				</tr>
				<tr>
					<td>Difficulty:</td>
					<td><table>
				<tr>
					<td> 1<input type="radio" name="gender" value="1"></td>
					<td> 2<input type="radio" name="gender" value="2"></td>
					<td> 3<input type="radio" name="gender" value="3"></td>
					<td> 4<input type="radio" name="gender" value="4"></td>
					<td> 5<input type="radio" name="gender" value="5"></td>
				</tr>
			</table></td>
					<td><p id='space'></p></td>
				</tr>
			</table>
			<br>
			<br>
			<button class="button button2" id='hover' type="submit" value="Submit" size=40 onmousedown="changeBack(this,'gray')" onmouseup="changeBack(this,'rgb(19,122,212)')"> Add question </button>
		</form>
	</div>

</body>
</html>

<?php

?>








