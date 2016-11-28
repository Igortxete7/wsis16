<?php
session_start();
include ("securityH.php");
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Insert Question</title>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="functions.js"></script>
	<style type="text/css">
	.centerFix {
		position: fixed;
		left: 50%;
		top: 20%;
		transform: translate(-50%, -20%);
	}
	</style>

</head>

<body>
	<nav class="navbar navbar-inverse" style="border-radius:0px">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="layout.php"><span class="glyphicon glyphicon-lamp"></span> Quizzes</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="layout.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
					<li class="dropdown active">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-globe"></span> Questions <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="showQuestions.php"><span class="glyphicon glyphicon-eye-open"></span> Show Questions</a></li>
							<?php
							if(isset($_SESSION["auth"])){
								?>
								<li class="active"><a href="insertQuestion.php"><span class="glyphicon glyphicon-import"></span> Insert Questions</a></li>
								<li><a href="handlingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Handle Questions</a></li>
								<?php
								if($_SESSION['user-email'] == "web000@ehu.es"){
									?>
									<li><a href="reviewingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Rewiew Questions</a></li>
									<?php
								}
							}
							
							?>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Users <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="showUsersWithImage.php"><span class="glyphicon glyphicon-eye-open"></span> Show Users</a></li>
							<li><a href="getUserInfo.php"><span class="glyphicon glyphicon-search"></span> Get User Info</a></li>
						</ul>
					</li>
					<li><a href="sendComment.php"><span class="glyphicon glyphicon-comment"></span> Send a comment</a></li>
					<li><a href="credits.php"><span class="glyphicon glyphicon-align-left"></span> Credits</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php
					if(isset($_SESSION["auth"])){
						?>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ". $_SESSION["user-firstname"]." ". $_SESSION["user-lastname"];?><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#"><span class="glyphicon glyphicon-cog"></span> Configuration</a></li>
								<li><a href="changePass.php"><span class="glyphicon glyphicon-transfer"></span> Change Password</a></li>
								<li><a href="logOut.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
							</ul>
						</li>
						<?php
					}else{
						?>
						<li><a href='signIn.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
						<li><a href='signUp.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="jumbotron text-center">
			<h1>Insert Question</h1>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p align="center">Insert any kind of question in the first field and the answer below. <br> If you want you can specify the difficulty.</p>
				<br>
				<form id="question" name="question" method="post" action="insertQuestion.php">
					<div class="form-group form-inline">
						<label for="question" style="width:12%">Question:</label>
						<input type="text" style="width:87%" name="question" id="Question" class="form-control" placeholder="Enter your question" required onfocus="del()">
					</div>
					<div class="form-group form-inline">
						<label for="answer" style="width:12%">Answer:</label>
						<input type="text" style="width:87%" name="answer" id="Answer" class="form-control" placeholder="Enter your answer" required>
					</div>
					<br>
					<div class="form-group form-inline">
						<label for="subject" style="width:12%">Subject:</label>
						<input type="text" style="width:87%" name="subject" id="subject" class="form-control" placeholder="Enter the subject" required>
					</div>
					<div class="form-group form-inline" >
						<label for="difficulty" style="width:12%">Difficulty:</label>
						<select class="form-control" style="width:87%" name="diff">
							<option value=""></option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
					<button class="btn btn-primary btn-block" type="submit" value="Submit" name="submit">Add question</button>
				</form>
				<br><br><br><br><br>
			</div>

		</div>
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