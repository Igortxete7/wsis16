<html>
<head>
	<meta charset="utf-8">
	<title>Questions</title>
	<style>
	p#name  {font-size: 250%; text-align: center; font-weight: 100;}
	body	{font-family: 'Helvetica Neue'}
	input   {font-size:100%;}
	</style>
</head>
<body>
	<div align='center'>
		<img src="https://auth.gfx.ms/16.000.26614.00/AppCentipede/AppCentipede_Microsoft.svg">
	</div>
	<form action="layout.html" style="position: absolute; top: 25px; left: 25px;">
		<input type="submit" value="Go back">
	</form>
	<p id='name' align='center'> Questions </p>
</body>
</html>


<?php

//$connect = mysqli_connect("mysql.hostinger.es", "u218379427_igor", "isanchez127", "u218379427_quiz");
$connect = mysqli_connect("localhost", "root", "", "Quiz");

$ema = mysqli_query($connect, "SELECT * FROM Galderak");

echo '<table border=1 align="center" cellpadding="5"> <tr> <th> Question </th><th> Difficulty </th></tr>';

while($row=mysqli_fetch_array($ema, MYSQLI_ASSOC)){
	if($row['Difficulty']==0){
		echo '<tr align="center"><td>'.$row['Question'].'</td><td>'."-".'</td></tr>';
	}
	else{
		echo '<tr align="center"><td>'.$row['Question'].'</td><td>'.$row['Difficulty'].'</td></tr>';
	}
}


echo '</table>';
mysqli_free_result($ema);
mysqli_close($connect);

?>