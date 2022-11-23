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
include "../includes/graphs.inc.php";
$disabled = "";

?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>WebTester Online Testing</title>
<meta http-equiv="refresh" content="15" />
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
        <p class="style4">Sess&otilde;es Atuais </p>
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
		   <!-- InstanceBeginEditable name="nav" --><a href="./index.php">WebTester</a> &gt; Sess&otilde;es Atuais <!-- InstanceEndEditable --></div></td>
    </tr>
    <tr> 
      <td align="center" valign="top">		<div align="left"><!-- InstanceBeginEditable name="Content Area" -->
       		<?php
		if ($_SESSION['loggedIn'] != "1") {
			redirect_to("index.php?ref=currentSessions.php");
			exit;
		}
		require_once("../includes/graphs.inc.php");
		$IDteste = filter_input(INPUT_GET, 'TestID');;
		

		if ($IDteste == "") {
			$sessionsSQL="SELECT * From sessions ORDER by ID";
		} else {
			$sessionsSQL="SELECT * From sessions WHERE TestID='" . $IDteste . "' ORDER by ID";
		}
		$result=mysqli_query($conn, $sessionsSQL);
		$num_rows=mysqli_num_rows($result);
//		$myRs=mysqli_fetch_assoc($result);
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
	    <p class="style7">Sess&otilde;es Atuais</p>
       <form action="deleteSessions.php" method="post">
       <table width="100%"  border="0" cellspacing="2" cellpadding="0">
         <tr bgcolor="#EBEBEB">
           <td width="40" bgcolor="#EBEBEB"><div align="center"> </div>
               <div align="center">
                 <input <?=$disabled?> type="image" alt="Clear Selected Sessions" value="Clear Selected Sessions" id="Del" name="Del" src="../images/delete.png" width="18" height="18" title="Clear Selected Sessions">
             </div></td>
           <td width="150" class="style1 style5"><?=$num_rows?>
      Sess&otilde;es</td>
           <td class="style1 style5">Ver: 
             <select name="view" id="view" onChange="document.location.href='currentSessions.php?TestID='+this.value;">
			 <option value="">Todas</option>
		  <?php 
		$testsSQL="SELECT * FROM tests ORDER by TestName";
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
			  <td align="center"><input name="checkall" type="checkbox" id="checkall" value="checkall" onClick="checkUncheckAll(this);"></td>
              <td>Sobrenome</td>
              <td>Nome</td>
              <td>Teste</td>
              <td>Progresso</td>
              <td>Tempo Inicial</td>
              <td>Finalizado</td>
              <td>ID</td>
              <td>Armazenado</td>
			  <td>Endre&ccedil;o IP</td>
            </tr>
          <?php
        $numRows=mysqli_num_rows($result);
		$i = 0;
		if ($numRows != 0) {
			while ($myRs = mysqli_fetch_assoc($result)) {
				if ($myRs['questionNumber'] / $myRs['numQuestions'] >= .9) {
					$color="#ff0000";
				} else {
					$color="darkgreen";
				}
				$i++
		   ?>
            <tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
			  <td align="center"><input type="checkbox" name="delete[]" value="<?=$myRs['ID']?>"></td>
              <td><?=$myRs['LastName']?></td>
              <td><?=$myRs['FirstName']?></td>
              <td><?=$myRs['TestName']?></td>
              <td>
			  <?php
			  $graph = new BAR_GRAPH("pBar");
			$graph->values = $myRs['questionNumber'] . ";" . $myRs['numQuestions'];
			$graph->barColor = "#C8D8FF";
			$graph->barBorder = "1px solid #808080";
			$graph->labelBGColor = "";
			$graph->barWidth = 10;
			$graph->barLength=.75;
			echo $graph->create();
			?>
			  <font color=<?=$color?>>
			  <?=$myRs['questionNumber']?>
			  of
			  <?=$myRs['numQuestions']?>	
			  </font></td>
              <td><?=date("n/j/Y g:i:s A",$myRs['StartTime'])?></td>
              <td>
			  <?php
			  if ($myRs['finished']) {
			  	?>
				Yes
				<?php
				} else {
				?>
				No
				<?php
				}
			  ?>
			  </td>
              <td><?=$myRs['ID']?></td>
              <td>
			  <?php
			  if ($myRs['finished']) {
			  	?>
				Yes
				<?php
				} else {
				?>
				No
				<?php
				}
			  ?>
			  </td>
			  <td><?=$myRs['IP']?></td>
            </tr></font>
          <?php
		  }
		  ?>
		  </table>
		    <div align="center"> 
              <p align="center"> 
                <?php
				$showButton=1;
		  } else {
		  $showButton=0;
		  echo("</table>");
		  $strSQL="SELECT * FROM answers";
		  $result=mysqli_query($conn, $strSQL);
		  $numRows=mysqli_num_rows($result);
		  // myRs.Open strSQL,testDB,1,3
		  if ($numRows == 0) {
		  	echo("<p align='center'>Sem Sess&otilde;es Atuais</p>");
		  } else {
		  ?>
		  <?php
		  if ($_REQUEST['TestID']=="") {
		  ?><br>
		  <font face="Arial, Helvetica, sans-serif">
          No current Sessions, however, there are uncleared Answer entries. Click 
          the 'Clean DB' button to clean up the database.</font>
		  <?php
		  }
		  ?>
                <?php echo("</form>") ?>
        <form action="cleardb.php" method="post">
          <input type="submit" value="Clean DB">
		  </form>
                <?php
			}
		  }
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
