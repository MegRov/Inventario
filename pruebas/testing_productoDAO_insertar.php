<?php
    include_once '../modelos/ConstantesConexion.php';
    include_once PATH.'modelos/ConBdMysql.php';
    include_once PATH.'modelos/modeloTablas/productoDAO.php';

    $registro= array();

    $_POST['proId']=6;
    $_POST['proNombre']="Piña";
    $_POST['proDescripcion']="";
    $_POST['proCantExistente']="5";
    $_POST['proUnidadMedida']="Libras";
    $_POST['proEstado']=1;
    $_POST['proUsuSesion']="";
    $_POST['pro_created_at']="";
    $_POST['pro_updated_at']="";

    $registro['proId']=$_POST['proId'];
    $registro['proNombre']=$_POST['proNombre'];
    $registro['proDescripcion']=$_POST['proDescripcion'];
    $registro['proCantExistente']=$_POST['proCantExistente'];
    $registro['proUnidadMedida']=$_POST['proUnidadMedida'];
    $registro['proEstado']=$_POST['proEstado'];
    $registro['proUsuSesion']=$_POST['proUsuSesion'];
    $registro['pro_created_at']=$_POST['pro_created_at'];
    $registro['pro_updated_at']=$_POST['pro_updated_at'];


    $insertar = new productoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);

    $insertarProducto=$insertar->insertar($registro);

    echo "<pre>";
    print_r($insertarProducto);
    echo "</pre>";
?>