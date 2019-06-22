<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/rolDAO.php';

$cambiarEstadoRol = new rolDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$eliminacionLogicaRol=$cambiarEstadoRol->eliminarLogico(array(2));


echo "<pre>";
print_r($eliminacionLogicaRol);
echo "</pre>";