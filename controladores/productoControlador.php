<?php

include_once  PATH.'modelos/modeloTablas/productoDAO.php';
include_once PATH . 'modelos/modeloCategoriaTablas/categoriaProductoDAO.php';

class productoControlador {

    private $datos;

    public function __construct($datos) {
        $this->datos = $datos;
        $this->productoControlador();
    }

    public function productoControlador() {

//        echo __FILE__ . "<br/>" . __CLASS__ . "<br/>" . __METHOD__ . "<br/>" . __LINE__ . "<br/><br/>";

        switch ($this->datos['ruta']) {
            case 'mostrarInsertarproducto':
                //Se alistan datos a desplegar en los campos select con relación a otras tablas
                $gestarCategoriasproducto = new categoriaproductoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                $registroCategoriasproducto = $gestarCategoriasproducto->seleccionarTodos(); /*                 * *********** */

                session_start();
                $_SESSION['registroCategoriasproducto'] = $registroCategoriasproducto;
                $gestarCategoriasproducto= null;

                header("location:principal.php?contenido=vistas/vistasTablas/vistaInsertarproducto.php");
                break;
            case 'insertarproducto':

                $buscarproducto = new productoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD); //Se instancia EntradaDAO para insertar
                $productoHallado = $buscarproducto->seleccionarId(array($this->datos['prodId'])); //Se consulta si existe ya el registro
                echo "<pre>";
                print_r($productoHallado);
                echo "</pre>";
                if (!$productoHallado['exitoSeleccionId']) {//Si no existe el Entrada en la base se procede a insertar
                    $insertarproducto = new productoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                    $insertoproducto = $insertarproducto->insertar($this->datos); //inserción de los campos en la tabla Entradas    
                    $exitoInsercionproducto = $insertoproducto['inserto']; //indica si se logró inserción de los campos en la tabla Entradas
                    $resultadoInsercionproducto = $insertoproducto['resultado']; //Traer el id con que quedó el Entrada de lo contrario la excepción o fallo
                    session_start();
                    $_SESSION['mensaje'] = "Registrado ".$this->datos['prodId']." con èxito. Agregado Nuevo entrada: " . $resultadoInsercionproducto. " "; //mensaje de inserción 

                    header("location:controlador.php?ruta=listarproducto");
                } else {
                    session_start();
                    $_SESSION['prodId'] = $this->datos['prodId'];
                    $_SESSION['proNombre'] = $this->datos['proNombre'];
                    $_SESSION['proDescripcion'] = $this->datos['proDescripcion'];
                    $_SESSION['proUnidad'] = $this->datos['proUnidad'];
                    $_SESSION['proId'] = "   El código " . $this->datos['prodId'] . " ya existe en el sistema.";

                    header("location:controlador.php?ruta=mostrarInsertarproducto");
                }
                break;
            case 'listarproducto':
                /*header("location:principal.php?contenido=vistas/vistasTablas/listarRegistrosPedido.php");
                break;
        }
    }

}
?>*/
                // PARA LA PAGINACIÒN SE VERIFICA Y VALIDA QUE EL LIMIT Y EL OFFSET ESTÈN EN LOS RANGOS QUE CORRESPONDAN//
                $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 2;
                $offset = (isset($_GET['pag'])) ? $_GET['pag'] : 0;
                $offset = ($offset < 0 || !isset($_GET['pag'])) ? 0 : $_GET['pag'];

                $filtrarBuscar = "";
                $this->conservarFiltroYBuscar();
            
                $filtrarBuscar = $this->armarFiltradoYBusqueda();

                // SE HACE LA CONSULTA A LA BASE PARA TRAER LA CANTIDAD DE REGISTROS SOLICITADOS Y EL TOTAL PARA PAGINARLOS//
                $gestarproducto = new productoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                $resultadoConsultaPaginada = $gestarproducto->consultaPaginada($limit, $offset,$filtrarBuscar);
                $totalRegistros = $resultadoConsultaPaginada[0];
                $listaDeproducto = $resultadoConsultaPaginada[1];

                //SE CONSTRUYEN LOS ENLACES PARA LA PAGINACIÓN QUE SE MOSTRARÀ EN LA VISTA//
                $totalEnlacesPaginacion = (isset($_GET['limit'])) ? $_GET['limit'] : 2;
                $paginacionVinculos = $this->enlacesPaginacion($totalRegistros, $limit, $offset, $totalEnlacesPaginacion); //Se obtienen los enlaces de paginación

                //SE ALISTA LA CONSULTA DE CATEGORIAS DE EntradaS PARA FUTURO FORMULARIO DE FILTRAR//
                $gestarCategoriasproducto = new CategoriaproductoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                $registroCategoriasproducto = $gestarCategoriasproducto->seleccionarTodos(); /*                 * *********** */

                //SE SUBEN A SESION LOS DATOS NECESARIOS PARA QUE LA VISTA LOS IMPRIMA O UTILICE//
                session_start();
                $_SESSION['listaDeproducto'] = $listaDeproducto;
                $_SESSION['paginacionVinculos'] = $paginacionVinculos;
                $_SESSION['totalRegistros'] = $totalRegistros;
                $_SESSION['registroCategoriasproducto'] = $registroCategoriasproducto; /*                 * *********** */

                $gestarproducto = null;//CIERRE D ELA CONEXIÓN CON LA BASE DE DATOS//
                header("location:principal.php?contenido=vistas/vistasTablas/listarRegistrosproducto.php");
                break;
                case "actualizarProducto":

                $gestarproducto = new productoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
//                $consultaEntrada = new EntradaVO();
                $consultaDeproducto = $gestarproducto->seleccionarId(array($this->datos["idAct"])); //Se consulta el Entrada para traer los datos.

                $actualizarDatosproducto = $consultaDeproducto['registroEncontrado'][0];

                session_start();
                $_SESSION['actualizarDatosproducto'] = $actualizarDatosproducto;

                header("location:principal.php?contenido=vistas/vistasTablas/vistaActualizarproducto.php");
                break;
            case "confirmaActualizarproducto":
                $gestarproducto = new productoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
//                $consultaEntrada = new EntradaVO();
                $actualizarproducto = $gestarproducto->actualizar(array($this->datos)); //Se envía datos del Entrada para actualizar.

                $actualizarproducto = $consultaDeproducto['registroEncontrado'][0];
                
                session_start();
                $_SESSION['mensaje'] = "Actualización realizada.";
                header("location:Controlador.php?ruta=listarproducto");
                break;
        }
    }
}