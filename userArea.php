<?php
include "./includes/timerhead.php";
include "./includes/conn.php";
include "./includes/includes.php";

session_start();
if ($_SESSION['loggedInTest']!="1") {
	redirect_to("./userLogin.php?li=" . $_SESSION['loggedInTest']);
	exit;
}

$username=$_SESSION['loggedInName'];
$password=$_SESSION['password'];

?>
<html><!-- InstanceBegin template="/Templates/Test Layout.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
<link href="includes/wtstyle.css" rel="stylesheet"  type="text/css">
<?
// Copyright (C) 2003 - 2007 Eppler Software.  All rights reserved.
// Any redistribution or reproduction of any materials herein is strictly prohibited.
?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>WebTester Online Testing</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<style type="text/css">
input.next
{ 
  margin-top       : 1.6em;
  float            : right;
}
.t {background: url(images/dot.gif) 0 0 repeat-x; width: 20em}
.b {background: url(images/dot.gif) 0 100% repeat-x}
.l {background: url(images/dot.gif) 0 0 repeat-y}
.r {background: url(images/dot.gif) 100% 0 repeat-y}
.bl {background: url(images/bl.gif) 0 100% no-repeat}
.br {background: url(images/br.gif) 100% 100% no-repeat}
.tl {background: url(images/tl.gif) 0 0 no-repeat}
.tr {background: url(images/tr.gif) 100% 0 no-repeat; padding:10px}
p {font-family: sans-serif; text-align:left}
<?php
if (DISABLE_PRINT) {  ?>
@media print {
body {display:none}
<?php
}
?>
}

</style>
</head>
<?php
	  if (IPSESSIONS) {
	  	$strSQL="SELECT * From sessions WHERE IP='" . $ip . "'";
	  } else {
	  	$strSQL="SELECT * From sessions WHERE ID='" . $sessID . "'";
	  }
	  // $strSQL="SELECT * From sessions WHERE IP='" . $ip . "'";
	  $result=mysqli_query($conn, $strSQL)
	  	or $myVar=true;
	 
	  if (!isset($myVar)) {
		  $num_records=mysqli_num_rows($result);
		  $row=mysqli_fetch_array($result);
		  if ($num_records == 0) {
	  		$myVar = true;
		  } else {
		  	$myVar = false;
		  }
	  }

?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="<?=BGCOLOR?>">
<?php
include "./includes/top.php";
?>
<div align="center"> 
  <table width="100%" border="0" cellpadding="2" cellspacing="0">
    <tr> 
      <td height="47" align="left" valign="middle"><img src="images/webtestertop.gif" width="<?=LOGOW?>" height="<?=LOGOH?>">
        <br>        
      </td>
      <td align="center" valign="middle">
	            <?php if (!$myVar) { ?>
	      
        <div class="t"><div class="b"><div class="l"><div class="r"><div class="bl"><div class="br"><div class="tl">
		  <div class="tr"><font face="Arial, Helvetica, sans-serif"><?php echo($row['FirstName'] . $myVar . " " . $row['LastName']) ?><br>
		    <?php } ?>
        <?php
 if ($myVar != 1) {
 	if ($row['TestName'] != "") {
 ?>
        <?=$row['TestName']?><br>
		<div id="countdowncontainer"></div>
		<?
		if ($row['AllowQuit']) {
			if (!$row['review'] and !$quit) {
		?>
		<div id="quit"><a href="./quitTest.php">Quit</a></div>
		<? 		} 
			}?>
		</font> 
		</div></div></div></div></div></div></div></div>
        <?php
 }
}
?> 
</td>
    </tr>
    <tr> 
      <td colspan="2" align="left" valign="top"> <div class="hr">
        <hr />
      </div>       
        <!-- InstanceBeginEditable name="Content Area" -->
        <p class="style1"><strong>Available Tests for <?=$_SESSION['firstname']?> <?=$_SESSION['lastname']?></strong> - <a href="./changePassword.php">Change Password</a> - <a href="./logout.php">Logout</a></p>
        <?php
		$limitedsubjects=explode(",",$_SESSION['limitedsubjects']);
		$subjectsfilter=implode(" OR ",$limitedsubjects);
	  if($_SESSION['limited']) {
	  	$strSQL="SELECT * FROM tests  WHERE Enabled=1 AND Subject=" . $subjectsfilter . " ORDER by TestName";
	  } else {
	  	$strSQL="SELECT * FROM tests  WHERE Enabled=1 ORDER by TestName";
	  }
	  $result=mysqli_query($conn, $strSQL);
	  if($result) {
	  	$num_rows=mysqli_num_rows($result);
	  } else {
	  	$num_rows=0;
	  }
	  ?>
	  <script language="javascript" type="text/javascript" src="includes/tableH.js"></script>
        <!-- <table width="100%"  border="0" cellspacing="2" cellpadding="0">
          <tr bgcolor="#EBEBEB">
            <td class="style1 style5"><?=$num_rows?> Tests/Quizzes</td>
          </tr>
        </table>
		-->
		<table class="style1 style5" width="100%"  border="0" cellspacing="2" cellpadding="0" onMouseOut="javascript:highlightTableRowVersionA(0);">
  <tr bgcolor="#C8D8FF">
    <td>Name</td>
    <td width="240">Subject</td>
  </tr>
  <?php
			if ($num_rows != 0) {
				while($row = mysqli_fetch_assoc($result)) {
				$i++;
			?>
              <tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
			  <td class="pointer" onClick="document.location.href='go.php?testID=<?=$row['ID']?>';"><a class="pointer" href="go.php?testID=<?=$row['ID']?>"><?=$row['TestName']?></a></td>
			  <?php
			  $subjectSQL="SELECT Name FROM subjects WHERE ID=" . $row['Subject'];
			  $subjectResult=mysqli_query( $conn,$subjectSQL);
			  $subject=mysqli_fetch_assoc($subjectResult);
			  ?>
			  <td><?=$subject['Name']?></td></tr>
			 <?php
			 }
			}
			?>
</table>
<!-- InstanceEndEditable -->	  </td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="top">
        <div align="center"> 
		<div class="hr"><hr /></div>
          <?php include "./includes/copyright.php" ?></div></td>
    </tr>
  </table>
</div>
</body>
<!-- InstanceEnd --></html>
