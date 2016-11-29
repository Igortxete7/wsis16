<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
	<title>Questions</title>
	<style>
	p#name  {font-size: 250%; text-align: center; font-weight: 100;}
	body	{font-family: 'Roboto', sans-serif;}
	input   {font-size: 100%;}
	table	{border-collapse: collapse; width: 50%; }
	th		{text-align: center;padding: 8px; border-bottom: 1px solid #ddd;}
	td 		{padding: 8px; text-align: left; border-bottom: 1px solid #ddd;}
	tr:hover{background-color:#f5f5f5}

	</style>
</head>
<body>
	<p id='name' align='center'> Questions </p>
</body>
</html>


<?php

include("dataBase.php");

$ema = mysqli_query($connect, "SELECT * FROM Galderak");

echo '<table align="center" cellpadding="5"> <tr> <th> Question </th><th> Difficulty </th></tr>';

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