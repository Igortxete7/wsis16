<?php
//nusoap.php klasea gehitzen dugu 
require_once('lib/nusoap.php'); 
require_once('lib/class.wsdlcache.php');

//soap_server motako objektua sortzen dugu 
$ns="http://localhost/wsis16/myquiz/egiaztatuPasahitzaZerbitzari.php"; //ALDATU BEHAR DA HOSTINGERREN

//soap_server motako objektua sortzen dugu
$server = new soap_server;
$server->configureWSDL('validatePass',$ns); 
$server->wsdl->schemaTargetNamespace=$ns;

//inplementatu nahi dugun funtzioa erregistratzen dugu 
//funtzio bat baino gehiago erregistra liteke ... 
$server->register('validatePass',
	array('pass'=>'xsd:string'), 
	array('z'=>'xsd:string'),
	$ns);

//funtzioa inplementatzen da
function validatePass($pass){

	$file = file_get_contents("toppasswords.txt");

	if (!strpos($file, $pass)) {
		return "BALIOZKOA";
	} else {
		return "BALIOGABEA";
	}
}

//nusoap klaseko sevice metodoari dei egiten diogu
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>