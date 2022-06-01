<?php 
	include_once 'conexion2.php';	
	if(isset($_POST['guardar'])){
		$descripcion=$_POST['descripcion'];
		$cantidad=$_POST['cantidad'];
		
		date_default_timezone_set('UTC');
	    $fecha_reg1 = date("d/m/y");
		if(!empty($descripcion) && !empty($cantidad)){
				$consulta_insert=$con->prepare('INSERT INTO articulo(descripcion,cantidad,fecha_reg1) VALUES(:descripcion,:cantidad,:fecha_reg1)');				
				$consulta_insert->execute(array(':descripcion' =>$descripcion,':cantidad' =>$cantidad,':fecha_reg1' =>$fecha_reg1));
				header('Location: tablaarticulo.php');
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}

	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>IOSET</title>
	<link rel="stylesheet" href="css2/estilos4.css">
	<link rel="Shortcut icon"  href="assets/icons/logo.png"/>
</head>
<body>
<div class="contenedor3">
	<div class="contenedor2">
		<h2 class="titulo">Agregar Artículo</h2>
		<form class="form" action="" method="post" class ="form-horizontal form-label-left">
			<div>
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="descripcion">Descripción</label>
				<input type="text" name="descripcion" placeholder="Descripción" class="input__text">

			
				<br>
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="cantidad">Cantidad</label>
				<input type="text" name="cantidad" placeholder="Cantidad" class="input__text">
			</div>
		
		<a href="tablaarticulo.php" class="btn btn__danger">Cancelar</a>
		<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			
			
		</form>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
	</div>
</body>
</html>
