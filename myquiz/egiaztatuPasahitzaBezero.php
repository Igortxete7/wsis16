<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
	<title>Password validator</title>
	<style type="text/css">
	body  {margin:50px;}
	</style>
</head>

<body hspace="50">
	<fieldset>
		<legend>Sartu pasahitz bat</legend>
		<form action="egiaztatuPasahitzaBezero.php" method="post">
			<br>
			<input type="password" name="pass"><br>
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

	$soapclient = new nusoap_client('http://localhost/wsis16/myquiz/egiaztatuPasahitzaZerbitzari.php?wsdl', true);

	$result = $soapclient->call('egiaztatuE',array('x'=>"$_POST[pass]"));
	echo "Zure pasahitza ";
	echo $result;
	echo " da.";
}
?>