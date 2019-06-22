<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/pedidoDAO.php';


$eliminarPedido = new pedidoDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$pedidoEliminado=$eliminarPedido->eliminar(array(6));

echo "<pre>";
print_r($pedidoEliminado);
echo "</pre>";

