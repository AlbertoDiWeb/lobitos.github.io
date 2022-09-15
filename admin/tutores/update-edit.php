<?php
include "conn.php";
if(isset($_POST['update'])){
	$id			= intval($_POST['id']);
	$dni = mysqli_real_escape_string($conn,(strip_tags($_POST['dni'], ENT_QUOTES)));
	$nombre = mysqli_real_escape_string($conn,(strip_tags($_POST['nombre'], ENT_QUOTES)));
	$primerApellido = mysqli_real_escape_string($conn,(strip_tags($_POST['primerApellido'], ENT_QUOTES)));
	$segundoApellido = mysqli_real_escape_string($conn,(strip_tags($_POST['segundoApellido'], ENT_QUOTES)));
	$direccion = mysqli_real_escape_string($conn,(strip_tags($_POST['direccion'], ENT_QUOTES)));
	$telefono = mysqli_real_escape_string($conn,(strip_tags($_POST['telefono'], ENT_QUOTES)));
	$cuentaTutores_id = mysqli_real_escape_string($conn,(strip_tags($_POST['idCuentaTutores'], ENT_QUOTES)));

	$usuario = mysqli_real_escape_string($conn,(strip_tags($_POST['usuario'], ENT_QUOTES)));
	$passwordCuenta = mysqli_real_escape_string($conn,(strip_tags($_POST['passwordCuenta'], ENT_QUOTES)));


		$update = mysqli_query($conn, "UPDATE tutores, cuentaTutores SET tutores.dni='$dni', tutores.nombre='$nombre', tutores.primerApellido='$primerApellido', tutores.segundoApellido='$segundoApellido', tutores.direccion ='$direccion', tutores.telefono ='$telefono', tutores.cuentaTutores_id='$cuentaTutores_id', cuentaTutores.usuario='$usuario', cuentaTutores.password='$passwordCuenta' WHERE Tutores.id='$id' and cuentaTutores.id='$cuentaTutores_id'") or die(mysqli_error());
	
	if($update){
		echo "<script>alert('Los datos han sido actualizados!'); window.location = 'editar.php'</script>";
	}else{
		echo "<script>alert('Error, no se pudo actualizar los datos'); window.location = 'editar.php'</script>";
	}


}
?>