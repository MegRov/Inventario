<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH. 'modelos/ConBdMysql.php';
    include_once PATH. 'modelos/modeloTablas/presentacionDAO.php';

    $hallarIdPresentacion = new presentacionDAO (SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);

    $idHallado=$hallarIdPresentacion->seleccionarId(array(1));
    
    echo "<pre>";
    print_r($idHallado);
    echo "<pre>";
?>