<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH. 'modelos/ConBdMysql.php';
    include_once PATH. 'modelos/modeloTablas/entradaDAO.php';

    $hallarIdEntrada = new entradaDAO (SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);

    $idHallado=$hallarIdEntrada->seleccionarId(array(1));
    
    echo "<pre>";
    print_r($idHallado);
    echo "<pre>";
?>