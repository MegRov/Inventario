<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH.'modelos/ConBdMysql.php';
    include_once PATH.'modelos/modeloTablas/productoDAO.php';

    $listarProducto = new productoDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);
    $listadoProducto = $listarProducto->seleccionarTodos();

     echo "<pre>";
     print_r($listadoProducto);
     echo "</pre>";