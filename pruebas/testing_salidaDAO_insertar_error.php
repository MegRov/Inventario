<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH.'modelos/ConBdMysql.php';
    include_once PATH.'modelos/modeloTablas/salidaDAO.php';

    $registro= array();

    $_POST['salId']=4;
    $_POST['persona_perId']="";
    $_POST['salidaEstado']="";
    $_POST['salidaUsuSesion']="";
    $_POST['salida_created_at']="";
    $_POST['salida_updated_at']="";
 

    $registro['salId']=$_POST['salId'];
    $registro['persona_perId']=$_POST['persona_perId'];
    $registro['salidaEstado']=$_POST['salidaEstado'];
    $registro['salidaUsuSesion']=$_POST['salidaUsuSesion'];
    $registro['salida_created_at']=$_POST['salida_created_at'];
    $registro['salida_updated_at']=$_POST['salida_updated_at'];



    $insertar = new salidaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);

    $insertarSalida=$insertar->insertar($registro);

    echo "<pre>";
    print_r($insertarSalida);
    echo "</pre>";
?>