<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH. 'modelos/ConBdMysql.php';
    include_once PATH. 'modelos/modeloTablas/pedidoDAO.php';

    $hallarIdPedido = new pedidoDAO (SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);

    $idHallado=$hallarIdPedido->seleccionarId(array(2));
    
    echo "<pre>";
    print_r($idHallado);
    echo "<pre>";
?>