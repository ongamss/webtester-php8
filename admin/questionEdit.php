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
        <p class="style4">Editor de Quest&atilde;o </p>
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
		   <!-- InstanceBeginEditable name="nav" --><a href="index.php">WebTester</a> &gt; <a href="./testManage.php">Gerenciamento de Teste</a> &gt; <a href="./editTest.php?TestID=<?=$_REQUEST['TestID']?>">Editor de Teste</a> &gt; Editor de Quest&atilde;o <!-- InstanceEndEditable --></div></td>
    </tr>
    <tr> 
      <td align="center" valign="top">		<div align="left"><!-- InstanceBeginEditable name="Content Area" --> 
        <?php
		if ($_SESSION['loggedIn'] != "1") {
			redirect_to("index.php");
			exit;
		}
		$questionsSQL="SELECT * FROM questions WHERE TestID='" . $_REQUEST['TestID'] . "' ORDER BY 'sortOrder' ASC, 'ID' ASC";
		$myRsRes=mysqli_query($conn, $questionsSQL);
		$num_rows=mysqli_num_rows($myRsRes);
		require_once('../includes/questions.php');
		$questions=getQuestions($_REQUEST['TestID']);
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
		<script type="text/javascript" src="../includes/scriptaculous/prototype.js"></script>
        <script type="text/javascript" src="../includes/scriptaculous/scriptaculous.js"></script>
		<script type="text/javascript">
		function change(id, newClass) {
			identity=document.getElementById(id);
			identity.className=newClass;
			}
		</script>
		<p><span class="style7">Editor de  Quest&atilde;o</span></p>
		<form name="form1" method="post" action="deleteQuestion.php">
        <table width="100%"  border="0" cellspacing="2" cellpadding="0">
          <tr bgcolor="#EBEBEB">
            <td width="40"><div align="center"><a href="addQuestion.php?TestID=<?=$_REQUEST['TestID']?>"><img src="../images/new.gif" alt="Criar nova quest&atilde;o" width="19" height="18" border="0" title="Criar nova quest&atilde;o"></a></div></td>
            <td width="40" bgcolor="#EBEBEB"><div align="center"><a href="reorderQuestions.php?TestID=<?=$_REQUEST['TestID']?>"><img src="../images/reorder.gif" alt="Reordenar quest&otilde;es" width="16" height="16" border="0" class="pointer" title="Reordenar quest&otilde;es"></a></div></td>
            <td width="40" bgcolor="#EBEBEB"><div align="center"><a class="pointer" href="questionStats.php?TestID=<?=$_REQUEST['TestID']?>"><img src="../images/questionstats.png" width="18" height="18" border="0" title="Question Statistics"></a></div></td>
            <td width="40" bgcolor="#EBEBEB"><div align="center">            </div>              <div align="center">
                  <input <?=$disabled?> type="image" alt="Deletar Quest&otilde;es selecionadas" value="Delete Selected Questions" id="Del" name="Del" src="../images/delete.png" width="18" height="18" title="Deletar Quest&otilde;es selecionadas">
                          </div></td>
            <td class="style1 style5">
              <?=$num_rows?> Quest&otilde;es</td>
            </tr>
        </table>
        <?php
		if ($num_rows != 0) {
		$i=1;
		?>
        <table width="100%"  border="0" cellpadding="0" cellspacing="2" class="style1 style5" onMouseOut="javascript:highlightTableRowVersionA(0);">
          <tr bgcolor="#C8D8FF">
            <td width="40"><div align="center">
              <input name="checkall" type="checkbox" id="checkall" value="checkall" onClick="checkUncheckAll(this);">
            </div></td>
            <td width="100"><div align="center">ID</div></td>
            <td width="100"><div align="center">Ordem </div></td>
            <td colspan="4" width="100"><div align="center">A&ccedil;oes</div></td>
            <td><div align="center">Quest&atilde;o</div></td>
          </tr>
		<?php
		// while($row = mysqli_fetch_assoc($myRsRes)) {
		foreach ($questions as $question_id => $questiontext) {
		?>
		<tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
		<td width="40" align="center"><input name="delete[]" type="checkbox" value="<?=$question_id?>"></td>
		<td width="100" align="center"><?=$question_id?></td>
		<td width="100" align="center"><?=$i?></td>
		<td width="33" align="center"><A class="pointer" HREF="editQuestion.php?quesID=<?=$question_id?>&TestID=<?=$_REQUEST['TestID']?>"><img src="../images/edit.png" alt="Editar" width="16" height="16" border="0" title="Editar Quest&atilde;o"></a></td>
		<td width="33" align="center"><a class="pointer" href="reorderQuestions.php?TestID=<?=$_REQUEST['TestID']?>"><img src="../images/reorder.gif" alt="Reordenar Quest&otilde;es" width="16" height="16" border="0" title="Reordenar Quest&otilde;es"></a></td>
		<td width="33" align="center"><a class="pointer" href="questionStats.php?quesID=<?=$question_id?>&TestID=<?=$_REQUEST['TestID']?>"><img src="../images/questionstats.png" width="18" height="18" border="0" title="Estatisticas de Quest&otilde;es"></a></td>
		<td width="33" align="center"><A class="pointer" HREF="deleteQuestion.php?quesID=<?=$question_id?>&TestID=<?=$_REQUEST['TestID']?>"><img src="../images/delete.png" alt="Delete" width="18" height="18" border="0" title="Deletar Quest&otilde;es"></a></td>
		<td class="pointer" align="left" onClick="document.location.href='editQuestion.php?quesID=<?=$question_id?>&TestID=<?=$_REQUEST['TestID']?>';"><?=strip_tags($questiontext)?></td>
			</tr>
			<?php
			$i++;
			}
			?>
			</table>
			<?php
		} else {
		?>
		    <div align="center"><span class="style1">N&atilde; exitem quest&otilde;es para este teste.  Click <a href="addQuestion.php?TestID=<?=$_REQUEST['TestID']?>"><img src="../images/new.gif" width="19" height="18" border="0"></a> to create a new question.</span>		      <?php
		}
		?>
              </p>
		      <input type="hidden" name="TestID" value="<?=$_REQUEST['TestID']?>">
		    </div>
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
