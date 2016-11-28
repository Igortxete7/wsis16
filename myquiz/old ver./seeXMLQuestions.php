<?php
session_start();

include("dataBase.php");
if($_SESSION['auth'] == "YES"){
	echo "<p align='right'style='position: absolute; top: 0px; right: 10px;'>Hello, ".$_SESSION['user-firstname']." ".$_SESSION['user-lastname']." | <a href='logOut.php'>Logout</a></p>";
}

echo '<div align="center">
<img src="https://auth.gfx.ms/16.000.26614.00/AppCentipede/AppCentipede_Microsoft.svg">
</div>
<form action="layout.html" style="position: absolute; top: 25px; left: 25px;" method="post">
<input type="submit" value="Home"/>
</form>';

$xslDoc = new DOMDocument();
$xslDoc->load("seeQuestions.xsl");

$xmlDoc = new DOMDocument();
$xmlDoc->load("galderak.xml");

$proc = new XSLTProcessor();
$proc->importStylesheet($xslDoc);

echo $proc->transformToXML($xmlDoc);
?>