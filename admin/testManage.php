<?php
ob_start();
session_start();
// Copyright (C) 2003 - 2007 Eppler Software.  All rights reserved.
// Any redistribution or reproduction of any materials herein is strictly prohibited.
?>
<html><!-- InstanceBegin template="/Templates/Admin%20Layout.dwt.php" codeOutsideHTMLIsLocked="true" -->
<head>
<?php

include "../includes/timerhead.php";
include "../includes/conn.php";
include "../includes/includes.php";
include "../includes/nocache.php";


?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>WebTester Online Testing</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
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
        <p class="style4">Gerenciamento de Teste</p>
        <!-- InstanceEndEditable --></td>
    </tr>
  </table>
  <div class="hr"><hr /></div>
  <table width="100%" height="50" border="0" align="center" cellpadding="3" cellspacing="1" bordercolor="#333333" BORDERCOLORLIGHT="#999999" BORDERCOLORDARK="#333333">
    <tr> 
      <td align="center" valign="top"><table width="100%"  border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td><div align="center"><span class="style1"><a href="testManage.php"><img src="../images/tests.gif" width="48" height="48" border="0"><br>
            Testes</a></span></div></td>
          <td><div align="center"><span class="style1"><a href="subjects.php"><img src="../images/subjects.gif" width="48" height="48" border="0"><br>
            Assuntos</a></span></div></td>
          <td><div align="center"><span class="style1"><a href="currentSessions.php"><img src="../images/sessions.gif" width="48" height="48" border="0"><br>
            Sess&otilde;es</a></span></div></td>
          <td><div align="center"><span class="style1"><a href="viewReports.php"><img src="../images/reports.gif" width="48" height="48" border="0"><br>
            Relat&oacute;rios</a></span></div></td>
          <td><div align="center"><span class="style1"><a href="preferences.php"><img src="../images/preferences.gif" width="48" height="48" border="0"><br>
            Prefer&ecirc;ncias</a></span></div></td>
          <td><div align="center"><span class="style1"><a href="logout.php"><img src="../images/logout.gif" width="48" height="48" border="0"><br>
            Sair</a></span></div></td>
        </tr>
      </table>          </td>
    </tr>
    <tr>
      <td align="center" valign="top">
	          <div align="left" class="style2">
	  <?php
	if (isset($_SESSION['loggedInName'])) {
		if ($_SESSION['loggedInName'] != "") {
		?>
          <div align="center">Usu&aacute;rio atualmente ativo:
            <?=$_SESSION['loggedInName']?>
		  </div>
            <?php
		}
	}
