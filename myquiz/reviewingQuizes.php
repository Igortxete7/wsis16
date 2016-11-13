<?php
session_start();
if($_SESSION['user-email'] !== 'web000@ehu.es'){
	header("Location: layout.html");
} else {
	echo "<p align='right'style='position: absolute; top: 0px; right: 10px;'>Hello, ".$_SESSION['user-firstname']." ".$_SESSION['user-lastname']." | <a href='logOut.php'>Logout</a></p>";
}
?>
<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
	<title>Reviewing Quizes</title>
	<style>
	p#name  {font-size: 250%; text-align: center; font-weight: 100;}
	p#sur	{text-align: center;}
	input 	{font-size:100%;}
	p#space	{font-size: 10%;}
	body	{font-family: 'Roboto', sans-serif; margin: 5 100px 0 100px;}
	button 	{width:100px; height:35px; background-color: rgb(19,122,212); font-size: 100%; border:none; color:white;}
	div#container {color: red;}
	table {border-spacing: 50px 10px;}
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

	<div align='center'>
		<img src="https://auth.gfx.ms/16.000.26614.00/AppCentipede/AppCentipede_Microsoft.svg" >
		<form action="layout.html" style="position: absolute; top: 25px; left: 25px;" method="post">
			<input type="submit" value="Home">
		</form>
		<p id='name'> Reviewing Quizes </p>
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