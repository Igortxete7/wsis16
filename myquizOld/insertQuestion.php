<?php
session_start();
include ("securityH.php");
?>

<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
	<title>Insert Question</title>
	<style>
	p#name  {font-size: 250%; text-align: center; font-weight: 100;}
	p#sur	{text-align: center;}
	input 	{font-size:100%;}
	p#space	{font-size: 10%; }
	body	{font-family: 'Roboto', sans-serif;}
	button 	{width:400px; height:35px; background-color: rgb(19,122,212); font-size: 100%; border:none; color:white;}

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
		<form action="layout.html" style="position: absolute; top: 25px; left: 25px;" method="post">
			<input type="submit" value="Home">
		</form>
		<form action="showQuestions.php" style="position: absolute; top: 50px; left: 25px;" method="post">
			<input type="submit" value="Show questions">
		</form>
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
					<td><p id='space'></p></td>
				</tr>
				<tr>
					<td>Subject: </td>
					<td><input type="text" name="subject" id="subject" size=40 placeholder="Subject"></td>
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

	include("dataBase.php");

	$email = $_SESSION['user-email'];
	$quest = $_POST['question'];
	$ans = $_POST['answer'];

	if(empty($quest) || empty($ans)){
		?>
		<script>
		var container = document.getElementById("container");
		container.appendChild(document.createTextNode("You need to fill question and answer fields."));
		container.style.color = "red";
		container.appendChild(document.createElement("br"));
		container.appendChild(document.createElement("br"));

		</script>
		<?php

	}
	else{

		//GALDERAK TAULARA GEHITU

		if(isset($_POST['subject']))
			$subj=$_POST['subject'];
		else
			$subj = "";


		if(isset($_POST['diff'])){
			$diff=$_POST['diff'];
			$sql = "INSERT INTO Galderak (eMail,Question,Answer,Subject,Difficulty)
			VALUES ('$email','$quest','$ans','$subj','$diff')";
		}else{
			$diff="";
			$sql = "INSERT INTO Galderak (eMail,Question,Answer,Subject,Difficulty)
			VALUES ('$email','$quest','$ans','$subj',NULL)";
		}
		$ema=mysqli_query($connect, $sql);

		if(!$ema)
			die('ERROR in query execution: ' . mysqli_error($connect));



		//EKINTZAK TAULARA GEHITU

		$konex = $_SESSION['konex-id'];
		//$email
		$task = "Insert question";
		$date = date ("Y-m-d H:i:sa");
		$ip = $_SERVER['REMOTE_ADDR'];

		$sql2 = "INSERT INTO Ekintzak (Konex, User, Task, Data, IP)
		VALUES ('$konex','$email','$task','$date','$ip')";

		$ema2=mysqli_query($connect, $sql2);

		if(!$ema2)
			die('ERROR in query execution: ' . mysqli_error($connect));



		//XML FITXATEGIRA GEHITU

		$file = 'galderak.xml';
		$xml = simplexml_load_file($file);

		$assessmentItem = $xml->addChild('assessmentItem');
		$assessmentItem->addAttribute('complexity', $diff);
		$assessmentItem->addAttribute('subject', $subj);

		$itemBody = $assessmentItem->addChild('itemBody');
		$itemBody->addChild('p', $quest);

		$correctResponse = $assessmentItem->addChild('correctResponse');
		$correctResponse->addChild('value',$ans);

		$xml->asXML($file);

		
		?>
		<script>
		var container = document.getElementById("container");
		container.appendChild(document.createTextNode("The question was successfully created."));
		container.style.color = "green";
		container.appendChild(document.createElement("br"));
		container.appendChild(document.createElement("br"));

		</script>
		<?php
		mysqli_close($connect);
	}

}


?>






