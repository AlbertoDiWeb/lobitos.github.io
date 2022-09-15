<?php  
 $connect = mysqli_connect("localhost", "root", "", "guarderia_database");  
 $output = '';  
 $sql = "SELECT * FROM cuidadores ORDER BY id ASC";  
 $result = mysqli_query($connect, $sql);  
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">  
                <tr>  
                     <th width="12%">Id</th>  
                     <th width="22%">dni</th>  
                     <th width="22%">Nombre</th>  
                     <th width="22%">Primer apellido</th>
                     <th width="22%">Segundo apellido</th> 
                </tr>';  
 $rows = mysqli_num_rows($result);
 if($rows > 0)  
 {  
	  if($rows > 10)
	  {
		  $delete_records = $rows - 10;
		  $delete_sql = "DELETE FROM guarderia_database LIMIT $delete_records";
		  mysqli_query($connect, $delete_sql);
	  }
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td>'.$row["id"].'</td>  
                     <td class="dni" data-id1="'.$row["id"].'" contenteditable>'.$row["dni"].'</td>  
                     <td class="nombre" data-id2="'.$row["id"].'" contenteditable>'.$row["nombre"].'</td>
                     <td class="primerApellido" data-id3="'.$row["id"].'" contenteditable>'.$row["primerApellido"].'</td>
                     <td class="segundoApellido" data-id4="'.$row["id"].'" contenteditable>'.$row["segundoApellido"].'</td>    
                     <td><button type="button" name="delete_btn" data-id5="'.$row["id"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>  
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td></td>  
                <td id="dni" contenteditable></td>  
                <td id="nombre" contenteditable></td>
                <td id="primerApellido" contenteditable></td>
                <td id="segundoApellido" contenteditable></td>   
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '
				<tr>  
					<td></td>  
					<td id="dni" contenteditable></td>  
                	<td id="nombre" contenteditable></td>
                	<td id="primerApellido" contenteditable></td>
                	<td id="segundoApellido" contenteditable></td> 
					<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
			   </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>