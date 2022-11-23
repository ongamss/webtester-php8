<?php
	  if (!isset($go)) {
	  	$go=false;
	  }
	  if (!isset($inTest)) {
	  	$inTest=false;
	  }
	  if (!isset($inReview)) {
	  	$inReview=false;
	  }
	  if (!isset($finished)) {
	  	$finished=false;
	  }
	  if (IPSESSIONS) {
	  	$strSQL="SELECT * From sessions WHERE IP='" . $ip . "'";
	  } else {
	  	$strSQL="SELECT * From sessions WHERE ID='" . $sessID . "'";
	  }
	//   echo $strSQL;
	//   echo "<br> id";
	//   echo  $sessID;
	//   exit();
	  $result=mysqli_query($conn, $strSQL) or die ("Erro na consulta".mysqli_error());
	  $num_rows=mysqli_num_rows($result);
	  $row=mysqli_fetch_array($result);
	  
	  //se houver algum retorno na consulta acima
	  if ($num_rows != 0) {
		  if ($go) {
		  	$answersSQL="DELETE FROM answers WHERE SessionID='" . $sessID . "'";
			$result=mysqli_query($answersSQL)
				or die("Invalid Query: " . $answersSQL . " - " . mysqli_error());
			if (IPSESSIONS) {
				$sessionsSQL="DELETE From sessions WHERE IP='" . $ip . "'";
			} else {
				$sessionsSQL="DELETE From sessions WHERE ID='" . $sessID . "'";
			}
			$result=mysqli_query($conn, $sessionsSQL)
				or die("Invalid Query: " . $sessionsSQL . " - " . mysqli_error());
			session_destroy();
			redirect_to("go.php?testID=" . $_GET['testID']);
			exit;
		  }
		  if ($row['finished']) {
			 if (!$finished) {
			 	redirect_to("grade.php");
			 	exit;
			 }
		  } elseif ($row['review']) {
		  	if (!$inReview and !isset($_POST['Save'])) {
				redirect_to("reviewTest.php");
		  		exit;
		  	} elseif (isset($_REQUEST['Grade'])) {
		  		// do nothing
		  	}
		  } elseif ($row['takingTest']) {
			if (!$inTest) {
				redirect_to("test.php");
				exit;
			}
		  }
	  } 
	//   else {
	//   	 if ($inTest) {
	// 	  	redirect_to("index.php");
	// 	}
	//   }
?>