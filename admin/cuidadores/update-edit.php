<?php
include "conn.php";
if(isset($_POST['update'])){
	$id			= intval($_POST['id']);
	$dni = mysqli_real_escape_string($conn,(strip_tags($_POST['dni'], ENT_QUOTES)));
	$nombre = mysqli_real_escape_string($conn,(strip_tags($_POST['nombre'], ENT_QUOTES)));
	$primerApellido = mysqli_real_escape_string($conn,(strip_tags($_POST['primerApellido'], ENT_QUOTES)));
	$segundoApellido = mysqli_real_escape_string($conn,(strip_tags($_POST['segundoApellido'], ENT_QUOTES)));
	$fecha_nacimiento = mysqli_real_escape_string($conn,(strip_tags($_POST['fecha_nacimiento'], ENT_QUOTES)));
	$cuentaCuidadores_id = mysqli_real_escape_string($conn,(strip_tags($_POST['idCuentaCuidadores'], ENT_QUOTES)));

	$usuario = mysqli_real_escape_string($conn,(strip_tags($_POST['usuario'], ENT_QUOTES)));
	$passwordCuenta = mysqli_real_escape_string($conn,(strip_tags($_POST['passwordCuenta'], ENT_QUOTES)));


	$update = mysqli_query($conn, "UPDATE cuidadores, cuentacuidadores SET cuidadores.dni='$dni', cuidadores.nombre='$nombre', cuidadores.primerApellido='$primerApellido', cuidadores.segundoApellido='$segundoApellido', cuidadores.fecha_nacimiento ='$fecha_nacimiento', cuidadores.cuentaCuidadores_id='$cuentaCuidadores_id', cuentacuidadores.usuario='$usuario', cuentacuidadores.password='$passwordCuenta' WHERE cuidadores.id='$id' and cuentacuidadores.id='$cuentaCuidadores_id'") or die(mysqli_error());
	
	if($update){
		echo "<script>alert('Los datos han sido actualizados!'); window.location = 'editar.php'</script>";
	}else{
		echo "<script>alert('Error, no se pudo actualizar los datos'); window.location = 'editar.php'</script>";
	}


}
?>