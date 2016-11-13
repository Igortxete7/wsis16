<?php
session_start();

include("dataBase.php");
include ("securityH.php");

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