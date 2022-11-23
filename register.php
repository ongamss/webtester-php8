<?php
include "./includes/conn.php";
include "./includes/includes.php";

if ($_REQUEST['password'] != $_REQUEST['confirm']) {
	die("Password doesn't match");
}

if ($_REQUEST['username'] == "") {
	die("No username");
}

$registerCheckSQL="SELECT * FROM users WHERE Username='" . $_REQUEST['username'] . "'";

$checkResult=mysqli_query($registerCheckSQL, $conn);

if (mysqli_num_rows($checkResult) > 0) {
	die("User already exists...");
}

$registerSQL="INSERT INTO users
			(Username,
			Password,
			FirstName,
			LastName,
			Email,
			street,
			street2,
			city,
			state,
			zip)
			VALUES
			('" . mysqli_escape_string($_REQUEST['username']) . "',
			'" . md5(mysqli_escape_string($_REQUEST['password'])) . "',
			'" . mysqli_escape_string($_REQUEST['firstname']) . "',
			'" . mysqli_escape_string($_REQUEST['lastname']) . "',
			'" . mysqli_escape_string($_REQUEST['email']) . "',
			'" . mysqli_escape_string($_REQUEST['street']) . "',
			'" . mysqli_escape_string($_REQUEST['street2']) . "',
			'" . mysqli_escape_string($_REQUEST['city']) . "',
			'" . mysqli_escape_string($_REQUEST['state']) . "',
			'" . mysqli_escape_string($_REQUEST['zip']) . "')";
						
$result=mysqli_query($registerSQL, $conn)
	or die("Invalid Query: " . $registerSQL . " - " . mysqli_error());
	
redirect_to("userLogin.php");



?>