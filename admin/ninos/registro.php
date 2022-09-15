<?php include "conn.php"; ?>
<?php 
session_start(); 

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "Debes iniciar sesión.";
	header('location: ../../view/loginCuidadores.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: ../../view/loginCuidadores.php");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<head>
		<title>Registrar niño</title>
		<link rel="stylesheet" href="datatables/dataTables.bootstrap.css"/>
		<link type="text/css" href="css/bootstrap.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'    rel='stylesheet'> 
		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	</head>
	<body class="bg-info">
		<nav class="navbar navbar-light bg-primary static-top">
			<div class="container-fluid">
				<div class="row">
					<a class="navbar-brand" href="ninos.php" style="font-size: 20px; margin-left: 10%;font-weight: bold;">Página niños</a>
					<?php  if (isset($_SESSION['username'])) : ?>
						<a class="btn btn-danger pull-right" style="margin-right: 5%; margin-top: 0.6%" href="../../controller/indexCuidadores.php?logout='1'">Desconectar</a> 
					<?php endif ?>
				</div>
			</div>
		</nav>
		<br/>
		<div class="container bg-info">
			<div class="row">
				<div class="span12">
					<div class="content">
						<?php
						if(isset($_POST['input'])){
							$errors = array(); 
							$db = mysqli_connect('localhost', 'root', '', 'guarderia_database');

							if (count($errors) == 0) {
								$nombre = mysqli_real_escape_string($conn,(strip_tags($_POST['nombre'], ENT_QUOTES)));
								$primerApellido = mysqli_real_escape_string($conn,(strip_tags($_POST['primerApellido'], ENT_QUOTES)));
								$segundoApellido = mysqli_real_escape_string($conn,(strip_tags($_POST['segundoApellido'], ENT_QUOTES)));
								$fecha_nacimiento = mysqli_real_escape_string($conn,(strip_tags($_POST['fecha_nacimiento'], ENT_QUOTES)));
								$tutor = mysqli_real_escape_string($conn,(strip_tags($_POST['tutor'], ENT_QUOTES)));
								$cuidador = mysqli_real_escape_string($conn,(strip_tags($_POST['cuidador'], ENT_QUOTES)));
								$aula = mysqli_real_escape_string($conn,(strip_tags($_POST['aula'], ENT_QUOTES)));
								
								$insert = mysqli_query($conn, "INSERT INTO ninos(nombre, primerApellido, segundoApellido, fecha_nacimiento, tutores_id, cuidadores_id, aulas_id) VALUES('$nombre', '$primerApellido', '$segundoApellido', 
									'$fecha_nacimiento','$tutor','$cuidador','$aula')") or die(mysqli_error());
								if (empty($nombre || $primerApellido || $segundoApellido || $fecha_nacimiento || $tutor || $cuidador || $aula)) { array_push($errors, "Inserte todos los datos."); }
								if($insert){
									echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho, los datos han sido agregados correctamente.</div>';
								}else{
									echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo registrar los datos.</div>';
								}
							}
						}
						?>

						<blockquote>
							Agregar niño (Ingrese primero el Tutor).
						</blockquote>
						<form name="form1" id="form1" class="form-horizontal row-fluid" action="registro.php" method="POST" >
							<?php include('errors.php'); ?>

							<div class="control-group">
								<label class="control-label" for="nombre">Nombre</label>
								<div class="controls">
									<input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control span8 tip" required>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="primerApellido">Primer Apellido</label>
								<div class="controls">
									<input name="primerApellido" id="primerApellido" class="form-control span8 tip" type="text"placeholder="Primer Apellido"  required />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="segundoApellido">Segundo Apellido</label>
								<div class="controls">
									<input name="segundoApellido" id="segundoApellido" class="form-control span8 tip" type="text" placeholder="Segundo Apellido" required />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="fecha_nacimiento">Fecha de nacimiento</label>
								<div class="controls">
									<input name="fecha_nacimiento" id="fecha_nacimiento" class="form-control span8 tip" type="date" placeholder="Fecha de nacimiento" required />
								</div>
							</div>



							<div class="control-group">
								<label class="control-label" for="tutor">Tutor</label>
								<div class="controls">
									<?php
									$sql = "SELECT id,dni,nombre, primerApellido, segundoApellido FROM tutores ORDER BY nombre ASC";
									$result = $conn->query($sql); ?>
									<select name="tutor" id="tutor" class="form-control span8 tip" required>
										<option value="" <?php if(!isset($_POST['tutor']) || (isset($_POST['tutor']) && empty($_POST['tutor']))) { ?>selected<?php } ?>>Seleccione  tutor</option>
										<?php 
										while($row = $result->fetch_assoc()) {
											?>
											<option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['tutor']) && $_POST['tutor'] == $row['tutor']) { ?>selected<?php } ?>><?php echo $row['dni']; ?><?php echo " --> " ?><?php echo $row['nombre']; ?><?php echo "&nbsp;" ?><?php echo $row['primerApellido']; ?><?php echo "&nbsp;" ?><?php echo $row['segundoApellido']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="cuidador">Cuidador</label>
								<div class="controls">
									<?php
									$sql = "SELECT id,dni,nombre, primerApellido, segundoApellido FROM cuidadores ORDER BY nombre ASC";
									$result = $conn->query($sql); ?>

									<select name="cuidador" id="cuidador" class="form-control span8 tip" required> 
										<option value="" <?php if(!isset($_POST['cuidador']) || (isset($_POST['cuidador']) && empty($_POST['cuidador']))) { ?>selected<?php } ?>>Seleccione  cuidador</option>
										<?php 
										while($row = $result->fetch_assoc()) {
											?>
											<option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['cuidador']) && $_POST['cuidador'] == $row['cuidador']) { ?>selected<?php } ?>><?php echo $row['dni']; ?><?php echo " --> " ?><?php echo $row['nombre']; ?><?php echo "&nbsp;" ?><?php echo $row['primerApellido']; ?><?php echo "&nbsp;" ?><?php echo $row['segundoApellido']; ?></option>
										<?php } ?>
									</select>

								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="aula">Aula</label>
								<div class="controls">
									<?php
									$sql = "SELECT id,color FROM aulas ORDER BY color ASC";
									$result = $conn->query($sql); ?>

									<select name="aula" id="aula" class="form-control span8 tip" required>
										<option value="" <?php if(!isset($_POST['aula']) || (isset($_POST['aula']) && empty($_POST['aula']))) { ?>selected<?php } ?>>Seleccione  aula</option>
										<?php 
										while($row = $result->fetch_assoc()) {
											?>
											<option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['aula']) && $_POST['aula'] == $row['aula']) { ?>selected<?php } ?>><?php echo $row['color']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>


							<div class="control-group">
								<div class="controls">
									<button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Registrar</button>
									<a href="ninos.php" class="btn btn-sm btn-danger">Volver</a>
								</div>
							</div>
						</form>
					</div>
					<!--/.content-->
				</div>
				<!--/.span9-->
			</div>
		</div>
		<!--/.container-->

		<!--/.wrapper--><br />
		<div class="footer span-12">
			<div class="container">
				<center> <b class="copyright"><a href=""> Alberto Diéguez Álvarez</a> &copy; <?php echo date("Y")?> Guardería Lobitos </b></center>
			</div>
		</div>

		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

	</body>
