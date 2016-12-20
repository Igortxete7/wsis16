<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="general/style.css">
	<title>Suburbs Radio</title>
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
	<p class="title">SUBURBS RADIO</p>
	<hr>
	<br>
	<div align="center">
		<!-- COPY FOR EVERY PODCAST -->
		<div class="box">
			<div class="pic" id="image" onClick="location.href='Suburbs_Radio_001.html'">
				<img class="img" src="images/artwork.jpg">
				<div class="after">
					<img id="button" src="images/button.png">
				</div>
			</div>
			<p id="link" onClick="location.href='Suburbs_Radio_001.html'"> Suburbs Radio 001 </p>
		</div>
		<!-- UNTIL HERE -->
		<div class="box">
			<div class="pic" id="image" onClick="location.href='Suburbs_Radio_002.html'">
				<img class="img" src="images/artwork.jpg">
				<div class="after">
					<img id="button" src="images/button.png">
				</div>
			</div>
			<p id="link" onClick="location.href='Suburbs_Radio_002.html'"> Suburbs Radio 001 </p>
		</div>
	</div>
	<div id="footer">
	</div>
</body>
</html>
