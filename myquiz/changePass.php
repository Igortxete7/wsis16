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
	<style>
	input 	{font-size:100%;}
	p#space	{font-size: 10%;}
	button 	{width:400px; height:35px; background-color: rgb(19,122,212); font-size: 100%; border:none; color:white;}
	div#container {color: red;}

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
	<script>
	function equals() {

		if(document.getElementById("pass").value!=""){
			if(document.getElementById("pass").value.length >5){
				if (document.getElementById("pass").value !== document.getElementById("pass2").value){
					alert("The passwords are NOT equal.");
					document.getElementById("pass").value = "";
					document.getElementById("pass2").value = "";
					return false;
				}
			}else{
				alert("New password is too short!");
				document.getElementById("pass").value = "";
				document.getElementById("pass2").value = "";
				return false;
			}
			
		}
	}
	</script>
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
		<div align='center'>
			<p id='sur'>Introduce your old and new passwords.</p>
			<div id="container" name="container">
			</div>
			<form id="login" name="login" method="post" action="changePass.php" onsubmit="return equals()">
				<input type="password" name="old" id="old" size=40 placeholder="Old password" required>
				<p id='space'></p>
				<input type="password" name="pass" id="pass" size=40 placeholder="New password" required><br>
				<p id='space'></p>
				<input type="password" name="pass2" id="pass2" size=40 placeholder="Repeat" required onchange="equals()"><br>
				<p id='space'></p>
				<button class="button button2" id='hover' type="submit" value="Submit" name="submit" size=40> Change </button>
				<br>
				<br>
			</form>
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
		<script>
		var container = document.getElementById("container");
		container.appendChild(document.createTextNode("You need to fill all boxes."));
		container.appendChild(document.createElement("br"));
		container.appendChild(document.createElement("br"));

		</script>
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
			<script>
			var container = document.getElementById("container");
			container.style.color = "green";
			container.appendChild(document.createTextNode("Password changed!"));
			container.appendChild(document.createElement("br"));
			container.appendChild(document.createElement("br"));

			</script>
			<?php
		}
		mysqli_free_result($query);
		mysqli_close($connect);
	}
}
?>