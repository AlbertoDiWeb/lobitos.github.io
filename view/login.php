<!-- Iniciamos una sesión -->
<?php include('../controller/server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--Esto hace que si estamos trabajando con resposive desing que nuestra web se vea bien en todos los navegadores, incluyendo dispositivos móviles-->
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Lobitos</title>
	<!--Se cargan los archivos externos de CSS-->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="../css/login.css" media="all">
</head>
<body>
	

	<div class="container-fluid text-center">
		<div class="row h-100">
			<div class="col-lg-2" id="box-lados">
				
			</div>
			<div class="col-lg-8" id="box">
				<form  name="login" action="login.php" method="post" accept-charset="utf-8">
					<fieldset>
						<div>
							<?php include('../controller/errors.php'); ?>
							<br>
							<h2 class="blackJack" id="cabeceraFieldset">Iniciar sesión</h2>
							<p class="name">
								<input class="form-control" type="text" name="username" placeholder="Usuario" id="name">
							</p>
							<p class="password">
								<input class="form-control" type="password" name="password" id="password" placeholder="Contraseña">
							</p>
							<div>
								<input class="btn btn-primary m-3" type="submit" name="login_user" value="Iniciar sesión" id="botonSesion">
								<a href="../index.php">
									<input class="btn btn-primary m-3" type="button" name="volver" value="Volver">
								</a>
							</div>

						</div>
					</fieldset>
				</form>
				
			</div>
			<div class="col-lg-2" id="box-lados">
				
			</div>
		</div>
	</div>
	










	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>