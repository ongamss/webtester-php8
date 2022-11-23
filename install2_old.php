<?php
ob_start();
?>
<html>
<head>
<?php
session_start();
include "./includes/timerhead.php";
include "./includes/includes.php";
include "./includes/nocache.php";


?>
<title>WebTester Online Testing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/wtstyle.css" rel="stylesheet"  type="text/css">
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
<script language="javascript" type="text/javascript" src="includes/tableH.js"></script>
<script language="Javascript" src="editor/scripts/innovaeditor.js"></script>
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
      <td width="338" align="center" valign="top"><div align="left"><a href="./index.php"><img src="images/webtestertop.gif" width="337" height="75" border="0"></a></div></td>
      <td align="center" valign="middle">
        <p class="style4">Install</p>
      </td>
    </tr>
  </table>
  <div class="hr"><hr /></div>
  <table width="100%" height="50" border="0" align="center" cellpadding="3" cellspacing="1" bordercolor="#333333" BORDERCOLORLIGHT="#999999" BORDERCOLORDARK="#333333">
    <tr> 
      <td align="center" valign="top">&nbsp;</td>
    </tr>
    <tr> 
      <td align="center" valign="top">		<div align="left">
	         <p><span class="style7">WebTester Install</span></p>
<?php
if($_POST['createdb']=="yes") {
	if($_POST['cpanel']=="yes") {
		$_POST['dbusername']=substr($_POST['dbusername'],0,7);
		echo("Attempting to create database with cPanel...<br>");
		exec("/usr/bin/curl 'http://" . $_POST['cpusername'] . ":" . $_POST['cppassword'] . "@" . $_POST['cpdomain'] . ":2082/frontend/x/sql/adddb.html?db=" . $_POST['db'] . "'");
		exec("/usr/bin/curl 'http://" . $_POST['cpusername'] . ":" . $_POST['cppassword'] . "@" . $_POST['cpdomain'] . ":2082/frontend/x/sql/adduser.html?user=" . $_POST['dbusername'] . "&pass=" . $_POST['dbpassword'] . "'");
		$_POST['dbusername']=$_POST['cpusername'] . "_" . $_POST['dbusername'];
		$_POST['db']=$_POST['cpusername'] . "_" . $_POST['db'];
		exec("/usr/bin/curl 'http://" . $_POST['cpusername'] . ":" . $_POST['cppassword'] . "@" . $_POST['cpdomain'] . ":2082/frontend/x/sql/addusertodb.html?user=" . $_POST['dbusername'] . "&db=" . $_POST['db'] . "&ALL=ALL'");
		$link=mysqli_connect($_POST['dbhost'], $_POST['dbusername'], $_POST['dbpassword'], $_POST['db'] )
			or die("Failed to connect to database server.  The error is:  " . mysqli_error());
	} else {
    $link=mysqli_connect($_POST['dbhost'], $_POST['dbusername'], $_POST['dbpassword'], $_POST['db'] )
		or die("Failed to connect to database server.  The error is:  " . mysqli_error());
	echo("Connected to database server.<br>");
	$query="CREATE DATABASE " . $_POST['db'];
	$result=mysqli_query($query)
		or die("Failed to create a new database.  The error is:  " . mysqli_error());
	echo("Database creation successful.<br>");
	}
mysqli_select_db($_POST['db'], $link)
	or die("Failed to select database.  The error is:  " . mysqli_error($link));

} else {
$link=mysqli_connect($_POST['dbhost'], $_POST['dbusername'], $_POST['dbpassword'], $_POST['db'] )
	or die("Failed to connect to database server.  The error is:  " . mysqli_error());

// mysqli_select_db($_POST['db'], $link)
// 	or die("Failed to select database.  The error is:  " . mysqli_error($link));	

}
?>
<p>Creating tables...</p>
<?php
// require_once("includes/db-conf.php");

// $conn=mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS)
//	or die('Could not connect to the database; ' . mysqli_error());
	
