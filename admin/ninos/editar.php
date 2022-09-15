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
		<title>Registrar cuidador</title>
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

		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="content">
						<?php
						$id = intval($_GET['id']);
						$sql = mysqli_query($conn, "SELECT * FROM ninos WHERE id='$id'");
						if(mysqli_num_rows($sql) == 0){
							header("Location: ninos.php");
						}else{
							$row = mysqli_fetch_assoc($sql);
						}

					    $idtutor = intval($_GET['id']);
						$sqltutor = mysqli_query($conn, "SELECT * FROM ninos n, tutores t WHERE t.id = n.tutores_id and n.id = '$id'");
						if(mysqli_num_rows($sqltutor) == 0){
							header("Location: ninos.php");
						}else{
							$rowtutor = mysqli_fetch_assoc($sqltutor);
						}

						$idcuidador = intval($_GET['id']);
						$sqlcuidador = mysqli_query($conn, "SELECT * FROM ninos n, cuidadores c WHERE c.id = n.cuidadores_id and n.id = '$id' ");
						if(mysqli_num_rows($sqlcuidador) == 0){
							header("Location: ninos.php");
						}else{
							$rowcuidador = mysqli_fetch_assoc($sqlcuidador);
						}

					
						$sqlaula= mysqli_query($conn, "SELECT * FROM ninos n, aulas a WHERE a.id = n.aulas_id and n.id = '$id'  ");
						if(mysqli_num_rows($sqlaula) == 0){
							header("Location: ninos.php");
						}else{
							$rowaula = mysqli_fetch_assoc($sqlaula);
						}

					


					


						?>

						<blockquote>
							Actualizar datos del niño
						</blockquote>
						<form name="form1" id="form1" class="form-horizontal row-fluid" action="update-edit.php" method="POST" >
							<div class="control-group">
								<label class="control-label" for="basicinput">ID</label>
								<div class="controls">
									<input type="text" name="id" id="id" value="<?php echo $row['id']; ?>" placeholder="" class="form-control span8 tip" readonly="readonly">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="basicinput">Nombre</label>
								<div class="controls">
									<input type="text" name="nombre" id="nombre" value="<?php echo $row['nombre']; ?>" placeholder="" class="form-control span8 tip" required>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="basicinput">Primer apellido</label>
								<div class="controls">
									<input name="primerApellido" id="primerApellido" value="<?php echo $row['primerApellido']; ?>" class="form-control span8 tip" type="text"  required />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="basicinput">Segundo apellido</label>
								<div class="controls">
									<input name="segundoApellido" id="segundoApellido" value="<?php echo $row['segundoApellido']; ?>" class="form-control span8 tip" type="text"  required />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="basicinput">Fecha de nacimiento</label>
								<div class="controls">
									<input name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $row['fecha_nacimiento']; ?>" class="form-control span8 tip" type="date"  required />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="tutor">Tutor</label>
								<div class="controls">
									<?php
									$sql = "SELECT id,dni,nombre, primerApellido, segundoApellido FROM tutores ORDER BY nombre ASC";
									$result = $conn->query($sql); ?>
									<select name="tutor" id="tutor" class="form-control span8 tip" required>
										<option value="<?php echo $rowtutor['id']; ?>" <?php if(!isset($_POST['tutor']) || (isset($_POST['tutor']) && empty($_POST['tutor']))) { ?>selected<?php } ?>><?php echo $rowtutor['dni']; ?><?php echo " --> " ?><?php echo $rowtutor['nombre']; ?><?php echo "&nbsp;" ?><?php echo $rowtutor['primerApellido']; ?><?php echo "&nbsp;" ?><?php echo $rowtutor['segundoApellido']; ?></option>
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

										<option value="<?php echo $rowcuidador['id']; ?>" <?php if(!isset($_POST['cuidador']) || (isset($_POST['cuidador']) && empty($_POST['cuidador']))) { ?>selected<?php } ?>><?php echo $rowcuidador['dni']; ?><?php echo " --> " ?><?php echo $rowcuidador['nombre']; ?><?php echo "&nbsp;" ?><?php echo $rowcuidador['primerApellido']; ?><?php echo "&nbsp;" ?><?php echo $rowcuidador['segundoApellido']; ?></option>
										
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
										<option value="<?php echo $rowaula['id']; ?>" <?php if(!isset($_POST['aula']) || (isset($_POST['aula']) && empty($_POST['aula']))) { ?>selected<?php } ?>><?php echo $rowaula['color']; ?></option>
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
									<input type="submit" name="update" id="update" value="Actualizar" class="btn btn-sm btn-primary"/>
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
