<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/proveedorDAO.php';


$registro= array();

    $_POST['provId']=3;
    $_POST['provNombre']="Señor";
    $_POST['provApellido']="Lastima";
    $_POST['provTelefono']=1234567890;
    $_POST['provDireccion']="calle Falsa";
    $_POST['provContacto']=1234567;
    $_POST['provTelContacto']=12345677777;
    $_POST['provEstado']=1;
    $_POST['proUsuSesion']="";
    $_POST['prov_created_at']="";
    $_POST['prov_updated_at']="";

    $registro['provId']=$_POST['provId'];
    $registro['provNombre']=$_POST['provNombre'];
    $registro['provApellido']=$_POST['provApellido'];
    $registro['provTelefono']=$_POST['provTelefono'];
    $registro['provDireccion']=$_POST['provDireccion'];
    $registro['provContacto']=$_POST['provContacto'];
    $registro['provTelContacto']=$_POST['provTelContacto'];
    $registro['provEstado']=$_POST['provEstado'];
    $registro['proUsuSesion']=$_POST['proUsuSesion'];
    $registro['prov_created_at']=$_POST['prov_created_at'];
    $registro['prov_updated_at']=$_POST['prov_updated_at'];
/*******************************************************************/

$actualizar = new proveedorDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$actualizaProv=$actualizar->actualizar($registro);


echo "<pre>";
print_r($actualizaProv);
echo "</pre>";