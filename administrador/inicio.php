<?php include('template/header.php'); ?>

    <div class="col-md-12">
        <div class="jumbotron">
          <h1 class="display-3">Bienvenido <?php echo $nombreUsuario; ?></h1>
          <p class="lead">Listo para administrar nuestros Libros en la Web?</p>
          <hr class="my-2">
          <p><?php echo Date('d/m/Y'); ?></p>
          <p class="lead">
            <a class="btn btn-primary btn-lg" href="seccion/productos.php" role="button">Administrar Libros</a>
          </p>
        </div>
      </div>

<?php include('template/footer.php'); ?>