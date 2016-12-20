<?php
session_start();
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Sign Up</title>
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/myFunctions.js" type="text/javascript"></script>

  <!--Irudiak ikusteko-->
  <link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <script src="js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
  <script src="js/plugins/sortable.min.js" type="text/javascript"></script>
  <script src="js/fileinput.min.js"></script>


  <style>
  .kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
  }
  .kv-avatar .file-input {
    display: table-cell;
    max-width: 220px;
  }

  .fixed {
    position: fixed;
    top: 25;
    right: 25;
  }

  .centerFix {
    position: fixed;
    left: 50%;
    top: 20%;
    transform: translate(-50%, -20%);
  }

  </style>
</head>
<body>
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
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span> Quizzes <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="selectQuiz.php"><span class="glyphicon glyphicon-play"></span> Play Quizzes</a></li>
              <?php
              if(isset($_SESSION["auth"])){
                ?>
                <li><a href="createTest.php"><span class="glyphicon glyphicon-book"></span> Create Quiz</a></li>
                <li><a href="insertQuestion.php"><span class="glyphicon glyphicon-import"></span> Insert Questions</a></li>
                <li><a href="questions.php"><span class="glyphicon glyphicon-eye-open"></span> See All Quizzes</a></li>
                <li><a href="handlingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Handle Quizzes</a></li>
                <?php
                if($_SESSION['user-email'] == "web000@ehu.es"){
                  ?>
                  <li><a href="reviewingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Rewiew Quizzes</a></li>
                  <?php
                }
              }
              ?>
            </ul>
          </li>
          <?php
          if(isset($_SESSION["auth"])){
            ?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Users <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="users.php"><span class="glyphicon glyphicon-eye-open"></span> Show Users</a></li>
                <li><a href="getUserInfo.php"><span class="glyphicon glyphicon-search"></span> Get User Info</a></li>
              </ul>
            </li>
            <?php
          }
          ?>
          <li><a href="sendComment.php"><span class="glyphicon glyphicon-comment"></span> Support</a></li>
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
            <li class="active"><a href='signUp.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
            <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="jumbotron text-center">
      <h1>Sign Up</h1>
    </div>
    <div class="row">
      <div id="kv-avatar-errors-1" align="center" class="center-block" style="width:800px;display:none"></div>
      <form id="erregistro" name="erregistro" method="post" action="signUp.php" enctype="multipart/form-data" onSubmit="return balioztatu()">
        <div class="col-sm-4 col-sm-offset-3 col-sm-push-5">
          <div class="form-group">
            <div class="kv-avatar" align="center" style="width:200px">
              <label>Picture:</label>
              <input id="avatar-1" name="avatar-1" type="file" class="file-loading">
            </div>
            <script>
            $("#avatar-1").fileinput({
              overwriteInitial: true,
              maxFileSize: 1500,
              showClose: false,
              showCaption: false,
              browseLabel: '',
              removeLabel: '',
              browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
              removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
              removeTitle: 'Cancel or reset changes',
              elErrorContainer: '#kv-avatar-errors-1',
              msgErrorClass: 'alert alert-block alert-danger',
              defaultPreviewContent: '<img src="img/default_avatar_male.jpg" id="PREVIEW" alt="Your Avatar" style="width:160px">',
              layoutTemplates: {main2: '{preview} {remove} {browse}'},
              allowedFileExtensions: ["jpg", "png", "gif"]
            });
            </script>
          </div>
        </div>
        <div class="col-sm-4 col-sm-offset-1 col-sm-pull-7">
          <div class="form-group">
            <label for="firstname">First Name:<font color="red">*</font></label>
            <input type="text" name="firstname" id="First name" class="form-control" placeholder="Enter your first name" required onfocus="removeGlyph('glyphicon8')">
          </div>
          <div class="form-group">
            <label for="lastname">Last Name:<font color="red">*</font></label>
            <input type="text" name="lastname" id="Last name" class="form-control" placeholder="Enter your last name" required onfocus="removeGlyph('glyphicon9')">
          </div>
          <div class="form-group" id="mailGroup">
            <label for="email">Email:<font color="red">*</font></label>
            <input type="email" name="email" id="e-mail" class="form-control" placeholder="Enter your email" required onchange="validate()">
            <span id="container"></span>
          </div>
          <div class="form-group" id="codeGroup">
            <label for="code">Subscription Code:<font color="red">*</font></label>
            <input type="text" name="code" id="Code" class="form-control" placeholder="Enter your subscription code" required onchange="validatePass()">
            <span id="container2"></span>
          </div>
          <div class="form-group" id="pass1Group">
            <label for="password">Password:<font color="red">*</font></label>
            <input type="password" name="password" id="Password" class="form-control" placeholder="Enter your password" required onchange="validatePass()">
            <span id="container3"></span>
          </div>
          <div class="form-group" id="pass2Group">
            <label for="password2">Repeat Password:<font color="red">*</font></label>
            <input type="password" name="password2" id="Password2" class="form-control" placeholder="Repeat your password" required onchange="validatePass()">
            <span id="container4"></span>
          </div>
          <div class="form-group">
            <label for="phonenumber">Telephone Number:<font color="red">*</font></label>
            <input type="text" name="phonenumber" id="Telephone number" class="form-control" placeholder="Enter your telephone number" required onfocus="removeGlyph('glyphicon14')">
          </div>
          <div class="form-group">
            <label for="department">Department:<font color="red">*</font></label>
            <select class="form-control" name="department" id="Department">
              <option value="Software Engineering">Software Engineering</option>
              <option value="Computer Engineering">Computer Engineering</option>
              <option value="Computer Science">Computer Science</option>
              <option value="Others" >Others</option>
            </select>
          </div>
          <div id="container">
          </div>
          <div class="form-group">
            <div class="collapse">
              <label> Please specify your department:</label>
              <textarea class="form-control" rows="4" id="Other Department" name="others" placeholder="Specify your department"></textarea>
            </div>
            <script>
            $("#Department").change(function(){if($(this).val() == "Others"){$('.collapse').collapse('show');}else{$('.collapse').collapse('hide');}});
            </script>
          </div>
          <div class="form-group">
            <label for="text">Technologies and tools you're interested in:</label>
            <textarea class="form-control" rows="4" id="Text" name="text" placeholder="Explain your interests"></textarea>
          </div>
          <button class="btn btn-primary btn-inline" type="submit" value="Submit" name="submit" id="Submit">Submit</button>
          <button class="btn btn-danger btn-inline" type="reset" value="Reset" onclick="$('.collapse').collapse('hide');">Reset</button>
        </div>
      </form>         
    </div>
    <br><br><br><br>
  </div>
