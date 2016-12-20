<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="general/style.css">
	<title>Actuaciones</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript">

	$(document).ready(function(){
		$("#footer").load("general/footer.html");
		$("#menu").load("general/menu.html");

	});
	</script>
</head>

<body background="images/stressed_linen.png">

	<div id="menu">
	</div>
	<br>
	<br>
	<p class="title">ACTUACIONES</p>
	<hr>
	<br>
	<br>
	<div class="right">
		<div align="center">
			<img src="images/world.png">
			<p> ¿DÓNDE TE GUSTARÍA QUE FUERAMOS? </p>
			<br>
			<a href="https://twitter.com/intent/tweet?button_hashtag=TheStrangersInMyTown" class="twitter-hashtag-button" data-size="large" data-lang="es" data-show-count="true">TWEET</a>
			<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div>
	</div>

	<p class="title" align="center">PRÓXIMAMENTE</p>
	<p class="title" align="center">...</p>


	<?php

	include("dataBase.php");

	$ema = mysqli_query($connect, "SELECT * FROM Actuaciones");

	echo '<table class="dates" align="left"> ';

	while($row=mysqli_fetch_array($ema, MYSQLI_ASSOC)){

		echo '<tr>
		<td id="date">
		<span id="day">'.$row['Day'].'</span>
		<br>
		<span id="month">'.$row['Month'].'</span>
		</td>
		<td id="name">
		<span>'.utf8_decode($row['Place']).'</span>
		<br>
		<span id="city">'.utf8_decode($row['City']).'</span>
		</td>
		<td id="info">MÁS INFO</td>
		</tr>';

	}

	echo '</table>';
	?>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	
	<div id="footer">
	</div>
</body>
</html>


