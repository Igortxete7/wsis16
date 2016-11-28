<?php
session_start();

//SARRERAK KONTROLATZEKO

include("dataBase.php");

$task = "View questions";
$date = date ("Y-m-d H:i:sa");
$ip = $_SERVER['REMOTE_ADDR'];

if(isset($_SESSION['user-email'])){
	$konex = $_SESSION['konex-id'];
	$email = $_SESSION['user-email'];
}
else{
	$konex = NULL;
	$email = NULL;
}

$sql2 = "INSERT INTO Ekintzak (Konex, User, Task, Data, IP)
VALUES ('$konex','$email','$task','$date','$ip')";

$ema2=mysqli_query($connect, $sql2);

if(!$ema2)
	die('ERROR in query execution: ' . mysqli_error($connect));
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Questions</title>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
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
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-globe"></span> Questions <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li class="active"><a href="showQuestions.php"><span class="glyphicon glyphicon-eye-open"></span> Show Questions</a></li>
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
			<h1>Questions</h1>
		</div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="table-responsive">          
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Question</th>
								<th>Subject</th>
								<th>Difficulty</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$ema = mysqli_query($connect, "SELECT * FROM Galderak");

							while($row=mysqli_fetch_array($ema, MYSQLI_ASSOC)){
								if($row['Difficulty']==0){
									echo '<tr><td>'.$row['Question'].'</td><td>'.$row['Subject'].'</td><td>'."-".'</td></tr>';
								}
								else{
									echo '<tr><td>'.$row['Question'].'</td><td>'.$row['Subject'].'</td><td>'.$row['Difficulty'].'</td></tr>';
								}
							}
							mysqli_free_result($ema);
							mysqli_close($connect);

							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>