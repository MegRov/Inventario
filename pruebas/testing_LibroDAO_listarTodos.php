<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloEntradas/EntradaDAO.php';

$Entradas = new EntradaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
$listadoEntradas=$Entradas->seleccionarTodos();

//echo json_encode($listadoEntradas);
echo "<pre>";
print_r($listadoEntradas);
echo "</pre>";

