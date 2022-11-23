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
        <p class="style4">Edit User </p>
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
		   <!-- InstanceBeginEditable name="nav" --><a href="./index.php">WebTester</a> &gt; <a href="./preferences.php">Preferences</a> &gt; <a href="./accountManage.php">User Accounts</a> &gt; Edit User <!-- InstanceEndEditable --></div></td>
    </tr>
    <tr> 
      <td align="center" valign="top">		<div align="left"><!-- InstanceBeginEditable name="Content Area" -->
          <p class="style7">Edit User </p>
          <?php
		  if ($_SESSION['loggedIn'] != "1") {
		  	redirect_to("index.php");
			exit;
		  }
		  if ($_REQUEST['UserID'] == "") {
		  	redirect_to("accountManage.php");
			exit;
		  }
		  $usersSQL="SELECT * FROM users WHERE ID=" . $_REQUEST['UserID'];
		  $result=mysqli_query($conn, $usersSQL)
		  	or die("Invalid Query: " . $usersSQL . " - " . mysqli_error());
		  $myRs=mysqli_fetch_assoc($result);
		  ?>
        <form action="updateUser.php" method="post" name="updateUser" id="updateUser">
          <table class="style1" width="100%"  border="0" cellspacing="2" cellpadding="0" onMouseOut="javascript:highlightTableRowVersionA(0);">
            <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="172">Username:</td>
              <td><input name="Username" type="text" id="Username" value="<?=$myRs['Username']?>"></td>
            </tr>
            <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="172">New Password:</td>
              <td><input name="Password" type="password" id="Password"><?php if (filter_input(INPUT_GET,'error')=="password") echo("<font color=red>Passwords did not match</font>");?></td>
            </tr>
            <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="172">Confirm Password: </td>
              <td><input name="ConfirmPassword" type="password" id="ConfirmPassword"></td>
            </tr>
            <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="172">First Name: </td>
              <td><input name="firstname" type="text" id="firstname" value="<?=$myRs['FirstName']?>"></td>
            </tr>
            <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="172">Last Name: </td>
              <td><input name="lastname" type="text" id="lastname" value="<?=$myRs['LastName']?>"></td>
            </tr>
            <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="172">Location:</td>
              <td><input name="Location" type="text" id="Location" value="<?=$myRs['Location']?>"></td>
            </tr>
            <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="172">Email Address: </td>
              <td><input name="email" type="text" id="email" value="<?=$myRs['Email']?>"></td>
            </tr>
            <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td>Allowed Subjects </td>
              <td><p>
			  		<?php
					if($myRs['Limited']) {
						$allchecked="";
						$limitedchecked="checked";
					} else {
						$allchecked="checked";
						$limitedchecked="";
					}
					?>
                    <input name="limited" type="radio" value="all" <?=$allchecked?>>
                All<br>
                  <input name="limited" type="radio" value="limited" <?=$limitedchecked?>>
                Limited</p>
				<p>
				<?php
				$subjectSQL="SELECT * FROM subjects ORDER by NAME ASC";
				$result=mysqli_query($conn, $subjectSQL);
				$num_rows=mysqli_num_rows($result);
				if ($num_rows != 0) {
					while($row = mysqli_fetch_assoc($result)) {
						$checked="";
						$limitedSubject=explode(",",$myRs['LimitedSubjects']);
						foreach ($limitedSubject as $l) {
							if($l==$row['ID']) $checked="checked";
						}
				?>
                <input name='subject[]' type='checkbox' value='<?=$row['ID']?>' <?=$checked?>><?=$row['Name']?><br>
				<?php
					}
				}
				?>
				</p></td>
            </tr>
            <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td>ID Tentativas de teste </td>
              <td><input name="Attempts" type="text" id="Attempts" value="<?=$myRs['Attempts']?>"></td>
            </tr>
            <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td>ID Testes aprovados</td>
              <td><input name="Attempts2" type="text" id="Attempts2" value="<?=$myRs['Attempts']?>"></td>
            </tr>
            <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="172">Administrator</td>
			  <?php
			  if ($myRs['Admin']) {
			  	$admin="checked";
			  }
				else{
					$admin = "";
				}
			  ?>
              <td><input name="admin" type="checkbox" id="admin" value="admin" <?=$admin?>></td>
            </tr>
            <tr>
              <td colspan="2"><input name="Save" type="submit" id="Save" value="Save">
                <input name="UserID" type="hidden" value="<?=$myRs['ID']?>"></td>
              </tr>
          </table>
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
