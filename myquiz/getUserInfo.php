<?php
session_start();
?>
<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
	<title>Get User Info</title>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
	input 	{font-size:100%;}
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
	<script type="text/javascript">

	function getInfo(){
		var dago = false;
		var xmlDoc = document.getElementById('xml-file').contentDocument;

		var mail = document.getElementById('mail').value;

		var emails = xmlDoc.getElementsByTagName('eposta');
		var firstnames = xmlDoc.getElementsByTagName('izena');
		var lastnames = xmlDoc.getElementsByTagName('abizena');
		var tlfs = xmlDoc.getElementsByTagName('telefonoa');

		for (var i = 0; i < emails.length; i++) {

			if(mail == emails[i].childNodes[0].nodeValue){
				document.getElementById('name').value = firstnames[i].childNodes[0].nodeValue;
				document.getElementById('surname').value = lastnames[i].childNodes[0].nodeValue;
				document.getElementById('tlf').value = tlfs[i].childNodes[0].nodeValue;
				dago = true;
				break;
			}
		}
		if(!dago){
			alert("The e-mail does not exist.");
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
									<li><a href="reviewingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Rewiew Questions</a></li>
									<?php
								}
							}
							
							?>
						</ul>
					</li>
					<li class="dropdown active">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Users <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="showUsersWithImage.php"><span class="glyphicon glyphicon-eye-open"></span> Show Users</a></li>
							<li class="active"><a href="getUserInfo.php"><span class="glyphicon glyphicon-search"></span> Get User Info</a></li>
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
			<h1>Get User Info</h1>
		</div>
		<div align='center'>
			<p id='sur'>Insert an user e-mail to get their personal information.</p>
			<div id="container" name="container">
			</div>
			<form>
				<input type="email" name="mail" id="mail" size=40 placeholder="Email" required><br>
				<br>
				<br>
				<input type="text" name="name" id="name" size=40 placeholder="Name" ><br>
				<p id='space'></p>
				<input type="text" name="surname" id="surname" size=40 placeholder="Surname" ><br>
				<p id='space'></p>
				<input type="text" name="tlf" id="tlf" size=40 placeholder="Telephone" ><br>
				<p id='space'></p>
				<button class="button button2" id='hover' size=40 onmousedown="changeBack(this,'gray')" onmouseup="changeBack(this,'rgb(19,122,212)')" onclick="getInfo()"> Get info </button>
			</form>
			<br>
			<br>
		</div>
	</div>
</body>
</html>