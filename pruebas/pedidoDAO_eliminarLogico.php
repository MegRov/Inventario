<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/pedidoDAO.php';

$cambiarEstadoPedido = new pedidoDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$eliminacionLogicaPedido=$cambiarEstadoPedido->eliminarLogico(array(5));


echo "<pre>";
print_r($eliminacionLogicaPedido);
echo "</pre>";