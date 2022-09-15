<?php

 include "conn.php";
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











/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$columns = array( 
// datatable column index  => database column name
	0 => 'nombreNino',
	1 => 'nombreTutor',
	2 => 'direccion',
	3 => 'telefono'
);

$user = $_SESSION['username'];
$sql = mysqli_query($conn, "SELECT * FROM cuentacuidadores WHERE usuario = '$user' ");
if(mysqli_num_rows($sql) == 0){
	header("Location: cuidador.php");
}else{
	$row = mysqli_fetch_assoc($sql);
}
$userid = $row['id'];





// getting total number records without any search
$sql = "SELECT ninos.id, CONCAT(ninos.nombre,' ', ninos.primerApellido,' ', ninos.segundoApellido) as nombreNino, CONCAT(tutores.nombre,' ', tutores.primerApellido,' ', tutores.segundoApellido) as nombreTutor, tutores.direccion, tutores.telefono  ";
$sql.=" FROM ninos, tutores, cuidadores WHERE cuidadores.id = $userid";
$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
$sql = "SELECT ninos.id, CONCAT(ninos.nombre,' ', ninos.primerApellido,' ', ninos.segundoApellido) as nombreNino, CONCAT(tutores.nombre,' ', tutores.primerApellido,' ', tutores.segundoApellido) as nombreTutor, tutores.direccion, tutores.telefono  ";
$sql.=" FROM ninos, tutores, cuidadores WHERE cuidadores.id = $userid";
	$sql.=" WHERE id LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR nombreNino LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR nombreTutor LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR direccion LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR telefono LIKE '".$requestData['search']['value']."%' ";

	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO"); // again run query with limit
	
} else {	

$sql = "SELECT ninos.id, CONCAT(ninos.nombre,' ', ninos.primerApellido,' ', ninos.segundoApellido) as nombreNino, CONCAT(tutores.nombre,' ', tutores.primerApellido,' ', tutores.segundoApellido) as nombreTutor, tutores.direccion, tutores.telefono  ";
$sql.=" FROM ninos, tutores, cuidadores WHERE cuidadores.id = $userid";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	
    $nestedData[] = $row["nombreNino"];
    $nestedData[] = $row["nombreTutor"];
    $nestedData[] = $row["direccion"];
    $nestedData[] = $row["telefono"];

    $nestedData[] = '<td><center>
                     <a href="editar.php?id='.$row['id'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-info"> <i class="menu-icon icon-pencil"></i> </a>
                     <a href="homeCuidadores.php?action=delete&id='.$row['id'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-danger"> <i class="menu-icon icon-trash"></i> </a>
				     </center></td>';		
	
	$data[] = $nestedData;
    
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
