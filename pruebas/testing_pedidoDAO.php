<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH.'modelos/ConBdMysql.php';
    include_once PATH.'modelos/modeloTablas/pedidoDAO.php';

    $listarPedido = new pedidoDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);
    $listadoPedido = $listarPedido->seleccionarTodos();

     echo "<pre>";
     print_r($listadoPedido);
     echo "</pre>";