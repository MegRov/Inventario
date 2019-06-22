<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/productoDAO.php';


$eliminarPro = new productoDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$proEliminado=$eliminarPro->eliminar(array(6));

echo "<pre>";
print_r($proEliminado);
echo "</pre>";
