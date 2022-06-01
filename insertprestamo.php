<?php 
	include_once 'conexion2.php';	
	if(isset($_POST['guardar'])){
		$estudiante=$_POST['estudiante'];
		$articulo=$_POST['articulo'];
		$cantidad=(int)$_POST['cantidad'];

		date_default_timezone_set('UTC');
		$fecha_reg = date("d/m/y");
		if(!empty($estudiante) && !empty($articulo) && !empty($cantidad)){
			$cod_articulo=(int) ($articulo);
			//$buscar_id=$con->prepare('SELECT * FROM prestamo WHERE cod_prestamo=:cod_prestamo LIMIT 1');
			$consulta_desponibles=$con->prepare("SELECT  IFNULL(articulo.cantidad-sum(prestamo.cantidad),articulo.cantidad)  as Disponibles
												 FROM articulo
												 LEFT  join prestamo ON articulo.cod_articulo=prestamo.cod_articulo 
												 where articulo.cod_articulo=:cod_articulo");
			$consulta_desponibles->execute(array(':cod_articulo' =>$cod_articulo));
			$candisponible=$consulta_desponibles->fetch();	


			$disponibles=(int) $candisponible['Disponibles'];  
				if($cantidad>$disponibles){
					echo "<script> alert('No hay suficiente existencia para este prestamo!!!');</script>";
				}else{
					$consulta_insert=$con->prepare('INSERT INTO prestamo(id_estudiante,cod_articulo,cantidad,fecha_reg ) 
															VALUES(:estudiante,:articulo,:cantidad,:fecha_reg)');
					$consulta_insert->execute(array(
						':estudiante' =>$estudiante,
						':articulo' =>$articulo,
						':cantidad' =>$cantidad,
						':fecha_reg' =>$fecha_reg
					));
					$disponibles=0;
					$cod_articulo="";
					header('Location: tablaprestamo.php');
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
		<link rel="Shortcut icon"  href="assets/icons/logo.png"/>
		<link rel="stylesheet" href="css2/estilos4.css">
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="style.css">
		<!-- <script src="js/sweet-alert.min.js"></script> 
		<link rel="stylesheet" href="css/sweet-alert.css">
		<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
		<link rel="stylesheet" href="css/style.css">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script>
			window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')
		</script>
		<script src="js/modernizr.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="js/main.js"></script>-->

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
			margin-left: 29%;
			margin-top: 1%;
			margin-bottom: 1%;
		}
		</style>
	</head>
<body>
<div class="contenedor3">
	<div class="contenedor2">
		<h2 class="titulo">Agregar préstamo</h2>
		<form  class="form" action="" method="post" class ="form-horizontal form-label-left">
		<label for="articulo" class="control-label col-md-4 col-sm-3 col-xs-12">Nombre completo:</label>
		<div class="selecionar">
		<div class="form-box search-bar">
        
          <select  name="estudiante" data-live-search="true" title="Selecione el nombre"  class="selectpicker">
		  <!-- <option  value=""></option> -->
		  <div class="barra">
			  
						<?php
								//require_once("conexion2.php");
								include_once 'conexion2.php'; 
								$resultado = $con->query("SELECT * FROM estudiante");                           

								foreach($resultado as $fila){                                     
									$id= $fila['id']; 
									$nombre= $fila['nombre'];  
							 
									//$apellidos= $fila['apellidos']; 
									echo '<option value="'.$id.	'">'.$nombre.'</option>';   
								   
								} 
								
							?>  
							
							</div>
          </select>
		</div>
		
		</div>
			
			<br>
			<br>
			<label for="articulo" class="control-label col-md-4 col-sm-3 col-xs-12">Artículo :</label>
			<div class="selecionar">
				
				<div class="form-box search-bar"> 
			    <select  name="articulo" data-live-search="true" title="Selecione el artículo"  class="selectpicker">
                  <option value="">Seleccionar</option>
                    <?php
                            //require_once("conexion2.php");
                            include_once 'conexion2.php'; 
                            $resultado = $con->query("SELECT * FROM articulo");                           

                            foreach($resultado as $fila){                                     
                              $cod_articulo= $fila['cod_articulo']; 
                              $descripcion= $fila['descripcion'];       
                              echo '<option value="'.$cod_articulo.	'">'.$descripcion.'</option>';        
                          } 
                              
                        ?>  
				  </select> 
				  </div>
			</div>
			<br>		
			<br>  	
			<div>
				<label class="control-label col-md-4 col-sm-3 col-xs-12" for="existencia">Cantidad</label>
				<input type="text" name="cantidad" placeholder="Cantidad" class="input__text">
			</div>

            
		
				<a href="tablaprestamo.php" class="btn btn__danger">Cancelar</a>
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
	 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
</body>
</html>
