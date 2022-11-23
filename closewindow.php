<?php
ob_start();
?>
<html>
<head>
<?php
session_start();
include "./includes/timerhead.php";
include "./includes/conn.php";
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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="window.opener='x';window.close();">
<div align="center"> 
  <table width="100%" height="50" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td width="338" align="center" valign="top"><div align="left"><a href="./index.php"><img src="images/webtestertop.gif" width="337" height="75" border="0"></a></div></td>
      <td align="center" valign="middle">
        <p class="style4">Finalizado!</p>
        </td>
    </tr>
  </table>
        </td>
    </tr>
    <tr>
      <td align="center" valign="top">
	    <div class="hr"><hr /></div></td>
    </tr>
    <tr> 
      <td align="center" valign="top">		<div align="left">
        <p>&nbsp;</p>
        <?=CLOSE_BODY?>
        <p>&nbsp;</p>
        </div>	
        <div class="hr"><hr /></div>
</td>
    </tr>
    <tr> 
      <td align="center" valign="top">
          <p><span class="style1 style5">Copyright &copy; 2003 - 2008 <a href="http://www.epplersoft.com">Eppler 
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
