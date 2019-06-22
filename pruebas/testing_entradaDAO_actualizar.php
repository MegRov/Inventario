<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/entradaDAO.php';


$registro=array();/**Array para capturar datos de un formulario***/
/******SIMULAMOS DATOS QUE VIENEN DE UN FORMULARIO CON MÉTODO POST******/
    $_POST['entId']=7;
    $_POST['entId']=2000;
    $_POST['entradaEstado']=1;
    $_POST['entradaUsuSesion']="";
    $_POST['entrada_created_at']="";
    $_POST['entrada_updated_at']="";
/********************************************************************/
/******SIMULAMOS CAPTURAR LOS DATOS QUE VIENEN DESDE UN FORMULARIO CON MÉTODO POST*/
$registro['entId']=$_POST['entId'];
$registro['entId']=$_POST['entId'];
$registro['entradaEstado']=$_POST['entradaEstado'];
$registro['entradaUsuSesion']=$_POST['entradaUsuSesion'];
$registro['entrada_created_at']=$_POST['entrada_created_at'];
$registro['entrada_updated_at']=$_POST['entrada_updated_at'];
/*******************************************************************/

$actualizar = new entradaDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$actualizaEntrada=$actualizar->actualizar($registro);


echo "<pre>";
print_r($actualizaEntrada);
echo "</pre>";