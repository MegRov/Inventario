<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH. 'modelos/ConBdMysql.php';
    include_once PATH. 'modelos/modeloTablas/salidaDAO.php';

    $hallarIdSalida = new salidaDAO (SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);

    $idHallado=$hallarIdSalida->seleccionarId(array(1));
    
    echo "<pre>";
    print_r($idHallado);
    echo "<pre>";
?>