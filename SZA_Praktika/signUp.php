<html>
<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
  <link href="style.css" rel="stylesheet" type="text/css">
  <title>Sign UP</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
  <script type="text/javascript" src="functions.js"></script>
  <style>
  body {color: black; margin-left: 200px; margin-right: 200px; font-family: 'Roboto', sans-serif;}
  fieldset {background-color: rgba(255,255,255,0.2); border:none; padding: 10px;}
  input   {font-size:100%;}
  select  {font-size:100%;}
  textarea   {font-size:100%;}
  button#submit, #reset {width: 200px;}
  </style>
  <script type="text/javascript" src="functions.js"></script>
</head>
<body hspace="50">
  <button style="position: absolute; top: 50px; left:50px;"> Go back </button>
  <br>
  <br>
  <p id='name'><b>Sign Up</b></p>
  <form id="erregistro" name="erregistro" onsubmit="return balioztatu()" method="post" action="signUp.php">
    <fieldset>
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
      <button class="button button2" id="Submit" type="submit" name="submit" value="Submit">Submit</button>
      <button class="button button2" id="Reset" type="reset" value="Reset">Reset</button>
      
    </fieldset>
  </form>
</body>
</html>
<?php

if(isset($_POST["submit"])){


  //XML FITXATEGIRA GEHITU

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
