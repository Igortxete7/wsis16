<html>
<head>
	<meta charset="utf-8">
	<title>Users</title>
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
	<form action="layout.html">
			<input type="submit" value="Go back">
	</form>
	<p id='name' align='center'> Users </p>
</body>
</html>


<?php

//$connect = mysqli_connect("mysql.hostinger.es", "u218379427_igor", "isanchez127", "u218379427_quiz");
$connect = mysqli_connect("localhost", "root", "", "Quiz");

$ema = mysqli_query($connect, "SELECT * FROM Erabiltzaile");

echo '<table border=1 align="center" cellpadding="5"> <tr> <th> First name </th><th> Last Name </th> <th> e-Mail </th> <th> Telephone number </th> <th> Department </th> <th> Technologies and Tools </th> <th> Image </th> </tr>';

while($row=mysqli_fetch_array($ema, MYSQLI_ASSOC)){
	if(empty($row['Image'])){
		echo '<tr align="center"><td>'.$row['First Name'].'</td><td>'.$row['Last Names'].'</td><td>'.$row['e-Mail'].'</td><td>'.$row['Phone'].'</td><td>'.$row['Department'].'</td><td>'.$row['Tech'].'</td><td></td></tr>';
	}
	else{
		echo '<tr align="center"><td>'.$row['First Name'].'</td><td>'.$row['Last Names'].'</td><td>'.$row['e-Mail'].'</td><td>'.$row['Phone'].'</td><td>'.$row['Department'].'</td><td>'.$row['Tech'].'</td><td><img src="data:image/jpeg;base64,'.base64_encode( $row['Image'] ).'" width="100"/></td></tr>';
	}
}


echo '</table>';
mysqli_free_result($ema);
mysqli_close($connect);

?>