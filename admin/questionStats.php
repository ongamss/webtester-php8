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
        <p class="style4">Question Statistics </p>
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
		   <!-- InstanceBeginEditable name="nav" --><a href="./index.php">WebTester</a> &gt; <a href="./testManage.php">Test Management</a> &gt; <a href="./editTest.php?TestID=<?=$_REQUEST['TestID']?>">Edit Test</a> &gt; <a href="./questionEdit.php?TestID=<?=$_REQUEST['TestID']?>">Question Editor</a> &gt; Question Statistics <!-- InstanceEndEditable --></div></td>
    </tr>
    <tr> 
      <td align="center" valign="top">		<div align="left"><!-- InstanceBeginEditable name="Content Area" -->
        <?php
		if ($_SESSION['loggedIn'] != "1") {
			redirect_to("index.php");
			exit;
		}
		if (!isset($_REQUEST['quesID'])) {
			$questionsSQL="SELECT * FROM questions WHERE TestID='" . $_REQUEST['TestID'] . "' ORDER BY 'sortOrder' ASC, 'ID' ASC";
		} else {
			$questionsSQL="SELECT * FROM questions WHERE ID='" . $_REQUEST['quesID'] . "' ORDER BY 'sortOrder' ASC, 'ID' ASC";
		}
		require_once("../includes/graphs.inc.php");
		$questionsResult=mysqli_query($conn, $questionsSQL);
		$num_rows=mysqli_num_rows($questionsResult);
		?>
		<p class="style7">Question Statistics</p>
