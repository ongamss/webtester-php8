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
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style8 {font-size: 14px}
-->
</style>
<style type="text/css">
<!--
.style9 {font-size: 16px}
-->
</style>
<style type="text/css">
<!--
.style10 {font-size: 24px}
-->
</style>
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
        <p class="style4">Adicionar Quest&atilde;o </p>
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
		   <!-- InstanceBeginEditable name="nav" --><a href="index.php">WebTester</a> &gt; <a href="./testManage.php">Gerenciamento de Teste</a> &gt; <a href="./editTest.php?TestID=<?=$_REQUEST['TestID']?>">Editar Teste</a> &gt; <a href="./questionEdit.php?TestID=<?=$_REQUEST['TestID']?>">Editor de Quest&atilde;o</a> &gt; Adicionar Quest&atilde;o <!-- InstanceEndEditable --></div></td>
    </tr>
    <tr> 
      <td align="center" valign="top">		<div align="left"><!-- InstanceBeginEditable name="Content Area" --> 
        <?php
	  if ($_SESSION['loggedIn'] != "1") {
	  	redirect_to("index.php");
		exit;
	  }
	  $_SESSION['redirectTo'] = "addQuestion.php?TestID=" . $_REQUEST['TestID'];
	  $_SESSION['TestID'] = $_REQUEST['TestID'];
	  if (!file_exists("../test-images/" . $_REQUEST['TestID'])) {
	  	mkdir("../test-images/" . $_REQUEST['TestID']);
	  }
	  ?>
          <p align="left" class="style7">Adicionar Quest&atilde;o</p>
        <form name="form1" method="post" action="insertQuestion.php">
          <table width="100%" border="0" cellpadding="0" cellspacing="2" onMouseOut="javascript:highlightTableRowVersionA(0);">
            <tr onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td bgcolor="#E2ECFF" width="125" valign="top"><span class="style1">Quest&atilde;o:</span><div class="style1" id="safari" style="visibility:hidden">(HTML Editor n&atilde;o suportadono Safari)</div></td>
              <td bgcolor="#E2ECFF" colspan="3">
			  <span class="style1">
                <textarea name="QuestionText" cols="80" rows="15" id="QuestionText"><?php
					function encodeHTML($sHTML)
					{
						$sHTML=ereg_replace("&","&amp;",$sHTML);
						$sHTML=ereg_replace("<","&lt;",$sHTML);
						$sHTML=ereg_replace(">","&gt;",$sHTML);
						return $sHTML;
					}

					if(isset($_POST["QuestionText"]))
					{
						$sContent=stripslashes($_POST['QuestionText']); //Remove slashes
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
						oEdit1.cmdAssetManager="modalDialogShow('<?=$rootdir?>assetmanager/assetmanager.php?TestID=<?=$_REQUEST['TestID']?>',640,445);";
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
						oEdit1.REPLACE("QuestionText");
					} else {
						document.getElementById('safari').style.visibility = 'visible'; 
					}
				</script>
              </span></td>
			  <td bgcolor="#E2ECFF" valign="top">&nbsp;</td>
            </tr>
            <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" title="Case insensitive.  If you enter an Resposta here, no other items will appear.">
              <td valign="top"><span class="style1">Explica&ccedil;&atilde;o:</span></td>
              <td colspan="4"><strong>
                <input name="Explanation" type="text" id="AnswerText2" size="60">
              </strong></td>
            </tr>
            <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" title="Case insensitive.  If you enter an Resposta here, no other items will appear.">
              <td width="125" valign="top"><span class="style1">Resposta Curta:</span></td>
              <td colspan="4">
                <input name="AnswerText" type="text" id="AnswerText" size="60"></td>
            </tr>
            <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="125" valign="top"><span class="style1">Resposta 1</span>:<br></td>
              <td><input name="Answer1" type="text" id="Answer112" size="60">
                <br>                </td>
              <td width="149" title="Selecione uma imagem a ser exibida com esta resposta."><span class="style1">Imagem:</span>
                <select name="AnswerPic1" id="AnswerPic1">
                  <option value="" selected> </option>
                  <?php
					  $files = "";
					  $file = "";
					  $image_dir = realpath("../test-images/" . $_REQUEST['TestID']);
					  if ($handle = opendir($image_dir)) {
					  	while (false !== ($file = readdir($handle))) {
					  		if ($file != "." && $file != ".." && $file != "Thumbs.db") {
					  			$files[] = $file;
					  		}
					  	}
					  	sort($files);
					  	foreach ($files as $file) {
		   			  ?>
                  <option value="<?=$file?>">
                  <?=$file?>
                  </option>
                  <?php
						}
					}
					  ?>
                </select></td>
              <td width="149" title="Selecione uma som a ser tocado com esta resposta."><span class="style1">Audio:</span>
                <select name="AnswerAud1" id="AnswerAud1">
                  <option value="" selected> </option>
                  <?php
					  $files = "";
					  $file = "";
					  $image_dir = realpath("../test-images/" . $_REQUEST['TestID']);
					  if ($handle = opendir($image_dir)) {
					  	while (false !== ($file = readdir($handle))) {
					  		if ($file != "." && $file != ".." && $file != "Thumbs.db") {
					  			if (strtolower(file_extension($file))=="mp3") {
									$files[] = $file;
								}
					  		}
					  	}
					  	sort($files);
					  	foreach ($files as $file) {
		   			  ?>
                  <option value="<?=$file?>">
                  <?=$file?>
                  </option>
                  <?php
						}
					}
					  ?>
                </select></td>
              <td width="95"><input name="A1" type="checkbox" id="A112" value="1">
                <span class="style1">Correta?</span></td>
            </tr>
            <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="125" valign="top" class="style1">Resposta 2:<br>                </td>
              <td class="style1"><input name="Answer2" type="text" id="Answer2" size="60">
                <br></td>
              <td width="149" class="style1" title="Selecione uma imagem a ser exibida com esta resposta.">Picture:
                <select name="AnswerPic2" id="select">
                  <option value="" selected> </option>
                  <?php
					  $files = "";
					  $file = "";
					  $image_dir = realpath("../test-images/" . $_REQUEST['TestID']);
					  if ($handle = opendir($image_dir)) {
					  	while (false !== ($file = readdir($handle))) {
					  		if ($file != "." && $file != ".." && $file != "Thumbs.db") {
					  			$files[] = $file;
					  		}
					  	}
					  	sort($files);
					  	foreach ($files as $file) {
		   			  ?>
                  <option value="<?=$file?>">
                  <?=$file?>
                  </option>
                  <?php
						}
					}
					  ?>
                </select></td>
              <td width="149" class="style1" title="Selecione uma imagem a ser exibida com esta resposta.">Audio:
                <select name="AnswerAud2" id="AnswerAud2">
                  <option value="" selected> </option>
                  <?php
					  $files = "";
					  $file = "";
					  $image_dir = realpath("../test-images/" . $_REQUEST['TestID']);
					  if ($handle = opendir($image_dir)) {
					  	while (false !== ($file = readdir($handle))) {
					  		if ($file != "." && $file != ".." && $file != "Thumbs.db") {
					  			if (strtolower(file_extension($file))=="mp3") {
									$files[] = $file;
								}
					  		}
					  	}
					  	sort($files);
					  	foreach ($files as $file) {
		   			  ?>
                  <option value="<?=$file?>">
                  <?=$file?>
                  </option>
                  <?php
						}
					}
					  ?>
                </select></td>
              <td width="95" class="style1"><input name="A2" type="checkbox" id="A2" value="1">
