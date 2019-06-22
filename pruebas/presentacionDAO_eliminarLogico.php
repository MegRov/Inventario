<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/presentacionDAO.php';

$cambiarEstadoPre = new presentacionDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$eliminacionLogicaPre=$cambiarEstadoPre->eliminarLogico(array(2));


echo "<pre>";
print_r($eliminacionLogicaPre);
echo "</pre>";