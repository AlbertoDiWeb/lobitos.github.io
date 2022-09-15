<?php 
session_start(); 

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "Debes iniciar sesión.";
	header('location: ../view/loginCuidadores.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: ../view/loginCuidadores.php");
}

?>
<!DOCTYPE html>
<html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--Esto hace que si estamos trabajando con resposive desing que nuestra web se vea bien en todos los navegadores, incluyendo dispositivos móviles-->
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Cuenta Administrador</title>
	<!--Se cargan los archivos externos de CSS-->
	<link rel="stylesheet" type="text/css" href="../css/home.css" media="all">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" media="all">

</head>
<body>
	<nav class="navbar navbar-light bg-primary static-top">
		<div class="container">
			<a class="navbar-brand" href="home.php"><h1 id="bienvenido">Bienvenido</h1></a>
			<h1 id="bienvenido">Administrador</h1>
			<?php  if (isset($_SESSION['username'])) : ?>
				<a class="btn btn-danger" href="../controller/indexCuidadores.php?logout='1'">Desconectar</a> 
			<?php endif ?>
		</div>
	</nav>

	
	<section class="text-white text-center bg-info py-2">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4 bg-info">
					<input class="btn btn-primary m-3" type="submit" name="cuidadores" value="Cuidadores">
					<?php if (isset($_POST['cuidadores'])) {
						header('location: homeCuidadores.php');
					} ?>
				</div>
				<div class="col-lg-4 bg-info">
					adf
				</div>
				<div class="col-lg-4 bg-info">
					asdf
				</div>
			</div>
		</div>
	</section>





































<div class="container-fluid">
	

	<table>
		<tr>
			<th>id</th>
			<th>DNI</th>
			<th>Nombre</th>
			<th>Apellido1</th>
			<th>Apellido2</th>
			<th>Cuenta id</th>
		</tr>
		<?php
		$conn = mysqli_connect("localhost", "root", "", "guarderia_database");
// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT id, dni, nombre,primerApellido,segundoApellido,cuentaCuidadores_id FROM cuidadores";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>" . 
				$row["id"]. "</td><td>" . 
				$row["dni"] . "</td><td>".
				$row["nombre"] . "</td><td>". 
				$row["primerApellido"] . "</td><td>". 
				$row["segundoApellido"] . "</td><td>".
				$row["cuentaCuidadores_id"]. "</td></tr>";
			}
			echo "</table>";
		} else { echo "0 results"; }
		$conn->close();
		?>
	</table>
	</div>

	





























	<!--Cargamos las librerias de jquery y bootstrap-->
	<script src="../js/jquery-3.4.1.min.js"></script>
	<!--Algunas propiedades de bootstrap no funcionan bien sin la libreria popper, esta debe ser cargada primero-->
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>