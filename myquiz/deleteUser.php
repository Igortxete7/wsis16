<?php
  session_start();
  include('security.php');
  if($_SESSION['user-email'] !== 'web000@ehu.es'){
    header("Location: layout.php");
  }
  include('dataBase.php');
  $email = mysqli_real_escape_string($connect,$_POST['email']);
  $sql = "SELECT * FROM tests WHERE `Creator`='$email'";
  $query = mysqli_query($connect,$sql);
  while($quiz=mysqli_fetch_array($query,MYSQLI_ASSOC)){
    mysqli_query($connect, "DELETE FROM galderak WHERE TestID = '". $quiz['ID'] ."'" );
    mysqli_query($connect, "DELETE FROM testak WHERE ID = '". $quiz['ID'] ."'");
  }
  $dsql = "DELETE FROM erabiltzaile WHERE eMail = '$email'";
  $dquery = mysqli_query($connect, $dsql);
  mysqli_close($connect);
  echo "deleted";
?>