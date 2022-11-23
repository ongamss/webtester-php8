<?php
ob_start();
session_start();

$inTest=true;
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
	  $mySessions=mysqli_fetch_assoc($mySessionsRes)
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
	  <script LANGUAGE="JavaScript">
function clickNext()
{
	<?php if ($mySessions['questionNumber'] > 1) { ?>document.getElementById('previous').disabled="disabled";<?php } ?>
	document.getElementById('next').disabled="disabled";
	form1.button.value="Next";
	document.form1.submit()
	return (true);
}
function clickPrevious()
{
	<?php if ($mySessions['numQuestions'] != $mySessions['questionNumber']) { ?>document.getElementById('next').disabled="disabled";<?php } ?>
	<?php if ($mySessions['numQuestions'] == $mySessions['questionNumber']) { ?>document.getElementById('review').disabled="disabled";<?php } ?>
	document.getElementById('previous').disabled="disabled";
	form1.button.value="Previous";
	form1.submit()
	return (true);
}
function clickReview()
{
	<?php if ($mySessions['questionNumber'] > 1) { ?>document.getElementById('previous').disabled="disabled";<?php } ?>
	document.getElementById('review').disabled="disabled";
	form1.button.value="Review";
	form1.submit()
	return (true);
}
function clickAnswer(answer)
{
	if (clickedBox!="true") {
		box=document.getElementByID(answer);
		box.click()
	}
	clickedBox="false"
}
</script>

 <?php
	//$questionID = $_SESSION['TestID'];
	$questionID = $mySessions['currentQuestion'];
	$questionsSQL="SELECT * FROM questions WHERE ID=" . $questionID;
	$myRsRes=mysqli_query($conn, $questionsSQL);
	  //var_dump ($myRsRes);
	  $myRs=mysqli_fetch_assoc($myRsRes);
	  $answersSQL="SELECT * FROM answers WHERE QuesID=" . $questionID . " AND SessionID=" . $mySessions['ID'];
	   //echo $answersSQL;
	  $myAnswersRes=mysqli_query($conn, $answersSQL)
	  	or die(mysqli_error());
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
		  $result=mysqli_query($conn, $answersUpdate)
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
	  echo("<strong>Quest&atilde;o " . $mySessions['questionNumber'] . " de " . $mySessions['numQuestions'] . "</strong><BR><BR>");
	  ?>
	  <table class="style1 style5" width="100%"  border="0" cellspacing="2" cellpadding="0" onMouseOut="javascript:highlightTableRowVersionA(0);">
	  <tr><td>
	  <?php
	//   Imprime a questão
	  echo($myRs['QuestionText'] . "<BR><BR>");
	 
	  // se o Campo PicMov for igual picuture
	  if ($myRs['PicMov'] == "picture") {
		  if ($myRs['QuestionPic'] != "") {
		  	if ($myRs['PicMovHeight'] != "") $picHeight="height=" . $myRs['PicMovHeight'];
		  	if ($myRs['PicMovWidth'] != "") $picWidth="width=" . $myRs['PicMovWidth'];
		  	?>
		  	<img src="test-images/<?=$myRs['TestID']?>/<?=$myRs['QuestionPic']?>" <?=$picWidth?> <?=$picHeight?>>
		  <?php
		  }
		//se não se for igual a movie
	  } elseif ($myRs['PicMov'] == "movie") {
	  	  if ($myRs['QuestionPic'] != "") {
		  	echo("<embed width=" . $myRs['PicMovWidth'] . " height=" . $myRs['PicMovHeight'] . " src='test-images/" . $myRs['TestID'] . "/" . $myRs['QuestionPic'] . "' scale='tofit'></embed>");
		  }
	  }
	  ?>
	  </td></tr>
		<form name="form1" method="post" action="submitAnswer.php?submit=true" autocomplete="off">
		  <?php
	//Se o campo AnswerText for vazio
	if ($myRs['AnswerText'] == "") {
    $answerArray = range(1,6);
	$i =0;
    if (SHUFFLEANSWERS) shuffle($answerArray);
    foreach ($answerArray as $num) {
		if ($myRs["Answer$num"] != "") {
			$var="";
			if ($myAnswers["A$num"]) $var="checked";
			$i++;
	  ?><tr class="answer<?=$num?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" onMouseDown="document.form1.A<?=$num?>.click();"><td>
		  <input type=<?=$respType?> id="A<?=$num?>" name="Answer[]" value="A<?=$num?>" <?=$var?> onMouseUp="document.form1.A<?=$num?>.checked=!document.form1.A<?=$num?>.checked"> 
		  <?=$myRs["Answer$num"]?> 
		  <!-- se  AnswerPic for diferente de vazio-->
		  <?php if ($myRs["AnswerPic$num"] != "") {
			//   var_dump ($myRs["AnswerPic$num"]); ?>
			<img name="image" src="test-images/<?=$myRs['TestID']?>/<?=$myRs["AnswerPic$num"]?>" alt=""> <?php } ?>
			<!-- se AnswerPicAud for diferente de vazio -->
		  <?php if ($myRs["AnswerAud$num"] != "") { ?>
<object type="application/x-shockwave-flash"
data="includes/musicplayer/musicplayer.swf?&song_url=test-images/<?=$myRs['TestID']?>/<?=$myRs["AnswerAud$num"]?>&" 
width="17" height="17">
<param name="movie" 
value="includes/musicplayer/musicplayer.swf?&song_url=test-images/<?=$myRs['TestID']?>/<?=$myRs["AnswerAud$num"]?>&" />
<img src="noflash.gif" 
width="17" height="17" alt="" />
</object>
<?php } ?>
		<br />
		<br />
		</td></tr>
		<?php
		}
	}
// Caso o campo AnswerText não for vazio
	} else {
		$questionID = $mySessions['currentQuestion'];
		$questionsSQL="SELECT * FROM questions WHERE ID=" . $questionID;
		$myRsRes=mysqli_query($conn, $questionsSQL);
		$myRs=mysqli_fetch_assoc($myRsRes);

		$answerArray = range(1,6);
		foreach ($answerArray as $num) {
			?>
			<img name="image" src="test-images/<?=$myRs['TestID']?>/<?=$myRs["AnswerPic$num"]?>" alt=""> <?php }	
	// var_dump ($myRs["AnswerPic$num"]); 
		$i=0;
		$i++;
		?>
		<tr><td>
          Resposta:<br>
          <input name="AnswerText" type="text" id="AnswerText" value="<?=$myAnswers['AnswerText']?>" autocomplete="off">
		  		  <script language="JavaScript">
			<!--

			document.form1.AnswerText.focus();

			//-->
		  </script>
     	  </td></tr> 
          <?php
	}