// mysqli_select_db(SQL_DB, $conn)
// 	or die('Could not select database; ' . mysqli_error());
		
$sql="
CREATE TABLE IF NOT EXISTS `Answers` (
  `ID` int(11) NOT NULL auto_increment,
  `SessionID` int(11) default '0',
  `TestID` int(11) default '0',
  `QuesID` int(11) default '0',
  `A1` tinyint(1) NOT NULL default '0',
  `A2` tinyint(1) NOT NULL default '0',
  `A3` tinyint(1) NOT NULL default '0',
  `A4` tinyint(1) NOT NULL default '0',
  `A5` tinyint(1) NOT NULL default '0',
  `A6` tinyint(1) NOT NULL default '0',
  `AnswerText` text,
  `SortOrder` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `QuesID` (`QuesID`),
  KEY `SessionID` (`SessionID`),
  KEY `TestID` (`TestID`)
) ENGINE=MyISAM AUTO_INCREMENT=1;";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));

$sql="CREATE TABLE IF NOT EXISTS `EmailTemplates` (
  `ID` int(11) NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL default '',
  `Description` text NOT NULL,
  `FromEmail` varchar(255) NOT NULL default '',
  `Subject` varchar(255) NOT NULL default '',
  `Text` text NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));

$sql="CREATE TABLE IF NOT EXISTS `Preferences` (
  `AllowBrowse` tinyint(1) NOT NULL default '0',
  `WelcomeMessage` text NOT NULL,
  `mimetex` varchar(255) NOT NULL default '',
  `notes` varchar(255) NOT NULL default ''
) ENGINE=MyISAM;";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));
	
$sql="CREATE TABLE IF NOT EXISTS `Questions` (
  `ID` int(11) NOT NULL auto_increment,
  `TestID` varchar(50) default NULL,
  `QuestionText` text,
  `QuestionPic` varchar(255) default NULL,
  `PicMov` varchar(255) default NULL,
  `PicMovWidth` varchar(50) default NULL,
  `PicMovHeight` varchar(50) default NULL,
  `Answer1` text,
  `AnswerPic1` varchar(255) default NULL,
  `A1` tinyint(4) default '0',
  `A1Clicks` int(11) NOT NULL default '0',
  `Answer2` text,
  `AnswerPic2` varchar(255) default NULL,
  `A2` tinyint(4) default '0',
  `A2Clicks` int(11) NOT NULL default '0',
  `Answer3` text,
  `AnswerPic3` varchar(255) default NULL,
  `A3` tinyint(4) default '0',
  `A3Clicks` int(11) NOT NULL default '0',
  `Answer4` text,
  `AnswerPic4` varchar(255) default NULL,
  `A4` tinyint(4) default '0',
  `A4Clicks` int(11) NOT NULL default '0',
  `Answer5` text,
  `AnswerPic5` varchar(255) default NULL,
  `A5` tinyint(4) default '0',
  `A5Clicks` int(11) NOT NULL default '0',
  `Answer6` text,
  `AnswerPic6` varchar(255) default NULL,
  `A6` tinyint(4) default '0',
  `A6Clicks` int(11) NOT NULL default '0',
  `AnswerText` text,
  `sortOrder` smallint(6) NOT NULL default '100',
  `Points` int(11) NOT NULL default '1',
  `Correct` int(11) NOT NULL default '0',
  `Incorrect` int(11) NOT NULL default '0',
  `Explanation` text default NULL,
  `Subject` int(11) NOT NULL default '1',
  `AnswerAud1` varchar(255) default NULL,
  `AnswerAud2` varchar(255) default NULL,
  `AnswerAud3` varchar(255) default NULL,
  `AnswerAud4` varchar(255) default NULL,
  `AnswerAud5` varchar(255) default NULL,
  `AnswerAud6` varchar(255) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `TestID` (`TestID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));

$sql="CREATE TABLE IF NOT EXISTS `ReportTemplates` (
  `ID` int(11) NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL default '',
  `Description` text NOT NULL,
  `Text` text NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));


$sql="CREATE TABLE IF NOT EXISTS `Results` (
  `ID` int(11) NOT NULL auto_increment,
  `LastName` varchar(255) default NULL,
  `FirstName` varchar(255) default NULL,
  `Notes` varchar(255) default NULL,
  `TestID` varchar(255) default NULL,
  `TestName` varchar(255) default NULL,
  `NumCorrect` int(11) default '0',
  `NumPossible` int(11) default '0',
  `Score` int(11) default '0',
  `Pass` tinyint(4) default '0',
  `IPAddress` varchar(50) default NULL,
  `StartTime` varchar(50) default NULL,
  `EndTime` varchar(50) default NULL,
  `TotalTime` varchar(50) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `NumCorrect` (`NumCorrect`),
  KEY `NumPossible` (`NumPossible`),
  KEY `TestID` (`TestID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));


