<?php 

	include_once 'conexion2.php';
	if(isset($_GET['cod_articulo'])){
		$cod_articulo=(int) $_GET['cod_articulo'];
		$delete=$con->prepare('DELETE FROM articulo WHERE cod_articulo=:cod_articulo');
		$delete->execute(array(':cod_articulo' =>$cod_articulo));
		header('Location:tablaarticulo.php');
	}else{
		header('Location:tablaarticulo.php');
	}
 ?>