<?php
session_start();
include ("securityH.php");
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Change Password</title>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/myFunctions.js"></script>
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
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-globe"></span> Questions <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="showQuestions.php"><span class="glyphicon glyphicon-eye-open"></span> Show Questions</a></li>
							<?php
							if(isset($_SESSION["auth"])){
								?>
								<li><a href="insertQuestion.php"><span class="glyphicon glyphicon-import"></span> Insert Questions</a></li>
								<li><a href="handlingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Handle Questions</a></li>
								<?php
								if($_SESSION['user-email'] == "web000@ehu.es"){
									?>
									<li><a href="#"><span class="glyphicon glyphicon-stats"></span> Rewiew Questions</a></li>
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
						<li class="dropdown active">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ". $_SESSION["user-firstname"]." ". $_SESSION["user-lastname"];?><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#"><span class="glyphicon glyphicon-cog"></span> Configuration</a></li>
								<li class="active"><a href="changePass.php"><span class="glyphicon glyphicon-transfer"></span> Change Password</a></li>
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
			<h1>Change Password</h1>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p align="center">Introduce your old and new passwords.</p>
				<form id="login" name="login" method="post" action="changePass.php" onsubmit="return passEquals()">
					<div class="form-group">
						<input type="password" name="old" id="old" class="form-control" placeholder="Enter your old password" required>
					</div>
					<br>
					<div class="form-group" id="passClass">
						<input type="password" name="pass" id="pass" class="form-control" placeholder="Enter your new password" required onchange="validateChangePass()">
					</div>
					<label id="container"></label>
					<div class="form-group" id="pass2Class">
						<input type="password" name="pass2" id="pass2" class="form-control" placeholder="Repeat your new password" required onchange="passEquals()">
					</div>
					
					<button class="btn btn-primary btn-block" type="submit" value="Submit" id="submit" name="submit">Change</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php

if(isset($_POST["submit"])){

	$old = $_POST['old'];
	$pass = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	$email = $_SESSION['user-email'];

	$encOld = sha1($old);
	$encNew = sha1($pass);

	if(empty($old) || empty($pass2) || empty($pass)){
		?>
		<div class="alert alert-danger alert-dismissable fade in centerFix">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			<strong align="center">You need to fill all boxes.</strong>
		</div>
		<?php
	}
	else{

		include("dataBase.php");

		$sql = "SELECT * FROM Erabiltzaile WHERE eMail = '$email' AND Password = '$encOld'";
		$query = mysqli_query($connect,$sql);
		$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
		$count = mysqli_num_rows($query);

		if($count == 1){

			$sql2 = "UPDATE Erabiltzaile
			SET Password = '$encNew'
			WHERE eMail = '$email'";
			$ema2=mysqli_query($connect, $sql2);

			if(!$ema2)
				die('ERROR in insert konnexion: ' . mysqli_error($connect));	

			?>
			<div class="alert alert-success alert-dismissable fade in centerFix">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
				<strong align="center">Password successfully changed!</strong>
			</div>
			<?php
		}
		mysqli_free_result($query);
		mysqli_close($connect);
	}
}
?>