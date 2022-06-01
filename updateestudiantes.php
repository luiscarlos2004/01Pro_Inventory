<?php
	include_once 'conexion2.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM estudiante WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: tablaestudiantes.php');
	}


	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$grado=$_POST['grado'];
		$correo=$_POST['correo'];
		$id=(int) $_GET['id'];

		if(!empty($nombre) && !empty($grado) && !empty($correo) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_update=$con->prepare(' UPDATE estudiante SET  
					nombre=:nombre,
					grado=:grado,
					correo=:correo
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':nombre' =>$nombre,
					':grado' =>$grado,
					':correo' =>$correo,
					':id' =>$id
				));
				header('Location: tablaestudiantes.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Editar Estudiantes</title>
	<link rel="stylesheet" href="css2/estilos4.css">
	<link rel="Shortcut icon"  href="assets/icons/logo.png"/>
</head>
<body>
	<div class="contenedor3">
	<div class="contenedor2">
		<h2 class="titulo">Editar Estudiantes </h2>
		<form class="form" action="" method="post">
			<!-- <div class="form-group"> -->
			<div>
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="nombre">Nombre Completo</label>
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre']; ?>" class="input__text">
				<br>
			<!-- </div> -->
			<!-- <div class="form-group"> -->
			<label class="control-label col-md-4 col-sm-3 col-xs-12" for="grado">Grado</label>
				<input type="text" name="grado" value="<?php if($resultado) echo $resultado['grado']; ?>" class="input__text">
				<br>
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="correo">Correo Electronico</label>
				<input type="text" name="correo" value="<?php if($resultado) echo $resultado['correo']; ?>" class="input__text">
			<!-- </div> -->
			<!-- <div class="btn__group"> -->
			</div>
			
				<a href="tablaestudiantes.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			<!-- </div> -->

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
