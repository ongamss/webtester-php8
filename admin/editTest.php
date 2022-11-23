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
$disabled="";
$allowSave="";

?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>WebTester Online Testing</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style8 {font-size: 10px}
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
        <p class="style4">Edit Test </p>
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
          <div align="center">Usu&aacute;rio atualmente ativo:
            <?=$_SESSION['loggedInName']?>
		  </div>
            <?php
		}
	}
?>
		   <div class="hr"><hr /></div><br>
		   <!-- InstanceBeginEditable name="nav" --><a href="index.php">WebTester</a> &gt; <a href="./testManage.php">Gerenciado de teste</a> &gt; Editor de Teste <!-- InstanceEndEditable --></div></td>
    </tr>
    <tr> 
      <td align="center" valign="top">		<div align="left"><!-- InstanceBeginEditable name="Content Area" -->
              <?php
		if ($_SESSION['loggedIn'] != "1") {
			redirect_to("index.php");
			exit;
		}
		if ($_REQUEST['TestID']=="") redirect_to("testManage.php");
		$_SESSION['redirectTo']="editTest.php?TestID=" . $_REQUEST['TestID'];
		if (!file_exists("../test-images/" . $_REQUEST['TestID'])) {
			mkdir("../test-images/" . $_REQUEST['TestID']);
		}
		$questionsSQL="SELECT * FROM questions WHERE TestID='" . $_REQUEST['TestID'] . "'";
		$myRsRes=mysqli_query($conn, $questionsSQL);
		$myRs=mysqli_fetch_assoc($myRsRes);
		$numQuestions=mysqli_num_rows($myRsRes);
		if ($numQuestions <= 0) $numQuestions=0;
		$testsSQL="SELECT * FROM tests  WHERE ID=" . $_REQUEST['TestID'];
		$myRsRes=mysqli_query($conn, $testsSQL);
		$myRs=mysqli_fetch_assoc($myRsRes);
	
		//if ($myRs['RequiredTests'] == NULL) $myRs['RequiredTests'] = "";
		  ?>
            <p><span class="style7">Edit Test</span></p>
			<form action="updateTest.php" method="post" name="updateTest" id="updateTest">
            <table width="100%"  border="0" cellspacing="2" cellpadding="0" onMouseOut="javascript:highlightTableRowVersionA(0);">
              <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td width="172"><span class="style1">Name:</span></td>
                <td><input name="TestName" type="text" id="testName" value="<?=$myRs['TestName']?>" size="60"></td>
                <td>&nbsp;</td>
              </tr>
              <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td width="172" class="style1">Pontua&ccedil;&atilde;o p/ passar:</td>
                <td><p>
                  <input name="PassingScore" type="text" id="passingScore" value="<?=$myRs['PassingScore']?>" size="2" maxlength="2">
                  <span class="style1">%</span></p>               </td>
                <td>&nbsp;</td>
              </tr>
              <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td width="172" valign="top"><span class="style1">Quest&otilde;es:</span></td>
                <td><span class="style1">
                  <?=$numQuestions?> Quest&otilde;es (<a href="questionEdit.php?TestID=<?=$_REQUEST['TestID']?>">Editar</a>) </span></td>
                <td>&nbsp;</td>
              </tr>
              <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td width="172" valign="top" class="style1">Instru&ccedil;&otilde;es: <div id="safari" style="visibility:hidden">(HTML editor not supported in Safari)</div></td>
                <td><strong>
                  <textarea name="Directions" cols="80" rows="15" id="directions"><?=$myRs['Directions']?><?php
					function encodeHTML($sHTML)
					{
						$sHTML=ereg_replace("&","&amp;",$sHTML);
						$sHTML=ereg_replace("<","&lt;",$sHTML);
						$sHTML=ereg_replace(">","&gt;",$sHTML);
						return $sHTML;
					}

					if(isset($_POST["directions"]))
					{
						$sContent=stripslashes($_POST['directions']); //Remove slashes
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
						oEdit1.REPLACE("directions");
					} else {
						document.getElementById('safari').style.visibility = 'visible'; 
					}
				</script>
                </strong></td>
                <td>&nbsp;</td>
              </tr>
              <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td width="172" valign="top"><span class="style1">Assunto:</span></td>
                <td><select name="subject" id="subject">
				<?php
	$subjectSQL="SELECT * FROM subjects";
	$subjectResult=mysqli_query($conn, $subjectSQL);
	while($subject = mysqli_fetch_assoc($subjectResult)) {
	if ($subject['ID']==$myRs['Subject']) {
		$selected="selected";
	} else {
		$selected="";
	}
	?>
	<option value="<?=$subject['ID']?>" <?=$selected?>><?=$subject['Name']?></option>
	<?php
	}
	?>
                </select></td>
                <td>&nbsp;</td>
              </tr>
              <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td width="172" valign="top"><span class="style1">
                  <label>Habilitado:</label>
                </span></td>
                <td onClick="getElementById('enabled').checked=!getElementById('enabled').checked;"><?php
			$var1="";
			$var2="";
			$var3="";
			$var4="";
			$var5="";
			$var6="";
			$var7="";
			$var8="";
			$var9="";
			$var10="";
			if ($myRs['Enabled']==1) $var1="checked";
			if ($myRs['Random']==1) $var2="checked";
			if ($myRs['RequireLogin']==1) $var3="checked";
			if ($myRs['LimitTime']==1) {
				$var4="checked";
			} else {
				$disabled="disabled";
			}
			if ($myRs['EmailInstructor']==1) $var5="checked";
			if ($myRs['EmailUsers']==1) $var6="checked";
			if ($myRs['AutoSession']==1) $var7="checked";
			if ($myRs['AllowQuit']==1) $var8="checked";
			if ($myRs['Browseable']==1) $var9="checked";
			if ($myRs['AltEmail']==1) $var10="checked";
			?>
                  <span class="style1">Marque esta caixa para habilitar este teste </span></td>
                <td><input type="checkbox" name="enabled" value="1" <?=$var1?> id="enabled"></td>
              </tr>
              <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td valign="top"><span class="style1">
                  <label>Naveg&aacute;vel:</label>
                </span></td>
                <td onClick="getElementById('browseable').checked=!getElementById('browseable').checked;"><span class="style1">Marque esta caixa para mostrar o text na p&aacute;gina principal</span></td>
                <td><input type="checkbox" name="browseable" value="1" <?=$var9?> id="browseable"></td>
              </tr>
              <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td width="172" valign="top"><span class="style1">Quest&otilde;es Aleat&oacute;rias:</span></td>
                <td onClick="getElementById('random').checked=!getElementById('random').checked;"><span class="style1"> Marque esta caixa para que as quest&otilde;es sejam embaralhadas no in&iacute;cio do teste </span></td>
                <td><input type="checkbox" name="random" value="1" <?=$var2?> id="random"></td>
              </tr>
              <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td width="172" valign="top"><span class="style1">Login requerido: </span></td>
                <td  onClick="getElementById('login').checked=!getElementById('login').checked;"><span class="style1">Marque esta caixa para exigir que os usu&aacute;rios fa&ccedil;am login para iniciar o teste </span></td>
                <td><input type="checkbox" name="RequireLogin" value="1" <?=$var3?> id="login"></td>
              </tr>
              <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td width="172" valign="top"><span class="style1">Email para Instrutor:</span></td>
                <td onClick="getElementById('emailInstructor').checked=!getElementById('emailInstructor').checked;"><div align="center" class="style1">
                  <div align="left">Marque esta caixa para ter os resultados enviados para o email do instrutor do teste </div>
                </div></td>
                <td><input name="emailInstructor" type="checkbox" id="emailInstructor" value="1" <?=$var5?>></td>
              </tr>
              <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td width="172" valign="top"><span class="style1">Email para participante:</span></td>
                <td onClick="getElementById('emailUsers').checked=!getElementById('emailUsers').checked;"><div align="center" class="style1">
                  <div align="left">Marque esta caixa para ter os resultados enviados para o email do participante do teste </div>
                </div></td>
                <td><input name="emailUsers" type="checkbox" id="emailUsers" value="1" <?=$var6?>></td>
              </tr>
              <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td onClick="getElementById('altemail').checked=!getElementById('altemail').checked;" valign="top"><span class="style1">Email alternativo:</span></td>
                <td onClick="getElementById('altemail').checked=!getElementById('altemail').checked;"><span class="style1">Marque esta caixa para ativar campo de email alternativo</span></td>
                <td><input name="altemail" type="checkbox" id="altemail" value="1" <?=$var10?>></td>
              </tr>
              <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td onClick="getElementById('allowQuit').checked=!getElementById('allowQuit').checked;" valign="top"><span class="style1">Permitir sair: </span></td>
                <td onClick="getElementById('allowQuit').checked=!getElementById('allowQuit').checked;"><span class="style1">Marque esta caixa para que os usu&aacute;rios encerrem um teste inicial </span></td>
                <td><input name="allowQuit" type="checkbox" id="allowQuit" value="1" <?=$var8?>></td>
              </tr>
              <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td onClick="getElementById('autoSession').checked=!getElementById('autoSession').checked;" valign="top"><span class="style1">Auto reiniciar sess&atilde;o: </span></td>
                <td onClick="getElementById('autoSession').checked=!getElementById('autoSession').checked;"><span class="style1">Marque esta caixa para permitir que os participantes redefinal automaticamente as esta&ccedil;&oatilde;es de trabalho no final de um teste </span></td>
                <td><input name="autoSession" type="checkbox" id="autoSession" value="1" <?=$var7?>></td>
              </tr>
              <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td valign="top"><span class="style1">M&aacute;ximo de Tentativas </span></td>
                <td><input name="MaxAttempts" type="text" id="MaxAttempts" value="<?=$myRs['MaxAttempts']?>" size="4" maxlength="4">
                  <span class="style1">(Digite 0 para permitir tentativas ilimitadas. Login Requerido deve estar ativado.)</span> </td>
                <td>&nbsp;</td>
              </tr>
              <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td valign="top"><span class="style1">Modelo de Email: </span></td>
                <td><select name="emailTemplate" id="emailTemplate">
	<?php
	$emailSQL="SELECT * FROM emailtemplates";
	$emailResult=mysqli_query($conn, $emailSQL);
	while($email = mysqli_fetch_assoc($emailResult)) {
	if ($email['ID']==$myRs['EmailTemplate']) {
		$selected="selected";
	} else {
		$selected="";
	}
	?>
	<option value="<?=$email['ID']?>" <?=$selected?>><?=$email['Name']?></option>
	<?php
	}
	?>
	</select></td>
                <td>&nbsp;</td>
              </tr>
              <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td valign="top"><span class="style1">Modelo de Relat&oacute;rio: </span></td>
                <td><select name="reportTemplate" id="reportTemplate">
				<?php
	$reportSQL="SELECT * FROM reporttemplates";
	$reportResult=mysqli_query($conn, $reportSQL);
	while($report = mysqli_fetch_assoc($reportResult)) {
	if ($report['ID']==$myRs['ReportTemplate']) {
		$selected="selected";
	} else {
		$selected="";
	}
	?>
	<option value="<?=$report['ID']?>" <?=$selected?>><?=$report['Name']?></option>
	<?php
	}
	?>
                </select></td>
                <td>&nbsp;</td>
              </tr>
              <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td width="172" valign="top"><span class="style1">Tempo limite: </span></td>
                <td><div align="left" class="style1 style8">
                      <input name="TimeHours" type="text" id="TimeHours" value="<?=sprintf("%02d",$myRs['TimeLimitH'])?>" size="2" maxlength="2" <?=$disabled?>>
                      h : 
                      <input name="TimeMinutes" type="text" id="TimeMinutes" value="<?=sprintf("%02d",$myRs['TimeLimitM'])?>" size="2" maxlength="2" <?=$disabled?>>
                      m
                </div></td>
                <td><input name="TimeEnabled" type="checkbox" id="timelimit" value="1" <?=$var4?> onClick="getElementById('TimeHours').disabled=!(this.checked); getElementById('TimeMinutes').disabled=!(this.checked); return true;"></td>
              </tr>
              <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td valign="top"><span class="style1">N&uacute;mero de quest&otilde;es</span></td>
                <td>
                  <input name="QuestionLimit" type="text" id="QuestionLimit" value="<?=$myRs['QuestionLimit']?>" size="4" maxlength="4">
                  <span class="style1">(Digite 0 para todas as quest&otilde;es atribu&iacute;das a este teste)</span> </span></td>
                <td>&nbsp;</td>
              </tr>
              <tr class="d1" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td valign="top" class="d1"><span class="style1">Pr&eacute;-requisitos</span></td>
                <td class="d0"><input name="RequiredTests" type="text" id="RequiredTests" value="<?=$myRs['RequiredTests']?>" size="4">
                    <span class="style1">(Digite os n&uacute;meros de identifica&ccedil;&atilde;o dos testes de pr&eacute;-requisitos, separados por v&iacute;rgula)</span> </span></td>
                <td>&nbsp;</td>
              </tr>
              <tr class="d0" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');">
                <td width="172" valign="top"><span class="style1">Link Direto: </span></td>
                <td><span class="style1 style1">
                  <?php
			$serverPath="http://";
			$serverPath=$serverPath . $_SERVER['HTTP_HOST'];
			if ($_SERVER['SERVER_PORT'] != "80") $serverPath=$serverPath . ":" . $_SERVER['SERVER_PORT'];
			$currentDirectory = dirname(dirname($_SERVER['PHP_SELF']));
			if ($currentDirectory=="/") $currentDirectory="";
			$serverPath=$serverPath . $currentDirectory;
			$serverPath=$serverPath . "/" . "go.php?testID=" . $myRs['ID'];
			?>
                  <a href="../go.php?testID=<?=$myRs['ID']?>">
                  <?=$serverPath?>
                </a></span></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" valign="top"><div align="center">
				<?php
				if ($_SESSION['loggedInName']!=$myRs['Creator']) $allowSave="disabled"
				?>
                    <input name="Save" type="submit" id="Save" value="Salvar" <?=$allowSave?>>
                    <input name="TestID" type="hidden" value="<?=$myRs['ID']?>">
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
