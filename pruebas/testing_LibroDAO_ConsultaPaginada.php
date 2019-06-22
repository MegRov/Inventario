<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloEntradas/EntradaDAO.php';

$limit=null;
$offset=null;

$consultaEntradasPaginados = new EntradaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
$listadoEntradasPaginados=$consultaEntradasPaginados->consultaPaginada($limit, $offset);


echo "<pre>";
print_r($listadoEntradasPaginados);
echo "</pre>";

