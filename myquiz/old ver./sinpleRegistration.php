<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
	<title>Sinple Registration</title>
	<style type="text/css">
	body  {margin:50px;}
	</style>
</head>

<body hspace="50">
	<fieldset>
		<legend>Sartu zure email kontua</legend>
		<form action="sinpleRegistration.php" method="post">
			<br>
			<input type="text" name="email"><br>
			<input type="submit" value="Submit" name="submit"><br>
		</form>
	</fieldset>
	<br>
</body>
</html>
<?php
if(isset($_POST["submit"])){

	require_once('lib/nusoap.php'); 
	require_once('lib/class.wsdlcache.php');

	$soapclient = new nusoap_client('http://wsjiparsar.esy.es/webZerbitzuak/egiaztatuMatrikula.php?wsdl', true);

	$result = $soapclient->call('egiaztatuE',array('x'=>"$_POST[email]"));
	echo "Zure emaila matrikulatuta dago WS-tan?: ";
	echo $result;
}
?>