$sql="CREATE TABLE IF NOT EXISTS `Sessions` (
  `ID` int(11) NOT NULL auto_increment,
  `IP` varchar(50) default NULL,
  `SessionID` int(11) default NULL,
  `TestID` int(11) default NULL,
  `review` tinyint(4) default '0',
  `finished` tinyint(4) default '0',
  `takingTest` tinyint(4) default '0',
  `currentQuestion` int(11) default NULL,
  `questionNumber` int(11) default NULL,
  `numQuestions` int(11) default NULL,
  `firstQuestion` int(11) default NULL,
  `lastQuestion` int(11) default NULL,
  `LastName` varchar(255) default NULL,
  `FirstName` varchar(255) default NULL,
  `Email` varchar(255) NOT NULL default '',
  `AltEmail` varchar(255) NOT NULL default '',
  `Notes` varchar(255) default NULL,
  `StartTime` varchar(50) default NULL,
  `MaxTime` varchar(50) default NULL,
  `TestName` varchar(255) default NULL,
  `TestImage` varchar(255) default NULL,
  `Stored` tinyint(4) default '0',
  `QuestionOrder` text,
  `AllowQuit` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `numQuestions` (`numQuestions`),
  KEY `SessionID` (`SessionID`),
  KEY `TestID` (`TestID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));


$sql="CREATE TABLE IF NOT EXISTS `Subjects` (
  `ID` int(11) NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL default '',
  `Description` text NOT NULL,
  `Correct` int(11) NOT NULL,
  `Incorrect` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));


$sql="CREATE TABLE IF NOT EXISTS `Tests` (
  `ID` int(11) NOT NULL auto_increment,
  `TestName` varchar(255) NOT NULL default 'No Name',
  `Subject` int(255) NOT NULL default '1',
  `Enabled` tinyint(1) NOT NULL default '0',
  `RequireLogin` tinyint(1) NOT NULL default '0',
  `PassingScore` int(11) NOT NULL default '60',
  `TestPicture` varchar(255) default NULL,
  `Random` tinyint(1) NOT NULL default '0',
  `Creator` varchar(255) NOT NULL default '',
  `Directions` text,
  `LimitTime` tinyint(1) NOT NULL default '0',
  `TimeLimitH` char(2) NOT NULL default '00',
  `TimeLimitM` char(2) NOT NULL default '00',
  `EmailInstructor` int(11) NOT NULL default '0',
  `EmailUsers` int(11) NOT NULL default '0',
  `EmailTemplate` int(11) NOT NULL default '1',
  `ReportTemplate` int(11) NOT NULL default '1',
  `AutoSession` tinyint(1) NOT NULL default '0',
  `QuestionLimit` int(11) NOT NULL default '0',
  `MaxAttempts` int(11) NOT NULL default '0',
  `AllowQuit` tinyint(1) NOT NULL default '0',
  `Browseable` tinyint(1) NOT NULL default '1',
  `AltEmail` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));


$sql="CREATE TABLE IF NOT EXISTS `Users` (
  `ID` int(11) NOT NULL auto_increment,
  `Username` varchar(255) default NULL,
  `Password` varchar(255) default NULL,
  `Location` varchar(255) default NULL,
  `FirstName` varchar(255) NOT NULL default '',
  `LastName` varchar(255) NOT NULL default '',
  `Email` varchar(255) NOT NULL default '',
  `Admin` tinyint(1) NOT NULL default '0',
  `Instructor` tinyint(1) NOT NULL default '0',
  `Limited` tinyint(1) NOT NULL default '0',
  `LimitedSubjects` varchar(255) NOT NULL default '',
  `Attempts` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));
	
$sql="CREATE TABLE IF NOT EXISTS `CustomMessages` (
  `ID` int(11) NOT NULL auto_increment,
  `ReportID` int(11) NOT NULL default '0',
  `Description` varchar(255) NOT NULL default '',
  `MinPoints` int(11) NOT NULL default '0',
  `MaxPoints` int(11) NOT NULL default '0',
  `Message` text NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `ReportID` (`ReportID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));
	
