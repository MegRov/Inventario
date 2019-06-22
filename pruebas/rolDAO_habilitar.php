<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/rolDAO.php';


$eliminarRol = new rolDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$rolEliminado=$eliminarRol->habilitar(array(2));

echo "<pre>";
print_r($rolEliminado);
echo "</pre>";
