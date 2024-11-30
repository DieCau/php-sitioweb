<?php 
// Inicio de la sesion
session_start();
  if(!isset($_SESSION['usuario'])) {
    // Si hay una sesion iniciada se redirecciona a index.php (login)
    header('Location:../index.php');
  }else {
    // Si no hay una sesion iniciada se crea la sesion y se almacena en la variable $nombreUsuario
    if($_SESSION['usuario'] == 'ok') {
      $nombreUsuario = $_SESSION['nombreUsuario'];
    }
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio Administrador</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>

  <?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb"; ?>

  <nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
      <a class="nav-item nav-link active" href="<?php echo $url; ?>/administrador/inicio.php">Administrador de Libreria</span></a>
      <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/inicio.php">Inicio</a>
      <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/productos.php">Libros</a>
      <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/cerrar.php">Cerrar</a>
      <a class="nav-item nav-link" href="<?php echo $url; ?>">Ver Sitio Web</a>
      </li>
    </div>
  </nav>

  <div class="container">
    <br>
    <div class="row">