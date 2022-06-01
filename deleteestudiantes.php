<?php 

	include_once 'conexion2.php';
	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];
		$delete=$con->prepare('DELETE FROM estudiante WHERE id=:id');
		$delete->execute(array(':id'=>$id));
		header('Location:tablaestudiantes.php');
	}else{
		header('Location:tablaestudiantes.php');
	}
 ?>