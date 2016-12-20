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
	#userImg, #modalImg {
		border-radius: 5px;
		cursor: pointer;
		transition: 0.3s;
	}

	#myImg:hover {opacity: 0.7;}
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
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span> Quizzes <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="selectQuiz.php"><span class="glyphicon glyphicon-play"></span> Play Quizzes</a></li>
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
						<li class="dropdown active">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Users <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li class="active"><a href="users.php"><span class="glyphicon glyphicon-eye-open"></span> Show Users</a></li>
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

							$ema = mysqli_query($connect, "SELECT * FROM erabiltzaile");

							while($row=mysqli_fetch_array($ema, MYSQLI_ASSOC)){
								if(empty($row['Image'])){
									echo '<tr><td>'.$row['First Name'].'</td><td>'.$row['Last Names'].'</td><td>'.$row['eMail'].'</td><td>'.$row['Phone'].'</td><td>'.$row['Department'].'</td><td>'.$row['Tech'].'</td><td></td></tr>';
								}
								else{
									echo '<tr><td>'.$row['First Name'].'</td><td>'.$row['Last Names'].'</td><td>'.$row['eMail'].'</td><td>'.$row['Phone'].'</td><td>'.$row['Department'].'</td><td>'.$row['Tech'].'</td><td><img id="userImg" data-toggle="modal" data-target="#myModal" src="data:image/jpeg;base64,'.base64_encode( $row['Image'] ).'" alt="'.$row['First Name'].' '.$row['Last Names'].'" width="100"></td></tr>';
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
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<img id="modalImg" class="img-responsive" src="" />
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		$(document).ready(function () {
			$('#myModal').on('show.bs.modal', function (e) {
				var image = $(e.relatedTarget).attr('src');
				$(".img-responsive").attr("src", image);
			});
		});
		</script>
	</div>
</body>
</html>