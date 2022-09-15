<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "guarderia_database";

	$errors = array(); 
	$_SESSION['success'] = "";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$conn -> set_charset("utf8"); // ESTO ME COSTÓ LA VIDA!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if(mysqli_connect_errno()){
	echo 'Error, no se pudo conectar a la base de datos: '.mysqli_connect_error();
}   
?>





