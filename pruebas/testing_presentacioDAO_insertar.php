<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH.'modelos/ConBdMysql.php';
    include_once PATH.'modelos/modeloTablas/presentacionDAO.php';

    $registro= array();

    $_POST['preId']="";
    $_POST['preNombre']="";
    $_POST['preDescripcion']="";
    $_POST['preEstado']="";
    $_POST['preUsuSesion']="";
    $_POST['pre_created_at']="";
    $_POST['pre_updated_at']="";

    $registro['preId']=$_POST['preId'];
    $registro['preNombre']=$_POST['preNombre'];
    $registro['preDescripcion']=$_POST['preDescripcion'];
    $registro['preEstado']=$_POST['preEstado'];
    $registro['preUsuSesion']=$_POST['preUsuSesion'];
    $registro['pre_created_at']=$_POST['pre_created_at'];
    $registro['pre_updated_at']=$_POST['pre_updated_at'];

    $insertar = new presentacionDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);

    $insertarPresentacion=$insertar->insertar($registro);

    echo "<pre>";
    print_r($insertarPresentacion);
    echo "</pre>";
?>