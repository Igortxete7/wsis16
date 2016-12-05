<html>
<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
	<title>Login</title>
	<script type="text/javascript" src="functions.js"></script>
</head>

<body>
	<br><br><br><br>
	<!-- Login egiteko orria -->
	<div id="page">
		<p id='name'>Login</p>
		<p id='sur' align="center">Use your ID or mail account.</p>
		<div id="container" name="container" align="center" style="color:red">
		</div>
		<form id="login" name="login" method="post" action="logIn.php">
			<input type="email" name="e-mail" id="e-mail" size=40 placeholder="Email" required>
			<input type="password" name="pass" id="Pass" size=40 placeholder="Password" required>
			<p><input type="checkbox"> Keep me signed in</p>
			<input type="submit" value="Login" name="submit">
			<br>
		</form>
		<p>No account? <a href='signUp.php'>Create one!</a></p>
	</div>

</body>
</html>

<?php
// Login egitean exekutatzen den kodea, xml fitxategia aztertzen du ea erabiltzailea existitzen den eta pasahitza zuzena den
if(isset($_POST["submit"])){

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
			header("Location: slotMachine.php");
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