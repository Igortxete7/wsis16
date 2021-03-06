<?php
//XML fitxategia eguneratzeko erabiltzen den PHP-a
session_start();
$file = 'jokalariak.xml';
$xml = simplexml_load_file($file);
$mail = $_POST['user'];

//Kredituak erosteko baldin bada...
//1$ = 4 kreditu bidalitako aldagaiekin trukea egin eta bidali bueltan.
if(isset($_POST['coinsToBuy'])){

	$cash = $_POST['coinsToBuy'];

	foreach($xml->children() as $jokalaria) { 
		$unekoMail = (string)$jokalaria->mail;
		$unekoCoins = (int)$jokalaria->kredituak;
		$unekoCash = (int)$jokalaria->dirua;

		if(strcmp($mail, $unekoMail) == 0){
			$jokalaria->dirua = $unekoCash - $cash;
			$jokalaria->kredituak = $unekoCoins + $cash*4;
			$_SESSION["coins"] = $unekoCoins + $cash*4;
			$_SESSION["cash"] = $unekoCash - $cash;
			break;
		}
	}
	echo "BOUGHT ";
	echo"$_SESSION[cash] ";
	echo"$_SESSION[coins] ";

//Kredituak diruaren truke emateko...
//4 kreditu = 1$ bidalitako aldagaiekin trukea egin eta bidali bueltan.
}else if(isset($_POST['coinsToExchange'])){

	$exchange = $_POST['coinsToExchange'];

	foreach($xml->children() as $jokalaria) { 
		$unekoMail = (string)$jokalaria->mail;
		$unekoCoins = (int)$jokalaria->kredituak;
		$unekoCash = (float)$jokalaria->dirua;

		if(strcmp($mail, $unekoMail) == 0){
			$jokalaria->dirua = $unekoCash + $exchange/4;
			$jokalaria->kredituak = $unekoCoins - $exchange;
			$_SESSION["coins"] = $unekoCoins - $exchange;
			$_SESSION["cash"] = $unekoCash + $exchange/4;
			break;
		}
	}
	echo "EXCHANGED ";
	echo"$_SESSION[cash] ";
	echo"$_SESSION[coins] ";

//Kredituak kendu edo gordetzeko...
}else{

	$coins = $_POST['coins'];
	if($coins == 1)
		$coins = 0;

	foreach($xml->children() as $jokalaria) { 
		$unekoMail = (string)$jokalaria->mail;
		$unekoCoins = (int)$jokalaria->kredituak;

		if(strcmp($mail, $unekoMail) == 0){
			$jokalaria->kredituak = $unekoCoins + $coins;
			$_SESSION["coins"] = $unekoCoins + $coins;
			break;
		}
	}
	echo "OK ";
	echo"$_SESSION[coins]";
}
$xml->asXML($file);
?>