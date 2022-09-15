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
		<title>Editar cuidador</title>
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
					<a class="navbar-brand" href="home.php" style="font-size: 20px; margin-left: 10%;font-weight: bold;">Página Principal</a>
					<?php  if (isset($_SESSION['username'])) : ?>
						<a class="btn btn-danger pull-right" style="margin-right: 5%; margin-top: 0.6%" href="../controller/indexCuidadores.php?logout='1'">Desconectar</a> 
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
						$sql = mysqli_query($conn, "SELECT * FROM eventos WHERE id='$id'");
						if(mysqli_num_rows($sql) == 0){
							header("Location: home.php");
						}else{
							$row = mysqli_fetch_assoc($sql);
						}

						?>

						<blockquote>
							Actualizar datos de eventos
						</blockquote>
						<form name="form1" id="form1" class="form-horizontal row-fluid" action="update-edit.php" method="POST" >
							<div class="control-group">
								<label class="control-label" for="basicinput">ID</label>
								<div class="controls">
									<input type="text" name="id" id="id" value="<?php echo $row['id']; ?>" placeholder="" class="form-control span8 tip" readonly="readonly">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="basicinput">Texto</label>
								<div class="controls">
									<textarea type="text" name="texto" id="texto" value="<?php echo $row['texto']; ?>" placeholder="Texto" class="form-control span8 tip" required><?php echo $row['texto']; ?></textarea>
								</div>
							</div>



							<div class="control-group">
								<div class="controls">
									<input type="submit" name="update" id="update" value="Actualizar" class="btn btn-sm btn-primary"/>
									<a href="home.php" class="btn btn-sm btn-danger">Volver</a>
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
