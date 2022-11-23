<?php
//  End TIMER
//  ---------
$etimer = explode( ' ', microtime() );
$etimer = $etimer[1] + $etimer[0];
printf( "%f", ($etimer-$stimer) );
//  ---------
?>