Correta?</td>
            </tr>
            <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="125" valign="top" class="style1">Resposta 3:<br>              </td>
              <td class="style1"><input name="Answer3" type="text" id="Answer32" size="60">
                <br></td>
              <td width="149" class="style1" title="Selecione uma imagem a ser exibida com esta resposta.">Picture:
                <select name="AnswerPic3" id="select2">
                  <option value="" selected> </option>
                  <?php
					  $files = "";
					  $file = "";
					  $image_dir = realpath("../test-images/" . $_REQUEST['TestID']);
					  if ($handle = opendir($image_dir)) {
					  	while (false !== ($file = readdir($handle))) {
					  		if ($file != "." && $file != ".." && $file != "Thumbs.db") {
					  			$files[] = $file;
					  		}
					  	}
					  	sort($files);
					  	foreach ($files as $file) {
		   			  ?>
                  <option value="<?=$file?>">
                  <?=$file?>
                  </option>
                  <?php
						}
					}
					  ?>
                </select></td>
              <td width="149" class="style1" title="Selecione uma imagem a ser exibida com esta resposta.">Audio:
                <select name="AnswerAud3" id="AnswerAud3">
                  <option value="" selected> </option>
                  <?php
					  $files = "";
					  $file = "";
					  $image_dir = realpath("../test-images/" . $_REQUEST['TestID']);
					  if ($handle = opendir($image_dir)) {
					  	while (false !== ($file = readdir($handle))) {
					  		if ($file != "." && $file != ".." && $file != "Thumbs.db") {
					  			if (strtolower(file_extension($file))=="mp3") {
									$files[] = $file;
								}
					  		}
					  	}
					  	sort($files);
					  	foreach ($files as $file) {
		   			  ?>
                  <option value="<?=$file?>">
                  <?=$file?>
                  </option>
                  <?php
						}
					}
					  ?>
                </select></td>
              <td width="95" class="style1"><input name="A3" type="checkbox" id="A32" value="1">
