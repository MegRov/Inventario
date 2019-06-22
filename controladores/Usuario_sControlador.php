<?php

require_once PATH . 'controladores/ManejoSesiones/ClaseSesion.php';
require_once PATH . 'modelos/modeloUsuario_s/Usuario_sDAO.php';
require_once PATH . 'modelos/modeloPersona/PersonaDAO.php';
require_once PATH . 'modelos/modeloRol/RolDAO.php';

class Usuario_sControlador {

    private $datos = array();

    public function __construct($datos) {
        $this->datos = $datos;
        $this->usuario_sControlador();
    }

    public function usuario_sControlador() {
        switch ($this->datos["ruta"]) {
            case "gestionDeRegistro":
            case "insertarUsuario_s":
                $gestarUsuario_s = new Usuario_sDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
//                $insertarUsuario = new Usuario_sVO();
                $existeUsuario_s = $gestarUsuario_s->seleccionarId(array($this->datos["documento"], $this->datos['email'])); //Se revisa si existe la persona en la base
                if (0 == $existeUsuario_s['exitoSeleccionId']) {//Si no existe la persona en la base se procede a insertar
                    $this->datos['password'] = md5($this->datos['password']); //se encripta la contraseña que viene
                    $insertoUsuario_s = $gestarUsuario_s->insertar($this->datos); //inserción de los campos en la tabla usuario_s
                    $exitoInsercionUsuario_s = $insertoUsuario_s['inserto']; //indica si se logró inserción de los campos en la tabla usuario_s
                    $resultadoInsercionUsuario_s = $insertoUsuario_s['resultado']; //Traer el id con que quedó el usuario de lo contrario la excepción o fallo
//                    if (1 == $exitoInsercionUsuario_s) {//si se logró la inserción de los campos en la tabla usuario_s insertar datos en tabla persona
                    $gestarPersona = new PersonaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                    $this->datos['perId'] = $resultadoInsercionUsuario_s; //Id 'usuID' con quedó insertado el usuario, con el fin que quede el mismo en la tabla 'persona'
                    $insertoPersona = $gestarPersona->insertar($this->datos); //inserción de los campos en la tabla persona
//                    echo __FILE__ . "-----" . __LINE__;
//                    exit(1);
                    $exitoInsercionPersona = $insertoPersona['inserto']; //indica si se logró inserción de los campos en la tabla persona
                    $resultadoInsercionPersona = $insertoPersona['resultado']; //***Si logró insertar trae el id con que quedó la persona de lo contrario la excepción o fallo
                    //FALTA AQUÍ IMPLEMENTAR LA VALIDACIÓN EN CASO DE NO INSERTAR EN LA TABLA persona
                    session_start(); //se abre sesión para almacenar en ella el mensaje de inserción
                    $_SESSION['mensaje'] = "Registrado con èxito para ingreso al sistema"; //mensaje de inserción
                    if ($this->datos['ruta'] == 'gestionDeRegistro') {//si el formulario de la inserción es el de registrarse y fue exitoso se devuelve a login.php
                        header("location:login.php");
                    }
                    if ($this->datos['ruta'] == 'insertarUsuario_s') {//si el formulario de la inserción es el de Agregar Usuarios y fue exitoso se devuelve a listarRegistrosUsuario_s.php
//                        header("location:../principal.php?contenido=vistas/vistasUsuario_s/listarRegistrosUsuario_s.php");
                        header("location:Controlador.php?ruta=listarPersonas");
                    }
                } else {//Si la persona ya existe se abre sesión para almacenar en ella el mensaje de inserción y devolver datos al formulario por medio de la sesión
                    session_start();
                    $_SESSION['documento'] = $this->datos['documento'];
                    $_SESSION['nombre'] = $this->datos['nombre'];
                    $_SESSION['apellidos'] = $this->datos['apellidos'];
                    $_SESSION['email'] = $this->datos['email'];
                    $_SESSION['mensaje'] = "El usuario ya existe en el sistema.";
                    if ($this->datos['ruta'] == 'gestionDeRegistro') {//si al insertar un usuario en el formulario de registrarse y éste ya existe a registro.php
                        header("location:registro.php");
                    }
                    if ($this->datos['ruta'] == 'insertarUsuario_s') {//si al insertar un usuario en el formulario de Agregar nuevo usuario y éste ya existe a listarRegistrosUsuario_s.php
                        header("location:Controlador.php?ruta=mostrarInsertarPersonas");
                    }
                }
                break;

            case "gestionDeAcceso":
                $gestarUsuario_s = new Usuario_sDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);

                $this->datos["password"] = md5($this->datos["password"]); //Encriptamos password para que coincida con la base de datos
                $this->datos["documento"] = ""; //Para logueo crear ésta variable límpia por cuanto se utiliza el mismo método de registrarse a continuación
                $existeUsuario_s = $gestarUsuario_s->seleccionarId(array($this->datos["documento"], $this->datos['email'], $this->datos["password"])); //Se revisa si existe la persona en la base                
                if ((0 != $existeUsuario_s['exitoSeleccionId']) && ($existeUsuario_s['registroEncontrado'][0]->usuLogin == $this->datos['email'])) {
                    session_start(); //se abre sesión para almacenar en ella el mensaje de inserción
                    $_SESSION['mensaje'] = "Bienvenido a nuestra Aplicación."; //mensaje de inserción
                    //Consultamos los roles de la persona logueada
                    $consultaRoles = new RolDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                    $rolesUsuario = $consultaRoles->seleccionarRolPorPersona(array($existeUsuario_s['registroEncontrado'][0]->perDocumento));
                    $cantidadRoles = count($rolesUsuario['registroEncontrado']);
                    $rolesEnSesion = array();
                    for ($i = 0; $i < $cantidadRoles; $i++) {
                        $rolesEnSesion[] = $rolesUsuario['registroEncontrado'][$i]->rolId;
                    }
                    //ABRIR SESION ******************************************
                    $sesionPermitida = new ClaseSesion(); //Se abre sesiòn
                    $sesionPermitida->crearSesion(array($existeUsuario_s['registroEncontrado'][0], $rolesUsuario, $rolesEnSesion)); //Se envìa a la sesiòn los datos del usuario logeado

                    header("location:principal.php");
                } else {
                    session_start(); //se abre sesión para almacenar en ella el mensaje de inserción
                    $_SESSION['mensaje'] = "Credenciales de acceso incorrectas"; //mensaje de inserción
                    header("location:login.php");
                }
                break;
            case "cerrarSesion":
                $cerrarSesion = new ClaseSesion();
                $cerrarSesion->cerrarSesion(); //Se cierra sesión

                break;
        }
    }

}
