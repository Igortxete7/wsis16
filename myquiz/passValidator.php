<?php

	require_once('lib/nusoap.php'); 
	require_once('lib/class.wsdlcache.php');

	$soapclient = new nusoap_client('http://localhost/wsis16/myquiz/egiaztatuPasahitzaZerbitzari.php?wsdl', true);

	$result = $soapclient->call('validatePass',array('pass'=>"$_POST[pass]"));
	echo $result;
?>