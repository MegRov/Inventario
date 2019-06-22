<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH.'modelos/ConBdMysql.php';
    include_once PATH.'modelos/modeloTablas/proveedorDAO.php';

    $listarProveedor = new proveedorDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);
    $listadoProveedor = $listarProveedor->seleccionarTodos();

     echo "<pre>";
     print_r($listadoProveedor);
     echo "</pre>";