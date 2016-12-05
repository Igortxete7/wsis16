<html>
<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
  <link href="style.css" rel="stylesheet" type="text/css">
  <title>Sign UP</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
  <script type="text/javascript" src="functions.js"></script>
</head>
<body>
  <!-- Erregistratzeko orria -->
  <button style="position: absolute; top: 50px; left:50px;"> Go back </button>
  <br>
  <br>
  <div id="page">
    <p id='name'>Sign Up</p>
    <!-- Formularioa, datuak sartzeko -->
    <form id="erregistro" name="erregistro" onsubmit="return balioztatu()" method="post" action="signUp.php">
      First name:<font color="red">*</font><br>
      <input type="text" name="firstname" id="First name" required placeholder="Name"><br>
      <p id='space'></p>
      Last name:<font color="red">*</font><br>
      <input type="text" name="lastname" id="Last name" required placeholder="Surname"><br>
      <p id='space'></p>
      e-mail:<font color="red">*</font><br>
      <input type="text" name="email" id="e-mail" onchange="validateMail()" required placeholder="e-Mail"><br>
      <p id='space'></p>
      Password:<font color="red">*</font><br>
      <input type="password" name="password" id="Password"  required placeholder="Password"><br>
      <p id='space'></p>
      Repeat Password:<font color="red">*</font><br>
      <input type="password" name="password2" id="Password Repeat"  required placeholder="Password"><br>
      <p id='space'></p>
      Credit card number:<font color="red">*</font><br>
      <input type="text" name="credit" id="Credit Card number" required placeholder="XXXX-XXXX-XXXX"><br>
      <p id='space'></p>
      <div id="container">
      </div>
      <br>
      <input id="Submit" type="submit" name="submit" value="Submit">
      <input id="Reset" type="reset" value="Reset">
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