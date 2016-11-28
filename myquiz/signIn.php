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
	div#container {
		color: red;
	}

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
				<div id="container" name="container" align="center">
				</div>
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
							<span>Forgot your password? <a href='#'>Click here</a></span>
						</div>
					</div>
				</form>
			</div>
		</div>
		<br><br><br>
	</div>
</body>
</html>

<?php

if(isset($_POST["submit"])){

	$email = $_POST['user'];
	$password = $_POST['pass'];
	$enct = sha1($password);

	if(empty($email) || empty($password)){
		?>
		<script>
		var container = document.getElementById("container");
		container.appendChild(document.createTextNode("You need to introduce your credentials."));
		container.appendChild(document.createElement("br"));
		container.appendChild(document.createElement("br"));

		</script>
		<?php
	}
	else{

		include("dataBase.php");

		$sql = "SELECT * FROM Erabiltzaile WHERE eMail = '$email' AND Password = '$enct'";
		$query = mysqli_query($connect,$sql);
		$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
		$count = mysqli_num_rows($query);

		if($count == 1){
			$_SESSION['user-email'] = $email;
			$_SESSION['user-firstname'] = $row['First Name'];
			$_SESSION['user-lastname'] =  $row['Last Names'];
			$_SESSION['auth'] = "YES";

			$date = date ("Y-m-d H:i:sa");
			$sql2 = "INSERT INTO Konexioak (User,Data)
			VALUES ('$email','$date')";
			$ema2=mysqli_query($connect, $sql2);

			if(!$ema2)
				die('ERROR in insert konnexion: ' . mysqli_error($connect));

			$sql3 = "SELECT MAX(ID) FROM Konexioak WHERE User = '$email'"; //OJO QUE LO HE CAMBIADO
			$result = mysqli_query($connect,$sql3);

			if(!$result)
				die('ERROR in insert konnexion: ' . mysqli_error($connect));

			$row = mysqli_fetch_row($result);

			$_SESSION['konex-id'] = $row[0];

			mysqli_free_result($query);
			mysqli_close($connect);
			// IKASLE ETA IRAKASLEEN KONTROLA

			header('Location: layout.php');			
		}
		else{
			?>
			<script>
			var container = document.getElementById("container");
			container.appendChild(document.createTextNode("Your account or password is incorrect."));
			container.appendChild(document.createElement("br"));
			container.appendChild(document.createElement("br"));

			</script>
			<?php
		}
	}
}
ob_end_flush();
?>