?>
<p>Inserting data...</p>
<?php

$sql="INSERT INTO `Tests` VALUES (1, 'Sample Test', 1, 1, 0, 60, '', 1, 'admin', '<span style=\"font-family: Arial;\">This is the sample test.</span><br style=\"font-family: Arial;\"><br style=\"font-family: Arial;\"><span style=\"font-family: Arial;\">You can put your own instructions in this area.</span><br>', 1, '0', '1', 0, 0, 1, 1, 1, 0, 0, 0, 1, 0);";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));

$sql="INSERT INTO `Questions` VALUES (1, '1', 'What is 2+2?', NULL, NULL, NULL, NULL, '2', NULL, 0, 0, '3', NULL, 0, 0, '4', NULL, 1, 0, '5', NULL, 0, 0, '6', NULL, 0, 0, NULL, NULL, 0, 0, NULL, 2, 1, 0, 0, '', 1, NULL, NULL, NULL, NULL, NULL, NULL);";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));
	
	
$sql="INSERT INTO `Questions` VALUES (3, '1', 'Solve:<br><br><img src=\"/mimetex.cgi?%5Csqrt%7B9%7D\" align=\"middle\" /><br>', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 0, '3', 3, 1, 0, 0, '', 1, NULL, NULL, NULL, NULL, NULL, NULL);";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));
	
	
$sql="INSERT INTO `Questions` VALUES (4, '1', 'What does this image say?', 'test.gif', 'picture', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 0, 'Test', 1, 1, 0, 0, '', 1, NULL, NULL, NULL, NULL, NULL, NULL);";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));

$sql="INSERT INTO `Questions` VALUES (5, '1', 'What colors does a CRT use to make all the other colors?', NULL, NULL, NULL, NULL, 'Yellow', NULL, 0, 0, 'Red', NULL, 1, 0, 'Orange', NULL, 0, 0, 'Blue', NULL, 1, 0, 'Green', NULL, 1, 0, 'White', NULL, 0, 0, NULL, 4, 1, 0, 0, '', 1, NULL, NULL, NULL, NULL, NULL, NULL);";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));

$sql="INSERT INTO `Questions` VALUES (6, '1', 'Which picture is a camera?', NULL, NULL, NULL, NULL, 'A', 'test.gif', 0, 0, 'B', 'test-fuj-s602-t.jpg', 1, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, 5, 1, 0, 0, '', 1, NULL, NULL, NULL, NULL, NULL, NULL);";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));

$sql="INSERT INTO `Preferences` VALUES (1, '<p><span style=\"font-size: 14pt; font-family: arial;\">Welcome to WebTester.  Select a test to begin.</span></p>\r\n', '/mimetex.cgi', 'Notes');";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));

