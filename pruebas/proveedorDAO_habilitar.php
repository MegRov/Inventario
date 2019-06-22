<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/proveedorDAO.php';


$eliminarProv = new proveedorDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$provEliminado=$eliminarProv->habilitar(array(3));

echo "<pre>";
print_r($provEliminado);
echo "</pre>";