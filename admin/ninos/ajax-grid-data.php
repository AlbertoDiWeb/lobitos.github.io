<?php

 include "conn.php";

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'id',
    1 => 'nombreCompleto',
    2 => 'fecha_nacimiento',
    3 => 'tutor',
    4 => 'cuidador',
    5 => 'color'

);

// getting total number records without any search
$sql = "SELECT ninos.id, ninos.fecha_nacimiento, ninos.cuidadores_id, ninos.aulas_id, CONCAT(ninos.nombre,' ', ninos.primerApellido,' ', ninos.segundoApellido) as nombreCompleto, CONCAT(tutores.nombre,' ', tutores.primerApellido,' ', tutores.segundoApellido) as tutor, CONCAT(cuidadores.nombre,' ', cuidadores.primerApellido,' ', cuidadores.segundoApellido) as cuidador, aulas.color as color ";
$sql.=" FROM ninos, tutores, cuidadores, aulas WHERE ninos.tutores_id = tutores.id and ninos.cuidadores_id = cuidadores.id and ninos.aulas_id = aulas.id  ";
$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
$sql = "SELECT ninos.id, ninos.fecha_nacimiento, ninos.cuidadores_id, ninos.aulas_id, CONCAT(ninos.nombre,' ', ninos.primerApellido,' ', ninos.segundoApellido) as nombreCompleto, CONCAT(tutores.nombre,' ', tutores.primerApellido,' ', tutores.segundoApellido) as tutor, CONCAT(cuidadores.nombre,' ', cuidadores.primerApellido,' ', cuidadores.segundoApellido) as cuidador, aulas.color as color ";
$sql.=" FROM ninos, tutores, cuidadores, aulas WHERE ninos.tutores_id = tutores.id and ninos.cuidadores_id = cuidadores.id and ninos.aulas_id = aulas.id  ";
	$sql.=" WHERE nombreCompleto LIKE '".$requestData['search']['value']."%' ";
	$sql.=" WHERE fecha_nacimiento LIKE '".$requestData['search']['value']."%' "; 
	$sql.=" WHERE tutor LIKE '".$requestData['search']['value']."%' "; 
	$sql.=" WHERE cuidadores_id LIKE '".$requestData['search']['value']."%' "; 
	$sql.=" WHERE aulas_id LIKE '".$requestData['search']['value']."%' "; 
    // $requestData['search']['value'] contains search parameter


	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO"); // again run query with limit
	
} else {	

$sql = "SELECT ninos.id, ninos.fecha_nacimiento, ninos.cuidadores_id, ninos.aulas_id, CONCAT(ninos.nombre,' ', ninos.primerApellido,' ', ninos.segundoApellido) as nombreCompleto, CONCAT(tutores.nombre,' ', tutores.primerApellido,' ', tutores.segundoApellido) as tutor, CONCAT(cuidadores.nombre,' ', cuidadores.primerApellido,' ', cuidadores.segundoApellido) as cuidador, aulas.color as color ";
$sql.=" FROM ninos, tutores, cuidadores, aulas WHERE ninos.tutores_id = tutores.id and ninos.cuidadores_id = cuidadores.id and ninos.aulas_id = aulas.id  ";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["id"];
    $nestedData[] = $row["nombreCompleto"];
	$nestedData[] = date("d/m/Y", strtotime($row["fecha_nacimiento"]));
	$nestedData[] = $row["tutor"];
	$nestedData[] = $row["cuidador"];
	$nestedData[] = $row["color"];
    $nestedData[] = '<td><center>
                     <a href="editar.php?id='.$row['id'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-info"> <i class="menu-icon icon-pencil"></i> </a>
                     <a href="ninos.php?action=delete&id='.$row['id'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-danger"> <i class="menu-icon icon-trash"></i> </a>
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
