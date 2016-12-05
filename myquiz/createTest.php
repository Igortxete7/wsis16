<?php
session_start();
include ("security.php");
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Create Test</title>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="functions.js"></script>
	<style type="text/css">
	.centerFix {
		position: fixed;
		left: 50%;
		top: 20%;
		transform: translate(-50%, -20%);
	}
	</style>
	<script type="text/javascript">
	$(document).ready(function() {
	var max_fields      = 20; //maximum input boxes allowed
	var wrapper         = $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID
	var delete_button	= $(".remove_field_button");
	var alert = false;

	var x = 1; //initlal text box count
	$(add_button).click(function(){ //on add input button click
		//e.preventDefault();
    	if(x < max_fields){ //max input box allowed
        	x++; //text box increment
        	$(wrapper).append('<div class="form-group form-inline" id="a"><input type="text" name="question[]" id="Question" class="form-control" placeholder="Enter your question" required>&nbsp; <input type="text" name="answer[]" id="Answer" class="form-control" placeholder="Enter your answer" required>&nbsp; <select class="form-control" name="diff[]" id="Diff"><option value=""></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>'); //add input box
        } else {
        	if(!alert){
        		$("body").append('<div class="alert alert-danger alert-dismissable fade in centerFix"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong align="center">Input max field reached.</strong></div>');
        		alert = true;
        	}
        }
    });

	$(delete_button).click(function(e){ //user click on remove text
		if(x > 1){ 
			e.preventDefault(); $('#inputs div:last').remove(); x--;
			alert=false;
		}
		
	})
});
</script>
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
								<li class="active"><a href="createTest.php"><span class="glyphicon glyphicon-book"></span> Create Test</a></li>
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
			<h1>Create Test</h1>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p align="center">Specify the name and subject of the test and insert some questions. <br> If you want you can specify the difficulty.</p>
				<form id="question" name="question" method="post" action="createTest.php">
					<div class="form-group">
						<label for="name">Test name:</label>
						<input type="text" name="name" id="Name" class="form-control" placeholder="Enter test name" required onfocus="del()">
					</div>
					<div class="form-group">
						<label for="subject">Test subject:</label>
						<input type="text" name="subject" id="Subject" class="form-control" placeholder="Enter test subject" required>
					</div>
					<br>
					<div class="form-group">
						<button type="button" class="btn btn-default add_field_button"><span class="glyphicon glyphicon-plus"></span> Add question</button>
						<button type="button" class="btn btn-default remove_field_button"><span class="glyphicon glyphicon-remove"></span> Remove question</button>
					</div>
					<div class="input_fields_wrap" align="center" id="inputs">
						<div class="form-group form-inline" id="a">
							<input type="text" name="question[]" id="Question" class="form-control" placeholder="Enter your question" required>&nbsp;
							<input type="text" name="answer[]" id="Answer" class="form-control" placeholder="Enter your answer" required>&nbsp;
							<select class="form-control" name="diff[]" id="Diff">
								<option value="0"></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
						<!-- HEMEN GEHIAGO SARTU -->

					</div>
					<button class="btn btn-primary btn-block" type="submit" value="Submit" name="submit">Create test</button>
				</form>
				<br><br><br><br><br>
			</div>
		</div>
	</div>
</body>
</html>
<?php

if(isset($_POST["submit"])){

	include("dataBase.php");

	$email = $_SESSION['user-email'];
	$name = $_POST['name'];
	$subject = $_POST['subject'];
	$question = $_POST['question'][0];
	$answer = $_POST['answer'][0];
	$diff = $_POST['diff'][0];

	if(empty($name) || empty($subject) || empty($question) || empty($answer)){
		?>
		<div class="alert alert-danger alert-dismissable fade in centerFix">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			<strong align="center">You need to fill test data and at least one question.</strong>
		</div>
		<?php

	}
	else{
		//TESTA SORTU

		$sql = "INSERT INTO testak (Name, Subject, Creator) VALUES ('$name','$subject','$email')";

		if(!mysqli_query($connect, $sql))
			die('ERROR in test creation: ' . mysqli_error($connect));


		//GALDERAK GEHITU

		$ema = mysqli_query($connect, "SELECT MAX(ID) FROM testak WHERE Name = '$name' AND Subject = '$subject' AND Creator = '$email' LIMIT 1");
		$row=mysqli_fetch_row($ema);
		$TestID = $row[0];
		$empty = false;

		for($i=0; $i<count($_POST['question']); $i++){

			$unekogal = $_POST['question'][$i];
			$unekoans = $_POST['answer'][$i];
			$unekodif = $_POST['diff'][$i];

			if(empty($unekogal) || empty($unekoans)){
				$empty = true;
			}else{
				$sql2 = "INSERT INTO galderak (TestID, Question, Answer, Difficulty) VALUES ('$TestID','$unekogal','$unekoans','$unekodif')";

				if(!mysqli_query($connect, $sql2))
					die('ERROR in question insertion: ' . mysqli_error($connect));
			}
		}

		if($empty){
			?>
			<div class="alert alert-warning alert-dismissable fade in centerFix" style="top:30%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
				<strong align="center">Some questions could not be added because some fields were empty.</strong>
			</div>
			<?php
		}

		//EKINTZAK TAULARA GEHITU

		$konex = $_SESSION['konex-id'];
		$task = "Create quiz";
		$date = date ("Y-m-d H:i:sa");
		$ip = $_SERVER['REMOTE_ADDR'];

		$sql2 = "INSERT INTO Ekintzak (Konex, User, Task, Data, IP)
		VALUES ('$konex','$email','$task','$date','$ip')";

		$ema2=mysqli_query($connect, $sql2);

		if(!$ema2)
			die('ERROR in query execution: ' . mysqli_error($connect));
		?>
		<div class="alert alert-success alert-dismissable fade in centerFix">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			<strong align="center">The test was successfully created.</strong>
		</div>
		<?php
		mysqli_close($connect);
	}
}
?>