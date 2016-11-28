<?php
session_start();
if($_SESSION['user-email'] !== 'web000@ehu.es'){
	header("Location: layout.html");
}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Reviewing Quizes</title>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
	input 	{font-size:100%;}
	p#space	{font-size: 10%;}
	button 	{width:100px; height:35px; background-color: rgb(19,122,212); font-size: 100%; border:none; color:white;}
	div#container {color: red;}
	table {border-spacing: 50px 10px; width:70%;}
	select {width: 100px;}
	.button {
		-webkit-transition-duration: 0.4s; /* Safari */
		transition-duration: 0.4s;
	}

	.button2:hover {
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
		border:solid;
		border-color:rgb(8,79,138);
	}
	</style>
	<script src="functions.js"></script>
	<!-- DIALOGS -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script>
	var changed = false;

	$( function() {
		$( "#dialog" ).dialog({
			autoOpen: false,
			autoResize: true,
			show: {
				effect: "fade",
				duration: 500
			},
			hide: {
				effect: "explode",
				duration: 500
			},
			height: 'auto',
			width: 'auto',
			modal: true,
			draggable: true,
			close: function() {
				location.reload();
			},

			buttons: { 
				"Update": function() {
					var conf = confirm("Do you really want to update?");
					if(conf){
						var form = $('#edition-menu').serialize();
						$.ajax({
							url: "editQuestion.php",
							type: "post",
							data: form,
							success: function(ans){
								if(ans === "OK"){
									alert("Successfully edited!");
									changed = true;
								} else {
									alert("The edition could not be done.");
									return false;
								}
							}
						});
					} else{
						alert("The edition could not be done.");
						return false;
					}
					$(this).dialog("close");
				},
				"Delete": function() {
					var conf = confirm("Do you really want to delete?");
					if(conf){
						var form = $('#edition-menu').serialize();
						$.ajax({
							url: "deleteQuestion.php",
							type: "post",
							data: form,
							success: function(ans){
								if(ans === "OK"){
									alert("Successfully deleted!");
									changed = true;
								} else {
									alert("The deletion could not be done.");
									return false;
								}
							}
						});
					} else{
						alert("The deletion could not be done.");
						return false;
					}
					$(this).dialog("close");
				}
			}
		});

$( ".button" ).on( "click", function() {

	var row = $(this).closest("tr");
	var id = row.find(".id").text();
	var mail = row.find(".mail").text();
	var question = row.find(".question").text();
	var answer = row.find(".answer").text();
	var difficulty = row.find(".dif").text();
	var subject = row.find(".subj").text();

	$("#idIN").val(id);
	$("#mailIN").html(mail);
	$("#emailIN").val(mail);
	$("#questionIN").val(question);
	$("#answerIN").val(answer);
	$("#subjectIN").val(subject);
	$("#difficultyIN").val(difficulty);

	$( "#dialog" ).dialog( "open" );
});
});
</script>
</head>

<body hspace="50">
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
							<li><a href="showQuestions.php"><span class="glyphicon glyphicon-eye-open"></span> Show Questions</a></li>
							<?php
							if(isset($_SESSION["auth"])){
								?>
								<li><a href="insertQuestion.php"><span class="glyphicon glyphicon-import"></span> Insert Questions</a></li>
								<li><a href="handlingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Handle Questions</a></li>
								<?php
								if($_SESSION['user-email'] == "web000@ehu.es"){
									?>
									<li class="active"><a href="reviewingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Rewiew Questions</a></li>
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
			<h1>Review Questions</h1> 
		</div>
		<!-- AGERTZEN DEN MENUA -->
		<div id="dialog" title="Edition Menu">
			<form id="edition-menu">
				Student: <span id="mailIN"></span><br>
				<input type="hidden" name="emailIN" id="emailIN">
				<input type="hidden" name="idIN" id="idIN">
				<table border=0 align="center">
					<tr>
						<th></th>
					</tr>
					<tr>
						<td>Question:</td>
					</tr>
					<tr>
						<td><input type="text" name="questionIN" id="questionIN" size=40 placeholder="Question"></td>
					</tr>
					<tr>
						<td>Answer:</td>
					</tr>
					<tr>
						<td><input type="text" name="answerIN" id="answerIN" size=40 placeholder="Answer"></td>

					</tr>
					<tr>
						<td>Subject:</td>
					</tr>
					<tr>
						<td><input type="text" name="subjectIN" id="subjectIN" size=40 placeholder="Subject"></td>
					</tr>
					<tr>
						<td>Difficulty:
							<select name="difficultyIN" id="difficultyIN">
								<option value="0"> - </option>
								<option value="1"> 1 </option>
								<option value="2"> 2 </option>
								<option value="3"> 3 </option>
								<option value="4"> 4 </option>
								<option value="5"> 5 </option>
							</select>
						</td>
					</tr>
				</table>
			</form>

		</div>

	</body>
	</html>

	<?php
	include("dataBase.php");

	$ema = mysqli_query($connect, "SELECT * FROM Galderak");

	echo '<table align="center" cellpadding="5" > <tr> <th> E-mail </th><th> Question </th><th> Answer </th><th> Difficulty </th><th> Subject </th><th> Configuration </th></tr>';

	while($row=mysqli_fetch_array($ema, MYSQLI_ASSOC)){
		if($row['Difficulty']==0){
			echo '<tr><td style="display:none;" class="id">'.$row['ID'].'</td><td align="left" class="mail">'.$row['eMail'].'</td><td align="left" class="question">'.$row['Question'].'</td><td align="left" class="answer">'.$row['Answer'].'</td><td align="center" class="dif">'."-".'</td><td align="left" class="subj">'.$row['Subject'].'</td><td align="center"><button class="button button2" type="submit" value="Submit" name="submit" size=40 > Edit </button></td></tr>';
		}
		else{
			echo '<tr><td style="display:none;" class="id">'.$row['ID'].'</td><td align="left" class="mail">'.$row['eMail'].'</td><td align="left" class="question">'.$row['Question'].'</td><td align="left" class="answer">'.$row['Answer'].'</td><td align="center" class="dif">'.$row['Difficulty'].'</td><td align="left" class="subj">'.$row['Subject'].'</td><td align="center"><button class="button button2" type="submit" value="Submit" name="submit" size=40 > Edit </button></td></tr>';


		}
	}


	echo '</table>';
	mysqli_free_result($ema);
	mysqli_close($connect);

	?>