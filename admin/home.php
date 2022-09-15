<?php include "cuidadores/conn.php"; ?>
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
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--Esto hace que si estamos trabajando con resposive desing que nuestra web se vea bien en todos los navegadores, incluyendo dispositivos móviles-->
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Cuenta Administrador</title>
	<!--Se cargan los archivos externos de CSS-->
	<link rel="stylesheet" href="cuidadores/datatables/dataTables.bootstrap.css"/>
  <link type="text/css" href="cuidadores/css/bootstrap.css" rel="stylesheet">
  <link type="text/css" href="cuidadores/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
  <link type="text/css" href="cuidadores/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
  <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'    rel='stylesheet'> 
  <script src="cuidadores/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
  <script src="cuidadores/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

</head>
<body>
	<nav class="navbar navbar-light bg-primary static-top">
		<div class="container-fluid">
			<div class="row">
				<a class="navbar-brand" href="home.php" style="font-size: 20px; margin-left: 10%;font-weight: bold;">Bienvenido &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Administrador</a>
				<?php  if (isset($_SESSION['username'])) : ?>
          <a class="btn btn-danger pull-right" style="margin-right: 5%; margin-top: 0.6%" href="../controller/indexCuidadores.php?logout='1'">Desconectar</a> 
        <?php endif ?>
      </div>
    </div>
  </nav>


  <section class="text-white text-center bg-info py-2" style="padding-top: 20px; margin-top: -20px;">
    <div class="container-fluid">
      <div class="row">

      	<div class="col-lg-3 bg-info">
          <form action="home.php" method="post" accept-charset="utf-8">
            <input class="btn btn-primary m-3" type="submit" name="eventos" value="Eventos">
            <?php if (isset($_POST['eventos'])) {
              header('location: home.php');
            } ?>
          </form>
        </div>
        <div class="col-lg-3 bg-info">
          <form action="home.php" method="post" accept-charset="utf-8">
           <input class="btn btn-primary m-3" type="submit" name="cuidadores" value="Cuidadores">
           <?php if (isset($_POST['cuidadores'])) {
             header('location: cuidadores/homeCuidadores.php');
           } ?>
         </form>
       </div>


       <div class="col-lg-3 bg-info">
        <form action="home.php" method="post" accept-charset="utf-8">
         <input class="btn btn-primary m-3" type="submit" name="ninos" value="Niños">
         <?php if (isset($_POST['ninos'])) {
           header('location: ninos/ninos.php');
         } ?>
       </form>
     </div>

     <div class="col-lg-3 bg-info">
      <form action="home.php" method="post" accept-charset="utf-8">
        <input class="btn btn-primary m-3" type="submit" name="tutores" value="Tutores">
        <?php if (isset($_POST['tutores'])) {
          header('location: tutores/tutor.php');
        } ?>
      </form>
    </div>


  </div>
</div>
</section>
<div class="content container-fluid">
  <?php
  if(isset($_GET['action']) == 'delete'){
    $id_delete = intval($_GET['id']);
    $query = mysqli_query($conn, "SELECT * FROM eventos WHERE id='$id_delete'");
    if(mysqli_num_rows($query) == 0){
      echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
    }else{
      $delete = mysqli_query($conn, "DELETE FROM eventos WHERE id='$id_delete' LIMIT 1");
      if($delete){
        echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos del cuidador han sido eliminados.</div>';
      }else{
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
      }
    }
  }
  ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="pull-right">
        <a href="registroeventos.php" class="btn btn-sm btn-primary">Nuevo evento</a>
      </div><br>
      <hr>
      <table id="lookup" class="table table-bordered table-hover table-responsive">  
       <thead bgcolor="#eeeeee" align="center">
        <tr>

          <th>ID</th>
          <th>Texto evento</th>
          <th>Fecha</th>
          <th id="sinClick" class="text-center"> Acciones </th> 

        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

  </div>
</div>

</div>
<!--/.content-->
<!--/.wrapper--><br />
<div class="footer span-12">
  <div class="container">
    <center> <b class="copyright"><a href=""> Alberto Diéguez Álvarez</a> &copy; <?php echo date("Y")?> Guardería Lobitos </b></center>
  </div>
</div>
<script src="cuidadores/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="cuidadores/datatables/jquery.dataTables.js"></script>
<script src="cuidadores/datatables/dataTables.bootstrap.js"></script>
<script>
  $(document).ready(function() {
    var dataTable = $('#lookup').DataTable( {

     "language":  {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },

    "processing": true,
    "serverSide": true,
    "ajax":{
            url :"ajax-grid-data.php", // json datasource
            type: "post",  // method  , by default get
            error: function(){  // error handling
              $(".lookup-error").html("");
              $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No se han encontrado datos en el servidor.</th></tr></tbody>');
              $("#lookup_processing").css("display","none");
              
            }
          }
        } );
  } );
</script>  
</body>
</html>