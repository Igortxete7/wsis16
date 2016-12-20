<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<link href="style.css" rel="stylesheet" type="text/css"/>
	<link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet"/>
	<title>Login</title>
	<script type="text/javascript" src="functions.js"></script>
</head>

<body>
	<p><br/><br/><br/><br/></p>
	<!-- Login egiteko orria -->
	<div id="page">
		<p id="name">Login</p>
		<p id="sur">Use your ID or mail account.</p>
		<div id="container" style="color:red">
		</div>
		<form id="login" method="post" action="logIn.php">
			<p><input type="email" name="e-mail" id="e-mail" placeholder="Email" required/></p>
			<p><input type="password" name="pass" id="Pass" placeholder="Password" required/></p>
			<p><input type="checkbox"/> Keep me signed in</p>
			<p><input type="submit" value="Login" name="submit"/></p>
			<p><br/></p>
		</form>
		<p>No account? <a href='signUp.php'>Create one!</a></p>
	</div>
</body>
</html>

<?php
// Login egitean exekutatzen den kodea, xml fitxategia aztertzen du ea erabiltzailea existitzen den eta pasahitza zuzena den
if(isset($_POST["submit"])){

	session_start();

	$email = $_POST['e-mail'];
	$password = $_POST['pass'];
	$valid = false;

	//Hutsik badaude errorea azaldu
	if(empty($email) || empty($password)){
		?>
		<script>
		var container = document.getElementById("container");
		container.style.display = "block";
		container.appendChild(document.createTextNode("You need to introduce your credentials."));
		container.appendChild(document.createElement("br"));

		</script>
		<?php
	}
	else{
		//Bestela XML fitxategia aztertu

		$xml = simplexml_load_file("jokalariak.xml") or die("Error: Cannot create object");

		//Fitxategiko sarrera bakoitzeko bilatu. Zuzena bada, sesioko aldagaian gorde eta irten.
		foreach($xml->children() as $jokalaria) { 
			$unekoMail = $jokalaria->mail;
			$unekoPass = $jokalaria->pasahitza;
			$unekoCash = $jokalaria->dirua;
			$unekoCoins = $jokalaria->kredituak;


			if((strcmp($email, $unekoMail) == 0)&&(strcmp($password, $unekoPass) == 0)){
				$_SESSION["user"] = (string)$unekoMail;
				$_SESSION["cash"] = (int)$unekoCash;
				$_SESSION["coins"] = (int)$unekoCoins;
				$_SESSION["user-firstname"] = (string) $jokalaria->izena;
				$_SESSION["user-lastname"] = (string) $jokalaria->abizenak;
				$valid = true;
				break;
			}
		}

		//Erabiltzailea aurkitu badu, orri nagusira bideratzen du erabiltzailea.
		if($valid){
			header("Location: Casino.html");
			exit();
		} else{
			//Bestela beste errore mezu hau azalduko da.
			?>
			<script>
			var container = document.getElementById("container");
			container.style.display = "block";
			container.appendChild(document.createTextNode("Your account or password is incorrect."));
			container.appendChild(document.createElement("br"));
			</script>
			<?php
		}
	}
}
?>