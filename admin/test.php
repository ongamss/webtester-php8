<?php
foreach($_SERVER as $key => $value) {
echo("_SERVER['" . $key . "'] = " .  $value . "<br>");
// echo("$_SERVER['" . $key . "'] = " . $_SERVER[$value] . "<br>");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
<title>LaTeX Equations and Graphics in PHP</title>
</head>
<body>
<?php

function htmlpath($realpath) {
   $i = substr_count($_ENV["SCRIPT_URL"],'/')."<br>";
   if($i==1) {
   $baserealpath=realpath(str_repeat('../',$i-1));
   }
   $htmlpath=str_replace($baserealpath,'',$realpath);
   return $htmlpath;
}

function cleanPath($path) {
   $result = array();
   // $pathA = preg_explode('/[\/\\\]/', $path);
   $pathA = explode('/', $path);
   if (!$pathA[0])
       $result[] = '';
   foreach ($pathA AS $key => $dir) {
       if ($dir == '..') {
           if (end($result) == '..') {
               $result[] = '..';
           } elseif (!array_pop($result)) {
               $result[] = '..';
           }
       } elseif ($dir && $dir != '.') {
           $result[] = $dir;
       }
   }
   if (!end($pathA))
       $result[] = '';
   return implode('/', $result);
}

$new=htmlspecialchars("test \"quotes\"", ENT_QUOTES);
echo $new . "<br>";
echo "Magic Quotes: " . get_magic_quotes_gpc() . "<br>";
$scriptpath=pathinfo($_SERVER['PHP_SELF']);
$thedir=$scriptpath['dirname'];
$rootdir=cleanPath($thedir . "/../");
echo "<br>" . $rootdir
?>
</body>
</html>