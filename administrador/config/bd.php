<?php 

// Conexion a la base de datos
$host = "localhost";
$user = "root"; 
$password = "root";
$database = "sitio";

// Probar con un try-catch si realiza la conexion
try {
  $conexion = new PDO("mysql:host=$host;dbname=$database;", $user, $password);
  $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Conexion fallida: " . $e->getMessage();
}

?>