?>
		   <div class="hr"><hr /></div><br>
		   <!-- InstanceBeginEditable name="nav" --><a href="index.php">WebTester</a> &gt; Gerenciamento de Testes <!-- InstanceEndEditable --></div></td>
    </tr>
    <tr> 
      <td align="center" valign="top">		<div align="left"><!-- InstanceBeginEditable name="Content Area" --> 
		<?php
		if ($_SESSION['loggedIn'] != "1") redirect_to("index.php");
		?>
		<script type="text/javascript">
			function checkUncheckAll(theElement) {
     var theForm = theElement.form, z = 0;
	 for(z=0; z<theForm.length;z++){
      if(theForm[z].type == 'checkbox' && theForm[z].name != 'checkall'){
	  theForm[z].checked = theElement.checked;
	  }
     }
    }
		</script>
        <form action="deleteTest.php" method="post" name="delete" id="delete">
		<p><span class="style7">Gerenciamento de Teste</span></p>
          <table width="100%"  border="0" cellspacing="2" cellpadding="0">
            <tr bgcolor="#EBEBEB">
              <td width="40"><div align="center"><a href="addTest.php"><img src="../images/new.gif" alt="Create New Test" width="19" height="18" border="0" title="Create New Test"></a></div></td>
              <td width="40"><div align="center">
                <input type="image" id="Dup"  value="Dup" name="Dup" src="../images/duplicate.png" width="18" height="18" alt="Duplicate Test" title="Duplicate Test">
              </div></td>
			  <?php
			  $var1="";
			  $var2="";
			  $disabled = "";
			  if (isset($_REQUEST['view'])) {
			  	if ($_REQUEST['view']=="allTests") {
					$var1="selected";
					$disabled="disabled";
				} else {
					$var2="selected";
				}
			  } else {
			  	$var2="selected";
			  }
			  ?> 
              <td width="40"><div align="center">
                <input <?=$disabled?> type="image" alt="Delete Selected Tests" value="Delete Selected Tests" id="Del" name="Del" src="../images/delete<?=$disabled?>.png" width="18" height="18" title="Delete Selected Tests">
              </div></td>
              <td width="170" class="style1 style5">Ver:
                <select name="view" id="view" onChange="document.location.href='testManage.php?sort=<?=$_REQUEST['sort']?>&order=<?=$_REQUEST['order']?>&subject=<?=$_REQUEST['subject']?>&view='+this.value;">
                  <option value="allTests" <?=$var1?>>Todos Testes</option>
                  <option value="myTests" <?=$var2?>>Meus Testes</option>
                </select></td>
              <td bgcolor="#EBEBEB" class="style1 style5">Asunto: 
                <select name="subject" id="subject" onChange="document.location.href='testManage.php?sort=<?=$_REQUEST['sort']?>&order=<?=$_REQUEST['order']?>&view=<?=$_REQUEST['view']?>&subject='+this.value;">
				<option value="">Todos</option>
				<?php
				$subjectSQL="SELECT ID,Name from subjects";
				$subjectResult=mysqli_query($conn, $subjectSQL);
				while($subject = mysqli_fetch_assoc($subjectResult)) {
				if ($_REQUEST['subject']==$subject['ID']) {
					$sub="selected";
				} else {
					$sub="";
				}
				?>
				<option value="<?=$subject['ID']?>" <?=$sub?>><?=$subject['Name']?></option>
				<?php
				}
				?>
              </select></td>
            </tr>
          </table>
            <?php
			if (!isset($_REQUEST['sort'])) {
				$sort="TestName";
			} else {
				$sort=$_REQUEST['sort'];
				if ($sort=="") $sort="TestName";
			}
			if (!isset($_REQUEST['order'])) {
				$order="ASC";
			} else {
				$order=$_REQUEST['order'];
				if ($order=="") $order="ASC";
			}
			if (!isset($_REQUEST['subject'])) {
				$filterString="";
				$filterString2="";
			} else {
				$filterString=" AND Subject = " . $_REQUEST['subject'] . " ";
				$filterString2=" WHERE Subject = " . $_REQUEST['subject'] . " ";
				if ($_REQUEST['subject']=="") {
					$filterString="";
					$filterString2="";
				}
			}
   if ($var1 != "selected") {
	   $testsSQL="SELECT * FROM tests  WHERE Creator = '" . $_SESSION['loggedInName'] . "' " . $filterString . " ORDER by " . $sort . " " . $order;
	   // echo $testsSQL;
 } else {
	$testsSQL="SELECT * FROM tests  " . $filterString2 . " ORDER by " . $sort . " " . $order;
   }
