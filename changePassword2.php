<?php
include "./includes/conn.php";
include "./includes/includes.php";

if ($_POST['password']!=$_POST['confirm']) {
	redirect_to("changePassword.php?m=0");
	exit;
}

if ($_POST['password']=="") {
	redirect_to("changePassword.php?b=1");
	exit;
}

session_start();
		  $usersSQL="UPDATE users SET
		  Password='" . md5($_POST['confirm']) . "'
		  WHERE ID=" . $_SESSION['userID'];
		  $result=mysqli_query($usersSQL)
		  	or die("Invalid Query: " . $usersSQL . " - " . mysqli_error());
		  redirect_to("index.php");
?>