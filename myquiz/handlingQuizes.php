<?php 
session_start(); 
include('security.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Handle your quizes and questions</title>
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<style>
	#count {
		margin-bottom: 12px;
		font-size: 110%;
	}
	#showquestions {
		margin-bottom: 5px;
	}
	.form-php{
		color: green;
	}
	.form-control, #create-quiz {
		border: 1px solid #000;
	}
	.form-group, #create-quiz {
		margin-bottom: 7px;
	}
	#difficulties{
		margin-bottom: 7px;
	}
	a#testname:hover, a#testname:active, a#testname:link, a#testname:visited {
		text-decoration: none;
	}

	.centerFix {
		position: fixed;
		left: 50%;
		top: 20%;
		transform: translate(-50%, -20%);
	}
	</style>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	function addQuestion(){
		$('#showquestions').removeClass('active');
		//$('#div-showquestions').css('display','none');
		$('#div-showquestions').collapse("hide");
		//if($('#div-addquestion').css('display') == 'none'){
			if($('#div-addquestion').is(":hidden")){
				$('#addquestion').addClass('active');
				$('#addquestion').blur();
			//$('#div-addquestion').css('display','block');
			$('#div-addquestion').collapse("show");
			$('#div-php').empty();
			//$('#div-php').css('display','block');
			$('#div-php').collapse("show");
			$('#div-addquestion').load("handlingQuizes-insertQuestion.php");
		//} else if($('#div-addquestion').css('display') == 'block'){
		} else if ($('#div-addquestion').is(":visible")){
			$('#addquestion').removeClass('active');
			$('#addquestion').blur();
			//$('#div-addquestion').css('display','none');
			$('#div-addquestion').collapse("hide");
			//$("#div-php").css('display','none');
			$('#div-php').collapse("hide");
			$("#div-php").empty();
		}
	}
	function showQuestions(){
		$('#addquestion').removeClass('active');
		//$("#div-addquestion").css('display','none');
		$('#div-addquestion').collapse("hide");
		//$("#div-php").css('display','none');
		$('#div-php').collapse("hide");
		$("#div-php").empty();
		//if($('#div-showquestions').css('display') == 'none'){
			if($('#div-showquestions').is(":hidden")){
				$('#showquestions').addClass('active');
				$('#showquestions').blur();
			//$('#div-showquestions').css('display','block');
			$('#div-showquestions').collapse("show");
			$('#div-showquestions').load("handlingQuizes-showMyQuestions.php");
		//} else if($('#div-showquestions').css('display') == 'block'){
		} else if ($('#div-showquestions').is(":visible")){
			$('#showquestions').removeClass('active');
			$('#showquestions').blur();
			//$('#div-showquestions').css('display','none');
			$('#div-showquestions').collapse("hide");
		}
	}
	function submitForm(){
		var test = $("#tests option:selected").text();
		var question = $("#question").val();
		var answer = $("#answer").val();
		var diff = document.getElementsByName("difficulty");
		if(question !== "" && answer !== ""){
			$("#div-php").html("...");
			var difficulty="";
			for(var i=0;i<5;i++){
				if(diff[i].checked){
					difficulty = diff[i].value;
				}
			}
			$.post(
				"handlingQuizes-insertPHP.php",
				{
					test: test,
					question: question,
					answer: answer,
					difficulty: difficulty
				},
				function(result){
					$('#div-php').html(result);
				}
				);
		} else{
			var content = '<div class="alert alert-danger alert-dismissable fade in centerFix"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong align="center">You need to fill question and answer fields.</strong></div>';
			$("#div-php").html(content);
		}
	}
	window.onload = function(){load();};
	function refresh(){
		$("#questioncount").load("handlingQuizes-questionCount.php");
	}
	function load(){
		refresh();
		setInterval(refresh,5000);
	}
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
					<li class="dropdown active">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span> Quizzes <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="selectQuiz.php"><span class="glyphicon glyphicon-play"></span> Play Quizzes</a></li>
							<?php
							if(isset($_SESSION["auth"])){
								?>
								<li><a href="createTest.php"><span class="glyphicon glyphicon-book"></span> Create Quiz</a></li>
								<li><a href="insertQuestion.php"><span class="glyphicon glyphicon-import"></span> Insert Questions</a></li>
								<li><a href="questions.php"><span class="glyphicon glyphicon-eye-open"></span> See All Quizzes</a></li>
								<li class="active"><a href="handlingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Handle Quizzes</a></li>
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
	<div class="container" style="text-align: center">
		<div class="jumbotron text-center" style="margin-bottom: 12px">
			<h1>Handle quizes and questions</h1>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div id="count">
					My questions/Total questions : <span id="questioncount"></span>
				</div>
				<input class="btn btn-primary btn-block" type="button" id="addquestion" name="addquestion" value="Add question" onclick="addQuestion()">
				<input class="btn btn-primary btn-block" type="button" id="showquestions" name="showquestions" value="Show my questions" onclick="showQuestions()">
				<br>
				<div class="form-group collapse" id="div-addquestion"></div><!-- style="display:none" -->
				<div class="form-php collapse" id="div-php"></div>
				<div class="form-group collapse" id="div-showquestions"></div>
			</div>
		</div>
	</div>
</body>
</html>