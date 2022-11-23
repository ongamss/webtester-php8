<?php
if (isset($_GET['override'])) {
	if (ALLOW_OVERRIDE) {
		$go=true;
	}
}
include "./includes/timerhead.php";
include "./includes/conn.php";
include "./includes/includes.php";
include "./includes/nocache.php";
include "./includes/validation.php";

if (isset($_SESSION['username'])) {
	$_REQUEST['username']=$_SESSION['loggedInName'];
	$_REQUEST['password']=$_SESSION['password'];
} else {
	$_REQUEST['password']=md5($_REQUEST['password']);
}

	  if (!isset($_REQUEST['testID'])) {
	  	?>
	  	Sem testes a iniciar. Por favor tente novamente.
	  	<?php
	  } else {
	  	if (isset($_GET['username'])) {			
			redirect_to("directions.php?username=" . $_REQUEST['username'] . "&password=" . $_REQUEST['password'] . "&testID=" . $_REQUEST['testID']);
		} else {
			redirect_to("directions.php?testID=" . $_REQUEST['testID']);
		}
	  }
	  ?>