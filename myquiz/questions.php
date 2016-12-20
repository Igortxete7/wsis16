<?php
session_start();
include('dataBase.php');
$sql = "SELECT * FROM testak ORDER BY ID";
$query = mysqli_query($connect,$sql);
$type = "Check questions";
$date = date ("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_SESSION['user-email'])){
  $connection = (int)$_SESSION['konex-id'];
  $email = "'".$_SESSION['user-email']."'";
  $sql2 = "INSERT INTO ekintzak VALUES(0, $connection, $email, '$type', '$date', '$ip')";
} else{
  $sql2 = "INSERT INTO ekintzak (`Task`, `Data`, `IP`) VALUES('$type', '$date', '$ip')";
}
$query2 = mysqli_query($connect,$sql2);
if (!$query2){
  die('ERROR at query execution:' . mysqli_error($connect));
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Quizzes and questions</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css"/>
  <style>
  a#testname:hover, a#testname:active, a#testname:link, a#testname:visited {
    text-decoration: none;
  }
  .panel-body {
    padding: 10px;
    padding-bottom: 0px;
  }
  </style>
  <script src="./js/jquery-3.1.1.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
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
          <li class="dropdown active">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span> Quizzes <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="selectQuiz.php"><span class="glyphicon glyphicon-play"></span> Play Quizzes</a></li>
              <?php
              if(isset($_SESSION["auth"])){
                ?>
                <li><a href="createTest.php"><span class="glyphicon glyphicon-book"></span> Create Quiz</a></li>
                <li><a href="insertQuestion.php"><span class="glyphicon glyphicon-import"></span> Insert Questions</a></li>
                <li><a href="questions.php"><span class="glyphicon glyphicon-eye-open"></span> See All Quizzes</a></li>
                <li class="active"><a href="handlingQuizes.php"><span class="glyphicon glyphicon-stats"></span> Handle Quizzes</a></li>
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
      <h1>Quizes and questions</h1>
    </div>
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="panel-group" id="accordion">
          <?php while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){ ?>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="<?php echo "#collapse".$row['ID']; ?>" class="btn-block" id="testname"><?php echo $row['Name']; ?></a>
              </h4>
            </div>
            <div id="<?php echo "collapse".$row['ID']; ?>" class="panel-collapse collapse">
              <div class="panel-body table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Question</th>
                      <th width="10%">Difficulty</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $qsql = "SELECT * FROM galderak WHERE TestID='$row[ID]'";
                    $qquery = mysqli_query($connect,$qsql);
                    while($qrow=mysqli_fetch_array($qquery,MYSQLI_ASSOC)){
                      echo "<tr>";
                      echo "<td>".$qrow['Question']."</td>";
                      echo "<td>".$qrow['Difficulty']."</td>";
                      echo "</tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <?php }
          mysqli_free_result($query);
          mysqli_close($connect);
          ?>
        </div>
      </div>
    </div>
  </body>
  </html>