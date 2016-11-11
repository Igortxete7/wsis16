<?php
session_start();
if(isset($_SESSION['user-email'])){
  echo "<p align='right'style='position: absolute; top: 0px; right: 10px;'>Hello, ".$_SESSION['user-firstname']." ".$_SESSION['user-lastname']." | <a href='logOut.php'>Logout</a></p>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Credits Geolocation</title>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>Credits</title>
  <style>
  p#name  {font-size: 250%; text-align: center; font-weight: 100;}
  html, body  {font-family: 'Roboto', sans-serif; height:100%; padding-left: 20px;}
  img {border-radius:50px;}
  input {font-size: 100%}
  #map {height: 50%; width: 50%;}
  </style>
</head>
<body hspace="50">
  <div align='center'>
    <img src="https://auth.gfx.ms/16.000.26614.00/AppCentipede/AppCentipede_Microsoft.svg">
  </div>
  <form action="layout.html" style="position: absolute; top: 25px; left: 25px;" method="post">
    <input type="submit" value="Home">
  </form>
  <div align='center'>
    <p id='name'>Credits</p>
    <p> Eneko Ortiz de Zarate &amp; Igor Sanchez </p>
    <p> <strong>Speciality:</strong> Software Engineering.</p>
    <img width=720 src="http://media.meltybuzz.es/article-2618826-fb-f1437502963/willyrex-vegetta-wigetta-fanpics-relatos.jpg">
  </div>
  <p>User position.</p>
  <div id="map">
  </div>
  <script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.

    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 37.245, lng: -115.81448611111111},
        zoom: 15
      });
      var infoWindow = new google.maps.InfoWindow({map: map});

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        infoWindow.setPosition(pos);
        infoWindow.setContent('Location found.');
        map.setCenter(pos);
      }, function() {
        handleLocationError(true, infoWindow, map.getCenter());
      });
    } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.');
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC03sfngySO2oj9SiKiwS3YfsNPdTLCOzU&signed_in=true&callback=initMap"
async defer>
</script>
</body>
</html>
