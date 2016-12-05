<?php
include('dataBase.php');
$email = mysqli_real_escape_string($connect,$_POST['email']);
$sql = "SELECT * FROM erabiltzaile WHERE eMail='$email'";
$query = mysqli_query($connect,$sql);
$user = mysqli_fetch_array($query,MYSQLI_ASSOC);
$xml = new SimpleXMLElement("<erabiltzailea></erabiltzailea>");
$xml->addChild("email",$user['eMail']);
$xml->addChild("firstname",$user['First Name']);
$xml->addChild("lastname",$user['Last Names']);
$xml->addChild("phone",$user['Phone']);
echo $xml->asXML();
mysqli_close($connect);
?>