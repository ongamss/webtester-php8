<?php
include "./includes/includes.php";




include "./includes/timerhead.php";
include "./includes/conn.php";

if (SKIP_REVIEW) {
	redirect_to("grade.php?Grade=true");
	exit;
} else {
	$inReview=true;
}

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
	  $answersSQL="SELECT * FROM answers WHERE SessionID=" . $mySessions['ID'] . " ORDER BY ID";
	  $myAnswersRes=mysqli_query($conn, $answersSQL);
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
	  <p><strong><?=REVIEW_TITLE?></strong></p>
	  <form name="form1" method="post" action="reviewQuestion.php">
	  <table class="style1 style5" width="100%"  border="0" cellspacing="2" cellpadding="0" onMouseOut="javascript:highlightTableRowVersionA(0);">
		<tr bgcolor="#C8D8FF"><td width=30>&nbsp;</td>
		<td>Quest&atilde;o (Dica: Execute um clique duplo no item a fim de reve-lo)</td>
		<td>Resposta</td></tr>
            <?php
	  $num_rows=mysqli_num_rows($myAnswersRes);
	  if ($num_rows != 0) {
		  $i=0;
	  	while($myAnswers=mysqli_fetch_assoc($myAnswersRes)) {
		$i++;
	  $questionsSQL="SELECT * FROM questions WHERE ID=" . $myAnswers['QuesID'];
	//   echo $questionsSQL;
	  $myRsRes=mysqli_query($conn, $questionsSQL)
	  	or die(mysqli_error);
	  $myRs=mysqli_fetch_assoc($myRsRes);
	  ?>
            <tr class="d<?=$i & 1?>" onMouseOver="javascript:highlightTableRowVersionA(this, '#FFFF99');" onDblClick="document.form1.submit();" onClick="document.form1.ID<?=$myRs['ID']?>.click();">
              <td align="center"><input type="radio" id="ID<?=$myRs['ID']?>" name="quesID" value="<?=$myRs['ID']?>"></td>
			  <td><?=strip_tags($myRs['QuestionText'])?></td>
			  <td>
			  <?php
			  $needComma = 0;
			  if ($myRs['AnswerText'] == "") {
			  	if ($myAnswers['A1']) {
					echo($myRs['Answer1']);
					$needComma = 1;
				}
			  	if ($myAnswers['A2']) {
					if ($needComma == 1) echo ", ";
					echo($myRs['Answer2']);
					$needComma = 1;
				}
			  	if ($myAnswers['A3']) {
					if ($needComma == 1) echo ", ";
					echo($myRs['Answer3']);
					$needComma = 1;
				}
			  	if ($myAnswers['A4']) {
					if ($needComma == 1) echo ", "; 
					echo($myRs['Answer4']);
					$needComma = 1;
				}
			  	if ($myAnswers['A5']) {
					if ($needComma == 1) echo ", ";
					echo($myRs['Answer5']);
					$needComma = 1;
				}
			  	if ($myAnswers['A6']) {
					if ($needComma == 1) echo ", ";
					echo($myRs['Answer6']);
				}
			  } else {
			  	echo($myAnswers['AnswerText']);
			  }
			  ?>
			  </td></tr>
			 <?php
			}
	  ?>
          </table>
		  <input class="css_btn_revisar" type="submit" name="Submit" value="<?=REVIEW_SEL_BUTTON?>">
        </form>
		<form name="form2" method="post" action="grade.php">
		  <input class="css_btn_encerrar" name="Grade" type="submit" value="<?=GRADE_REV_BUTTON?>">
		</form>
	  <?php
	  }
	  ?>
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
