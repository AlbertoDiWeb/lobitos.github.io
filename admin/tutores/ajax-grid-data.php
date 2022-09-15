<?php

 include "conn.php";

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'id',
    1 => 'dni',
    2 => 'nombreCompleto',
    3 => 'direccion',
    4 => 'telefono',
    5 => 'nombreCompletoNino'

);

// getting total number records without any search
$sql = "SELECT tutores.id, tutores.dni, CONCAT(tutores.nombre,' ', tutores.primerApellido,' ', tutores.segundoApellido) as nombreCompleto, CONCAT(ninos.nombre,' ', ninos.primerApellido,' ', ninos.segundoApellido) as nombreCompletoNino, tutores.direccion, tutores.telefono ";
$sql.=" FROM ninos RIGHT JOIN tutores ON ninos.tutores_id = tutores.id ";
$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
// getting total number records without any search
$sql = "SELECT tutores.id, tutores.dni, CONCAT(tutores.nombre,' ', tutores.primerApellido,' ', tutores.segundoApellido) as nombreCompleto, CONCAT(ninos.nombre,' ', ninos.primerApellido,' ', ninos.segundoApellido) as nombreCompletoNino, tutores.direccion, tutores.telefono ";
$sql.=" FROM ninos RIGHT JOIN tutores ON ninos.tutores_id = tutores.id ";
	$sql.=" WHERE dni LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR nombreCompleto LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR direccion LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR telefono LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR nombreCompletoNino LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO"); // again run query with limit
	
} else {	

	// getting total number records without any search
$sql = "SELECT tutores.id, tutores.dni, CONCAT(tutores.nombre,' ', tutores.primerApellido,' ', tutores.segundoApellido) as nombreCompleto, CONCAT(ninos.nombre,' ', ninos.primerApellido,' ', ninos.segundoApellido) as nombreCompletoNino, tutores.direccion, tutores.telefono ";
$sql.=" FROM ninos RIGHT JOIN tutores ON ninos.tutores_id = tutores.id ";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["id"];
    $nestedData[] = $row["dni"];
	$nestedData[] = $row["nombreCompleto"];
	$nestedData[] = $row["direccion"];
    $nestedData[] = $row["telefono"];
    $nestedData[] = $row["nombreCompletoNino"];
    $nestedData[] = '<td><center>
                     <a href="editar.php?id='.$row['id'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-info"> <i class="menu-icon icon-pencil"></i> </a>
                     <a href="tutor.php?action=delete&id='.$row['id'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-danger"> <i class="menu-icon icon-trash"></i> </a>
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
