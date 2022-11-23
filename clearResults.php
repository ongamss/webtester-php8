<?php
include "./includes/timerhead.php";
include "./includes/conn.php";
include "./includes/includes.php";
include "./includes/nocache.php";
// include "./includes/validation.php";



		if (IPSESSIONS) {
			$sessionsSQL="SELECT * From sessions WHERE IP='" . $ip . "'";
		} else {
			$sessionsSQL="SELECT * From sessions WHERE ID='" . $sessID . "'";
		}
		$mySessionsRes=mysqli_query($conn, $sessionsSQL);
		$mySessions=mysqli_fetch_assoc($mySessionsRes);
		if($_POST['autoReset']=="true") {
			$answersSQL="DELETE FROM answers WHERE SessionID='" . $mySessions['ID'] . "'";
			$result=mysqli_query($conn, $answersSQL)
				or die("Invalid Query: " . $answersSQL . " - " . mysqli_error());
			if (IPSESSIONS) {
				$sessionsSQL="DELETE From sessions WHERE IP='" . $ip . "'";
			} else {
				$sessionsSQL="DELETE From sessions WHERE ID='" . $sessID . "'";
			}
			$result=mysqli_query($conn, $sessionsSQL)
				or die("Invalid Query: " . $sessionsSQL . " - " . mysqli_error());
			session_destroy();
			if($_POST['Retry']==RETRY_BUTTON) {
				redirect_to("go.php?testID=" . $_POST['TestID']);
				exit;
			}
//			if(CLOSE_WINDOW) {
//				redirect_to("closewindow.php");
//				exit;
//			} else { 
//				clearstatcache();
//				redirect_to("index.php");
//				exit;
			}
		


			if(CLOSE_WINDOW) {
			    // unset cookies
			    if (isset($_SERVER['HTTP_COOKIE'])) {
				    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
				    foreach($cookies as $cookie) {
			            $parts = explode('=', $cookie);
			            $name = trim($parts[0]);
			            setcookie($name, '', time()-1000);
				        setcookie($name, '', time()-1000, '/');
				    }
			    }

				clearstatcache();
				redirect_to("closewindow.php");
				exit;
			} else { 
				clearstatcache();
				redirect_to("index.php");
				exit;
			}




		$usersSQL="SELECT * FROM users WHERE Username='" . $_POST['userName'] . "'";
		$myRsRes=mysqli_query($conn, $usersSQL)
			or die(mysqli_error());
		$myRs=mysqli_fetch_assoc($myRsRes);
		if (mysqli_num_rows($myRsRes) != 0) {
			if ($myRs['Password']==md5($_POST['password'])) {
			  if ($myRs['Admin']) {
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
			  }
			  redirect_to("index.php");
			  exit;
			}
		}
	  	redirect_to("index.php");
?>
