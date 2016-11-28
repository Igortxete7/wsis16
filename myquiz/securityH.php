<?php
if(isset($_SESSION['auth'])){
	if($_SESSION['auth'] == "YES"){
		echo "<p align='right'style='position: absolute; top: 0px; right: 10px;'>Hello, ".$_SESSION['user-firstname']." ".$_SESSION['user-lastname']." | <a href='logOut.php'>Logout</a></p>";
	}
} else{
	header('Location: layout.php');
	exit();
}
?>