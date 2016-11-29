<?php

require_once('lib/nusoap.php'); 
require_once('lib/class.wsdlcache.php');

$soapclient = new nusoap_client('http://wsjiparsar.esy.es/webZerbitzuak/egiaztatuMatrikula.php?wsdl', true);

$result = $soapclient->call('egiaztatuE',array('x'=>"$_POST[email]"));
echo $result;

?>