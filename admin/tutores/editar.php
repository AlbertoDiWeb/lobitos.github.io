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
		<title>Editar tutor</title>
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
					<a class="navbar-brand" href="tutor.php" style="font-size: 20px; margin-left: 10%;font-weight: bold;">Página tutores</a>
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
						$sql = mysqli_query($conn, "SELECT * FROM tutores WHERE id='$id'");
						if(mysqli_num_rows($sql) == 0){
							header("Location: tutor.php");
						}else{
							$row = mysqli_fetch_assoc($sql);
						}

						$idCuentaTutores = intval($_GET['id']);
						$sqlCuentaTutores = mysqli_query($conn, "SELECT * FROM cuentatutores WHERE id='$id'");
						if(mysqli_num_rows($sqlCuentaTutores) == 0){
							header("Location: tutor.php");
						}else{
							$rowCuentaTutores = mysqli_fetch_assoc($sqlCuentaTutores);
						}


						?>

						<blockquote>
							Actualizar datos del tutor
						</blockquote>
						<form name="form1" id="form1" class="form-horizontal row-fluid" action="update-edit.php" method="POST" >
							<div class="control-group">
								<label class="control-label" for="basicinput">ID</label>
								<div class="controls">
									<input type="text" name="id" id="id" value="<?php echo $row['id']; ?>" placeholder="" class="form-control span8 tip" readonly="readonly">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="basicinput">DNI</label>
								<div class="controls">
									<input type="text" name="dni" id="dni" value="<?php echo $row['dni']; ?>" placeholder="" class="form-control span8 tip" required>
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
								<label class="control-label" for="basicinput">Dirección</label>
								<div class="controls">
									<input name="direccion" id="direccion" value="<?php echo $row['direccion']; ?>" class="form-control span8 tip" type="text"  required />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="basicinput">Teléfono</label>
								<div class="controls">
									<input name="telefono" id="telefono" value="<?php echo $row['telefono']; ?>" class="form-control span8 tip" type="text"  required />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="basicinput">ID de la cuenta de tutor</label>
								<div class="controls">
									<input name="cuentaTutores_id" id="cuentaTutores_id" value="<?php echo $row['cuentaTutores_id']; ?>" class=" form-control span8 tip" type="text" required  />
								</div>
							</div>



							<blockquote>
								Actualizar datos de la cuenta del cuidador
							</blockquote>

							<div class="control-group">
								<label class="control-label" for="basicinput">ID</label>
								<div class="controls">
									<input type="text" name="idCuentaTutores" id="idCuentaTutores" value="<?php echo $rowCuentaTutores['id']; ?>" placeholder="" class="form-control span8 tip" required>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="basicinput">Usuario</label>
								<div class="controls">
									<input type="text" name="usuario" id="usuario" value="<?php echo $rowCuentaTutores['usuario']; ?>" placeholder="" class="form-control span8 tip" required>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="basicinput">Contraseña</label>
								<div class="controls">
									<input name="passwordCuenta" id="passwordCuenta" value="<?php echo $rowCuentaTutores['password']; ?>" class="form-control span8 tip" type="text"  required /> *Contraseña en md5
								</div>
							</div>


							<div class="control-group">
								<div class="controls">
									<input type="submit" name="update" id="update" value="Actualizar" class="btn btn-sm btn-primary"/>
									<a href="tutor.php" class="btn btn-sm btn-danger">Volver</a>
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
