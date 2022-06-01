<!DOCTYPE html>
<html lang="es">

<head>
    <title>IOSET</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut icon"  href="assets/icons/logo.png"/>
    <script src="js/sweet-alert.min.js"></script>
    <link rel="stylesheet" href="css/sweet-alert.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css2/estilo2.css">
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
    <script>
        window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')
    </script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/main.js"></script>
</head>

<body>
    <div class="navbar-lateral full-reset">
        <div class="visible-xs font-movile-menu mobile-menu-button"></div>
        <div class="full-reset container-menu-movile custom-scroll-containers">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="full-reset" style="background-color:#2B3D51; padding: 10px 0; color:#fff;">
                <figure>
                    <img src="assets/img/3.png" alt="Biblioteca" class="img-responsive center-box" style="width:60%;">
                </figure>
            </div>
            <div class="full-reset nav-lateral-list-menu">
                <ul class="list-unstyled">
                    <li><a href="inicio.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp; Inicio</a></li>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content-page-container full-reset custom-scroll-containers">
        <div class="footer-copyright full-reset all-tittles">IOSET</div>
        <div class="container">
            <div class="page-header">
                <h1 class="all-tittles">
                    <center>
                        <font size="10" face="roboto">Artículos</font>
                    </center>
                </h1>
            </div>
        </div>
        <div class="container-fluid" style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">

                </div>
                <?php
                include_once 'conexion2.php';

                $sentencia_select = $con->prepare('SELECT 
                                                        articulo.cod_articulo,
                                                        articulo.descripcion,
                                                        articulo.fecha_reg1,
                                                        articulo.cantidad,
                                                        IFNULL(sum(prestamo.cantidad),0)as prestados,
	                                                    IFNULL(articulo.cantidad-sum(prestamo.cantidad),articulo.cantidad) as Existencia                                                    
                                                    FROM articulo 
                                                    left join prestamo on articulo.cod_articulo=prestamo.cod_articulo 
                                                    group by articulo.cod_articulo,	articulo.descripcion,	articulo.fecha_reg1,articulo.cantidad
                                                    ORDER BY articulo.cod_articulo DESC');
                $sentencia_select->execute();
                $resultado = $sentencia_select->fetchAll();

                // metodo buscar
                if (isset($_POST['btn_buscar'])) {
                    $buscar_text = $_POST['txtbuscar'];
                    if($buscar_text==""){
                        $select_buscar = $con->prepare('SELECT 
                                                        articulo.cod_articulo,
                                                        articulo.descripcion,
                                                        articulo.fecha_reg1,
                                                        articulo.cantidad,
                                                        IFNULL(sum(prestamo.cantidad),0)as prestados,
	                                                    IFNULL(articulo.cantidad-sum(prestamo.cantidad),articulo.cantidad) as Existencia                                                    
                                                    FROM articulo 
                                                    left join prestamo on articulo.cod_articulo=prestamo.cod_articulo 
                                                    group by articulo.cod_articulo,	articulo.descripcion,	articulo.fecha_reg1,articulo.cantidad
                                                    ORDER BY articulo.cod_articulo DESC');
                         $select_buscar->execute();
                    }else{
                         $select_buscar = $con->prepare('SELECT articulo.cod_articulo,
                                                        articulo.descripcion,
                                                        articulo.fecha_reg1,
                                                        articulo.cantidad,
                                                        IFNULL(sum(prestamo.cantidad),0)as prestados,
                                                        IFNULL(articulo.cantidad-sum(prestamo.cantidad),articulo.cantidad) as Existencia  
                                                    FROM articulo 
                                                    left join prestamo on articulo.cod_articulo=prestamo.cod_articulo 
                                                    WHERE descripcion LIKE :campo OR descripcion LIKE :campo;
                                                    group by articulo.cod_articulo,	articulo.descripcion,	articulo.fecha_reg1,articulo.cantidad');
                        $select_buscar->execute(array(':campo' => "%" . $buscar_text . "%"));
                    }
                           
                    $resultado = $select_buscar->fetchAll();
                }

                ?>

                <body>
                    <div class="contenedor">

                        <div class="barra__buscador">
                            <form action="" class="formulario" method="post">
                                <input type="text" name="txtbuscar" placeholder="Buscar artículo" value="<?php if (isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
                                <input type="submit" class="btn" name="btn_buscar" value="Buscar">
                                <a href="insertarticulo.php" class="btn btn__nuevo">Nuevo</a>
                                <a href="tablaprestamo.php" class="btn btn__warning">Ver Prestamos</a>
                                <a href="tablaestudiantes.php" class="btn btn__dark">Ver Estudiantes</a>
                            </form>
                        </div>
                        <div class="cualquiera">
                            <table>
                                <tr class="head">
                                    <td>Id</td>
                                    <td>Artículo</td>
                                    <td>Cantidad</td>  
                                    <td>Prestados</td>  
                                    <td>Saldo</td> 
                                    <td>Fecha</td>
                                    <td colspan="2">Acción</td>
                                </tr>
                                <?php foreach ($resultado as $fila) : ?>
                                    <tr>
                                        <td><?php echo $fila['cod_articulo']; ?></td>
                                        <td><?php echo $fila['descripcion']; ?></td>
                                        <td><?php echo $fila['cantidad']; ?></td>                                   
                                        <td><?php echo $fila['prestados']; ?></td>
                                        <td><?php echo $fila['Existencia']; ?></td>
                                        <td><?php echo $fila['fecha_reg1']; ?></td>
                                        <td><a href="updatearticulo.php?cod_articulo=<?php echo $fila['cod_articulo']; ?>" class="btn btn__update">Editar</a></td>
                                        <td><a href="deletearticulo.php?cod_articulo=<?php echo $fila['cod_articulo']; ?>" class="btn btn__delete">Eliminar</a></td>
                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                    </div>

            </div>
        </div>
        <div class="container-fluid">



        </div>
        <footer class="footer full-reset">
            <div class="footer-copyright full-reset all-tittles">Promocion 2021</div>
            <footer>
            <p class="footer-copyright full-reset all-tittles">&copy; Felipe Villamizar, Samuel Chamorro, Isabella Arango, Liz Gonzalez, Cristian Polo</p>
            </footer>
        </footer>
    </div>
</body>

</html>