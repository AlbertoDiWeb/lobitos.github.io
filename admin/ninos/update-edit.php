<?php
include "conn.php";
if(isset($_POST['update'])){
	$id			= intval($_POST['id']);
	$nombre = mysqli_real_escape_string($conn,(strip_tags($_POST['nombre'], ENT_QUOTES)));
	$primerApellido = mysqli_real_escape_string($conn,(strip_tags($_POST['primerApellido'], ENT_QUOTES)));
	$segundoApellido = mysqli_real_escape_string($conn,(strip_tags($_POST['segundoApellido'], ENT_QUOTES)));
	$fecha_nacimiento = mysqli_real_escape_string($conn,(strip_tags($_POST['fecha_nacimiento'], ENT_QUOTES)));
	$tutor = mysqli_real_escape_string($conn,(strip_tags($_POST['tutor'], ENT_QUOTES)));
	$cuidador = mysqli_real_escape_string($conn,(strip_tags($_POST['cuidador'], ENT_QUOTES)));
	$aula = mysqli_real_escape_string($conn,(strip_tags($_POST['aula'], ENT_QUOTES)));




	$update = mysqli_query($conn, "UPDATE ninos SET ninos.nombre='$nombre', ninos.primerApellido='$primerApellido', ninos.segundoApellido='$segundoApellido', ninos.fecha_nacimiento ='$fecha_nacimiento', ninos.tutores_id='$tutor', ninos.cuidadores_id='$cuidador', ninos.aulas_id='$aula' WHERE ninos.id='$id'") or die(mysqli_error());
	
	if($update){
		echo "<script>alert('Los datos han sido actualizados!'); window.location = 'editar.php'</script>";
	}else{
		echo "<script>alert('Error, no se pudo actualizar los datos'); window.location = 'editar.php'</script>";
	}


}
?>