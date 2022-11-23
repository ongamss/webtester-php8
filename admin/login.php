<?php
include "../includes/conn.php";
include "../includes/includes.php";

//alterado para versao php5 por magno
if(!isset($_SESSION)){
    session_start();
}
//session_start();

$usersSQL="SELECT * FROM users WHERE Username='" . $_POST['txtName'] . "'";
$myRsRes=mysqli_query($conn, $usersSQL)
	or redirect_to("index.php");
$myRs=mysqli_fetch_assoc($myRsRes)
	or redirect_to("index.php");
if (mysqli_num_rows($myRsRes) != 0) {
	if ($myRs['Password']==md5($_POST['txtPassword'])) {
		if ($myRs['Admin']) {
			$_SESSION['loggedIn']="1";
			$_SESSION['loggedInName']=$myRs['Username'];
			$_SESSION['userID']=$myRs['ID'];
		}
	}
}
if ($_POST['referrer']!="") {
	redirect_to($_POST['referrer']);
} else {
	redirect_to("index.php");
}
?>