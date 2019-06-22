<?php


include_once '../modelos/ConstantesConexion.php';
include_once PATH.'modelos/ConBdMysql.php';
include_once PATH.'modelos/modeloEntradas/EntradaDAO.php';

$registro=array();/**Array para capturar datos de un formulario***/
/******SIMULAMOS DATOS QUE VIENEN DE UN FORMULARIO CON MÉTODO POST******/
$_POST['entId']=2;
$_POST['entradaCantidad']="FICHA 1804901 APRENDIENDO PHP";
$_POST['autor']="APRENDICES";
$_POST['precio']=105000;
$_POST['categoriaEntrada_catLibId']=2;
/********************************************************************/
/******SIMULAMOS CAPTURAR LOS DATOS QUE VIENEN DESDE UN FORMULARIO CON MÉTODO POST*/
$registro['entId']=$_POST['entId'];
$registro['entradaCantidad']=$_POST['entradaCantidad'];
$registro['autor']=$_POST['autor'];
$registro['precio']=$_POST['precio'];
$registro['categoriaEntrada_catLibId']=$_POST['categoriaEntrada_catLibId'];
/*******************************************************************/

$insertar = new EntradaDAO(SERVIDOR,BASE,USUARIO_BD,CONTRASENIA_BD);

$insertarEntrada=$insertar->insertar($registro);

echo "<pre>";
print_r($insertarEntrada);
echo "</pre>";