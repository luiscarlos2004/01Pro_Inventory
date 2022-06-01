<?php
    include_once 'conexion2.php';
	if(isset($_GET['cod_prestamo'])){
		$cod_prestamo=(int) $_GET['cod_prestamo'];
		$delete=$con->prepare('DELETE FROM prestamo WHERE cod_prestamo=:cod_prestamo');
		$delete->execute(array(':cod_prestamo' =>$cod_prestamo));
		header('Location:tablaprestamo.php');
	}else{
		header('Location:tablaprestamo.php');
	}
 ?>

?>