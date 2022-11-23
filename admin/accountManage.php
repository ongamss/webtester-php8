<?php
ob_start();
// Copyright (C) 2003 - 2007 Eppler Software.  All rights reserved.
// Any redistribution or reproduction of any materials herein is strictly prohibited.
?>
<html><!-- InstanceBegin template="/Templates/Admin%20Layout.dwt.php" codeOutsideHTMLIsLocked="true" -->
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
        <p class="style4">User Accounts </p>
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
		   <!-- InstanceBeginEditable name="nav" --><a href="./index.php">WebTester</a> &gt; <a href="./preferences.php">Preferences</a> &gt; User Accounts <!-- InstanceEndEditable --></div></td>
    </tr>
    <tr> 
      <td align="center" valign="top">		<div align="left"><!-- InstanceBeginEditable name="Content Area" --> 
          <?php
		if ($_SESSION['loggedIn'] != "1") redirect_to("index.php");
		?>
          <span class="style7 style1">User Accounts </span>
          <form action="deleteUser.php" method="post" name="delete" id="delete">
            <?php
if(!isset($_REQUEST['sort'])) {
	$usersSQL="SELECT * FROM users ORDER by ID";
} else {
	$usersSQL="SELECT * FROM users ORDER by " . $_REQUEST['sort'];
}
$result=mysqli_query($conn, $usersSQL)
	or die("Invalid Query: " . $usersSQL . " - " . mysqli_error());
$num_rows=mysqli_num_rows($result);
if ($num_rows != 0) {
?>
          <table width="100%"  border="0" cellspacing="2" cellpadding="0">
            <tr bgcolor="#EBEBEB">
              <td width="40"><div align="center"><a href="addUser.php"><img src="../images/new.gif" alt="Create New User" width="19" height="18" border="0" title="Create New Test"></a></div></td>
              <td width="40"><div align="center">
                  <input type="image" alt="Delete Selected Users" value="Delete Selected Users" id="Del" name="Del" src="../images/delete.png" width="18" height="18" title="Delete Selected Users">
              </div></td>
              <td bgcolor="#EBEBEB" class="style1 style5"><?=$num_rows?> Records</td>
            </tr>
          </table>
		  <table class="style1 style5" width="100%"  border="0" cellspacing="2" cellpadding="0" onMouseOut="javascript:highlightTableRowVersionA(0);">
  <tr bgcolor="#C8D8FF">
    <td width="40" align="center"><input name="checkall" type="checkbox" class="style1 " id="checkall" value="checkall" onClick="checkUncheckAll(this);"></td>
    <td width="65" align="center"><span class="style1 style5"><a href="./accountManage.php?sort=ID">ID</a></span></td>
    <td width="160" align="center"><span class="style1 style5"><a href="./accountManage.php?sort=Username">Username</a></span></td>
    <td width="160" align="center"><a href="./accountManage.php?sort=LastName"><span class="style1 style5">Last Name</span></a></td>
    <td width="160" align="center"><a href="./accountManage.php?sort=FirstName">First Name </a></td>
    <td width="171" align="center"><span class="style1 style5"><a href="./accountManage.php?sort=Email">Email</a></span></td>
    <td width="171" align="center"><a href="./accountManage.php?sort=Location">Location</a></td>
    <td width="62" align="center"><a href="./accountManage.php?sort=Admin">Admin</a></td>
  </tr>
<?php
	$i = 0;
	while($row = mysqli_fetch_assoc($result)) {
	$i++;
	?>
	<tr class="d<?=$i & 1?>" style="cursor:pointer;" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
	<td align="center"><input name='delete[]' type="checkbox" value="<?=$row['ID']?>"></td>
	<td align="center" onClick="document.location.href='editUser.php?UserID=<?=$row['ID']?>';"><a href="editUser.php?UserID=<?=$row['ID']?>"><?=$row['ID']?></a></td>
	<td width="160" onClick="document.location.href='editUser.php?UserID=<?=$row['ID']?>';"><?=$row['Username']?></td>
	<td width="160" onClick="document.location.href='editUser.php?UserID=<?=$row['ID']?>';"><?=$row['LastName']?></td>
	<td width="160" onClick="document.location.href='editUser.php?UserID=<?=$row['ID']?>';"><?=$row['FirstName']?></td>
	<td onClick="document.location.href='editUser.php?UserID=<?=$row['ID']?>';"><?=$row['Email']?></td>
	<td onClick="document.location.href='editUser.php?UserID=<?=$row['ID']?>';"><?=$row['Location']?></td>
	<td align="center" onClick="document.location.href='editUser.php?UserID=<?=$row['ID']?>';"><?php if($row['Admin']) {
		?>
		<img src="../images/checked.gif">
		<?php
		} else {
		?>
		<img src="../images/unchecked.gif">
		<?php
		}
		?></td>
		</tr>
	<?php
	}
}
?>
	</table>
<?php
//	while($row = mysqli_fetch_assoc($result)) {
//		echo("<input name='delete[]' type='checkbox' value='" . $row['ID'] . "'> <A HREF='editUser.php?UserID=" . $row['ID'] . "'>" . $row['Username'] . "</A>");
//		echo("<BR>");
//	}
// }
?>
        </form>

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
