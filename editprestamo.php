<?php
 include ('config/db.php');

    $id = $_GET['id'];
    $result = mysqli_query($conn,"select * from prestamo where cod_prestamo = '$id'");
    $row = mysqli_fetch_assoc($result);
   
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       $id_estudiante = $_POST['id_estudiante'];
       $cod_producto = $_POST['cod_producto'];
       $cantidad = $_POST['cantidad'];
        $resultt = mysqli_query($conn,"update prestamo set id_estudiante = '$id_estudiante', cod_producto = '$cod_producto', cantidad = '$cantidad' where cod_prestamo = '$id'");
        if($resultt){
        header('location: tablaprestamo.php');
        }
    }

 ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
    .n{
        margin-top: 100px;
        justify-content:  center;
    }
</style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
      <div class="row n">
      <div class="col-xs-12 col-lg-5">
      <form method="POST">
      <h1 class="text-center"><strong>Editar Producto</strong></h1>
      <br>
      <input type="text" placeholder="id_estudiante" value="<?php echo $row['id_estudiante'];?>" name="id_estudiante" class="form-control">
      <br>
      <input type="text" placeholder="cod_producto" value="<?php echo $row['cod_producto'];?>" name="cod_producto" class="form-control">
      <br>
      <input type="text" placeholder="cantidad" value="<?php echo $row['cantidad'];?>" name="cantidad" class="form-control">
      <br>
     <input type="submit" name="editar" value="Editar" class="btn btn-primary btn-block">
      </form>
      </div>
      </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>