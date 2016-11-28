<?php

if(isset($_POST["submit"])){

	include("dataBase.php");

	$email = $_SESSION['user-email'];
	$quest = $_POST['question'];
	$ans = $_POST['answer'];

	if(empty($quest) || empty($ans)){
		?>
		<div class="alert alert-danger alert-dismissable fade in centerFix">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			<strong align="center">You need to fill question and answer fields.</strong>
		</div>
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
		?>
		<div class="alert alert-success alert-dismissable fade in centerFix">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			<strong align="center">The question was successfully created.</strong>
		</div>
		<?php
		mysqli_close($connect);
	}
}
?>