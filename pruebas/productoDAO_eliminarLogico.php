<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/productoDAO.php';

$cambiarEstadoPro = new productoDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$eliminacionLogicaPro=$cambiarEstadoPro->eliminarLogico(array(2));


echo "<pre>";
print_r($eliminacionLogicaPro);
echo "</pre>";