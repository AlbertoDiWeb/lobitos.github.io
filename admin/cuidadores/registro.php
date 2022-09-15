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
					<a class="navbar-brand" href="homeCuidadores.php" style="font-size: 20px; margin-left: 10%;font-weight: bold;">Página cuidadores</a>
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
		// recive los valores del registro 'form'
							$usuario = mysqli_real_escape_string($db, $_POST['usuario']);
							$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
							$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		// se valida el 'form'
							if (empty($usuario)) { array_push($errors, "Inserte usuario"); }
							if (empty($password_1)) { array_push($errors, "Inserte contraseña"); }
							if ($password_1 != $password_2) {
								array_push($errors, "La contraseña no coincide");
							}

// register user if there are no errors in the form
							if (count($errors) == 0) {
$password = md5($password_1);//encrypt the password before saving in the database
$query = "INSERT INTO cuentacuidadores (usuario, password) 
VALUES('$usuario', '$password')";
mysqli_query($db, $query);
$dni = mysqli_real_escape_string($conn,(strip_tags($_POST['dni'], ENT_QUOTES)));
$nombre = mysqli_real_escape_string($conn,(strip_tags($_POST['nombre'], ENT_QUOTES)));
$primerApellido = mysqli_real_escape_string($conn,(strip_tags($_POST['primerApellido'], ENT_QUOTES)));
$segundoApellido = mysqli_real_escape_string($conn,(strip_tags($_POST['segundoApellido'], ENT_QUOTES)));
$fecha_nacimiento = mysqli_real_escape_string($conn,(strip_tags($_POST['fecha_nacimiento'], ENT_QUOTES)));

// $max = "SELECT MAX(Id) as max_id FROM cuentacuidadores";     
// $max1 =  mysqli_query($conn, $max);   
// $row = mysqli_fetch_assoc($max1); 
// $max_id=$row['max_id'];      

$max = "SELECT MAX(Id) as max_id FROM cuentacuidadores WHERE usuario = '$usuario'";     
$max1 =  mysqli_query($conn, $max);   
$row = mysqli_fetch_assoc($max1); 
$max_id=$row['max_id']; 
$insert = mysqli_query($conn, "INSERT INTO cuidadores(dni, nombre, primerApellido, segundoApellido, fecha_nacimiento, cuentaCuidadores_id) VALUES('$dni', '$nombre', '$primerApellido', '$segundoApellido', 
	'$fecha_nacimiento','$max_id')") or die(mysqli_error());
if($insert){
	echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho, los datos han sido agregados correctamente.</div>';
}else{
	echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo registrar los datos.</div>';
}
}
}
?>

<blockquote>
	Agregar cuidador
</blockquote>
<form name="form1" id="form1" class="form-horizontal row-fluid" action="registro.php" method="POST" >
	<?php include('errors.php'); ?>
	<div class="control-group">
		<label class="control-label" for="dni">DNI</label>
		<div class="controls">
			<input type="text" name="dni" id="dni" placeholder="DNI" class="form-control span8 tip" required>
		</div>
	</div>

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
		<label class="control-label" for="usuario">Usuario</label>
		<div class="controls">
			<input name="usuario" id="usuario" class="form-control span8 tip" type="text" placeholder="Usuario" required />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="password_1">Contraseña</label>
		<div class="controls">
			<input name="password_1" id="password_1" class="form-control span8 tip" type="password" placeholder="Contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos: Un número, una letra mayúscula, una letra minúscula y 8 caracteres." required />
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="password_2">Repetir contraseña</label>
		<div class="controls">
			<input name="password_2" id="password_2" class="form-control span8 tip" type="password" placeholder="Repetir contraseña" required />
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Registrar</button>
			<a href="homeCuidadores.php" class="btn btn-sm btn-danger">Volver</a>
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