<table class="style1 style5" width="100%"  border="0" cellspacing="2" cellpadding="0" onMouseOut="javascript:highlightTableRowVersionA(0);">
<?php
	while($row = mysqli_fetch_assoc($questionsResult)) {
	?>
  <tr bgcolor="#C8D8FF">
    <td width="30" align="center">&nbsp;</td>
    <td align="center">Question / Answer</td>
    <td width="60" align="center"><span class="style1 style5">Clicks</span></td>
    <td width="60" align="center">Correct</td>
    <td width="170" align="center"><span class="style1 style5">Percent</span></td>
  </tr>
	<tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
		<td colspan="5"><strong><?=strip_tags($row['QuestionText'])?></strong></td>
	</tr>
	<?php if ($row['Answer1']!="") { 
$i++;
?>
	<tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
		<td>&nbsp;</td>
		<td><?=$row['Answer1']?></td>
		<td width="60"><?=$row['A1Clicks']?></td>
		<td><?php
		if ($row['A1']) {
			echo("<img src='../images/checked.gif'>");
		} else {
			echo("<img src='../images/unchecked.gif'>");
		}
		?></td>
		<td width="170"><?php
		$total=$row['A1Clicks'] + $row['A2Clicks'] + $row['A3Clicks'] + $row['A4Clicks'] + $row['A5Clicks'] + $row['A6Clicks'];
		if ($total!=0) {
			$percent=$row['A1Clicks'] / $total;
			$percent=100*$percent;
		} else {
			$percent=0;
		}
		$percent=intval($percent);
		$graph = new BAR_GRAPH("pBar");
$graph->values = $percent . ";100";
$graph->barColor = "#C8D8FF";
$graph->barBorder = "1px solid #808080";
$graph->labelBGColor = "";
$graph->barWidth = 10;
$graph->barLength=.75;
echo $graph->create();
		?></td>
		<?php
		}
		?>
	<?php if ($row['Answer2']!="") {
      $i++;
      ?>
	<tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
		<td>&nbsp;</td>
		<td><?=$row['Answer2']?></td>
		<td width="60"><?=$row['A2Clicks']?></td>
		<td><?php
		if ($row['A2']) {
			echo("<img src='../images/checked.gif'>");
		} else {
			echo("<img src='../images/unchecked.gif'>");
		}
		?></td>
		<td width="170"><?php
		$total=$row['A1Clicks'] + $row['A2Clicks'] + $row['A3Clicks'] + $row['A4Clicks'] + $row['A5Clicks'] + $row['A6Clicks'];
		if ($total!=0) {
			$percent=$row['A2Clicks'] / $total;
			$percent=100*$percent;
		} else {
			$percent=0;
		}
		$percent=intval($percent);
		$graph = new BAR_GRAPH("pBar");
$graph->values = $percent . ";100";
$graph->barColor = "#C8D8FF";
$graph->barBorder = "1px solid #808080";
$graph->labelBGColor = "";
$graph->barWidth = 10;
$graph->barLength=.75;
echo $graph->create();
		?></td>
		<?php
		}
		?>
	<?php if ($row['Answer3']!="") {
      $i++;
      ?>
	<tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
		<td>&nbsp;</td>
		<td><?=$row['Answer3']?></td>
		<td width="60"><?=$row['A3Clicks']?></td>
		<td><?php
		if ($row['A3']) {
			echo("<img src='../images/checked.gif'>");
		} else {
			echo("<img src='../images/unchecked.gif'>");
		}
		?></td>
		<td width="170"><?php
		$total=$row['A1Clicks'] + $row['A2Clicks'] + $row['A3Clicks'] + $row['A4Clicks'] + $row['A5Clicks'] + $row['A6Clicks'];
		if ($total!=0) {
			$percent=$row['A3Clicks'] / $total;
			$percent=100*$percent;
		} else {
			$percent=0;
		}
		$percent=intval($percent);
		$graph = new BAR_GRAPH("pBar");
$graph->values = $percent . ";100";
$graph->barColor = "#C8D8FF";
$graph->barBorder = "1px solid #808080";
$graph->labelBGColor = "";
$graph->barWidth = 10;
$graph->barLength=.75;
echo $graph->create();
		?></td>
		<?php
		}
		?>
	<?php if ($row['Answer4']!="") {
      $i++;
      ?>
	<tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
		<td>&nbsp;</td>
		<td><?=$row['Answer4']?></td>
		<td width="60"><?=$row['A4Clicks']?></td>
		<td><?php
		if ($row['A4']) {
			echo("<img src='../images/checked.gif'>");
		} else {
			echo("<img src='../images/unchecked.gif'>");
		}
		?></td>
		<td width="170"><?php
		$total=$row['A1Clicks'] + $row['A2Clicks'] + $row['A3Clicks'] + $row['A4Clicks'] + $row['A5Clicks'] + $row['A6Clicks'];
		if ($total!=0) {
			$percent=$row['A4Clicks'] / $total;
			$percent=100*$percent;
		} else {
			$percent=0;
		}
		$percent=intval($percent);
		$graph = new BAR_GRAPH("pBar");
$graph->values = $percent . ";100";
$graph->barColor = "#C8D8FF";
$graph->barBorder = "1px solid #808080";
$graph->labelBGColor = "";
$graph->barWidth = 10;
$graph->barLength=.75;
echo $graph->create();
		?></td>
		<?php
		}
		?>
	<?php if ($row['Answer5']!="") {
      $i++;
      ?>
	<tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
		<td>&nbsp;</td>
		<td><?=$row['Answer5']?></td>
		<td width="60"><?=$row['A5Clicks']?></td>
		<td><?php
		if ($row['A5']) {
			echo("<img src='../images/checked.gif'>");
		} else {
			echo("<img src='../images/unchecked.gif'>");
		}
		?></td>
		<td width="170"><?php
		$total=$row['A1Clicks'] + $row['A2Clicks'] + $row['A3Clicks'] + $row['A4Clicks'] + $row['A5Clicks'] + $row['A6Clicks'];
		if ($total!=0) {
			$percent=$row['A5Clicks'] / $total;
			$percent=100*$percent;
		} else {
			$percent=0;
		}
		$percent=intval($percent);
		$graph = new BAR_GRAPH("pBar");
$graph->values = $percent . ";100";
$graph->barColor = "#C8D8FF";
$graph->barBorder = "1px solid #808080";
$graph->labelBGColor = "";
$graph->barWidth = 10;
$graph->barLength=.75;
echo $graph->create();
		?></td>
		<?php
		}
		?>
	<?php if ($row['Answer6']!="") {
      $i++;
      ?>
	<tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
		<td>&nbsp;</td>
		<td><?=$row['Answer6']?></td>
		<td width="60"><?=$row['A6Clicks']?></td>
		<td><?php
		if ($row['A6']) {
			echo("<img src='../images/checked.gif'>");
		} else {
			echo("<img src='../images/unchecked.gif'>");
		}
		?></td>
		<td width="170"><?php
		$total=$row['A1Clicks'] + $row['A2Clicks'] + $row['A3Clicks'] + $row['A4Clicks'] + $row['A5Clicks'] + $row['A6Clicks'];
		if ($total!=0) {
			$percent=$row['A6Clicks'] / $total;
			$percent=100*$percent;
		} else {
			$percent=0;
		}
		$percent=intval($percent);
		$graph = new BAR_GRAPH("pBar");
$graph->values = $percent . ";100";
$graph->barColor = "#C8D8FF";
$graph->barBorder = "1px solid #808080";
$graph->labelBGColor = "";
$graph->barWidth = 10;
$graph->barLength=.75;
echo $graph->create();
		?></td>
		<?php
		}
		?>
		<?php
		$i++
		?>
		<tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
		<td colspan="4">Correct Responses </td>
		<td width="170">
		<?php
		$total=$row['Correct'] + $row['Incorrect'];
		$graph = new BAR_GRAPH("pBar");
$graph->values = $row['Correct'] . ";" . $total;
$graph->barColor = "#C8D8FF";
$graph->barBorder = "1px solid #808080";
$graph->labelBGColor = "";
$graph->barWidth = 10;
$graph->barLength=.75;
echo $graph->create();
?>
		</td>
		</tr>
		<?php
		$i++
		?>
		<tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
		<td colspan="4">Incorrect Responses </td>
		<td width="170">
		<?php
		$total=$row['Correct'] + $row['Incorrect'];
		$graph = new BAR_GRAPH("pBar");
$graph->values = $row['Incorrect'] . ";" . $total;
$graph->barColor = "#C8D8FF";
$graph->barBorder = "1px solid #808080";
$graph->labelBGColor = "";
$graph->barWidth = 10;
$graph->barLength=.75;
echo $graph->create();
?></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		  <td colspan="5"></td>
		</tr>
	<?php
	}
	?>
	</table>
	<div align="center" class="style1">
		  <?php
		  if (!isset($_REQUEST['quesID'])) { ?>
		  <a href="./clearQuestionStats.php?TestID=<?=$_REQUEST['TestID']?>">Clear Above Statistics</a>
		  <?php
		}
		?>
		</div>
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
