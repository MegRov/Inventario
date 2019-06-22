<?php
include_once 'modelos/ConstantesConexion.php';

session_start();

//include_once PATH . 'controladores/ManejoSesiones/BloqueDeSeguridad.php';
//$seguridad = new BloqueDeSeguridad();
//$seguridad->seguridad("login.php");

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Fruver</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>        
        <link rel="stylesheet" href="principal.css">
    </head>
    <body><!--http://developando.com/blog/deshabilitar-el-boton-volver-del-navegador/-->
        <div>
            
            <header>  
   
                    <div id="menuHorizontal"><a href="controlador.php?ruta=cerrarSesion">Salir</a></div>
</header>
            <div class="container">
                <aside> 
                    <h2><a href="principal.php">Menú</a></h2>
                    <ol>
                        <li>
                            <h3><a href="principal.php">Gestión de Entrada</a></h3>
                            <ul>
                                <li><a href="controlador.php?ruta=listarEntrada&pag=1">Listar Entrada</a></li>
                                <li><a href="controlador.php?ruta=mostrarInsertarEntrada">Insertar Nueva Entrada</a></li>

                            </ul>
                        </li>
                       
            
                        <li>
                            <h3><a href="principal.php">Gestión de Producto</a></h3>
                            <ul>
                                <li><a href="controlador.php?ruta=listarProducto&pag=1">Listar Producto</a></li>
                                <li><a href="controlador.php?ruta=mostrarInsertarProducto">Insertar Nueva Producto</a></li>

                            </ul>
                        </li>

                </section>
                                    
               <!-- aquii van las otras tablas -->   
              <li>
                            <h3><a href="principal.php">Gestión de Pedido</a></h3>
                            <ul> 
                                <li><a href="controlador.php?ruta=listarPedido&pag=2">Listar Pedido</a></li>
                                <li><a href="controlador.php?ruta=mostrarInsertarPedido">Insertar Nueva Pedido</a></li>

                            </ul>
                        </li>         
                        <!-- TABLAA SALIDA.....-->  
                        <li>
                            <h3><a href="principal.php">Gestión de Salida</a></h3>
                            <ul> 
                                <li><a href="controlador.php?ruta=listarSalida&pag=3">Listar Salida</a></li>
                                <li><a href="controlador.php?ruta=mostrarInsertarSalida">Insertar Nueva Salida</a></li>

                            </ul>
                        </li>                                     
                    </ol>

                </aside>
                <section class="body">
                    <br/>
                    <?php
                    if (isset($_GET['contenido'])) {
                        include_once($_GET['contenido']);
                    }
                    ?>
                </section>  
            </div>
            <footer><a href="">Redes Sociales</a></footer>
        </div>
    </body>
</html>