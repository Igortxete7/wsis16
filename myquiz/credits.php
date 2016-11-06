<?php
session_start();
if(isset($_SESSION['user-email'])){
  echo "<p align='right'style='position: absolute; top: 0px; right: 10px;'>Hello, ".$_SESSION['user-firstname']." ".$_SESSION['user-lastname']." | <a href='logOut.php'>Logout</a></p>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
  <title>Credits</title>
  <style>
  p#name  {font-size: 250%; text-align: center; font-weight: 100;}
  body  {font-family: 'Roboto', sans-serif;}
  img {border-radius:50px;}
  input {font-size: 100%}
  </style>

  <script>
  var x = document.getElementById("alert");

  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
  }

  function showPosition(position) {
    var latlon = position.coords.latitude + "," + position.coords.longitude;

    var img_url = "https://maps.googleapis.com/maps/api/staticmap?center="
    +latlon+"&zoom=14&size=400x300&sensor=true";
    document.getElementById("mapa").innerHTML = "<img src='"+img_url+"'>";
  }

  function showError(error) {
    switch(error.code) {
      case error.PERMISSION_DENIED:
      x.innerHTML = "User denied the request for Geolocation."
      break;
      case error.POSITION_UNAVAILABLE:
      x.innerHTML = "Location information is unavailable."
      break;
      case error.TIMEOUT:
      x.innerHTML = "The request to get user location timed out."
      break;
      case error.UNKNOWN_ERROR:
      x.innerHTML = "An unknown error occurred."
      break;
    }
  }
  </script>

</head>
<body>
  <div align='center'>
    <img src="https://auth.gfx.ms/16.000.26614.00/AppCentipede/AppCentipede_Microsoft.svg">
  </div>
  <form action="layout.html" style="position: absolute; top: 25px; left: 25px;" method="post">
    <input type="submit" value="Home">
  </form>
  <div align='center'>
    <p id='name'>Credits</h1>
      <p> Eneko Ortiz de Zarate &amp; Igor Sanchez </p>
      <p> <strong>Speciality:</strong> Software Engineering.</p>
      <img width=720 src="http://media.meltybuzz.es/article-2618826-fb-f1437502963/willyrex-vegetta-wigetta-fanpics-relatos.jpg">
    </div>
    <!-- GEOLOCATION -->
    <div align="center">
      <p>Your position will be displayed below.</p>
      <button onclick="getLocation()">Try It</button>
      <br>
      <p id="alert"> </p>
      <div id="mapa"></div>
    </div>
  </body>
  </html>
