<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloEntradas/EntradaDAO.php';


$eliminarEntrada = new EntradaDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$EntradaEliminado=$eliminarEntrada->eliminar(array(2));

echo "<pre>";
print_r($EntradaEliminado);
echo "</pre>";

