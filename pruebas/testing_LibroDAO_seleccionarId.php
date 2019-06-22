<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloEntradas/EntradaDAO.php';


$hallarEntrada = new EntradaDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$EntradaHallado=$hallarEntrada->seleccionarId(array(5));


echo "<pre>";
print_r($EntradaHallado);
echo "</pre>";