<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH. 'modelos/ConBdMysql.php';
    include_once PATH. 'modelos/modeloTablas/rolDAO.php';

    $hallarIdRol = new rolDAO (SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);

    $idHallado=$hallarIdRol->seleccionarId(array(1));
    
    echo "<pre>";
    print_r($idHallado);
    echo "<pre>";
?>