<?php
session_start();
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Users</title>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
	#myImg {
		border-radius: 5px;
		cursor: pointer;
		transition: 0.3s;
	}

	#myImg:hover {opacity: 0.7;}

	/* The Modal (background) */
	.modal {
		display: none; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 1; /* Sit on top */
		padding-top: 100px; /* Location of the box */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0,0,0); /* Fallback color */
		background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
	}

	/* Modal Content (image) */
	.modal-content {
		margin: auto;
		display: block;
		width: 80%;
		max-width: 700px;
	}

	/* Caption of Modal Image */
	#caption {
		margin: auto;
		display: block;
		width: 80%;
		max-width: 700px;
		text-align: center;
		color: #ccc;
		padding: 10px 0;
		height: 150px;
	}

	/* Add Animation */
	.modal-content, #caption {    
		-webkit-animation-name: zoom;
		-webkit-animation-duration: 0.6s;
		animation-name: zoom;
		animation-duration: 0.6s;
	}

	@-webkit-keyframes zoom {
		from {-webkit-transform:scale(0)} 
		to {-webkit-transform:scale(1)}
	}

	@keyframes zoom {
		from {transform:scale(0)} 
		to {transform:scale(1)}
	}

	/* The Close Button */
	.close {
		position: absolute;
		top: 15px;
		right: 35px;
		color: #f1f1f1;
		font-size: 40px;
		font-weight: bold;
		transition: 0.3s;
	}

	.close:hover,
	.close:focus {
		color: #bbb;
		text-decoration: none;
		cursor: pointer;
	}

	/* 100% Image Width on Smaller Screens */
	@media only screen and (max-width: 700px){
		.modal-content {
			width: 100%;
		}
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
								<li class="active"><a href="showUsersWithImage.php"><span class="glyphicon glyphicon-eye-open"></span> Show Users</a></li>
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
			<h1>Users</h1>
		</div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="table-responsive">          
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Firstname</th>
								<th>Lastname</th>
								<th>Email</th>
								<th>Telephone</th>
								<th>Departament</th>
								<th>Technologies</th>
								<th>Image</th>
							</tr>
						</thead>
						<tbody>
							<?php

							include("dataBase.php");

							$ema = mysqli_query($connect, "SELECT * FROM Erabiltzaile");

							while($row=mysqli_fetch_array($ema, MYSQLI_ASSOC)){
								if(empty($row['Image'])){
									echo '<tr><td>'.$row['First Name'].'</td><td>'.$row['Last Names'].'</td><td>'.$row['eMail'].'</td><td>'.$row['Phone'].'</td><td>'.$row['Department'].'</td><td>'.$row['Tech'].'</td><td></td></tr>';
								}
								else{
									echo '<tr><td>'.$row['First Name'].'</td><td>'.$row['Last Names'].'</td><td>'.$row['eMail'].'</td><td>'.$row['Phone'].'</td><td>'.$row['Department'].'</td><td>'.$row['Tech'].'</td><td><img id="myImg" src="data:image/jpeg;base64,'.base64_encode( $row['Image'] ).'" alt="'.$row['First Name'].' '.$row['Last Names'].'" width="100"></td></tr>';
								}
							}

							echo '</table>';
							mysqli_free_result($ema);
							mysqli_close($connect);

							?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- The Modal -->
		<div id="myModal" class="modal">
			<span class="close">×</span>
			<img class="modal-content" id="img01">
			<div id="caption"></div>
		</div>
		<script>
		// Get the modal
		var modal = document.getElementById('myModal');

		// Get the image and insert it inside the modal - use its "alt" text as a caption
		var img = document.getElementById('myImg');
		var modalImg = document.getElementById("img01");
		var captionText = document.getElementById("caption");
		img.onclick = function(){
			modal.style.display = "block";
			modalImg.src = this.src;
			captionText.innerHTML = this.alt;
		}

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() { 
			modal.style.display = "none";
		}

		</script>
	</div>
</body>
</html>