<?php

include_once PATH . 'controladores/entradaControlador.php';
include_once PATH . 'controladores/pedidoControlador.php';
include_once PATH . 'controladores/salidaControlador.php';
include_once PATH . 'controladores/productoControlador.php';
include_once PATH . 'modelos/modeloTablas/validadorSalida.php';
include_once PATH . 'modelos/modeloTablas/validadorPedido.php';
include_once PATH . 'modelos/modeloTablas/validadorProducto.php';
include_once PATH . 'modelos/modeloTablas/validadorEntrada.php';
include_once PATH . 'controladores/Usuario_sControlador.php';
include_once PATH . 'modelos/modeloUsuario_s/ValidadorUsuarios_s.php';

class controladorPrincipal {

    private $datos = array();

    public function __construct() {

        if (!empty($_POST) && isset($_POST["ruta"])) {
            $this->datos = $_POST;
        }
        if (!empty($_GET) && isset($_GET["ruta"])) {
            $this->datos = $_GET;
        }

        $this->control();
    }

    public function control() {

        switch ($this->datos['ruta']) {
///*****GESTIONANDO LA TABLA Entradas********///
            case "mostrarInsertarEntrada":
            case "listarEntrada":
            case "actualizarEntrada":
            case "insertarEntrada":
            case "confirmaActualizarEntrada":
                if ($this->datos['ruta'] == "insertarEntrada" || $this->datos['ruta'] == "confirmaActualizarEntrada") {
                    $validarRegistro = new validadorEntrada();
                    $erroresValidacion = $validarRegistro->validarFormularioEntrada($this->datos);
                }
                if (isset($erroresValidacion) && $erroresValidacion != FALSE) {
                    session_start();
                    $_SESSION['erroresValidacion'] = $erroresValidacion;
//                    $erroresValidacion = json_encode($erroresValidacion);
                    if ($this->datos['ruta'] == "insertarEntrada") {
                        header("location:principal.php?contenido=vistas/vistasTablas/vistaInsertarEntrada.php");
                    }
                    if ($this->datos['ruta'] == "confirmaActualizarEntrada") {
                        header("location:principal.php?contenido=vistas/vistasTablas/vistaActualizarEntrada.php");
                    }
                } else {

                    $entradaControlador = new entradaControlador($this->datos); /* --------->>>>>>>>>>>>>>>*** */
//          
                }
                break;
//*****************Tabla pedido***********/
                case "mostrarInsertarPedido":
            case "listarPedido":
            case "actualizarPedido":
            case "insertarPedido":
            case "confirmaActualizarPedido":
                if ($this->datos['ruta'] == "insertarPedido" || $this->datos['ruta'] == "confirmaActualizarPedido") {
                    $validarRegistro = new validadorPedido();
                    $erroresValidacion = $validarRegistro->validarFormularioPedido($this->datos);
                }
                if (isset($erroresValidacion) && $erroresValidacion != FALSE) {
                    session_start();
                    $_SESSION['erroresValidacion'] = $erroresValidacion;
//                    $erroresValidacion = json_encode($erroresValidacion);
                    if ($this->datos['ruta'] == "insertarPedido") {
                        header("location:principal.php?contenido=vistas/vistasTablas/vistaInsertarPedido.php");
                    }
                    if ($this->datos['ruta'] == "confirmaActualizarPedido") {
                        header("location:principal.php?contenido=vistas/vistasTablas/vistaActualizarPedido.php");
                    }
                } else {

                    $pedidoControlador = new pedidoControlador($this->datos); /* --------->>>>>>>>>>>>>>>*** */
//          
                }
                break;
//******************TABLA PRODUCTO****************** *///
                case "mostrarInsertarProducto":
                case "listarProducto":
                case "actualizarProducto":
                case "insertarProducto":
                case "confirmaActualizarProducto":
                    if ($this->datos['ruta'] == "insertarProducto" || $this->datos['ruta'] == "confirmaActualizarProducto") {
                        $validarRegistro = new validadorProducto();
                        $erroresValidacion = $validarRegistro->validarFormularioProducto($this->datos);
                    }
                    if (isset($erroresValidacion) && $erroresValidacion != FALSE) {
                        session_start();
                        $_SESSION['erroresValidacion'] = $erroresValidacion;
    //                    $erroresValidacion = json_encode($erroresValidacion);
                        if ($this->datos['ruta'] == "insertarProducto") {
                            header("location:principal.php?contenido=vistas/vistasTablas/vistaInsertarProducto.php");
                        }
                        if ($this->datos['ruta'] == "confirmaActualizarProducto") {
                            header("location:principal.php?contenido=vistas/vistasTablas/vistaActualizarProducto.php");
                        }
                    } else {
    
                        $productoControlador = new productoControlador($this->datos); /* --------->>>>>>>>>>>>>>>*** */
    //          
                    }
                    break;










                //*******************TABLA SALIDA********************************* */ //
                case "mostrarInsertarSalida":
            case "listarSalida":
            case "actualizarSalida":
            case "insertarSalida":
            case "confirmaActualizarSalida":
                if ($this->datos['ruta'] == "insertarSalida" || $this->datos['ruta'] == "confirmaActualizarSalida") {
                    $validarRegistro = new validadorSalida();
                    $erroresValidacion = $validarRegistro->validarFormularioSalida($this->datos);
                }
                if (isset($erroresValidacion) && $erroresValidacion != FALSE) {
                    session_start();
                    $_SESSION['erroresValidacion'] = $erroresValidacion;
//                    $erroresValidacion = json_encode($erroresValidacion);
                    if ($this->datos['ruta'] == "insertarSalida") {
                        header("location:principal.php?contenido=vistas/vistasTablas/vistaInsertarSalida.php");
                    }
                    if ($this->datos['ruta'] == "confirmaActualizarSalida") {
                        header("location:principal.php?contenido=vistas/vistasTablas/vistaActualizarSalida.php");
                    }
                } else {

                    $SalidaControlador = new SalidaControlador($this->datos); /* --------->>>>>>>>>>>>>>>*** */
//          
                }
                break;
///******************************************************///
///*****GESTIONANDO LA TABLA usuario_S y PERSONAS********///
            case "cerrarSesion":
            case "gestionDeAcceso":
            case "gestionDeRegistro":
            case "insertarUsuario_s":
            case "confirmaActualizarUsuario_s":
                if ($this->datos['ruta'] == "gestionDeRegistro" || $this->datos['ruta'] == "insertarUsuario_s" || $this->datos['ruta'] == "confirmaActualizarUsuario_s") {
                    $validarRegistro = new ValidadorUsuarios_s();
                    $erroresValidacion = $validarRegistro->validarFormularioUsuarios_s($this->datos);
                }
                if (isset($erroresValidacion) && $erroresValidacion != FALSE) {
                    session_start();
                    $_SESSION['erroresValidacion'] = $erroresValidacion;
//                    $erroresValidacion = json_encode($erroresValidacion);
                    if ($this->datos['ruta'] == "gestionDeRegistro") {

                        header("location:registro.php");
                    }
                    if ($this->datos['ruta'] == "insertarUsuario_s") {

                        header("location:principal.php?contenido=vistas/vistasUsuario_s/vistaInsertarUsuario_s.php");
                    }
                    if ($this->datos['ruta'] == "confirmaActualizarUsuario_s") {
                        header("location:principal.php?contenido=vistas/vistasUsuario_s/vistaActualizarUsuario_s.php");
                    }
                } else {

                    $usuario_sControlador = new Usuario_sControlador($this->datos);
                }

                break;
        }
    }

}
