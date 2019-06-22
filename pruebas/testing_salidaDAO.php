<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH.'modelos/ConBdMysql.php';
    include_once PATH.'modelos/modeloTablas/salidaDAO.php';

    $listarSalida = new salidaDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);
    $listadoSalida = $listarSalida->seleccionarTodos();

     echo "<pre>";
     print_r($listadoSalida);
     echo "</pre>";