Correta?</td>
            </tr>
            <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="125" valign="top" class="style1">Resposta 4:<br>              </td>
              <td class="style1"><input name="Answer4" type="text" id="Answer42" size="60">                </td>
              <td width="149" class="style1" title="Selecione uma imagem a ser exibida com esta resposta.">Picture:
                <select name="AnswerPic4" id="select3">
                  <option value="" selected> </option>
                  <?php
					  $files = "";
					  $file = "";
					  $image_dir = realpath("../test-images/" . $_REQUEST['TestID']);
					  if ($handle = opendir($image_dir)) {
					  	while (false !== ($file = readdir($handle))) {
					  		if ($file != "." && $file != ".." && $file != "Thumbs.db") {
					  			$files[] = $file;
					  		}
					  	}
					  	sort($files);
					  	foreach ($files as $file) {
		   			  ?>
                  <option value="<?=$file?>">
                  <?=$file?>
                  </option>
                  <?php
						}
					}
					  ?>
                </select></td>
              <td width="149" class="style1" title="Selecione uma imagem a ser exibida com esta resposta.">Audio:
                <select name="AnswerAud4" id="AnswerAud4">
                  <option value="" selected> </option>
                  <?php
					  $files = "";
					  $file = "";
					  $image_dir = realpath("../test-images/" . $_REQUEST['TestID']);
					  if ($handle = opendir($image_dir)) {
					  	while (false !== ($file = readdir($handle))) {
					  		if ($file != "." && $file != ".." && $file != "Thumbs.db") {
					  			if (strtolower(file_extension($file))=="mp3") {
									$files[] = $file;
								}
					  		}
					  	}
					  	sort($files);
					  	foreach ($files as $file) {
		   			  ?>
                  <option value="<?=$file?>">
                  <?=$file?>
                  </option>
                  <?php
						}
					}
					  ?>
                </select></td>
              <td width="95" class="style1"><input name="A4" type="checkbox" id="A42" value="1">
