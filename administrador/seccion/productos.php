<?php include('../template/header.php'); ?>

<?php
$txtID = (isset($_POST['txtID'])) ?$_POST['txtID'] :'';

$txtNombre = (isset($_POST['txtNombre'])) ?$_POST['txtNombre'] :'';

$txtImagen = (isset($_FILES['txtImagen']['name'])) ?$_FILES['txtImagen']['name'] :'';

$accion = (isset($_POST['accion'])) ?$_POST['accion'] :'';

// Incluir archivo bd.php
include('../../administrador/config/bd.php');

switch($accion){
  case 'Agregar':
    $sentenciaSQL= $conexion->prepare("INSERT INTO libros (nombre, imagen) VALUES (:nombre, :imagen);");
    // Parametro ':nombre' tendra el valor de $txtNombre
    $sentenciaSQL->bindParam(':nombre', $txtNombre);
    
    // Coloco $fecha para que el nombre de la imagen sea unico
    $fecha = new DateTime();

    // Si hay una imagen tendra concatenado la fecha + el nombre de la imagen asignada en $nombreArchivo y si no tendra 'imagen.jpg'
    $nombreArchivo = ($txtImagen != '') ? $fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"] : "imagen.jpg";

    // $nombreArchivo se asigna con un tmp_name a $tmpImagen
    $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

    // Si $tmpImagen no esta vacio muevo el archivo $nombreArchivo a la carpeta img
    if($tmpImagen != '') {
      move_uploaded_file($tmpImagen, "../../img/".$nombreArchivo);
    }
    
    // Parametro ':imagen' tendra el valor de $nombreArchivo
    $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
    // Ejecuta la sentencia SQL
    $sentenciaSQL->execute();
    break;

  case 'Modificar':
      $sentenciaSQL= $conexion->prepare("UPDATE libros SET nombre=:nombre WHERE id=:id;");
      $sentenciaSQL->bindParam(':nombre', $txtNombre);
      $sentenciaSQL->bindParam(':id', $txtID);
      $sentenciaSQL->execute();

      if($txtImagen != '') {
        $sentenciaSQL= $conexion->prepare("UPDATE libros SET imagen=:imagen WHERE id=:id;");
        $sentenciaSQL->bindParam(':imagen', $txtImagen);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute(); 
      }
    break;
  
    case 'Cancelar':
      header('Location: productos.php');
    break;
  
    
    case 'Seleccionar':
      $sentenciaSQL= $conexion->prepare("SELECT * FROM libros WHERE id=:id;");
      $sentenciaSQL->bindParam(':id', $txtID);
      $sentenciaSQL->execute();
      // Crea los nombres de las variables del objeto a medida que se acceden a ellas 
      // y los almacena en la variable $libro
      $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
      // Asignar valores recuperados de la DB a las variables de los inputs del formulario 
      $txtNombre = $libro['nombre'];
      $txtImagen = $libro['imagen'];
    break;
    
    case 'Eliminar':

      $sentenciaSQL= $conexion->prepare("SELECT imagen FROM libros WHERE id=:id;");
      $sentenciaSQL->bindParam(':id', $txtID);
      $sentenciaSQL->execute();
      // Crea los nombres de las variables del objeto a medida que se acceden a ellas 
      // y los almacena en la variable $libro
      $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

      // Si existe la imagen y no es 'imagen.jpg' la borramos
      if(isset($libro['imagen']) && $libro['imagen'] != 'imagen.jpg') {
        // Si existe la imagen
        if(file_exists('../../img/'.$libro['imagen']))
        // Borrar la imagen
        unlink('../../img/'.$libro['imagen']);
      }

      // Borrar desde la tabla libros cuando el id sea igual a :id
      $sentenciaSQL= $conexion->prepare("DELETE FROM libros WHERE id=:id;");
      $sentenciaSQL->bindParam(':id', $txtID);
      $sentenciaSQL->execute();
    break;
}

// Mostrar la lista de libros
$sentenciaSQL= $conexion->prepare("SELECT * FROM libros;");
// Ejecutar la sentencia SQL
$sentenciaSQL->execute();
// Almacenar los resultados a la variable $listaLibros
$listaLibros= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">
  <!-- card -->
  <div class="card">
    <div class="card-header">
      Datos del Libro
    </div>

    <div class="card-body">
      <!-- Formulario -->
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="txtID">ID:</label>
            <input type="text" class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="Ingrese ID">
          </div>
      
          <div class="form-group">
            <label for="txtNombre">Nombre:</label>
            <input type="text" class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del Libro">
          </div>
      
          <div class="form-group">
            <label for="txtImagen">Imagen</label>
            
            <?php echo $txtImagen; ?>

            <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen...">
          </div>
      
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
            <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
            <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
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

    <!-- Recorremos la lista de libros almacenada en la variable $listaLibros -->
    <?php foreach($listaLibros as $libro) { ?>
      <tr>
        <td><?php echo $libro['id']; ?></td>
        <td><?php echo $libro['nombre']; ?></td>
        <td><?php echo $libro['imagen']; ?></td>
        <td>
          <form action="" method="post">

            <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id']; ?>"/>
            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">          
            <input type="submit" name="accion" value="Eliminar" class="btn btn-danger"/>
          
          </form>
        </td>
      </tr>
    <?php } ?>
 
    </tbody>
  </table>
</div>

<?php include('../template/footer.php'); ?>