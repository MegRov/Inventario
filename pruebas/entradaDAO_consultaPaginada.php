<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/entradaDAO.php';

$limit=null;
$offset=null;

$consultaEntradaPaginados = new entradaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
$listadoEntradaPaginados=$consultaEntradaPaginados->consultaPaginada($limit, $offset);


echo "<pre>";
print_r($listadoEntradaPaginados);
echo "</pre>";


