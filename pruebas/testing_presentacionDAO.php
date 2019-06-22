<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH.'modelos/ConBdMysql.php';
    include_once PATH.'modelos/modeloTablas/presentacionDAO.php';

    $listarPresentacion = new presentacionDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);
    $listadoPresentacion = $listarPresentacion->seleccionarTodos();

     echo "<pre>";
     print_r($listadoPresentacion);
     echo "</pre>";