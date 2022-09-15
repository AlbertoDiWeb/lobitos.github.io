<?php
include "cuidadores/conn.php";
if(isset($_POST['update'])){
	$id			= intval($_POST['id']);
	$texto = mysqli_real_escape_string($conn,(strip_tags($_POST['texto'], ENT_QUOTES)));

	$update = mysqli_query($conn, "UPDATE eventos SET texto='$texto' WHERE id='$id'") or die(mysqli_error());
	
	if($update){
		echo "<script>alert('Los datos han sido actualizados!'); window.location = 'editar.php'</script>";
	}else{
		echo "<script>alert('Error, no se pudo actualizar los datos'); window.location = 'editar.php'</script>";
	}


}
?>