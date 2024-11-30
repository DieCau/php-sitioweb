<?php 
session_start();
  if($_POST) {
    if($_POST['usuario'] == 'admin' && $_POST['password'] == 'admin') {
      
      $_SESSION['usuario'] = 'ok';
      $_SESSION['nombreUsuario'] = 'Diegol!';
      
      header('Location: inicio.php');
    }else {
      $mensaje = 'Usuario o Password incorrectos';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrador</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">  
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4">

      </div>
      <div class="col-md-4">
        <br/><br/><br/>
        <div class="card">
          <div class="card-body">
            Login
          </div>
          <div class="card-body"> 
            
          <?php if(isset($mensaje)) { ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $mensaje; ?>
            </div>
            <?php } ?>
            
            <form method="POST">
            
            <div class = "form-group">
              <label>Usuario</label>
              <input type="text" class="form-control" name="usuario" placeholder="Ingrese su Usuario">
            </div>
            
            <div class="form-group">
              <label for="txtPassword">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Ingrese su password">
            </div>           
            
            <button type="submit" class="btn btn-primary">Ingresar al Adminisatrador</button>
            
            </form>
          </div>          
        </div>
      </div>    
    </div>
  </div>
</body>
</html>