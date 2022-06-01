
<?php
	include_once 'conexion2.php';
	
	if(isset($_GET['cod_prestamo'])){
		$cod_prestamo=(int) $_GET['cod_prestamo'];
		$buscar_id=$con->prepare('SELECT * FROM prestamo WHERE cod_prestamo=:cod_prestamo LIMIT 1');
		$buscar_id->execute(array(':cod_prestamo'=>$cod_prestamo));
		$consultaPrestamo=$buscar_id->fetch();
		
	}else{
		header('Location: tablaprestamo.php');
	}
	if(isset($_POST['guardar'])){
		$estudiante=$_POST['estudiante'];
		$articulo=$_POST['articulo'];
		$cantidad=$_POST['cantidad'];
		$cod_prestamo=(int) $_GET['cod_prestamo'];

		$cod_articulo=(int) ($articulo);			
		$consulta_desponibles=$con->prepare("SELECT  IFNULL(articulo.cantidad-sum(prestamo.cantidad),articulo.cantidad) +
														prestamo.cantidad as Disponibles
												FROM articulo
												LEFT  join prestamo ON articulo.cod_articulo=prestamo.cod_articulo 
												where articulo.cod_articulo=:cod_articulo");
		$consulta_desponibles->execute(array(':cod_articulo' =>$cod_articulo));
		$candisponible=$consulta_desponibles->fetch();	
		$disponibles=(int) $candisponible['Disponibles']; 


		if($cantidad>$disponibles){
			echo "<script> alert('No hay suficiente existencia para este prestamo!!!');</script>";
		}else{
				if(!empty($estudiante) && !empty($articulo) && !empty($cantidad)){			
						$consulta_update=$con->prepare(' UPDATE prestamo SET  
																			id_estudiante =:estudiante,
																			cod_articulo=:articulo,
																			cantidad=:cantidad 
														WHERE cod_prestamo=:cod_prestamo');
						$consulta_update->execute(array(
							':estudiante' =>$estudiante,
							':articulo' =>$articulo,
							':cantidad' =>$cantidad,
							':cod_prestamo' =>$cod_prestamo
						));
						header('Location: tablaprestamo.php');
				}else{
					echo "<script> alert('Los campos estan vacios');</script>";
				}
			}
	}
?>


<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Editar prestamos</title>
		<link rel="Shortcut icon"  href="assets/icons/logo.png"/>
		<link rel="stylesheet" href="css2/estilos4.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	
	<style>
	body{
	background-color: #2D3945;	
	}
		.btn__primary{
			width: 20% !important;
		}
		.titulo{
			margin-top: 1%;
		}
		.contenedor2 .selecionar{
			margin-left: 30%;
			margin-top: 1%;
			margin-bottom: 1%;
		}
</style>
</head>

<body>
<div class="contenedor3">
	<div class="contenedor2">
		<h2 class="titulo">Editar Prestamo</h2>
		<form class="form" action="" method="post" class ="form-horizontal form-label-left">
		<label class="control-label col-md-4 col-sm-3 col-xs-12"  for="estudiante">Nombre completo</label>
				<div class="selecionar">
				<!-- <label  class="control-label col-md-4 col-sm-3 col-xs-12">Nombre Completo:</label> -->
				<div class="form-box search-bar">
						<select id="selecionar" name="estudiante" data-live-search="true" title="Selecione el nombre"  class="selectpicker">
							<option value="">Seleccionar</option>
								<?php
										//require_once("conexion2.php");
										include_once 'conexion2.php'; 
										$resultado = $con->query("SELECT * FROM estudiante");  								 
										                     
										$seleccionaritem="";
										foreach($resultado as $estudiante){ 
											$id= $estudiante['id'];   
											$idest=$consultaPrestamo['id_estudiante'];  
											$nombre= $estudiante['nombre'];    
											
											 if($id==$idest){
												$seleccionaritem="selected";
												echo "<option  value='".$id."' selected='".$seleccionaritem."'>" . $nombre.'</option>'; 											
											 }											  
										} 
										
									?>  
						</select> 
						</div>
					</div>
					<br>	
					<br>
					<br>
					<label class="control-label col-md-4 col-sm-3 col-xs-12"  for="articulo">Articulo</label>			
					<div class="selecionar">
					<!-- <label  class="control-label col-md-4 col-sm-3 col-xs-12">Articulo :</label> -->
						<div class="form-box search-bar">
						<select name="articulo" data-live-search="true" title="Selecione el articulo"  class="selectpicker" >
						<option value="">Seleccionar</option>
							<?php
									//require_once("conexion2.php");
									include_once 'conexion2.php'; 
									$resultado = $con->query("SELECT * FROM articulo");                           

									foreach($resultado as $articulo){                                     
										$cod_articulo	= $articulo['cod_articulo']; 
										$descripcion	= $articulo['descripcion'];      
										if($cod_articulo==$consultaPrestamo['cod_articulo']){
											$seleccionaritem="selected";
											echo "<option  value='".$cod_articulo."'. $seleccionaritem .'>" . $descripcion . "</option>";
										}	
										$seleccionarusuario=" ";


									} 
									
									
								?>  
						</select> 
						</div>
					</div>
					<br>	
					<br>
					<br>		  	
					<div>
						<label class="control-label col-md-4 col-sm-3 col-xs-12" for="existencia">Cantidad</label>
						<input type="text" name="cantidad" 		value="<?php if($consultaPrestamo) echo $consultaPrestamo['cantidad']; ?>" class="input__text">
						<!-- <input type="text" name="descripcion" 	value="<?php //if($resultado) echo $resultado['descripcion']; ?>" class="input__text"> -->
					</div>

					
		
				<a href="tablaprestamo.php" class="btn__danger" value="Cancelar">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn__primary">
			
		</form>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
		</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
</body>
</html>
