<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH.'modelos/ConBdMysql.php';
    include_once PATH.'modelos/modeloTablas/entradaDAO.php';

    $listarEntrada = new entradaDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);
    $listadoEntrada = $listarEntrada->seleccionarTodos();

     echo "<pre>";
     print_r($listadoEntrada);
     echo "</pre>";