Correta?</td>
            </tr>
            <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="125" valign="top" class="style1">Resposta 5:<br>              </td>
              <td class="style1"><input name="Answer5" type="text" id="Answer52" size="60">                </td>
              <td width="149" class="style1" title="Selecione uma imagem a ser exibida com esta resposta.">Picture:
                <select name="AnswerPic5" id="select4">
                  <option value="" selected> </option>
                  <?php
					  $files = "";
					  $file = "";
					  $image_dir = realpath("../test-images/" . $_REQUEST['TestID']);
					  if ($handle = opendir($image_dir)) {
					  	while (false !== ($file = readdir($handle))) {
					  		if ($file != "." && $file != ".." && $file != "Thumbs.db") {
					  			$files[] = $file;
					  		}
					  	}
					  	sort($files);
					  	foreach ($files as $file) {
		   			  ?>
                  <option value="<?=$file?>">
                  <?=$file?>
                  </option>
                  <?php
						}
					}
					  ?>
                </select></td>
              <td width="149" class="style1" title="Selecione uma imagem a ser exibida com esta resposta.">Audio:
                <select name="AnswerAud5" id="AnswerAud5">
                  <option value="" selected> </option>
                  <?php
					  $files = "";
					  $file = "";
					  $image_dir = realpath("../test-images/" . $_REQUEST['TestID']);
					  if ($handle = opendir($image_dir)) {
					  	while (false !== ($file = readdir($handle))) {
					  		if ($file != "." && $file != ".." && $file != "Thumbs.db") {
					  			if (strtolower(file_extension($file))=="mp3") {
									$files[] = $file;
								}
					  		}
					  	}
					  	sort($files);
					  	foreach ($files as $file) {
		   			  ?>
                  <option value="<?=$file?>">
                  <?=$file?>
                  </option>
                  <?php
						}
					}
					  ?>
                </select></td>
              <td width="95" class="style1"><input name="A5" type="checkbox" id="A52" value="1">
Correta?</td>
            </tr>
            <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
              <td width="125" valign="top" class="style1">Resposta 6:<br>              </td>
              <td class="style1"><input name="Answer6" type="text" id="Answer62" size="60">                </td>
              <td width="149" class="style1" title="Selecione uma imagem a ser exibida com esta resposta.">Picture:
                <select name="AnswerPic6" id="select5">
                  <option value="" selected> </option>
                  <?php
					  $files = "";
					  $file = "";
					  $image_dir = realpath("../test-images/" . $_REQUEST['TestID']);
					  if ($handle = opendir($image_dir)) {
					  	while (false !== ($file = readdir($handle))) {
					  		if ($file != "." && $file != ".." && $file != "Thumbs.db") {
					  			$files[] = $file;
					  		}
					  	}
					  	sort($files);
					  	foreach ($files as $file) {
		   			  ?>
                  <option value="<?=$file?>">
                  <?=$file?>
                  </option>
                  <?php
						}
					}
					  ?>
                </select></td>
              <td width="149" class="style1" title="Selecione uma imagem a ser exibida com esta resposta.">Audio:
                <select name="AnswerAud6" id="AnswerAud6">
                  <option value="" selected> </option>
                  <?php
					  $files = "";
					  $file = "";
					  $image_dir = realpath("../test-images/" . $_REQUEST['TestID']);
					  if ($handle = opendir($image_dir)) {
					  	while (false !== ($file = readdir($handle))) {
					  		if ($file != "." && $file != ".." && $file != "Thumbs.db") {
					  			if (strtolower(file_extension($file))=="mp3") {
									$files[] = $file;
								}
					  		}
					  	}
					  	sort($files);
					  	foreach ($files as $file) {
		   			  ?>
                  <option value="<?=$file?>">
                  <?=$file?>
                  </option>
                  <?php
						}
					}
					  ?>
                </select></td>
              <td width="95" class="style1"><input name="A6" type="checkbox" id="A62" value="1">
Correta?</td>
            </tr>
            <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" title="Point value of the question">
              <td width="125"><span class="style1">Pontos:</span></td>
              <td colspan="4"><span class="style1">
                <input name="Points" type="text" id="Points" value="1" size="5">
              </span></td>
              </tr>
            <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" title="Point value of the question">
              <td><span class="style1">Assunto:</span></td>
              <td colspan="4"><select name="subject" id="subject">
                <?php
	$subjectSQL="SELECT * FROM subjects";
	$subjectResult=mysqli_query($conn, $subjectSQL);
	while($subject = mysqli_fetch_assoc($subjectResult)) {
	?>
                <option value="<?=$subject['ID']?>">
                <?=$subject['Name']?>
                </option>
                <?php
	}
	?>
              </select></td>
            </tr>
            <tr> 
              <td colspan="5"> <div align="center" class="style1 style1"> 
                  <p>
                    <input type="hidden" name="TestID" value="<?=$_REQUEST['TestID']?>">
                    <input type="submit" name="Submit" value="Save">
                  </p>
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
