<?php
session_start();
include ("security.php");
include("dataBase.php");
$email = $_SESSION['user-email'];

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
	<title>Reviewing <?php echo $row[0]; ?> Quiz</title>
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
			<h2><?php echo $row[0]; ?> Results</h2>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<br>
				<form action="layout.php">
					<?php
					if(isset($_POST["submit"])){

						$ema = mysqli_query($connect, "SELECT * FROM Galderak WHERE TestID = '$id'");

						//GALDERAK KONPROBATU

						for($i=0; $i<count($_POST['answer']); $i++){

							$unekoans = $_POST['answer'][$i];

							$row=mysqli_fetch_array($ema, MYSQLI_ASSOC);

							echo "<div class='form-group form-inline'>
							<label for='question' style='width:12%'>Question: </label>
							<span style='width:87%; padding:1.5%; border: 1px solid #cccccc; border-radius:4px;'' name='question' id='Question'>".$row['Question']."</span>
							</div>";

							if(strcasecmp($unekoans, $row['Answer']) == 0){
								//ONDOO
								?>
								<div class="form-group has-success has-feedback form-inline">
									<label class="control-label" style='width:12%' for="inputSuccess">Correct:</label>
									<input type="text" style='width:87%' class="form-control" value="<?php echo $unekoans; ?>">
								</div><br>

								<?php
							} else {
								//GAIZKII
								?>
								<div class="form-group has-error has-feedback form-inline">
									<label class="control-label" style='width:12%' for="inputError">Wrong:</label>
									<input type="text" style='width:87%' class="form-control" value="<?php echo $unekoans; ?>">
								</div><br>
								<?php
							}
						}
						mysqli_free_result($ema);
						mysqli_close($connect);
					}
					?>
					<button class="btn btn-primary btn-block" type="submit">Finish</button>

				</form>
				<br><br><br><br><br>
			</div>
		</div>
	</div>
</body>
</html>