</body>
</html>
<?php
if(isset($_POST['submit'])){

  include("dataBase.php");

  if ($_POST['department']=='Others') {
    $var1 = $_POST['others'];
  } else{
    $var1 = $_POST['department'];
  }

  if(isset($_FILES['avatar-1']) && $_FILES['avatar-1']['size']>0){
    $image = addslashes(file_get_contents($_FILES['avatar-1']['tmp_name']));
  }else{
    $image="";
  }

//Balioen kontrolak
  $messageOK = '<div class="alert alert-success alert-dismissable fade in centerFix">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
  <strong align="center">The registration was successful!</strong>';

  $messageER = '<div class="alert alert-danger alert-dismissable fade in fixed">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
  <strong align="center">ERROR!</strong>';

  $name = $_POST['firstname'];

  if(filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array( "regexp" => "/[A-ZÁÉÍÓÚÑ][A-Za-z\sáéíóúñ]+/")))){
    $messageOK .= "<p> $name is a valid username </p>";
  } else {
    $messageER .= "<p>$name is not a valid username!</p></div>";
    echo($messageER);
    die;
  }


  $surname = $_POST['lastname'];

  if(filter_var($surname, FILTER_VALIDATE_REGEXP, array("options" => array( "regexp" => "/[A-ZÁÉÍÓÚÑ][A-Za-z\sáéíóúñ]+/")))){
    $messageOK .= "<p> $surname is a valid surname </p>";
  } else {
    $messageER .= "<p>$name is not a valid surname!</p></div>";
    echo($messageER);
    die;
  }

  $email = $_POST['email'];

  if (!filter_var($email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[a-zA-Z]+\d{3}@ikasle\.ehu\.e(u?)s/"))) === false) {
    $messageOK .= "<p> $email is a valid email address </p>";
  } else {
    $messageER .= "<p> $email is not a valid email address!</p></div>";
    echo($messageER);
    die;
  }


  $password = $_POST['password'];

  if(strlen($password)>5){
    $messageOK .= "<p> ****** is a valid password </p>";
  } else {
    $messageER .= "<p> ****** is not a valid password!</p></div>";
    echo($messageER);
    die;
  }


  $phonenumber = $_POST['phonenumber'];

  if(!filter_var($phonenumber, FILTER_VALIDATE_REGEXP, array("options" => array( "regexp" => "/[0-9]{9}/"))) == false){
    $messageOK .= "<p> $phonenumber is a valid telephone </p>";
  } else {
    $messageER .= "<p> $phonenumber is not a valid telephone!</p></div>";
    echo($messageER);
    die;
  }

//KRIPTOGRAFIATUTA
  $enct = sha1($password); 

  $sql="INSERT INTO erabiltzaile VALUES ('$name', '$surname', '$email', '$enct', '$phonenumber', '$var1', '$_POST[text]', '$image',0)";

  $ema=mysqli_query($connect, $sql);
  if(!$ema){
    die('<div class="alert alert-danger alert-dismissable fade in centerFix">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      <strong align="center">ERROR in query execution:</strong> '. mysqli_error($connect).'</div>');
  }
  $users = "location.href='showUsersWithImage.php'";
  $home = "location.href='layout.php'";
  $messageOK .= "<br><p><button class='btn btn-success btn-inline' onclick=".$home.">Go home</button>&nbsp;
                      <button class='btn btn-success btn-inline' onclick=".$users.">Show registers</button>
                  </p></div>";
  echo $messageOK;

  mysqli_close($connect);
}
?>