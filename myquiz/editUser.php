<?php
  session_start();
  include('security.php');
  if($_SESSION['user-email'] !== 'web000@ehu.es'){
    header("Location: layout.php");
  }
  include('dataBase.php');

  $firstname = mysqli_real_escape_string($connect,$_POST['firstname']);
  $lastname = mysqli_real_escape_string($connect,$_POST['lastname']);
  $email = mysqli_real_escape_string($connect,$_POST['email']);
  $phone = mysqli_real_escape_string($connect,$_POST['phone']);
  $specialty = mysqli_real_escape_string($connect,$_POST['specialty']);

  $sql = "SELECT * FROM erabiltzaile WHERE eMail = '$email' LIMIT 1";

  $query = mysqli_query($connect,$sql);
  $row=mysqli_fetch_array($query,MYSQLI_ASSOC);

  if($firstname !== $row['First Name']){
    $update = "UPDATE erabiltzaile SET `First Name`='$firstname' WHERE `eMail`='$email'";
    $updatequery = mysqli_query($connect,$update);
  }

  if($lastname !== $row['Last Names']){
    $update = "UPDATE erabiltzaile SET `Last name`='$lastname' WHERE `eMail`='$email'";
    $updatequery = mysqli_query($connect,$update);
  }

  if($phone !== $row['Phone']){
    $update = "UPDATE erabiltzaile SET `Phone`='$phone' WHERE `eMail`='$email'";
    $updatequery = mysqli_query($connect,$update);
  }

  if($specialty !== $row['Department']){
    $update = "UPDATE erabiltzaile SET `Department`='$specialty' WHERE `eMail`='$email'";
    $updatequery = mysqli_query($connect,$update);
  }

  mysqli_free_result($query);
  mysqli_close($connect);
  echo "edited";
?>