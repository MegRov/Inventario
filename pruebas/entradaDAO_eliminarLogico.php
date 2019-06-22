<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/entradaDAO.php';

$cambiarEstadoEntrada = new entradaDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$eliminacionLogicaEntrada=$cambiarEstadoEntrada->eliminarLogico(array(2));


echo "<pre>";
print_r($eliminacionLogicaEntrada);
echo "</pre>";