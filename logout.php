<?php
include "./includes/conn.php";
include "./includes/includes.php";

session_start();

	  if ($_SESSION['loggedInTest'] != "1") redirect_to("userLogin.php");
	  $_SESSION['loggedInTest']="0";
	  $_SESSION['loggedInName']="";
	  $_SESSION['password']="";
	  $_SESSION['firstname']="";
	  $_SESSION['lastname']="";
	  redirect_to("userLogin.php");
?>

