<?php
session_start();
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Reset Password</title>
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
					<li><a href="sendComment.php"><span class="glyphicon glyphicon-comment"></span> Support</a></li>
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
			<h1>Reset Password</h1>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p align="center">Introduce your email and your new password will be sent to you.</p>
				<form id="reset" name="reset" method="post" action="resetPass.php">
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
					</div>
					<button class="btn btn-primary btn-block" type="submit" value="Submit" id="submit" name="submit">Reset password</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php
if(isset($_POST['submit'])){

	$to = $_POST['email'];
	$subject = "New password confirmation";
	$newPass = uniqid();
	$enctPass = sha1($newPass);

	$message = "
	<html>
	<head>
	<title>New password</title>
	</head>
	<body>
	<p> Your password has been reset.</p>
	<p> Use this password to login: $newPass</p>
	<br>
	<p> We suggest that you change your password as soon as you login.</p>
	<br>
	<p><a href='http://www.igortxete.hol.es'>Igortxete.hol.es</a>. </p>
	<br>
	</body>
	</html>
	";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <Quizzes@ehu.es>' . "\r\n";

	$bidalia = mail($to,$subject,$message,$headers);

	if($bidalia){

		include("dataBase.php");

		$sql = "SELECT * FROM erabiltzaile WHERE eMail = '$to'";
		$query = mysqli_query($connect,$sql);
		$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
		$count = mysqli_num_rows($query);

		if($count == 1){

			$sql2 = "UPDATE erabiltzaile
			SET Password = '$enctPass'
			WHERE eMail = '$to'";
			$ema2=mysqli_query($connect, $sql2);

			if(!$ema2)
				die('ERROR in insert konnexion: ' . mysqli_error($connect));

			?>
			<div class="alert alert-success alert-dismissable fade in centerFix">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
				<strong align="center">The email was sent to <?php echo $to; ?></strong>
			</div>
			<?php
		} else {
			?>
			<div class="alert alert-danger alert-dismissable fade in centerFix">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
				<strong align="center">The email does not exist.</strong>
			</div>
			<?php
		}

	} else {
		?>
		<div class="alert alert-danger alert-dismissable fade in centerFix">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			<strong align="center">The email could not be sent.</strong>
		</div>
		<?php
	}
}
?>