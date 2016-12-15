<?php
session_start();
include("dataBase.php");
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Select Quiz</title>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/myFunctions.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
	.centerFix {
		position: fixed;
		left: 50%;
		top: 20%;
		transform: translate(-50%, -20%);
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
					<li><a href="layout.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
					<?php
					if(isset($_SESSION["auth"])){
						?>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span> Tests <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="createTest.php"><span class="glyphicon glyphicon-book"></span> Create Test</a></li>
								<li><a href="showQuestions.php"><span class="glyphicon glyphicon-eye-open"></span> Show Questions</a></li>
								<li class="active"><a href="insertQuestion.php"><span class="glyphicon glyphicon-import"></span> Insert Questions</a></li>
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
								<li><a href="showUsersWithImage.php"><span class="glyphicon glyphicon-eye-open"></span> Show Users</a></li>
								<li><a href="getUserInfo.php"><span class="glyphicon glyphicon-search"></span> Get User Info</a></li>
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
			<h1>Select a quiz</h1>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<br>
				<?php
				include("dataBase.php");

				$ema = mysqli_query($connect, "SELECT * FROM testak");

				while($row=mysqli_fetch_array($ema, MYSQLI_ASSOC)){

					$id = $row['ID'];
					$num = 0;
					?>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail" >
							<?php 
							if(empty($row['Image'])){
								echo '<img id="myImg" src="img/default.jpg" alt="'.$row['Name'].'">';

							} else{
								echo '<img id="myImg" src="data:image/jpeg;base64,'.base64_encode( $row['Image'] ).'" alt="'.$row['Name'].'">';
							}
							?>
							<div class="caption">
								<h3><?php echo $row['Name']; ?></h3>
								<form action="fillQuiz.php" method="post">
									<input type="hidden" value="<?php echo $id; ?>" name="TestID" id="TestID">
									<button type="submit" value="Submit" class="btn btn-xlarge btn-success"><span class="glyphicon glyphicon-play"></span> PLAY!</button>
								</form>
							</div>
						</div>
					</div>
					<?php
				}
				?>
				<br><br><br><br><br><br>
			</div>
		</div>
	</div>
</body>
</html>