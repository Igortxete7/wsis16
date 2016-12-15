<?php
session_start();
?>
<html>
<head>
  <title>Credits</title>
  <meta charset="utf-8">
  <title>Credits</title>
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
  img {border-radius:50px;}
  #map {height: 50%; width: 50%;}
  </style>
</head>
<body hspace="50">
  <nav class="navbar navbar-inverse" style="border-radius:0px">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="layout.php"><span class="glyphicon glyphicon-lamp"></span> Quizzes</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="layout.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
          <?php
          if(isset($_SESSION["auth"])){
            ?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-globe"></span> Questions <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="showQuestions.php"><span class="glyphicon glyphicon-eye-open"></span> Show Questions</a></li>

                <li><a href="insertQuestion.php"><span class="glyphicon glyphicon-import"></span> Insert Questions</a></li>
                <li><a href="handlingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Handle Questions</a></li>
                <?php
                if($_SESSION['user-email'] == "web000@ehu.es"){
                  ?>
                  <li><a href="reviewingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Rewiew Questions</a></li>
                  <?php
                }
                ?>
              </ul>
            </li>
            <?php
          }
          if(isset($_SESSION["auth"])){
            ?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Users <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="showUsersWithImage.php"><span class="glyphicon glyphicon-eye-open"></span> Show Users</a></li>
                <li><a href="getUserInfo.php"><span class="glyphicon glyphicon-search"></span> Get User Info</a></li>
              </ul>
            </li>
            <?php
          }
          ?>
          <li><a href="sendComment.php"><span class="glyphicon glyphicon-comment"></span> Send a comment</a></li>
          <li class="active"><a href="credits.php"><span class="glyphicon glyphicon-align-left"></span> Credits</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
          if(isset($_SESSION["auth"])){
            ?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ". $_SESSION["user-firstname"]." ". $_SESSION["user-lastname"];?><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Configuration</a></li>
                <li><a href="changePass.php"><span class="glyphicon glyphicon-transfer"></span> Change Password</a></li>
                <li><a href="logOut.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
              </ul>
            </li>
            <?php
          }else{
            ?>
            <li><a href='signIn.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
            <li><a href='signUp.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
            <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="jumbotron text-center">
      <h1>Credits</h1>
    </div>
    <div align='center'>
      <p> Eneko Ortiz de Zarate &amp; Igor Sanchez </p>
      <p> <strong>Speciality:</strong> Software Engineering.</p>
      <img width=720 src="http://media.meltybuzz.es/article-2618826-fb-f1437502963/willyrex-vegetta-wigetta-fanpics-relatos.jpg">
    </div>
    <br><br>
    <div class="row">
      <div align="center">
        <h3>User position.</h3>
        <div id="map">
        </div>
      </div>
    </div>
    <br><br>
    <script>
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
  </div>
</body>
</html>
