<?php 
session_start();

$username = "";
$errors = array();
$_SESSION['success'] = "";

// Conexión a la base de datos
$db = mysqli_connect('localhost' , 'root', '', 'guarderia_database');


// Login
if (isset($_POST['login_cuidadores'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors , "Debe introducir un usuario");
  }
  if (empty($password)) {
    array_push($errors , "Debe introducir una contraseña");
  }

  if (count($errors) == 0) {
    $admin = "admin";
    $password = md5($password);
    $query =  "SELECT * FROM cuentacuidadores WHERE usuario = '$username' AND password = '$password' LIMIT 1";
    $queryAdmin = "SELECT * FROM cuentacuidadores WHERE usuario='$username' AND password='$password' AND tipo='$admin' LIMIT 1";
    $resultAdmin =  mysqli_query($db, $queryAdmin);
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($resultAdmin) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "Sesión iniciada";
      header('location: ../admin/home.php');
    }else{
      if (mysqli_num_rows($results) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Sesión iniciada";
        header('location: cuidador/cuidador.php');
      }
      
    }
      array_push($errors, "Combinación errónea");
  }
}
?>