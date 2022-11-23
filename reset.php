<?php
// This file resets a session and then redirects to the URL specified by the
// link parameter
include "./includes/timerhead.php";
include "./includes/conn.php";
include "./includes/includes.php";
include "./includes/nocache.php";


		if (IPSESSIONS) {
			$sessionsSQL="SELECT * From sessions WHERE IP='" . $ip . "'";
		} else {
			$sessionsSQL="SELECT * From sessions WHERE ID='" . $sessID . "'";
		}
		$mySessionsRes=mysqli_query($sessionsSQL, $conn);
		$mySessions=mysqli_fetch_assoc($mySessionsRes);
		$answersSQL="DELETE FROM answers WHERE SessionID='" . $mySessions['ID'] . "'";
		$result=mysqli_query($answersSQL)
			or die("Invalid Query: " . $answersSQL . " - " . mysqli_error());
		if (IPSESSIONS) {
			$sessionsSQL="DELETE From sessions WHERE IP='" . $ip . "'";
		} else {
			$sessionsSQL="DELETE From sessions WHERE ID='" . $sessID . "'";
		}
		$result=mysqli_query($sessionsSQL)
			or die("Invalid Query: " . $sessionsSQL . " - " . mysqli_error());
		session_destroy();
		if(isset($_REQUEST['link'])) {
			header("Location: " . $_REQUEST['link']);
			exit;
		} else {
			redirect_to("index.php");
		}
	  	redirect_to("index.php");
?>