<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloEntradas/EntradaDAO.php';

$cambiarEstadoEntrada = new EntradaDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$eliminacionLogicaEntrada=$cambiarEstadoEntrada->eliminarLogico(array(2));


echo "<pre>";
print_r($eliminacionLogicaEntrada);
echo "</pre>";