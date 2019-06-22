<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH.'modelos/ConBdMysql.php';
    include_once PATH.'modelos/modeloTablas/pedidoDAO.php';

    $registro= array();

    $_POST['pedId']=6;
    $_POST['pedProducto']="Sandia";
    $_POST['pedCantidad']=99;
    $_POST['pedEstado']=1;
    $_POST['pedUsuSesion']="";
    $_POST['ped_created_at']="";
    $_POST['ped_updated_at']="";

    $registro['pedId']=$_POST['pedId'];
    $registro['pedProducto']=$_POST['pedProducto'];
    $registro['pedCantidad']=$_POST['pedCantidad'];
    $registro['pedEstado']=$_POST['pedEstado'];
    $registro['pedUsuSesion']=$_POST['pedUsuSesion'];
    $registro['ped_created_at']=$_POST['ped_created_at'];
    $registro['ped_updated_at']=$_POST['ped_updated_at'];

    $insertar = new pedidoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);

    $insertarPedido=$insertar->insertar($registro);

    echo "<pre>";
    print_r($insertarPedido);
    echo "</pre>";
?>