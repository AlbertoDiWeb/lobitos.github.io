<?php 
session_start();

$username = "";
$errors = array();
$_SESSION['success'] = "";

// Conexión a la base de datos
$db = mysqli_connect('localhost' , 'root', '', 'guarderia_database');
  

  // Login
  if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
      array_push($errors , "Debe introducir un usuario");
    }
    if (empty($password)) {
      array_push($errors , "Debe introducir una contraseña");
    }
    if (count($errors) == 0) {
      $password = md5($password);
      $query =  "SELECT * FROM cuentatutores WHERE usuario = '$username' AND password = '$password'";
      $results = mysqli_query($db, $query);

      if (mysqli_num_rows($results) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Sesión iniciada";
        header('location: tutor/tutor.php');
      }else{
        array_push($errors, "Combinación errónea");
      }
    }
  }
 ?>