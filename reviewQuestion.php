<?php
ob_start();
?>
<?php
$inReview=true;
include "./includes/timerhead.php";
include "./includes/conn.php";
include "./includes/includes.php";
include "./includes/nocache.php";
include "./includes/validation.php";





?>
<html><!-- InstanceBegin template="/Templates/Test%20Layout.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
<link href="includes/wtstyle.css" rel="stylesheet"  type="text/css">
<?
// Copyright (C) 2003 - 2007 Eppler Software.  All rights reserved.
// Any redistribution or reproduction of any materials herein is strictly prohibited.
?>
<!-- InstanceBeginEditable name="doctitle" -->
<title><?=TITLE?></title>
<script type="text/javascript">
/***********************************************
* Dynamic Countdown script- � Dynamic Drive (http://www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/
function cdtime(container, targetdate){
if (!document.getElementById || !document.getElementById(container)) return
this.container=document.getElementById(container)
this.currentTime=new Date("<?=date("F j, Y G:i:s",time())?>")
this.targetdate=new Date(targetdate)
this.timesup=false
this.updateTime()
}

cdtime.prototype.updateTime=function(){
var thisobj=this
this.currentTime.setSeconds(this.currentTime.getSeconds()+1)
setTimeout(function(){thisobj.updateTime()}, 1000) //update time every second
}

cdtime.prototype.displaycountdown=function(baseunit, functionref){
this.baseunit=baseunit
this.formatresults=functionref
this.showresults()
}

cdtime.prototype.showresults=function(){
var thisobj=this


var timediff=(this.targetdate-this.currentTime)/1000 //difference btw target date and current date, in seconds
if (timediff<0){ //if time is up
this.timesup=true
this.container.innerHTML=this.formatresults()
return
}
var oneMinute=60 //minute unit in seconds
var oneHour=60*60 //hour unit in seconds
var oneDay=60*60*24 //day unit in seconds
var dayfield=Math.floor(timediff/oneDay)
var hourfield=Math.floor((timediff-dayfield*oneDay)/oneHour)
var minutefield=Math.floor((timediff-dayfield*oneDay-hourfield*oneHour)/oneMinute)
var secondfield=Math.floor((timediff-dayfield*oneDay-hourfield*oneHour-minutefield*oneMinute))
if (this.baseunit=="hours"){ //if base unit is hours, set "hourfield" to be topmost level
hourfield=dayfield*24+hourfield
dayfield="n/a"
}
else if (this.baseunit=="minutes"){ //if base unit is minutes, set "minutefield" to be topmost level
minutefield=dayfield*24*60+hourfield*60+minutefield
dayfield=hourfield="n/a"
}
else if (this.baseunit=="seconds"){ //if base unit is seconds, set "secondfield" to be topmost level
var secondfield=timediff
dayfield=hourfield=minutefield="n/a"
}
this.container.innerHTML=this.formatresults(dayfield, hourfield, minutefield, secondfield)
setTimeout(function(){thisobj.showresults()}, 1000) //update results every second
}

/////CUSTOM FORMAT OUTPUT FUNCTIONS BELOW//////////////////////////////

//Create your own custom format function to pass into cdtime.displaycountdown()
//Use arguments[0] to access "Days" left
//Use arguments[1] to access "Hours" left
//Use arguments[2] to access "Minutes" left
//Use arguments[3] to access "Seconds" left

//The values of these arguments may change depending on the "baseunit" parameter of cdtime.displaycountdown()
//For example, if "baseunit" is set to "hours", arguments[0] becomes meaningless and contains "n/a"
//For example, if "baseunit" is set to "minutes", arguments[0] and arguments[1] become meaningless etc
function addZero(vNumber){ 
    return ((vNumber < 10) ? "0" : "") + vNumber 
  } 

function formatresults(){
if (this.timesup==false){//if target date/time not yet met
	if (arguments[1]!=0) {
		var displaystring=arguments[1]+":"+addZero(arguments[2])+":"+addZero(arguments[3])
	} else {
		var displaystring=addZero(arguments[2])+":"+addZero(arguments[3])
	}
}
else{ //else if target date/time met
alert("Allowed time has expired.");
window.location="./grade.php?TimeLimit=1";
}
return displaystring
}

</script>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<style type="text/css">
input.next
{ 
  margin-top       : 1.6em;
  float            : right;
}
.t {background: url(images/dot.gif) 0 0 repeat-x; width: 20em}
.b {background: url(images/dot.gif) 0 100% repeat-x}
.l {background: url(images/dot.gif) 0 0 repeat-y}
.r {background: url(images/dot.gif) 100% 0 repeat-y}
.bl {background: url(images/bl.gif) 0 100% no-repeat}
.br {background: url(images/br.gif) 100% 100% no-repeat}
.tl {background: url(images/tl.gif) 0 0 no-repeat}
.tr {background: url(images/tr.gif) 100% 0 no-repeat; padding:10px}
p {font-family: sans-serif; text-align:left}
<?php
if (DISABLE_PRINT) {  ?>
@media print {
body {display:none}
<?php
}
?>
}

</style>
</head>
<?php
	  if (IPSESSIONS) {
	  	$strSQL="SELECT * From sessions WHERE IP='" . $ip . "'";
	  } else {
	  	$strSQL="SELECT * From sessions WHERE ID='" . $sessID . "'";
	  }
	  // $strSQL="SELECT * From sessions WHERE IP='" . $ip . "'";
	  $result=mysqli_query($conn, $strSQL)
	  	or $myVar=true;
	 
	  if (!isset($myVar)) {
		  $num_records=mysqli_num_rows($result);
		  $row=mysqli_fetch_array($result);
		  if ($num_records == 0) {
	  		$myVar = true;
		  } else {
		  	$myVar = false;
		  }
	  }

?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="<?=BGCOLOR?>">
<?php
include "./includes/top.php";
?>
<div align="center"> 
  <table width="100%" border="0" cellpadding="2" cellspacing="0">
    <tr> 
      <td height="47" align="left" valign="middle"><img src="images/webtestertop.gif" width="<?=LOGOW?>" height="<?=LOGOH?>">
        <br>        
      </td>
      <td align="center" valign="middle">
	            <?php if (!$myVar) { ?>
	      
        <div class="t"><div class="b"><div class="l"><div class="r"><div class="bl"><div class="br"><div class="tl">
		  <div class="tr"><font face="Arial, Helvetica, sans-serif"><?php echo($row['FirstName'] . $myVar . " " . $row['LastName']) ?><br>
		    <?php } ?>
        <?php
 if ($myVar != 1) {
 	if ($row['TestName'] != "") {
 ?>
        <?=$row['TestName']?><br>
		<div id="countdowncontainer"></div>
		<?
		if ($row['AllowQuit']) {
			if (!$row['review'] and !$quit) {
		?>
		<div id="quit"><a href="./quitTest.php">Quit</a></div>
		<? 		} 
			}?>
		</font> 
		</div></div></div></div></div></div></div></div>
        <?php
 }
}
?> 
</td>
    </tr>
    <tr> 
      <td colspan="2" align="left" valign="top"> <div class="hr">
        <hr />
      </div>       
        <!-- InstanceBeginEditable name="Content Area" -->
	  <?php
	  if (IPSESSIONS) {
	  	$sessionsSQL="SELECT * From sessions WHERE IP='" . $ip . "'";
	  } else {
	  	$sessionsSQL="SELECT * From sessions WHERE ID='" . $sessID . "'";
	  }
	  $mySessionsRes=mysqli_query($conn, $sessionsSQL);
	  $mySessions=mysqli_fetch_assoc($mySessionsRes);
	  if ($mySessions['ID'] == "") redirect_to("index.php");
	  ?>
	  <script language="javascript" type="text/javascript" src="includes/tableH.js"></script>
	  <?php
	  if ($mySessions['MaxTime']>0) {
	  ?>
	  <script type="text/javascript">
var timelimit=new cdtime("countdowncontainer", "<?=date("F j, Y G:i:s",$mySessions['MaxTime'])?>")
timelimit.displaycountdown("hours", formatresults)
	  </script>
	  <?php
	  }
	  ?>
        <?php
	  // $questionID=$mySessions['currentQuestion'];
	  if ($_POST['quesID'] == "") redirect_to("index.php");
	  $questionID=$_POST['quesID'];
	  $questionsSQL="SELECT * FROM questions WHERE ID=" . $questionID;
	  $myRsRes=mysqli_query($conn, $questionsSQL);
	  $myRs=mysqli_fetch_assoc($myRsRes);
	  $answersSQL="SELECT * FROM answers WHERE QuesID=" . $questionID . " AND SessionID=" . $mySessions['ID'];
	  // echo $answersSQL;
	  $myAnswersRes=mysqli_query($conn, $answersSQL)
	  	or die("Invalid Query: " . $answersSQL . " - " . mysqli_error());
	  $myAnswers=mysqli_fetch_assoc($myAnswersRes);
	  // echo(mysqli_num_rows($myAnswersRes));
	  if (mysqli_num_rows($myAnswersRes)==0) {
		$answersUpdate="INSERT INTO answers
			(SessionID,
			TestID,
			QuesID)
			VALUES
			('" . $mySessions['ID'] . "',
			'" . $mySessions['TestID'] . "',
			'" . $questionID . "')";
		  $result=mysqli_query($answersUpdate, $conn)
		  	or die("Failed to update: " . $answersUpdate . " - " . mysqli_error());
	  }
	  $respCount=0;
	  if ($myRs['A1']) $respCount++;
	  if ($myRs['A2']) $respCount++;
	  if ($myRs['A3']) $respCount++;
	  if ($myRs['A4']) $respCount++;
	  if ($myRs['A5']) $respCount++;
	  if ($myRs['A6']) $respCount++;
	  if ($respCount > 1) {
	  	$respType="checkbox";
	  } else {
	  	$respType="radio";
	  }
	  // echo("<strong>Question " . $mySessions['questionNumber'] . " of " . $mySessions['numQuestions'] . "</strong><BR><BR>");
?>
	  <table class="style1 style5" width="100%"  border="0" cellspacing="2" cellpadding="0" onMouseOut="javascript:highlightTableRowVersionA(0);">
	  <tr><td>
<?php
	  echo($myRs['QuestionText'] . "<BR><BR>");
	  if ($myRs['PicMov'] == "picture") {
		  if ($myRs['QuestionPic'] != "") {
		  	echo("<img src=\"test-images/" . $myRs['TestID'] . "/" . $myRs['QuestionPic'] . "\" width=\"" . $myRs['PicMovWidth'] . "\" height=\"" . $myRs['PicMovHeight'] . "\">");
		  }
	  } elseif ($myRs['PicMov'] == "movie") {
	  	  if ($myRs['QuestionPic'] != "") {
		  	echo("<embed width=" . $myRs['PicMovWidth'] . " height=" . $myRs['PicMovHeight'] . " src='test-images/" . $myRs['TestID'] . "/" . $myRs['QuestionPic'] . "' scale='tofit'></embed>");
		  }
	  }
	  ?>
	  </td></tr>
	          <form name="form1" method="post" action="submitAnswer.php" autocomplete="off">
          <?php
	if ($myRs['AnswerText'] == "") {
		if ($myRs['Answer1'] != "") {
			$var="";
			if ($myAnswers['A1']) $var="checked";
			$i++;
	  ?>
	  <tr  onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" onMouseDown="document.form1.A1.click();"><td>
          <input type=<?=$respType?> id="A1" name="Answer[]" value="A1" <?=$var?> onMouseUp="document.form1.A1.checked=!document.form1.A1.checked"> <?=$myRs['Answer1']?> <?php if ($myRs['AnswerPic1'] != "") { ?><img name="image" src="test-images/<?=$myRs['TestID']?>/<?=$myRs['AnswerPic1']?>" alt=""> <?php } ?> <BR><BR>
		</td></tr>
		<?php
		}
		if ($myRs['Answer2'] != "") {
			$var="";
			if ($myAnswers['A2']) $var="checked";
			$i++;
		  ?>
		  <tr  onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" onMouseDown="document.form1.A2.click();"><td>
          <input type=<?=$respType?> id="A2" name="Answer[]" value="A2" <?=$var?> onMouseUp="document.form1.A2.checked=!document.form1.A2.checked"> <?=$myRs['Answer2']?> <?php if ($myRs['AnswerPic2'] != "") { ?><img name="image" src="test-images/<?=$myRs['TestID']?>/<?=$myRs['AnswerPic2']?>" alt=""> <?php } ?> <BR><br>
		  </td></tr>
		  <?php
		}
		if ($myRs['Answer3'] != "") {
			$var="";
			if ($myAnswers['A3']) $var="checked";
			$i++;
		  ?>
		  <tr  onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" onMouseDown="document.form1.A3.click();"><td>
          <input type=<?=$respType?> id="A3" name="Answer[]" value="A3" <?=$var?> onMouseUp="document.form1.A3.checked=!document.form1.A3.checked"> <?=$myRs['Answer3']?> <?php if ($myRs['AnswerPic3'] != "") { ?><img name="image" src="test-images/<?=$myRs['TestID']?>/<?=$myRs['AnswerPic3']?>" alt=""> <?php } ?> <BR><br>
		  </td></tr>
		  <?php
		}
		if ($myRs['Answer4'] != "") {
			$var="";
			if ($myAnswers['A4']) $var="checked";
			$i++;
		  ?>
		  <tr  onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" onMouseDown="document.form1.A4.click();"><td>
          <input type=<?=$respType?> id="A4" name="Answer[]" value="A4" <?=$var?> onMouseUp="document.form1.A4.checked=!document.form1.A4.checked"> <?=$myRs['Answer4']?> <?php if ($myRs['AnswerPic4'] != "") { ?><img name="image" src="test-images/<?=$myRs['TestID']?>/<?=$myRs['AnswerPic4']?>" alt=""> <?php } ?> <BR><br>
		  </td></tr>
		  <?php
		}
		if ($myRs['Answer5'] != "") {
			$var="";
			if ($myAnswers['A5']) $var="checked";
			$i++;
		  ?>
		  <tr  onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" onMouseDown="document.form1.A5.click();"><td>
          <input type=<?=$respType?> id="A5" name="Answer[]" value="A5" <?=$var?> onMouseUp="document.form1.A5.checked=!document.form1.A5.checked"> <?=$myRs['Answer5']?> <?php if ($myRs['AnswerPic5'] != "") { ?><img name="image" src="test-images/<?=$myRs['TestID']?>/<?=$myRs['AnswerPic5']?>" alt=""> <?php } ?> <BR><br>
		  </td></tr>
		  <?php
		}
		if ($myRs['Answer6'] != "") {
			$var="";
			if ($myAnswers['A6']) $var="checked";
			$i++;
		  ?>
		  <tr  onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" onMouseDown="document.form1.A6.click();"><td>
          <input type=<?=$respType?> id="A6" name="Answer[]" value="A6" <?=$var?> onMouseUp="document.form1.A6.checked=!document.form1.A6.checked"> <?=$myRs['Answer6']?> <?php if ($myRs['AnswerPic6'] != "") { ?><img name="image" src="test-images/<?=$myRs['TestID']?>/<?=$myRs['AnswerPic6']?>" alt=""> <?php } ?> <BR><br>
		  </td></tr>
		  <?php
		}
	} else {
		?>
		<tr><td>
          Answer:<br>
          <input name="AnswerText" type="text" id="AnswerText" value="<?=$myAnswers['AnswerText']?>" autocomplete="off">
		  		  		  <script language="JavaScript">
			<!--

			document.form1.AnswerText.focus();

			//-->
		  </script>
         </td></tr> 
          <?php
	}
?>
		  <tr><td>
		  <input type="hidden" name="SessionID" value="<?=$myAnswers['SessionID']?>">
		  <input type="hidden" name="Save" value="Save">
          <input class="css_btn_revisar"  type="submit" id="save" name="Save" value="<?=SAVE_BUTTON?>">
		  <input type="hidden" name="TestID" value="<?=$myRs['TestID']?>">
		  <input type="hidden" name="QuesID" value="<?=$questionID?>">
		  </td></tr>
	  </form>
	  </table>
	  <!-- InstanceEndEditable -->	  </td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="top">
        <div align="center"> 
		<div class="hr"><hr /></div>
          <?php include "./includes/copyright.php" ?></div></td>
    </tr>
  </table>
</div>
</body>
<!-- InstanceEnd --></html>
<?php ob_end_flush() ?>