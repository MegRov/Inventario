<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/salidaDAO.php';


$eliminarSalida = new salidaDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$salidaEliminado=$eliminarSalida->eliminar(array(4));

echo "<pre>";
print_r($salidaEliminado);
echo "</pre>";
