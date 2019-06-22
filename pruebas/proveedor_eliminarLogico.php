<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/proveedorDAO.php';

$cambiarEstadoProv = new proveedorDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$eliminacionLogicaProv=$cambiarEstadoProv->eliminarLogico(array(3));


echo "<pre>";
print_r($eliminacionLogicaProv);
echo "</pre>";