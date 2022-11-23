<?php
//header('Location: phpThumb.demo.demo.php');
//exit;
$dh = opendir('.');

while ($file = readdir($dh)) {

	if (is_file($file) && ($file{0} != '.') && ($file != basename(__FILE__))) {

		echo '<tt>'.str_replace(' ', '&nbsp;', str_pad(filesize($file), 10, ' ', STR_PAD_LEFT)).'</tt> <a href="'.$file.'">'.$file.'</a><br>';

	}

}

?>