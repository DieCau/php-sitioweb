<?php include('template/header.php'); ?>

<?php 

// Incluir archivo bd.php
include("administrador/config/bd.php");

  // Mostrar la lista de libros 
  $sentenciaSQL= $conexion->prepare("SELECT * FROM libros");
  $sentenciaSQL->execute();
  $listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Luego de hacer la query, recorrer la lista de libros -->
<?php 

foreach($listaLibros as $libro) { ?>

<div class="col-md-3">
  <div class="card">
    <img class="card-img-top" src="./img/<?php echo $libro['imagen']; ?>" alt="imagen">
    <div class="card-body">
      <h4 class="card-title"><?php echo $libro['nombre'] ?></h4>
      <a name="" id="" class="btn btn-primary" href="https://books.goalkicker.com/" target="_blank" role="button">Ver Mas</a>
    </div>
  </div>
</div>

<?php }?>


<?php include('template/footer.php'); ?>