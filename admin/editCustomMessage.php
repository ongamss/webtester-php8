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
        <p class="style4">Edit Custom Message</p>
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
		   <!-- InstanceBeginEditable name="nav" --><a href="index.php">WebTester</a> &gt; <a href="./preferences.php">Preferences</a> &gt; <a href="./reportTemplates.php">Report Templates</a> &gt; <a href="./editReportTemplate.php?ID=<?=$_REQUEST['reportID']?>">Edit Report Template</a> &gt; Edit Custom Message<!-- InstanceEndEditable --></div></td>
    </tr>
    <tr> 
      <td align="center" valign="top">		<div align="left"><!-- InstanceBeginEditable name="Content Area" --> 
        <?php
	  if ($_SESSION['loggedIn'] != "1") {
	  	redirect_to("index.php");
		exit;
	  }
	  $messageSQL="SELECT * FROM custommessages WHERE ID=" . $_REQUEST['messageID'];
	  $myRsRes=mysqli_query($conn, $messageSQL);
	  $row=mysqli_fetch_assoc($myRsRes);
      ?>
          <p align="left" class="style7">Edit Custom Message</p>
        <form name="form1" method="post" action="updateCustomMessage.php">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="2" onMouseOut="javascript:highlightTableRowVersionA(0);">
            <tr onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td valign="top" bgcolor="#E2ECFF"><span class="style1">Description:</span></td>
              <td width="298" bgcolor="#E2ECFF"><strong>
                <input name="desc" type="text" id="desc" value="<?=$row['Description']?>" size="60">
              </strong></td>
              <td width="95" bgcolor="#E2ECFF"></td>
            </tr>
            <tr onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');"> 
              <td width="125" valign="top" bgcolor="#E2ECFF"> <div align="left" class="style1">Message:</div><div id="safari" style="visibility:hidden" class="style1">(HTML Editor not supported in Safari)</div></td>
              <td bgcolor="#E2ECFF">
                <textarea name="message" cols="80" rows="15" id="message"><?=$row['Message']?><?php
					function encodeHTML($sHTML)
					{
						$sHTML=ereg_replace("&","&amp;",$sHTML);
						$sHTML=ereg_replace("<","&lt;",$sHTML);
						$sHTML=ereg_replace(">","&gt;",$sHTML);
						return $sHTML;
					}

					if(isset($_POST["message"]))
					{
						$sContent=stripslashes($_POST['message']); //Remove slashes
						echo encodeHTML($sContent);
					}
					$scriptpath=pathinfo($_SERVER['PHP_SELF']);
					$thedir=$scriptpath['dirname'];
					$rootdir=cleanPath($thedir . "/../");
				?></textarea>
				<script>
					if (!checkIt('safari'))
					{
						var oEdit1 = new InnovaEditor("oEdit1");
						oEdit1.width="100%";
						oEdit1.height="350px";
						oEdit1.arrStyle=[["BODY",false,"","background:white;"]];
						/* oEdit1.cmdAssetManager="modalDialogShow('<?=$rootdir?>assetmanager/assetmanager.php?TestID=<?=$_REQUEST['TestID']?>',640,445);"; */
						oEdit1.btnPrint=true;
						oEdit1.btnPasteText=true;
						oEdit1.btnFlash=true;
						oEdit1.btnMedia=true;
						oEdit1.btnLTR=true;
						oEdit1.btnRTL=true;
						oEdit1.btnSpellCheck=true;
						oEdit1.btnStrikethrough=true;
						oEdit1.btnSuperscript=true;
						oEdit1.btnSubscript=true;
						oEdit1.btnClearAll=true;
						oEdit1.REPLACE("message");
					} else {
						document.getElementById('safari').style.visibility = 'visible'; 
					}
				</script>			 </td>
              <td bgcolor="#E2ECFF"></td>
            </tr>
            <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" title="Minimum Points in the range">
              <td class="style1">Minimum Points:</td>
              <td colspan="2"><strong>
                <input name="minPoints" type="text" id="minPoints" value="<?=$row['MinPoints']?>" size="60">
              </strong></td>
            </tr>
            <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" title="Maximum Points in the range">
              <td width="125" class="style1">Maximum Points:</td>
              <td colspan="2"><strong>
                <input name="maxPoints" type="text" id="maxPoints" value="<?=$row['MaxPoints']?>" size="60">
              </strong></td>
            </tr>
            <tr>
              <td colspan="3"><div align="center">
                  <input type="hidden" name="messageID" value="<?=$_REQUEST['messageID']?>">
                  <input type="hidden" name="reportID" value="<?=$_REQUEST['reportID']?>">
                  <input type="submit" name="Submit" value="Save">
              </div></td>
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
