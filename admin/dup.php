<?php
ob_start();
// Copyright (C) 2003 - 2007 Eppler Software.  All rights reserved.
// Any redistribution or reproduction of any materials herein is strictly prohibited.
?>
<html><!-- InstanceBegin template="/Templates/Admin Layout.dwt.php" codeOutsideHTMLIsLocked="true" -->
<head>
<?php
session_start();
include "../includes/timerhead.php";
include "../includes/conn.php";
include "../includes/includes.php";
include "../includes/nocache.php";


?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>WebTester Online Testing</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<link href="../includes/wtstyle.css" rel="stylesheet"  type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<script language="javascript" type="text/javascript" src="../includes/tableH.js"></script>
<script language="Javascript" src="../editor/scripts/innovaeditor.js"></script>
<script language="javascript">
function checkIt(string)
{
	var detect = navigator.userAgent.toLowerCase();
	place = detect.indexOf(string) + 1;
	thestring = string;
	return place;
}
</script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div align="center"> 
  <table width="100%" height="50" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333" BORDERCOLORLIGHT="#999999" BORDERCOLORDARK="#333333">
    <tr> 
      <td width="338" align="center" valign="top"><div align="left"><a href="./index.php"><img src="../images/webtestertop.gif" width="337" height="75" border="0"></a></div></td>
      <td align="center" valign="middle"><!-- InstanceBeginEditable name="CurrentArea" -->
        <p>Area Goes Here </p>
        <!-- InstanceEndEditable --></td>
    </tr>
  </table>
  <div class="hr"><hr /></div>
  <table width="100%" height="50" border="0" align="center" cellpadding="3" cellspacing="1" bordercolor="#333333" BORDERCOLORLIGHT="#999999" BORDERCOLORDARK="#333333">
    <tr> 
      <td align="center" valign="top"><table width="100%"  border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td><div align="center"><span class="style1"><a href="testManage.php"><img src="../images/tests.gif" width="48" height="48" border="0"><br>
            Tests</a></span></div></td>
          <td><div align="center"><span class="style1"><a href="subjects.php"><img src="../images/subjects.gif" width="48" height="48" border="0"><br>
            Subjects</a></span></div></td>
          <td><div align="center"><span class="style1"><a href="currentSessions.php"><img src="../images/sessions.gif" width="48" height="48" border="0"><br>
            Sessions</a></span></div></td>
          <td><div align="center"><span class="style1"><a href="viewReports.php"><img src="../images/reports.gif" width="48" height="48" border="0"><br>
            Reports</a></span></div></td>
          <td><div align="center"><span class="style1"><a href="preferences.php"><img src="../images/preferences.gif" width="48" height="48" border="0"><br>
            Preferences</a></span></div></td>
          <td><div align="center"><span class="style1"><a href="logout.php"><img src="../images/logout.gif" width="48" height="48" border="0"><br>
            Logout</a></span></div></td>
        </tr>
      </table>        </td>
    </tr>
    <tr>
      <td align="center" valign="top">
	          <div align="left" class="style2">
	  <?php
	if (isset($_SESSION['loggedInName'])) {
		if ($_SESSION['loggedInName'] != "") {
		?>
          <div align="center">Currently logged in as:
            <?=$_SESSION['loggedInName']?>
		  </div>
            <?php
		}
	}
