<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/rolDAO.php';


$registro=array();/**Array para capturar datos de un formulario***/
/******SIMULAMOS DATOS QUE VIENEN DE UN FORMULARIO CON MÉTODO POST******/
$registro= array();

    $_POST['rolId']=3;
    $_POST['rolNombre']="Prueba";
    $_POST['rolDescripcion']="";
    $_POST['rolEstado']="";
    $_POST['rolUsuSesion']=1;
    $_POST['rol_created_at']="";
    $_POST['rol_updated_at']="";
 

    $registro['rolId']=$_POST['rolId'];
    $registro['rolNombre']=$_POST['rolNombre'];
    $registro['rolDescripcion']=$_POST['rolDescripcion'];
    $registro['rolEstado']=$_POST['rolEstado'];
    $registro['rolUsuSesion']=$_POST['rolUsuSesion'];
    $registro['rol_created_at']=$_POST['rol_created_at'];
    $registro['rol_updated_at']=$_POST['rol_updated_at'];
/*******************************************************************/

$actualizar = new rolDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$actualizaRol=$actualizar->actualizar($registro);


echo "<pre>";
print_r($actualizaRol);
echo "</pre>";
?>