<?php
/**
 * Copy a file, or recursively copy a folder and its contents
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.0.1
 * @link        http://aidanlister.com/repos/v/function.copyr.php
 * @param       string   $source    Source path
 * @param       string   $dest      Destination path
 * @return      bool     Returns TRUE on success, FALSE on failure
 */
function copyr($source, $dest)
{
    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }
 
    // Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest);
    }
 
    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }
 
        // Deep copy directories
        if ($dest !== "$source/$entry") {
            copyr("$source/$entry", "$dest/$entry");
        }
    }
 
    // Clean up
    $dir->close();
    return true;
}
 
if (getenv("HTTP_X_FORWARDED_FOR")) {							
    $ip = getenv("HTTP_X_FORWARDED_FOR"); 
} else { 
    $ip = getenv("REMOTE_ADDR");
}

//alterado para versao php5 por magno
if(!isset($_SESSION)){
    session_start();
}
//session_start();

$_COOKIE['sessID'] = "";
$sessID = $_COOKIE['sessID'];
$sessID = $_SESSION['ID'];

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

function redirect_to($url) {
	if (!headers_sent()) {
		$scriptpath=pathinfo($_SERVER['PHP_SELF']);
		$thedir=$scriptpath['dirname'];
		if($thedir=="\\") { $thedir="/"; }
		if($thedir!="/") {
			$endereco = "http://". $_SERVER['HTTP_HOST']. $thedir ."/". $url;
			//header('Location: http://'. $_SERVER['HTTP_HOST']. $thedir ."/". $url);
			header("Location: 	$endereco");
			//echo "<meta http-equiv=\"refresh\" content=\"0;url=$endereco\">\r\n";
		} else {
			header('Location: http://' . $_SERVER['HTTP_HOST'] . $thedir . $url);
		}		
	} else {
		die('Could not redirect; Headers already sent (output).');
	}
}

function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
  /*
    $interval can be:
    yyyy - Number of full years
    q - Number of full quarters
    m - Number of full months
    y - Difference between day numbers
      (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
    d - Number of full days
    w - Number of full weekdays
    ww - Number of full weeks
    h - Number of full hours
    n - Number of full minutes
    s - Number of full seconds (default)
  */
  
  if (!$using_timestamps) {
    $datefrom = strtotime($datefrom, 0);
    $dateto = strtotime($dateto, 0);
  }
  $difference = $dateto - $datefrom; // Difference in seconds
  
  switch($interval) {
  
    case 'yyyy': // Number of full years

      $years_difference = floor($difference / 31536000);
      if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
        $years_difference--;
      }
      if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
        $years_difference++;
      }
      $datediff = $years_difference;
      break;

    case "q": // Number of full quarters

      $quarters_difference = floor($difference / 8035200);
      while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
        $months_difference++;
      }
      $quarters_difference--;
      $datediff = $quarters_difference;
      break;

    case "m": // Number of full months

      $months_difference = floor($difference / 2678400);
      while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
        $months_difference++;
      }
      $months_difference--;
      $datediff = $months_difference;
      break;

    case 'y': // Difference between day numbers

      $datediff = date("z", $dateto) - date("z", $datefrom);
      break;

    case "d": // Number of full days

      $datediff = floor($difference / 86400);
      break;

    case "w": // Number of full weekdays

      $days_difference = floor($difference / 86400);
      $weeks_difference = floor($days_difference / 7); // Complete weeks
      $first_day = date("w", $datefrom);
      $days_remainder = floor($days_difference % 7);
      $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
      if ($odd_days > 7) { // Sunday
        $days_remainder--;
      }
      if ($odd_days > 6) { // Saturday
        $days_remainder--;
      }
      $datediff = ($weeks_difference * 5) + $days_remainder;
      break;

    case "ww": // Number of full weeks

      $datediff = floor($difference / 604800);
      break;

    case "h": // Number of full hours

      $datediff = floor($difference / 3600);
      break;

    case "n": // Number of full minutes

      $datediff = floor($difference / 60);
      break;

    default: // Number of full seconds (default)

      $datediff = $difference;
      break;
  }    

  return $datediff;

}

/**
 * rm() -- Vigorously erase files and directories.
 *
 * @param $fileglob mixed If string, must be a file name (foo.txt), glob pattern (*.txt), or directory name.
 *                        If array, must be an array of file names, glob patterns, or directories.
 */
function rm($fileglob)
{
   if (is_string($fileglob)) {
       if (is_file($fileglob)) {
           return unlink($fileglob);
       } else if (is_dir($fileglob)) {
           $ok = rm("$fileglob/*");
           if (! $ok) {
               return false;
           }
           return rmdir($fileglob);
       } else {
           $matching = glob($fileglob);
           if ($matching === false) {
               trigger_error(sprintf('No files match supplied glob %s', $fileglob), E_USER_WARNING);
               return false;
           }     
           $rcs = array_map('rm', $matching);
           if (in_array(false, $rcs)) {
               return false;
           }
       }     
   } else if (is_array($fileglob)) {
       $rcs = array_map('rm', $fileglob);
       if (in_array(false, $rcs)) {
           return false;
       }
   } else {
       trigger_error('Param #1 must be filename or glob pattern, or array of filenames or glob patterns', E_USER_ERROR);
       return false;
   }

   return true;
}

function file_extension($filename) {
	$path_info = pathinfo($filename);
	return $path_info['extension'];
}

function referencia(){
	if (isset($_REQUEST['ref'])):
	return $_REQUEST['ref'];
	endif;
}
?>
