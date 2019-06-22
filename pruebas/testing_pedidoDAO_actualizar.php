<?php

include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloTablas/pedidoDAO.php';


$registro=array();/**Array para capturar datos de un formulario***/
/******SIMULAMOS DATOS QUE VIENEN DE UN FORMULARIO CON MÉTODO POST******/
$_POST['pedId']=6;
$_POST['pedProducto']="Sandia";
$_POST['pedCantidad']=95;
$_POST['pedEstado']=1;
$_POST['pedUsuSesion']="";
$_POST['ped_created_at']="";
$_POST['ped_updated_at']="";
/********************************************************************/
/******SIMULAMOS CAPTURAR LOS DATOS QUE VIENEN DESDE UN FORMULARIO CON MÉTODO POST*/
$registro['pedId']=$_POST['pedId'];
$registro['pedProducto']=$_POST['pedProducto'];
$registro['pedCantidad']=$_POST['pedCantidad'];
$registro['pedEstado']=$_POST['pedEstado'];
$registro['pedUsuSesion']=$_POST['pedUsuSesion'];
$registro['ped_created_at']=$_POST['ped_created_at'];
$registro['ped_updated_at']=$_POST['ped_updated_at'];

/*******************************************************************/

$actualizar = new pedidoDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$actualizaPedido=$actualizar->actualizar($registro);


echo "<pre>";
print_r($actualizaPedido);
echo "</pre>";