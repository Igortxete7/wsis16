<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
	<title>Get user information</title>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript">
	function getInfo(){
		$.ajax({
			url: "getUser.php",
			type: "post",
			data: { email: $('#email').val() },
			dataType: "xml",
			success: function(xml){
				if($(xml).find('erabiltzailea').text() == "" && $('#email').val() !=""){
					$('#email').css("border-color","#cc0000");
					$('#firstname').val("");
					$('#lastname').val("");
					$('#phone').val("");
				} else{
					$('#email').css("border-color","#000");
					var firstname = $(xml).find('firstname').text();
					var lastname = $(xml).find('lastname').text();
					var phone = $(xml).find('phone').text();
					$('#firstname').val(firstname);
					$('#lastname').val(lastname);
					$('#phone').val(phone);
				}
			}
		});
	}
	</script>
</head>
<body>
	<nav class="navbar navbar-inverse" style="border-radius:0px">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="layout.php"><span class="glyphicon glyphicon-lamp"></span> Quizzes</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="layout.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
					<?php
					if(isset($_SESSION["auth"])){
						?>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span> Quizzes <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="createTest.php"><span class="glyphicon glyphicon-book"></span> Create Quiz</a></li>
								<li><a href="showQuestions.php"><span class="glyphicon glyphicon-eye-open"></span> Show Questions</a></li>
								<li><a href="insertQuestion.php"><span class="glyphicon glyphicon-import"></span> Insert Questions</a></li>
								<li><a href="handlingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Handle Questions</a></li>
								<?php
								if($_SESSION['user-email'] == "web000@ehu.es"){
									?>
									<li><a href="reviewingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Rewiew Questions</a></li>
									<?php
								}
								?>
							</ul>
						</li>
						<?php
					}
					if(isset($_SESSION["auth"])){
						?>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Users <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<?php
								if($_SESSION['user-email'] == "web000@ehu.es"){
									?>
									<li><a href="showUsersWithImage.php"><span class="glyphicon glyphicon-eye-open"></span> Show Users</a></li>
									<?php
								}
								?>
								<li class="active"><a href="getUserInfo.php"><span class="glyphicon glyphicon-search"></span> Get User Info</a></li>
							</ul>
						</li>
						<?php
					}
					?>
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
			<h1>Get user information</h1>
		</div>
		<div class="row">
			
			<div class="col-md-4 col-md-offset-1">
				<p align="center">Insert a user's e-mail to get their personal information.</p>
				<form> 
					<label for="email">E-mail:</label>
					<div class="form-group">
						<input class="form-control" type="email" name="email" id="email" required autocomplete="off">
					</div>
					<br>
					<input class="btn btn-primary btn-block" type="button" value="Get info" onClick="javascript:getInfo()">
				</form>
			</div>
			<div class="col-md-4 col-md-offset-2">
				<div class="form-group">
					<label for="email">First name:</label>
					<input type="text" class="form-control" name="firstname" id="firstname" readonly>
				</div>
				<div class="form-group">
					<label for="email">Last name:</label>
					<input type="text" class="form-control" name="lastname" id="lastname" readonly>
				</div>
				<div class="form-group">
					<label for="email">Telephone:</label>
					<input type="text" class="form-control" name="phone" id="phone" readonly>
				</div>
			</div>
		</div>
	</div>
</body>
</html>