?>
		   <div class="hr"><hr /></div><br>
		   <!-- InstanceBeginEditable name="nav" -->WebTester<!-- InstanceEndEditable --></div></td>
    </tr>
    <tr> 
      <td align="center" valign="top">		<div align="left"><!-- InstanceBeginEditable name="Content Area" -->
	  <?php if ($_SESSION['loggedIn'] != "1") {
			redirect_to("index.php");
			exit;
		}
		if (!isset($_REQUEST['testID'])) {
			redirect_to("index.php");
			exit;
		}
	?>
	  <p>Duplicating Test Table...</p>
	  <?php
		$testsSQL="SELECT * FROM tests  WHERE ID=" . $_REQUEST['testID'];
		$myRsRes=mysqli_query($conn, $testsSQL);
		$myRs=mysqli_fetch_assoc($myRsRes);
		
				$testsSQL="INSERT INTO Tests
			(TestName,
			PassingScore,
			Directions,
			Creator,
			Enabled,
			Random)
			VALUES
			('" . $myRs['TestName'] . " (Copy)" . "',
			'" . $myRs['PassingScore'] . "',
			'" . addslashes($myRs['Directions']) . "',
			'" . $_SESSION['loggedInName'] . "',
			'" . $myRs['Enabled'] . "',
			'" . $myRs['Random'] . "')";
		$result=mysqli_query($conn, $testsSQL)
			or die("Invalid Query: " . $testsSQL . " - " . mysqli_error());
		$lastID=mysqli_insert_id();
	  ?>
	  <p>Duplicating Questions Table... </p>
	  <?php
	  	$questionsSQL="SELECT * FROM questions WHERE TestID='" . $_REQUEST['testID'] . "'";
		$myRsRes=mysqli_query($conn, $questionsSQL);
		$num_rows=mysqli_num_rows($myRsRes);
		if ($num_rows != 0) {
			while($row = mysqli_fetch_assoc($myRsRes)) {
			$questionsSQL="INSERT INTO Questions
	  	(TestID,
	  	QuestionText,
	  	QuestionPic,
	  	Answer1,
	  	Answer2,
	  	Answer3,
	  	Answer4,
	  	Answer5,
	  	Answer6,
	  	AnswerPic1,
	  	AnswerPic2,
	  	AnswerPic3,
	  	AnswerPic4,
	  	AnswerPic5,
	  	AnswerPic6,
	  	A1,
	  	A2,
	  	A3,
	  	A4,
	  	A5,
	  	A6,
	  	AnswerText,
	  	PicMov,
	  	PicMovWidth,
	  	PicMovHeight)
	  	VALUES
	  	('" . $lastID . "',
	  	'" . addslashes($row['QuestionText']) . "',
	  	'" . $row['QuestionPic'] . "',
	  	'" . addslashes($row['Answer1']) . "',
	  	'" . addslashes($row['Answer2']) . "',
	  	'" . addslashes($row['Answer3']) . "',
	  	'" . addslashes($row['Answer4']) . "',
	  	'" . addslashes($row['Answer5']) . "',
	  	'" . addslashes($row['Answer6']) . "',
	  	'" . $row['AnswerPic1'] . "',
	  	'" . $row['AnswerPic2'] . "',
	  	'" . $row['AnswerPic3'] . "',
	  	'" . $row['AnswerPic4'] . "',
	  	'" . $row['AnswerPic5'] . "',
	  	'" . $row['AnswerPic6'] . "',
	  	'" . $row['A1'] . "',
	  	'" . $row['A2'] . "',
	  	'" . $row['A3'] . "',
	  	'" . $row['A4'] . "',
	  	'" . $row['A5'] . "',
	  	'" . $row['A6'] . "',
	  	'" . addslashes($row['AnswerText']) . "',
	  	'" . $row['PicMov'] . "',
	  	'" . $row['PicMovWidth'] . "',
	  	'" . $row['PicMovHeight'] . "')";
	  $result=mysqli_query($conn, $questionsSQL)
	  	or die("Invalid Query: " . $questionsSQL . " - " . mysqli_error());
			}
		}
	  ?>
      <p>Duplicating Images...</p>
	  <?php
	  copyr("../test-images/" . $_REQUEST['testID'], "../test-images/" . $lastID);
	  ?>
      <p>Finished.</p>
	  <?php
	  redirect_to("index.php");
	  ?>
      <!-- InstanceEndEditable --> </div>	<div class="hr"><hr /></div>
</td>
    </tr>
    <tr> 
      <td align="center" valign="top">
        <p><span class="style1 style5">Copyright &copy; 2003 - 2010<a href="./about.php">Eppler 
            Software</a> </span><br>
          <font size="-2">Page created in
        <?php include "../includes/timerfoot.php" ?> seconds.<br />
		Version 5.1.20101016</font><br>
</p>
      </td>
    </tr>
  </table>
</div>
</body>
<!-- InstanceEnd --></html>
<?php ob_end_flush() ?>
