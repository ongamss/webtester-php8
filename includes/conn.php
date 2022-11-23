<?php
require_once("db-conf.php");
require_once("conf.php");
require_once("language_strings.php");

// if (SQL_TYPE == "mysqli") {
	$conn=mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB)
		or die('Could not connect to the database; ' . mysqli_connect_error());
		
	if(!mysqli_set_charset($conn,"utf8")):
		echo "Não foi possível alterar o charset para utf8". mysqli_error();
	endif;
	
	//mysqli_select_db(, $conn)
		//or die('Não foi possivel selecionar a base de dados; ' . mysqli_error());
// } elseif (SQL_TYPE == "sqlite") {
	// $conn = sqlite_open(SQLITE_DB);
// }
?>
