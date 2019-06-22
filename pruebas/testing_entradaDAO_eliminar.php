<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/entradaDAO.php';


$eliminarEntrada = new entradaDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$entradaEliminado=$eliminarEntrada->eliminar(array(6));

echo "<pre>";
print_r($entradaEliminado);
echo "</pre>";