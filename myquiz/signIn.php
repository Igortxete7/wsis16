<?php
session_start();
ob_start();
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign in</title>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/myFunctions.js" type="text/javascript"></script>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<style>
	.btn-fb{
		color: #fff;
		background-color:#3b5998;
	}
	.btn-fb:hover{
		color: #fff;
		background-color:#496ebc 
	}
	.btn-tw{
		color: #fff;
		background-color:#55acee;
	}
	.btn-tw:hover{
		color: #fff;
		background-color:#59b5fa;
	}
	.centerFix {
		position: fixed;
		left: 50%;
		top: 20%;
		transform: translate(-50%, -20%);
	}
	</style>
</head>

<body hspace="50">
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
						<li class="active"><a href='signIn.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
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
			<h1>Login</h1>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p align="center">Use your work or school, or personal Google account.</p>
				<div class="social-buttons" align="center">
					<a href="#" class="btn btn-fb"> <i class="fa fa-facebook fa-lg" style="vertical-align: middle; padding:3px;"></i> Login with Facebook</a>
					<a href="#" class="btn btn-tw"><i class="fa fa-twitter fa-lg" style="vertical-align: middle; padding:3px;"></i> Login with Twitter</a>
				</div>
				<br>
				<form id="login" name="login" method="post" action="signIn.php">
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" name="user" id="user" class="form-control" placeholder="Enter email" required>
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" id="Pass" name="pass" placeholder="Enter password" required>
					</div>
					<div class="checkbox">
						<label><input type="checkbox"> Remember me</label>
					</div>
					<button class="btn btn-primary btn-block" size=40 type="submit" value="Submit" name="submit">Login</button>
					<br>
					<div class="col-sm-6">
						<div class="row">
							<span>No account? <a href='signUp.php'>Create one!</a></span>
						</div>
					</div>
					<div class="col-sm-6" align="right">
						<div class="row">
							<span>Forgot your password? <a href='resetPass.php'>Click here</a></span>
						</div>
					</div>
				</form>
			</div>
		</div>
		<br><br><br><br><br><br>
	</div>
</body>
</html>

<?php

include("dataBase.php");
if(isset($_POST["submit"])){

	$email = $_POST['user'];
	$password = $_POST['pass'];
	$enct = sha1($password);

	if(empty($email) || empty($password)){
		?>
		<div class="alert alert-danger alert-dismissable fade in centerFix">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			<strong align="center">You need to introduce your credentials.</strong>
		</div>
		<?php
	}
	else{

		$sql4 = "SELECT Attempts FROM erabiltzaile WHERE eMail = '$email' limit 1";
		$query2 = mysqli_query($connect,$sql4);
		$attempts = mysqli_fetch_row($query2);

		if(!$query2)
			die('ERROR in attempts konnexion: ' . mysqli_error($connect));

		if($attempts[0] <3){

			include("dataBase.php");

			$sql = "SELECT * FROM erabiltzaile WHERE eMail = '$email' AND Password = '$enct'";
			$query = mysqli_query($connect,$sql);
			$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
			$count = mysqli_num_rows($query);

			if($count == 1){
				$_SESSION['user-email'] = $email;
				$_SESSION['user-firstname'] = $row['First Name'];
				$_SESSION['user-lastname'] =  $row['Last Names'];
				$_SESSION['auth'] = "YES";

				$date = date ("Y-m-d H:i:sa");
				$sql2 = "INSERT INTO konexioak (User,Data)
				VALUES ('$email','$date')";
				$ema2=mysqli_query($connect, $sql2);

				if(!$ema2)
					die('ERROR in insert konnexion: ' . mysqli_error($connect));

			$sql3 = "SELECT MAX(ID) FROM konexioak WHERE User = '$email'"; //OJO QUE LO HE CAMBIADO
			$result = mysqli_query($connect,$sql3);

			if(!$result)
				die('ERROR in insert konnexion: ' . mysqli_error($connect));

			$row = mysqli_fetch_row($result);

			$_SESSION['konex-id'] = $row[0];

			$sql6 = "UPDATE erabiltzaile
			SET Attempts = 0
			WHERE eMail = '$email'";
			$ema4=mysqli_query($connect, $sql6);

			if(!$ema4)
				die('ERROR in update konnexion: ' . mysqli_error($connect));


			mysqli_free_result($query);
			mysqli_close($connect);
			header('Location: layout.php');		

		}else{

			// LOGIN ALDIEN KONTROLA
			if($email !== 'web000@ehu.es'){
				
				$tries = (int)$attempts[0] + 1;

				$sql5 = "UPDATE erabiltzaile
				SET Attempts = '$tries'
				WHERE eMail = '$email'";
				$ema3=mysqli_query($connect, $sql5);

				if(!$ema3)
					die('ERROR in update konnexion: ' . mysqli_error($connect));

				mysqli_close($connect);
			}

			?>
			<div class="alert alert-danger alert-dismissable fade in centerFix">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
				<strong align="center">Your account or password is incorrect.</strong>
			</div>
			<?php
		}

	} else {
		?>
		<div class="alert alert-danger alert-dismissable fade in centerFix">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			<strong align="center">Your account has been blocked for failing to login three times.</strong>
		</div>
		<?php
	}
}
}
ob_end_flush();
?>