$result=mysqli_query($conn, $testsSQL);
$num_rows=mysqli_num_rows($result);
if ($num_rows != 0) {
?>
<table class="style1 style5" width="100%"  border="0" cellspacing="2" cellpadding="0" onMouseOut="javascript:highlightTableRowVersionA(0);">
  <tr bgcolor="#C8D8FF">
    <td width="40" align="center"><input name="checkall" type="checkbox" class="style1 " id="checkall" value="checkall" onClick="checkUncheckAll(this);"></td>
    <td width="65" align="center"><span class="style1 style5"><a href="./testManage.php?sort=ID&order=ASC&view=<?=$_REQUEST['view']?>&subject=<?=$_REQUEST['subject']?>">ID<br>
      <img src="../images/down.gif" width="10" height="10" border="0"></a><a href="./testManage.php?sort=ID&order=DESC&view=<?=$_REQUEST['view']?>&subject=<?=$_REQUEST['subject']?>"><img src="../images/up.gif" width="10" height="10" border="0"></a> </span></td>
    <td align="center"><a href="./testManage.php?sort=TestName&order=ASC&view=<?=$_REQUEST['view']?>&subject=<?=$_REQUEST['subject']?>"><span class="style1 style5">Test Name</span><br>
      <img src="../images/down.gif" width="10" height="10" border="0"></a><a href="./testManage.php?sort=TestName&order=DESC&view=<?=$_REQUEST['view']?>&subject=<?=$_REQUEST['subject']?>"><img src="../images/up.gif" width="10" height="10" border="0"></a></td>
    <td align="center"><span class="style1 style5"><a href="./testManage.php?sort=Subject&order=ASC&view=<?=$_REQUEST['view']?>&subject=<?=$_REQUEST['subject']?>">Subject<br>
      <img src="../images/down.gif" width="10" height="10" border="0"></a><a href="./testManage.php?sort=Subject&order=DESC&view=<?=$_REQUEST['view']?>&subject=<?=$_REQUEST['subject']?>"><img src="../images/up.gif" width="10" height="10" border="0"></a> </span></td>
    <td width="120" align="center"><span class="style1 style5">Questions</span></td>
    <td width="60" align="center"><span class="style1 style5"><a href="./testManage.php?sort=Enabled&order=ASC&view=<?=$_REQUEST['view']?>&subject=<?=$_REQUEST['subject']?>">Enabled<br>
      <img src="../images/down.gif" width="10" height="10" border="0"></a><a href="./testManage.php?sort=Enabled&order=DESC&view=<?=$_REQUEST['view']?>&subject=<?=$_REQUEST['subject']?>"><img src="../images/up.gif" width="10" height="10" border="0"></a> </span></td>
  </tr>
<?php
	$i=0;
	while($row = mysqli_fetch_assoc($result)) {
	$i++;
	?>
	<tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
	<?php
		echo("<td width='40' align='center'><input name='delete[]' type='checkbox' value='" . $row['ID'] . "'></td>");
		echo("<td width='65' align='left'>" . $row['ID'] . "</td>");
		echo("<td align='left'><A class='pointer' HREF='editTest.php?TestID=" . $row['ID'] . "'>" . $row['TestName'] . "</A></td>");
		$subjectSQL="SELECT Name FROM subjects WHERE ID=" . $row['Subject'];
		$subjectResult=mysqli_query($conn, $subjectSQL);
		$subject=mysqli_fetch_assoc($subjectResult);
		echo("<td align='left'><a class='pointer' href='subjects.php'>" . $subject['Name'] . "</a></td>");
		$countSQL="SELECT * FROM questions WHERE TestID=" . $row['ID'];
		$countResult=mysqli_query($conn, $countSQL);
		$numQuestions=mysqli_num_rows($countResult);
		echo("<td width='120' align='left'><a class='pointer' href='questionEdit.php?TestID=" . $row['ID'] . "'>" . $numQuestions . " Questions</a></td>");
		if ($row['Enabled']) {
			echo("<td width='60' align='center'><a class='pointer' href='enableTest.php?enabled=0&TestID=" . $row['ID'] . "'><img src='../images/checked.gif' border='0'></a></td>");
		} else {
			echo("<td width='60' align='center'><a class='pointer' href='enableTest.php?enabled=1&TestID=" . $row['ID'] . "'><img src='../images/unchecked.gif' border='0'></a></td>");
		}
		echo("</tr>");
	}
	?>
	</table>
	<?php
}
		?>
          </p>
        </form>
        <p align="center">&nbsp;</p>
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
