<?php
session_start();
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Support</title>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/myFunctions.js" type="text/javascript"></script>
	<style type="text/css">
	.fixed {
		position: fixed;
		top: 25;
		right: 25;
	}

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
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span> Quizzes <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="selectQuiz.php"><span class="glyphicon glyphicon-play"></span> Play Quizzes</a></li>
							<?php
							if(isset($_SESSION["auth"])){
								?>
								<li><a href="createTest.php"><span class="glyphicon glyphicon-book"></span> Create Quiz</a></li>
								<li><a href="insertQuestion.php"><span class="glyphicon glyphicon-import"></span> Insert Questions</a></li>
								<li><a href="questions.php"><span class="glyphicon glyphicon-eye-open"></span> See All Quizzes</a></li>
								<li><a href="handlingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Handle Quizzes</a></li>
								<?php
								if($_SESSION['user-email'] == "web000@ehu.es"){
									?>
									<li><a href="reviewingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Rewiew Quizzes</a></li>
									<?php
								}
							}
							?>
						</ul>
					</li>
					<?php
					if(isset($_SESSION["auth"])){
						?>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Users <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="users.php"><span class="glyphicon glyphicon-eye-open"></span> Show Users</a></li>
								<li><a href="getUserInfo.php"><span class="glyphicon glyphicon-search"></span> Get User Info</a></li>
							</ul>
						</li>
						<?php
					}
					?>
					<li class="active"><a href="sendComment.php"><span class="glyphicon glyphicon-comment"></span> Support</a></li>
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
			<h1>Support</h1>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p align="center">We are here to help.</p>
				<form id="iruzkina" action="sendComment.php" method="post">
					<div class="form-group">
						<input type="text" name="izena" id="izena" class="form-control" placeholder="Enter your name" required autofocus>
					</div>
					<div class="form-group">
						<input type="email" name="email" id="email" class="form-control" placeholder="Enter your mail" onchange="desgaitu()">
					</div>
					<div class="form-group">
						<label id="testua" style="color:gray"><input type="checkbox" name="public" id="public" disabled="disabled"> Make my email public</label>
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="5" id="text" name="text" placeholder="Write your comment" style="border: 2px solid black" required onmouseover="changeColor()"></textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-block" type="submit" value="Submit" name="submit"> Send </button>
					</div>
				</form>
			</div>
		</div>
		<br><br><br><br><br><br>
	</div>
</body>
</html>
<?php

if(isset($_POST["submit"])){

	include("dataBase.php");

	$izena = $_POST['izena'];
	$mail = $_POST['email'];
	$iruzkina =$_POST['text'];

	if( empty($izena) || empty($iruzkina) ){
		?>
		<div class="alert alert-danger alert-dismissable fade in centerFix">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			<strong align="center">You need to fill name and comment fields.</strong>
		</div>
		<?php
	}
	else{

		//GALDERAK TAULARA GEHITU

		if(isset($_POST['public'])){
			$sql = "INSERT INTO kritika
			VALUES ('$izena','$mail','$iruzkina')";
		}else{
			$sql = "INSERT INTO kritika (Izena, Kritika)
			VALUES ('$izena','$iruzkina')";
		}

		$ema=mysqli_query($connect, $sql);

		if(!$ema)
			die('ERROR in query execution: ' . mysqli_error($connect));

		?>
		<div class="alert alert-success alert-dismissable fade in centerFix">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			<strong align="center">The comment was successfully sent.</strong>
		</div>
		<?php
		mysqli_close($connect);
	}
}
?>