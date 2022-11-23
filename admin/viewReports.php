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
$disabled = "";

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
        <p class="style4">Relat&oacute;rios</p>
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
      </table>       </td>
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
		   <!-- InstanceBeginEditable name="nav" --><a href="./index.php">WebTester</a> &gt; Relat&oacute;rios <!-- InstanceEndEditable --></div></td>
    </tr>
    <tr> 
      <td align="center" valign="top">		<div align="left"><!-- InstanceBeginEditable name="Content Area" --> 
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
        <p class="style7">Relat&oacute;rios</p>
		<?php
		if ($_SESSION['loggedIn'] != "1") {
			redirect_to("index.php?ref=viewReports.php");
			exit;
    }
    
    $sortOrder = filter_input(INPUT_GET, 'sortOrder');
    $idTeste =  filter_input(INPUT_GET, 'TestID');
        // if (isset($_REQUEST['sortOrder']) == "") {
    //   $sortOrder = "ID";
		// } else {
		// 	$sortOrder = $_REQUEST['sortOrder'];
    // }

    if ($sortOrder == "") {
      $sortOrder = "ID";
    } 
    // else {
		// 	$sortOrder = $GET['sortOrder'];
    // }

		if ($idTeste == "") {
			$resultsSQL="SELECT * FROM results ORDER by " . $sortOrder;
		} else {
      $resultsSQL="SELECT * FROM results WHERE TestID='" . $idTeste . "' ORDER by " . $sortOrder;
    }
    
    //echo "query .$resultsSQL";
		$result=mysqli_query($conn, $resultsSQL);
		$num_rows=mysqli_num_rows($result);
		?>
		<form action="deleteResults.php" method="post">
		<table width="100%"  border="0" cellspacing="2" cellpadding="0">
            <tr bgcolor="#EBEBEB">
              <td width="40"><div align="center">
                <input <?=$disabled?> type="image" alt="Delete Selected Reports" value="Delete Selected Reports" id="Del" name="Del" src="../images/delete.png" width="18" height="18" title="Delete Selected Reports">
              </div></td>
              <td width="150" class="style1 style5"><?=$num_rows?> Registros</td>
              <td bgcolor="#EBEBEB" class="style1 style5">Ver:
                <select name="view" id="view" onChange="document.location.href='viewReports.php?sortOrder=<?=$_REQUEST['sortOrder']?>&order=<?=$_REQUEST['order']?>&TestID='+this.value;">
		  	<option value="">Todos</option>
		  <?php
		$prefsSQL="SELECT * From preferences";
		$prefsResult=mysqli_query($conn, $prefsSQL);
		$prefs=mysqli_fetch_assoc($prefsResult);
		$notes=$prefs['notes'];  
		$testsSQL="SELECT * FROM tests  ORDER by TestName";
		$testsResult=mysqli_query($conn, $testsSQL)
			or die("Invalid Query: " . $testsSQL . " - " . mysqli_error());
		$num_test_rows=mysqli_num_rows($testsResult);
		  while($myRs = mysqli_fetch_assoc($testsResult)) {
		  	$testID=$_REQUEST['TestID'];
			if ($testID == "") $testID="0";
		  	 if (intval($myRs['ID']) == intval($testID)) {
			 	$var="selected";
			 } else {
			 	$var="";
			 }
            echo("<option value='" . $myRs['ID'] . "' " . $var . "> " . $myRs['TestName'] . "</option>");
		  }
		  ?>
                </select></td>
            </tr>
          </table>
          <table class="style1 style5" width="100%"  border="0" cellspacing="2" cellpadding="0" onMouseOut="javascript:highlightTableRowVersionA(0);">
            <tr bgcolor="#C8D8FF"> 
              <td align="center">
                <input name="checkall" type="checkbox" id="checkall" value="checkall" onClick="checkUncheckAll(this);">
              </td>
              <td><a href="viewReports.php?sortOrder=ID&TestID=<?=$_REQUEST['TestID']?>">ID</a></td>
              <td><a href="viewReports.php?sortOrder=LastName&TestID=<?=$_REQUEST['TestID']?>">Sobrenome</a></td>
              <td><a href="viewReports.php?sortOrder=FirstName&TestID=<?=$_REQUEST['TestID']?>">Nome</a></td>
              <td><a href="viewReports.php?sortOrder=Notes&TestID=<?=$_REQUEST['TestID']?>"><?=$notes?></a></td>
              <td><a href="viewReports.php?sortOrder=TestName&TestID=<?=$_REQUEST['TestID']?>">Nome do Teste</a></td>
              <td><a href="viewReports.php?sortOrder=TestID&TestID=<?=$_REQUEST['TestID']?>">IDteste</a></td>
              <td><a href="viewReports.php?sortOrder=Score&TestID=<?=$_REQUEST['TestID']?>">Pontos</a></td>
              <td><a href="viewReports.php?sortOrder=Pass&TestID=<?=$_REQUEST['TestID']?>">Passou?</a></td>
              <td><a href="viewReports.php?sortOrder=TotalTime&TestID=<?=$_REQUEST['TestID']?>">Tempo Decorrido</a></td>
              <td><a href="viewReports.php?sortOrder=StartTime&TestID=<?=$_REQUEST['TestID']?>">In&iacute;cio</a></td>
              <td><a href="viewReports.php?sortOrder=EndTime&TestID=<?=$_REQUEST['TestID']?>">Final</a></td>
              <td><a href="viewReports.php?sortOrder=NumCorrect&TestID=<?=$_REQUEST['TestID']?>">Pts Obtidos</a></td>
              <td><a href="viewReports.php?sortOrder=NumPossible&TestID=<?=$_REQUEST['TestID']?>">Total Pts</a></td>
              <td><a href="viewReports.php?sortOrder=IPAddress&TestID=<?=$_REQUEST['TestID']?>">IP</a></td>
            </tr>
            <?php
			$i = 0;
		if ($num_rows != 0) {
			while($myRs=mysqli_fetch_assoc($result)) {
			$i++;
		?>
            <tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');"> 
              <td> 
                <input type="checkbox" name="delete[]" value="<?=$myRs['ID']?>"> 
                </td>
              <td>				
				<a href="viewReportUser.php?STime=<?=$myRs['StartTime']?>">
                <?=$myRs['ID']?>
				</a>
                </td>
              <td>
                <?=$myRs['LastName']?>
                </td>
              <td>
                <?=$myRs['FirstName']?>
                </td>
              <td>
                <?=$myRs['Notes']?>
                </td>
              <td>
                <?=$myRs['TestName']?>
                </td>
              <td>
                <?=$myRs['TestID']?>
                </td>
              <td>
                <?=$myRs['Score']?>
                </td>
              <td>
                <?=$myRs['Pass']?>
                </td>
              <td>
                <?=$myRs['TotalTime']?>
                </td>
              <td>
                <?=date("n/j/Y g:i:s A",$myRs['StartTime'])?>
                </td>
              <td>
                <?=date("n/j/Y g:i:s A",$myRs['EndTime'])?>
                </td>
              <td>
                <?=$myRs['NumCorrect']?>
                </td>
              <td>
                <?=$myRs['NumPossible']?>
                </td>
              <td>
                <?=$myRs['IPAddress']?>
                </td>
            </tr>
            <?php
		  	}
		  }
		  ?>
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
