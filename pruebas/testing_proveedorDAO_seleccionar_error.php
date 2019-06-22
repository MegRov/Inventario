<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH. 'modelos/ConBdMysql.php';
    include_once PATH. 'modelos/modeloTablas/proveedorDAO.php';

    $hallarIdProveedor = new proveedorDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);

    $idHallado=$hallarIdProveedor->seleccionarId(array(1));
    
    echo "<pre>";
    print_r($idHallado);
    echo "<pre>";
?>