$sql="INSERT INTO `ReportTemplates` VALUES (1, '[Default]', 'Default Template', '<span style=\"font-family: arial;\">Results for %FIRST_NAME% %LAST_NAME%</span><br style=\"font-family: arial;\">\r\n<br style=\"font-family: arial;\"><span style=\"font-family: arial;\">\r\nTest: %TEST_NAME%</span><br style=\"font-family: arial;\"><span style=\"font-family: arial;\">\r\nDate: %TEST_DATE%</span><br style=\"font-family: arial;\">\r\n<br style=\"font-family: arial;\"><span style=\"font-family: arial;\">\r\nTotal Correct: %NUMBER_CORRECT%</span><br style=\"font-family: arial;\"><span style=\"font-family: arial;\">\r\nTotal Possible: %NUMBER_POSSIBLE%</span><br style=\"font-family: arial;\"><span style=\"font-family: arial;\">\r\nScore:  %PERCENTAGE%</span><br style=\"font-family: arial;\">\r\n<br style=\"font-family: arial;\"><span style=\"font-family: arial;\">\r\nYou have %PASSFAIL% this test.</span><br>\r\n');";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));

$sql="INSERT INTO `EmailTemplates` VALUES (1, '[Default]', 'Default Template', 'results@webtester.us', '%TEST_NAME% results for %FIRST_NAME% %LAST_NAME%', 'Results for %FIRST_NAME% %LAST_NAME%\r\n\r\nTest: %TEST_NAME%\r\nDate: %TEST_DATE%\r\nTotal Correct: %NUMBER_CORRECT%\r\nTotal Possible: %NUMBER_POSSIBLE%\r\nScore:  %PERCENTAGE%\r\n\r\nYou have %PASSFAIL% this test.\r\n\r\nThank you,\r\nThe WebTester Team\r\nhttp://www.webtester.us');";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));

$sql="INSERT INTO `Subjects` VALUES (1, '[Default]', 'This is the default subject', 0, 0);";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));
	
$sql="INSERT INTO users VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Default Admin', 'Admin', 'User', 'changeme@nowhere.com', 1, 1, 0, '', '');";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));
	
$sql="INSERT INTO `CustomMessages` (`ID`, `ReportID`, `Description`, `MinPoints`, `MaxPoints`, `Message`) VALUES
(1, 1, '[Default 1]', 0, 3, 'You scored between 0 and 3 points'),
(2, 1, '[Default 2]', 4, 5, 'You scored between 4 and 5 points');";

$result=mysqli_query($link, $sql)
	or die(mysqli_error($result));
		
?>
<p>Database created.</p>

<?php
$handle=fopen("./includes/db-conf.php","w");
fwrite($handle,"<?php
// Place your mysqli hostname here (usually localhost)
define (\"SQL_HOST\",\"" . $_POST['dbhost'] . "\");
// Place your mysqli username here
define (\"SQL_USER\",\"" . $_POST['dbusername'] . "\");
// Place your mysqli password here
define (\"SQL_PASS\",\"" . $_POST['dbpassword'] . "\");
// Place your mysqli database name here
define (\"SQL_DB\",\"" . $_POST['db'] . "\");
// Place your database type here (mysqli)
define (\"SQL_TYPE\",\"mysqli\");
?>");
 ?>
</p>
<p>Settings saved.</p>
<p>You can now login. The default account details are:</p>
<p>Username: admin<br>
  Password: admin
   </p>
<p><a href="./admin">WebTester Admin </a> </p>
</div>	
        <div class="hr"><hr /></div>
</td>
    </tr>
    <tr> 
      <td align="center" valign="top">
          <p><span class="style1 style5">Copyright &copy; 2003 - 2006 <a href="http://www.epplersoft.com">Eppler 
            Software</a> </span><br>
            <font size="-2">Page created in
        <?php include "./includes/timerfoot.php" ?> seconds.</font>          </p>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
<?php ob_end_flush() ?>
