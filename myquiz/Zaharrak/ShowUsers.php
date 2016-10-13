<?php

//$connect = mysqli_connect("mysql.hostinger.es", "u218379427_igor", "isanchez127", "u218379427_quiz");
$connect = mysqli_connect("localhost", "root", "", "Quiz");

$ema = mysqli_query($connect, "SELECT * FROM Erabiltzaile");

echo '<h1 align="center"> Erabiltzaileak </h1>';
echo '<p></p>';
echo '<p></p>';

echo '<table border=1 align="center" cellpadding="5"> <tr> <th> First name </th><th> Last Name </th> <th> e-Mail </th> <th> Telephone number </th> <th> Department </th> <th> Technologies and Tools </th> </tr>';

while($row=mysqli_fetch_array($ema, MYSQLI_ASSOC)){
	echo '<tr><td>'.$row['First Name'].'</td><td>'.$row['Last Names'].'</td><td>'.$row['e-Mail'].'</td><td>'.$row['Phone'].'</td><td>'.$row['Department'].'</td><td>'.$row['Tech'].'</td></tr>';
}

echo '</table>';
mysqli_free_result($ema);
mysqli_close($connect);

?>