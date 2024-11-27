<?php include('../template/header.php'); ?>

<?php

$txtID = (isset($_POST['txtID']))?$_POST['txtID']:'';

$txtNombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:'';

$txtImagen = (isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:'';

$accion = (isset($_POST['accion']))?$_POST['accion']:'';


?>

<div class="col-md-5">
  <!-- card -->
  <div class="card">

  <div class="card-header">
      Dato del Libro
    </div>

    <div class="card-body">
      <!-- Formulario -->
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="txtID">ID:</label>
            <input type="text" class="form-control" name="txtID" id="txtID" placeholder="Ingrese ID">
          </div>
      
          <div class="form-group">
            <label for="txtNombre">Nombre:</label>
            <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Nombre del Libro">
          </div>
      
          <div class="form-group">
            <label for="txtImagen">Imagen</label>
            <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen...">
          </div>
      
          <div class="btn-group" role="group" aria-label="">
            <button type="button" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
            <button type="button" name="accion" value="Editar" class="btn btn-warning">Editar</button>
            <button type="button" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
          </div>
      
        </form>

    </div>
  </div>
</div>

<div class="col-md-7">
  <!-- tabla -->
 
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Libro</th>
        <th>Imagen</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <td>2</td>
        <td>Aprende PHP</td>
        <td>imagen.jpg</td>
        <td>Seleccionar | Eliminar</td>
      </tr>
 
    </tbody>
  </table>
</div>

<?php include('../template/footer.php'); ?>