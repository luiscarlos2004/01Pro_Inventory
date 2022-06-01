
<?php
	include_once 'conexion2.php';

	if(isset($_GET['cod_articulo'])){
		$cod_articulo=(int) $_GET['cod_articulo'];
		$buscar_id=$con->prepare('SELECT * FROM articulo WHERE cod_articulo=:cod_articulo LIMIT 1');
		$buscar_id->execute(array(':cod_articulo'=>$cod_articulo));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: tablaarticulo.php');
	}

	if(isset($_POST['guardar'])){
		$descripcion=$_POST['descripcion'];
		$cantidad=$_POST['cantidad'];
		$cod_articulo=(int) $_GET['cod_articulo'];

		if(!empty($descripcion) && !empty($cantidad)){			
				$consulta_update=$con->prepare(' UPDATE articulo SET  
																	descripcion=:descripcion,
																	cantidad=:cantidad											
												WHERE cod_articulo=:cod_articulo');
												
				$consulta_update->execute(array(':descripcion' =>$descripcion,':cantidad' =>$cantidad,':cod_articulo' =>$cod_articulo));
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
	<title>Editar Artículos</title>
	<link rel="stylesheet" href="css2/estilos4.css">
	<link rel="Shortcut icon"  href="assets/icons/logo.png"/>
</head>
<body>
<div class="contenedor3">
	<div class="contenedor2">
	
		<h2 class="titulo">Editar Artículos</h2>
		<form class="form" action="" method="post" class ="form-horizontal form-label-left">
			<div>
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="identificacion">Descripción</label>
				<input type="text" name="descripcion" value="<?php if($resultado) echo $resultado['descripcion']; ?>" class="input__text">
				<br>
				<br>
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="cantidad">Cantidad</label>
				<input type="text" name="cantidad" value="<?php if($resultado) echo $resultado['cantidad']; ?>" class="input__text">
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
		<br>
	
	</div>
</body>
</html>
