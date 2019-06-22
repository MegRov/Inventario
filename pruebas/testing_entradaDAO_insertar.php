<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH.'modelos/ConBdMysql.php';
    include_once PATH.'modelos/modeloTablas/entradaDAO.php';

    $registro= array();

    $_POST['entId']=8;
    $_POST['entId']=50;
    //$_POST['pedEstado']=1;
 

    $registro['entId']=$_POST['entId'];
    $registro['entId']=$_POST['entId'];
    //$registro['pedEstado']=$_POST['pedEstado'];


    $insertar = new entradaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);

    $insertarEntrada=$insertar->insertar($registro);

    echo "<pre>";
    print_r($insertarEntrada);
    echo "</pre>";
?>