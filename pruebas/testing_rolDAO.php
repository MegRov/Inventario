<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH.'modelos/ConBdMysql.php';
    include_once PATH.'modelos/modeloTablas/rolDAO.php';

    $listarRol = new rolDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);
    $listadoRol = $listarRol->seleccionarTodos();

     echo "<pre>";
     print_r($listadoRol);
     echo "</pre>";