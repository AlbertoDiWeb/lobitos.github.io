<?php include "cuidadores/conn.php"; ?>
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
		<title>Registrar evento</title>
		<link rel="stylesheet" href="cuidadores/datatables/dataTables.bootstrap.css"/>
		<link type="text/css" href="cuidadores/css/bootstrap.css" rel="stylesheet">
		<link type="text/css" href="cuidadores/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
		<link type="text/css" href="cuidadores/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'    rel='stylesheet'> 
		<script src="cuidadores/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="cuidadores/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	</head>
	<body class="bg-info">
		<nav class="navbar navbar-light bg-primary static-top">
			<div class="container-fluid">
				<div class="row">
					<a class="navbar-brand" href="home.php" style="font-size: 20px; margin-left: 10%;font-weight: bold;">Página Eventos</a>
					<?php  if (isset($_SESSION['username'])) : ?>
						<a class="btn btn-danger pull-right" style="margin-right: 5%; margin-top: 0.6%" href="../controller/indexCuidadores.php?logout='1'">Desconectar</a> 
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
		
$texto = mysqli_real_escape_string($conn,(strip_tags($_POST['texto'], ENT_QUOTES)));
  
$insert = mysqli_query($conn, "INSERT INTO eventos (texto) VALUES('$texto')") or die(mysqli_error());
if($insert){
	echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho, los datos han sido agregados correctamente.</div>';
}else{
	echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo registrar los datos.</div>';
}
}

?>

<blockquote>
	Agregar evento
</blockquote>
<form name="form1" id="form1" class="form-horizontal row-fluid" action="registroeventos.php" method="POST" >
	<?php include('cuidadores/errors.php'); ?>
	<div class="control-group">
		<label class="control-label" for="texto">Texto</label>
		<div class="controls">

			<textarea type="text" name="texto" id="texto" placeholder="texto" class="form-control span8 tip" required></textarea>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Registrar</button>
			<a href="home.php" class="btn btn-sm btn-danger">Volver</a>
		</div>
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

<script src="cuidadores/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

</body>
