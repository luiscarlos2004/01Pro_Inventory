<?php 
	include_once 'conexion2.php';	
	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$grado=$_POST['grado'];
		$correo=$_POST['correo'];
		date_default_timezone_set('UTC');
	    $fechareg = date("d/m/y");

		if(!empty($nombre)  && !empty($correo)){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_insert=$con->prepare('INSERT INTO estudiante(nombre,grado,correo, fecha_reg) VALUES(:nombre,:grado,:correo,:fechareg)');
				$consulta_insert->execute(array(
					':nombre' =>$nombre,
					':grado' =>$grado,
					':correo' =>$correo,
					':fechareg' =>$fechareg
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
	<title>IOSET</title>
	<link rel="stylesheet" href="css2/estilos4.css">
	<link rel="Shortcut icon"  href="assets/icons/logo.png"/>
</head>
<body> 
<div class="contenedor3">
		<div class="contenedor2">
			<h2 class="titulo">Agregar Estudiante</h2>
			<form class="form" action="" method="post" class ="form-horizontal form-label-left">
					<div>
						<label class="control-label col-md-4 col-sm-3 col-xs-12" for="identificacion">Nombre Completo</label>
						<input type="text" name="nombre" placeholder="Nombre Completo" class="input__text">
						<br>
						<label class="control-label col-md-4 col-sm-3 col-xs-12" for="grado">Grado</label>
						<input type="text" name="grado" placeholder="Grado" class="input__text">
						<br>
						<label class="control-label col-md-4 col-sm-3 col-xs-12" for="identificacion">Email</label>
						<input type="text" name="correo" placeholder="Correo electrónico" class="input__text">
					</div>
						
			
				<a href="tablaestudiantes.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</form>
			</div>
		<br>
		<br>
		<br>
		<br>
		<br>
		</div>
	</div>
</body>
</html>
