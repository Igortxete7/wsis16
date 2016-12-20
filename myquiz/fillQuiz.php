<?php
session_start();
include("dataBase.php");

if(isset($_POST['TestID'])){
	$id = $_POST['TestID'];
}else{
	header("location:layout.php");
}

include("dataBase.php");

$ema1 = mysqli_query($connect, "SELECT Name FROM testak WHERE ID = '$id' LIMIT 1");
$row=mysqli_fetch_row($ema1);
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Filling <?php echo $row[0]; ?> Quiz</title>
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
					<li class="dropdown active">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span> Quizzes <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li class="active"><a href="selectQuiz.php"><span class="glyphicon glyphicon-play"></span> Play Quizzes</a></li>
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
			<h2><?php echo $row[0]; ?></h2>
		</div>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<br>
				<form id="question" name="question" method="post" action="quizResult.php">
					<?php

					$ema = mysqli_query($connect, "SELECT * FROM Galderak WHERE TestID = '$id'");

					while($row=mysqli_fetch_array($ema, MYSQLI_ASSOC)){

						echo "<div class='form-group form-inline'>
						<span style='width:100%; padding:1.5%; border: 1px solid #cccccc; border-radius:4px;'' name='question' id='Question'>".$row['Question']."</span>
						</div>";

						echo "<div class='form-group form-inline'>
						<label for='answer'>Answer:</label>
						<input type='text' style='width:100%' name='answer[]' id='Answer' class='form-control'>
						</div> <br><br>";
						
					}

					mysqli_free_result($ema);
					mysqli_close($connect);

					?>
					<input type="hidden" value="<?php echo $id; ?>" name="TestID" id="TestID">
					<button class="btn btn-primary btn-block" type="submit" value="Submit" name="submit">Submit</button>
					
				</form>
				<br><br><br><br><br>
			</div>
		</div>
	</div>
</body>
</html>