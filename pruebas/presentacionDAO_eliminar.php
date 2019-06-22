<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/presentacionDAO.php';


$eliminarPre = new presentacionDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$preEliminado=$eliminarPre->eliminar(array(4));

echo "<pre>";
print_r($preEliminado);
echo "</pre>";
