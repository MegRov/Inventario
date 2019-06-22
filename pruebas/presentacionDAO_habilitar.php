<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/presentacionDAO.php';

$cambiarEstadoPre = new presentacionDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$habilitarPre=$cambiarEstadoPre->habilitar(array(2));


echo "<pre>";
print_r($habilitarPre);
echo "</pre>";