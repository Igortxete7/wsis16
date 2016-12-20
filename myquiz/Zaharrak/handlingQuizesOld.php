<?php
session_start();
include ("security.php");
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Handling Quizes</title>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/myFunctions.js" type="text/javascript"></script>
	<script type="text/javascript">

	var activeCollapse = 0;
	xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function(){
		if (xhttp.readyState==4){
			var obj = document.getElementById('insert'); 
			obj.innerHTML = xhttp.responseText;
			$("#insert").collapse("show");
		}
	}

	function datuakEskatu(){
		if(activeCollapse !== 1){
			xhttp.open("GET",'insertQuestionHandling.php');
			xhttp.send(null);
			activeCollapse = 1;
		}else{
			$("#insert").collapse("toggle");
		}
	} 

	function datuakEskatu2(){
		if(activeCollapse !== 2){
			xhttp.open("GET",'showUserQuestionsHandling.php');
			xhttp.send(null);
			activeCollapse = 2;
		}else{
			$("#insert").collapse("toggle");
		}
	}

	function datuakEskatu3(){
		if(activeCollapse !== 3){
			xhttp.open("GET",'showQuestionsHandling.php');
			xhttp.send(null);
			activeCollapse = 3;
		}else{
			$("#insert").collapse("toggle");
		}
	} 

	xhttp1 = new XMLHttpRequest();

	function dbShowData(){
		xhttp1.onreadystatechange = function(){
			if((xhttp1.readyState==4) && (xhttp1.status==200)){
				document.getElementById("info").innerHTML=xhttp1.responseText;
			}
		}
		xhttp1.open("GET","userInfo.php");
		xhttp1.send(null);
	}


	xhttp2 = new XMLHttpRequest();

	xhttp2.onreadystatechange = function(){
		if((xhttp2.readyState==4) && (xhttp2.status==200)){
			alert(xhttp2.responseText);
			document.getElementById("info").innerHTML=xhttp2.responseText;
			$("#insert").collapse("show");
		}
	}

	function insert(){
		xhttp2.open("POST","insertQuestionHandling2.php");
		xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp2.send("question=" + document.getElementById("Question").value + "&answer=" + document.getElementById("Answer").value + "&subject=" + document.getElementById("subject").value + "&diff=" + document.getElementById("Diff").value + "$submit=Submit");
	}

	function refresh(){
		dbShowData();
		setInterval(dbShowData,5000);
	}
	</script>
</head>
<body hspace="50" onload="refresh()">
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
								<li><a href="insertQuestion.php"><span class="glyphicon glyphicon-import"></span> Insert Questions</a></li>
								<li class="active"><a href="handlingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Handle Questions</a></li>
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
			<h1>Handle Questions</h1> 
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div align="center" id="info">
				</div>
				<br>
				<div class="btn-group btn-group-justified">
					<a class="btn btn-primary" onclick="datuakEskatu3()">Show questions</a>
					<a class="btn btn-primary" onclick="datuakEskatu()">Insert questions</a>
					<a class="btn btn-primary" onclick="datuakEskatu2()">Show my questions</a>
				</div>
				<br>
				<br>
			</div>
		</div>
		<div id="insert" name="insert" class="collapse">
		</div>
	</div>
</div>
</div>
<br><br><br>
</div>
</body>
</html>