$i++;
?>		
<!-- Botão Proximo e Anterior -->
<tr><td>
		  <?php if ($mySessions['numQuestions'] == $mySessions['questionNumber']) { ?><input class="css_btn_prox" id="review"  type="submit" name="Review" value="<?=REVIEW_BUTTON?>" onClick="clickReview()"><?php } ?><br />
          <?php if ($mySessions['numQuestions'] != $mySessions['questionNumber']) { ?>
          <input id="next" type="submit" class="css_btn_prox" name="Next" value="<?=NEXT_BUTTON?>" onClick="clickNext()"><br />
		  <input type="hidden" name="Next" value="hidden">
          <?php } ?>
          <?php if ($mySessions['questionNumber'] > 1) { ?>
          <input id="previous" type="submit" name="Previous" class="css_btn_anteior" value="<?=PREV_BUTTON?>" onClick="clickPrevious()">
          <input type="hidden" name="hidden" value="hidden"><?php } ?>
		  <input type="hidden" name="button" value="">
		  <input type="hidden" name="TestID" value="<?=$myRs['TestID']?>">
		  <input type="hidden" name="SessionID" value="<?=$mySessions['ID']?>">
		  <input type="hidden" name="QuesID" value="<?=$questionID?>">
		  <input type="hidden" name="Order" value="<?=$mySessions['questionNumber']?>">
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
