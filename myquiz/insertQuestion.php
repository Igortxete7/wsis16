<html>
<head>
	<meta charset="utf-8">
	<title>Insert Question</title>
	<style>
	p#name  {font-size: 250%; text-align: center; font-weight: 100;}
	p#sur	{text-align: center;}
	input 	{font-size:100%;}
	p#space	{font-size: 10%; }
	body	{font-family: 'Helvetica Neue'}
	button 	{width:400px; height:35px; background-color: rgb(19,122,212); font-size: 100%; border:none; color:white;}
	div#container	{color: green;}

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
	<div>
		<form action="layout.html" style="position: absolute; top: 25px; left: 25px;">
			<input type="submit" value="Go back">
		</form>
		<form action="showQuestions.php" style="position: absolute; top: 25px; right: 25px;">
			<input type="submit" value="Show questions">
		</form>
	</div>

	<div align='center'>
		<p id='name'> Insert Question </p>
		<p id='sur'>Insert any kind of question in the first field and the answer below. <br> If you want you can specify the difficulty.</p>
		<br>
		<form id="question" name="question" method="post" action="insertQuestion.php">
			<table border=0 align="center">
				<tr>
					<td>Question: </td>
					<td><input type="text" name="question" id="Question" size=40 placeholder="Question" onfocus="del()"></td>
					<td><p id='space'></p></td>
				</tr>
				<tr>
					<td>Answer: </td>
					<td><input type="text" name="answer" id="Answer" size=40 placeholder="Answer"></td>
					<td><p id='space'></p></td>
				</tr>
				<tr>
					<td>Difficulty:</td>
					<td><table>
						<tr>
							<td> 1<input type="radio" name="diff" value="1"></td>
							<td> 2<input type="radio" name="diff" value="2"></td>
							<td> 3<input type="radio" name="diff" value="3"></td>
							<td> 4<input type="radio" name="diff" value="4"></td>
							<td> 5<input type="radio" name="diff" value="5"></td>
						</tr>
					</table></td>
					<td><p id='space'></p></td>
				</tr>
			</table>
			<br>
			<br>
			<div id='container'>
			</div>
			<button class="button button2" id='hover' type="submit" value="Submit" name="submit" size=40 onmousedown="changeBack(this,'gray')" onmouseup="changeBack(this,'rgb(19,122,212)')"> Add question </button>
		</form>
	</div>

</body>
</html>

<?php

if(isset($_POST["submit"])){

	//$connect = mysqli_connect("mysql.hostinger.es", "u218379427_igor", "isanchez127", "u218379427_quiz");
	$connect = mysqli_connect("localhost", "root", "", "Quiz");

	session_start();
	$email = $_SESSION['user'];
	$quest = $_POST['question'];
	$ans = $_POST['answer'];

	if(isset($_POST['diff']))
		$diff=$_POST['diff'];
	else
		$diff = "";

	$sql = "INSERT INTO Galderak (eMail,Question,Answer,Difficulty)
	VALUES ('$email','$quest','$ans','$diff')";

	$ema=mysqli_query($connect, $sql);

	if(!$ema)
		die('ERROR in query execution: ' . mysqli_error($connect));
	
	?>
	<script>
	var container = document.getElementById("container");
	container.appendChild(document.createTextNode("The question was successfully created."));
	container.appendChild(document.createElement("br"));
	container.appendChild(document.createElement("br"));

	</script>
	<?php

	mysqli_free_result($ema);
	mysqli_close($connect);
}

?>






