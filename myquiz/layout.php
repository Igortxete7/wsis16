<?php
session_start();
?>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Home</title>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
	body { background-color:#333; }
	#snow{
		background: none;
		font-family: Androgyne;
		background-image: url('http://www.wearewebstars.dk/codepen/img/s1.png'), url('http://www.wearewebstars.dk/codepen/img//s2.png'), url('http://www.wearewebstars.dk/codepen/img//s3.png');
		height: 100%;
		left: 0;
		position: absolute;
		top: 0;
		width: 100%;
		z-index:-1;
		-webkit-animation: snow 10s linear infinite;
		-moz-animation: snow 10s linear infinite;
		-ms-animation: snow 10s linear infinite;
		animation: snow 10s linear infinite;
	}
	@keyframes snow {
		0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
		50% {background-position: 500px 500px, 100px 200px, -100px 150px;}
		100% {background-position: 500px 1000px, 200px 400px, -100px 300px;}
	}
	@-moz-keyframes snow {
		0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
		50% {background-position: 500px 500px, 100px 200px, -100px 150px;}
		100% {background-position: 400px 1000px, 200px 400px, 100px 300px;}
	}
	@-webkit-keyframes snow {
		0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
		50% {background-position: 500px 500px, 100px 200px, -100px 150px;}
		100% {background-position: 500px 1000px, 200px 400px, -100px 300px;}
	}
	@-ms-keyframes snow {
		0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
		50% {background-position: 500px 500px, 100px 200px, -100px 150px;}
		100% {background-position: 500px 1000px, 200px 400px, -100px 300px;}
	}

	.btn-xlarge {
		padding: 18px 28px;
		font-size: 22px; //change this to your desired size
		line-height: normal;
		-webkit-border-radius: 8px;
		-moz-border-radius: 8px;
		border-radius: 8px;
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
					<li class="active"><a href="layout.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span> Quizzes <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="selectQuiz.php"><span class="glyphicon glyphicon-play"></span> Play Quizzes</a></li>
							<?php
							if(isset($_SESSION["auth"])){
								?>
								<li><a href="createTest.php"><span class="glyphicon glyphicon-book"></span> Create Quiz</a></li>
								<li><a href="insertQuestion.php"><span class="glyphicon glyphicon-import"></span> Insert Questions</a></li>
								<li><a href="showQuestions.php"><span class="glyphicon glyphicon-eye-open"></span> See All Quizzes</a></li>
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
								<li><a href="showUsersWithImage.php"><span class="glyphicon glyphicon-eye-open"></span> Show Users</a></li>
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
			<h1>Quiz: crazy questions</h1>
			<h3>Ready!</h3> 
		</div>
		<div class="progress">
			<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
				100%
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4" align="center">
				<a href="selectQuiz.php" type="button" class="btn btn-xlarge btn-success"><span class="glyphicon glyphicon-play"></span> PLAY!</a>
			</div>
		</div>
		<br><br><br><br><br><br><br>
	</div>
	<div class="navbar navbar-inverse navbar-static-bottom" style="border-radius:0px;">
		<ul class="nav navbar-nav navbar-left">
			<li><a href="credits.php"><span class="glyphicon glyphicon-sunglasses"></span> About Us</a></li>
			<li><a target="_blank" href="https://github.com/Igortxete7/wsis16/"><span class="glyphicon glyphicon-link"></span> Link Github</a></li>
			<li><a target="_blank" href="https://en.wikipedia.org/wiki/Quiz"><span class="glyphicon glyphicon-hourglass"></span> Quizzes</a></li>
		</ul>
		<div class="container">
			<p class="nav navbar-text navbar-right">© 2016 </p>
		</div>
	</div>
	<div id="snow">
	</div>
</body>
</html>
