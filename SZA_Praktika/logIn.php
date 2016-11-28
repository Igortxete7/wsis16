<?php
session_start();
?>
<html>
<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
	<title>Login</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script type="text/javascript" src="functions.js"></script>
	<style>
	p#sur	{text-align: center;}
	p#space	{font-size: 10%;}
	div#container {color: red; background-color: rgba(0,0,0,0.2); margin: 5px; width: 35%; padding: 5px; display:none;}
	input   {font-size:100%;}
	select  {font-size:100%;}
	textarea   {font-size:100%;}
	</style>
</head>

<body hspace="50">
	<button style="position: absolute; top: 50px; left=50px;"> Go back </button>
	<br><br><br>
	<div align='center'>
		<p id='name'>Login</p>
		<p id='sur'>Use your ID or mail account.</p>
		<div id="container" name="container">
		</div>
		<form id="login" name="login" method="post" action="logIn.php">
			<input type="email" name="e-mail" id="e-mail" size=40 placeholder="Email" required>
			<p id='space'></p>
			<input type="password" name="pass" id="Pass" size=40 placeholder="Password" required><br>
			<p id='space'></p>
			<input type="checkbox"> Keep me signed in <br>
			<p id='space'></p>
			<button class="button button2" type="submit" value="Submit" name="submit" size=40> Sign in </button>
			<br>
		</form>
		<p>No account? <a href='signUp.php'>Create one!</a></p>
	</div>

</body>
</html>

<?php
if(isset($_POST["submit"])){

	$email = $_POST['e-mail'];
	$password = $_POST['pass'];
	$valid = false;

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
		$xml = simplexml_load_file("jokalariak.xml") or die("Error: Cannot create object");

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

		if($valid){
			header("Location: slotMachine.php"); //CAMBIAR AL MAIN ORRIA
			exit();
		} else{
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