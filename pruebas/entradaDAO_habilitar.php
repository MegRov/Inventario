<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/entradaDAO.php';

$cambiarEstadoEntrada = new entradaDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$habilitarEntrada=$cambiarEstadoEntrada->habilitar(array(2));


echo "<pre>";
print_r($habilitarEntrada);
echo "</pre>";