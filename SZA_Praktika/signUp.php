<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet"/>
  <link href="style.css" rel="stylesheet" type="text/css"/>
  <title>Sign UP</title>
  <script type="text/javascript" src="functions.js"></script>
</head>
<body>
  <!-- Erregistratzeko orria -->
  <p><button style="position: absolute; top: 50px; left:50px;" onclick="location.href='login.php'"> Go back </button></p>
  <p><br/><br/></p>
  <div id="page">
    <p id='name'>Sign Up</p>
    <!-- Formularioa, datuak sartzeko -->
    <form id="erregistro" onsubmit="return balioztatu()" method="post" action="signUp.php">
      <p>First name:<span class="star">*</span><br/></p>
      <p><input type="text" name="firstname" id="First_name" required placeholder="Name"/><br/></p>
      <p>Last name:<span class="star">*</span><br/></p>
      <p><input type="text" name="lastname" id="Last_name" required placeholder="Surname"/><br/></p>
      <p>e-mail:<span class="star">*</span><br/></p>
      <p><input type="text" name="email" id="e-mail" onchange="validateMail()" required placeholder="e-Mail"/><br/></p>
      <p>Password:<span class="star">*</span><br/></p>
      <p><input type="password" name="password" id="Password"  required placeholder="Password"/><br/></p>
      <p>Repeat Password:<span class="star">*</span><br/></p>
      <p><input type="password" name="password2" id="Password_Repeat"  required placeholder="Password"/><br/></p>
      <p>Credit card number:<span class="star">*</span><br/></p>
      <p><input type="text" name="credit" id="Credit_Card_number" required placeholder="XXXX-XXXX-XXXX"/><br/></p>
      <div id="container">
      </div>
      <p><br/></p>
      <p><input id="Submit" type="submit" name="submit" value="Submit"/><input id="Reset" type="reset" value="Reset"/></p>
    </form>
  </div>
</body>
</html>
<?php

//Submit botoia sakatzean erregistroa aurrera eramango du.
if(isset($_POST["submit"])){

  //XML FITXATEGIRA GEHITU
  //XML fitxategiko egitura jarraituz

  $file = 'jokalariak.xml';
  $xml = simplexml_load_file($file);

  $jokalaria = $xml->addChild('jokalaria');
  $jokalaria->addChild('izena', $_POST['firstname']);
  $jokalaria->addChild('abizenak', $_POST['lastname']);
  $jokalaria->addChild('mail', $_POST['email']);
  $jokalaria->addChild('pasahitza', $_POST['password']);
  $jokalaria->addChild('kredituTxartela', $_POST['credit']);
  $jokalaria->addChild('dirua', 0);
  $jokalaria->addChild('kredituak', 0);

  $xml->asXML($file);

  //Ondo sortu du erablitzailea eta mezua azalduko du.
  ?>
  <script>
  var container = document.getElementById("container");
  container.appendChild(document.createTextNode("The user was successfully created."));
  container.style.color = "green";
  container.style.width = "250px";
  </script>
  <?php
}
?>