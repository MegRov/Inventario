<?php

include_once  PATH.'modelos/modeloTablas/pedidoDAO.php';
include_once PATH . 'modelos/modeloCategoriaTablas/categoriaPedidoDAO.php';

class pedidoControlador {

    private $datos;

    public function __construct($datos) {
        $this->datos = $datos;
        $this->pedidoControlador();
    }

    public function pedidoControlador() {

//        echo __FILE__ . "<br/>" . __CLASS__ . "<br/>" . __METHOD__ . "<br/>" . __LINE__ . "<br/><br/>";

        switch ($this->datos['ruta']) {
            case 'mostrarInsertarPedido':
                //Se alistan datos a desplegar en los campos select con relación a otras tablas
                $gestarCategoriasPedido = new categoriaPedidoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                $registroCategoriasPedido = $gestarCategoriasPedido->seleccionarTodos(); /*                 * *********** */

                session_start();
                $_SESSION['registroCategoriasPedido'] = $registroCategoriasPedido;
                $gestarCategoriasPedido= null;

                header("location:principal.php?contenido=vistas/vistasTablas/vistaInsertarPedido.php");
                break;
            case 'insertarPedido':

                $buscarPedido = new pedidoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD); //Se instancia EntradaDAO para insertar
                $pedidoHallado = $buscarPedido->seleccionarId(array($this->datos['pedId'])); //Se consulta si existe ya el registro
                echo "<pre>";
                print_r($pedidoHallado);
                echo "</pre>";
                if (!$pedidoHallado['exitoSeleccionId']) {//Si no existe el Entrada en la base se procede a insertar
                    $insertarPedido = new pedidoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                    $insertoPedido = $insertarPedido->insertar($this->datos); //inserción de los campos en la tabla Entradas    
                    $exitoInsercionPedido = $insertoPedido['inserto']; //indica si se logró inserción de los campos en la tabla Entradas
                    $resultadoInsercionPedido = $insertoPedido['resultado']; //Traer el id con que quedó el Entrada de lo contrario la excepción o fallo
                    session_start();
                    $_SESSION['mensaje'] = "Registrado ".$this->datos['pedId']." con èxito. Agregado Nuevo entrada: " . $resultadoInsercionPedido. " "; //mensaje de inserción 

                    header("location:controlador.php?ruta=listarPedido");
                } else {
                    session_start();
                    $_SESSION['pedId'] = $this->datos['pedId'];
                    $_SESSION['pedProducto'] = $this->datos['pedProducto'];
                    $_SESSION['pedCantidad'] = $this->datos['pedCantidad'];
                    $_SESSION['mensaje'] = "   El código " . $this->datos['pedId'] . " ya existe en el sistema.";

                    header("location:controlador.php?ruta=mostrarInsertarPedido");
                }
                break;
            case 'listarPedido':
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
                $gestarPedido = new pedidoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                $resultadoConsultaPaginada = $gestarPedido->consultaPaginada($limit, $offset,$filtrarBuscar);
                $totalRegistros = $resultadoConsultaPaginada[0];
                $listaDePedido = $resultadoConsultaPaginada[1];

                //SE CONSTRUYEN LOS ENLACES PARA LA PAGINACIÓN QUE SE MOSTRARÀ EN LA VISTA//
                $totalEnlacesPaginacion = (isset($_GET['limit'])) ? $_GET['limit'] : 2;
                $paginacionVinculos = $this->enlacesPaginacion($totalRegistros, $limit, $offset, $totalEnlacesPaginacion); //Se obtienen los enlaces de paginación

                //SE ALISTA LA CONSULTA DE CATEGORIAS DE EntradaS PARA FUTURO FORMULARIO DE FILTRAR//
                $gestarCategoriasPedido = new CategoriaPedidoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                $registroCategoriasPedido = $gestarCategoriasPedido->seleccionarTodos(); /*                 * *********** */

                //SE SUBEN A SESION LOS DATOS NECESARIOS PARA QUE LA VISTA LOS IMPRIMA O UTILICE//
                session_start();
                $_SESSION['listaDePedido'] = $listaDePedido;
                $_SESSION['paginacionVinculos'] = $paginacionVinculos;
                $_SESSION['totalRegistros'] = $totalRegistros;
                $_SESSION['registroCategoriasPedido'] = $registroCategoriasPedido; /*                 * *********** */

                $gestarPedido = null;//CIERRE D ELA CONEXIÓN CON LA BASE DE DATOS//
                header("location:principal.php?contenido=vistas/vistasTablas/listarRegistrosPedido.php");
                break;
                case "actualizarPedido":

                $gestarPedido = new pedidoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
//                $consultaEntrada = new EntradaVO();
                $consultaDePedido = $gestarPedido->seleccionarId(array($this->datos["idAct"])); //Se consulta el Entrada para traer los datos.

                $actualizarDatosPedido = $consultaDePedido['registroEncontrado'][0];

                session_start();
                $_SESSION['actualizarDatosPedido'] = $actualizarDatosPedido;

                header("location:principal.php?contenido=vistas/vistasTablas/vistaActualizarPedido.php");
                break;
            case "confirmaActualizarPedido":
                $gestarPedido = new pedidoDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
//                $consultaEntrada = new EntradaVO();
                $actualizarPedido = $gestarPedido->actualizar(array($this->datos)); //Se envía datos del Entrada para actualizar.

                $actualizarPedido = $consultaDePedido['registroEncontrado'][0];
                
                session_start();
                $_SESSION['mensaje'] = "Actualización realizada.";
                header("location:Controlador.php?ruta=listarPedido");
                break;
        }
    }
     
   

    public function enlacesPaginacion($totalRegistros = NULL, $limit = 2, $offset = 1, $totalEnlacesPaginacion = 2) {

//        $consultarCantidadRegistros = new EntradaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD); //Se instancia EntradaDAO para conocer la cantidad de registros de Entradas //  SE ACTIVAN ESTAS LINEAS PARA TESTING
//        $totalRegistros = $consultarCantidadRegistros->totalRegistros();//  SE ACTIVAN ESTAS LINEAS PARA TESTING

//        $totalRegistros = $totalRegistros->total;//  SE ACTIVAN ESTAS LINEAS PARA TESTING
        $ruta="listarPedido";
        
        if (isset($offset) && (int) $offset <= 0) {
            $offset = 1;
        }
        if (isset($offset) && ((int) $offset > ($totalRegistros - $limit))) {
            $offset = ($totalRegistros - $limit) + 1;
        }
        $anterior = $offset - $totalEnlacesPaginacion; /*         * **** */
        $siguiente = $offset + $totalEnlacesPaginacion; /*         * **** */

        $mostrar = array();
        $enlacesProvisional = array();
        $conteoEnlaces = 0;

        $mostrar['inicio'] = "controlador.php?ruta=".$ruta."&pag=1"; //Enlace a enviar para páginas Iniciales
        $mostrar['anterior'] = "controlador.php?ruta=".$ruta."&pag=" . (($anterior)); //Enlace a enviar para páginas anteriores

        for ($i = $offset; $i < ($offset + $limit) && $i < $totalRegistros && $conteoEnlaces < $totalEnlacesPaginacion; $i++) {

            $mostrar[$i] = "controlador.php?ruta=".$ruta."&pag=$i";
            $enlacesProvisional[$i] = "controlador.php?ruta=".$ruta."&pag=$i";
            $conteoEnlaces++;
            $siguiente = $i;
        }

        $cantidadProvisional = count($enlacesProvisional);

        if ($offset < $totalRegistros) {
            $mostrar['siguiente'] = "controlador.php?ruta=".$ruta."&pag=" . ($siguiente + 1);
//            $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarEntradas&pag=" . ($totalPag - $totalEnlacesPaginacion) . "'>..::BLOQUE FINAL::..</a><br></center>";
            $mostrar ['final'] = "controlador.php?ruta=".$ruta."&pag=" . ($totalRegistros);
        }

        if ($offset >= $totalRegistros) {
            $mostrar[$siguiente + 1] = "controlador.php?ruta=".$ruta."&pag=" . ($siguiente + 1);
            for ($j = 0; $j < $cantidadProvisional; $j++) {
                $mostrar [] = $enlacesProvisional[$j];
            }
            $mostrar [$totalRegistros - $offset] = "controlador.php?ruta=".$ruta."&pag=" . ($totalRegistros - $offset);
        }

        return $mostrar;
    }
    public function armarFiltradoYBusqueda() {

        $planConsulta = "";
    
        if (!empty($_SESSION['pedIdF'])) {
            $planConsulta .= " where pedido.pedId='" . $_SESSION['pedIdF'] . "'";
            $filtros = 0;  // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta        
        } else {
            $where = false; // inicializar $where a falso ( al comenzar la consulta NO HAY condiciones o criterios de búsqueda)
            $filtros = 0;  // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta            
            if (!empty($_SESSION['pedProductof'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . "pedido.pedProducto like upper('%" . $_SESSION['pedido.pedProductof'] . "%')"; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_SESSION['pedCantidadf'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . "pedido.pedCantidad like upper('%" . $_SESSION['pedido.pedCantidadf'] . "%')"; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
    
        }
        if (!empty($_SESSION['buscarF'])) {
            $where = TRUE;
            $condicionBuscar = (($where && !$filtros == 0) ? " or " : " where ");
            $filtros++;
            $planConsulta .= $condicionBuscar;
            $planConsulta .= "( pedId like '%" . $_SESSION['buscarF'] . "%'";
            $planConsulta .= " or pedProducto like '%" . $_SESSION['buscarF'] . "%'";
            $planConsulta .= " or pedCantidad like '%" . $_SESSION['buscarF'] . "%'";
            $planConsulta .= " ) ";
        }
        return $planConsulta;
    }
    
    public function conservarFiltroYBuscar() {   
    //        se almacenan en sesion las variables del filtro y buscar para conservarlas en el formulario
        $_SESSION['pedIdF'] = (isset($_POST['pedId']) && !isset($_SESSION['pedIdF'])) ? $_POST['pedId'] : $_SESSION['pedId']; 
        $_SESSION['pedIdF'] = (!isset($_POST['pedId']) && isset($_SESSION['pedIdF'])) ? $_SESSION['pedIdF'] : $_POST['pedId']; 
        
        $_SESSION['pedProductoF'] = (isset($_POST['pedProducto']) && !isset($_SESSION['pedProductoF'])) ? $_POST['pedProducto'] : $_SESSION['pedProductoF'];
        $_SESSION['pedProductoF'] = (!isset($_POST['pedProducto']) && isset($_SESSION['pedProductoF'])) ? $_SESSION['pedProductoF'] : $_POST['pedProducto'];
        
        $_SESSION['pedCantidadF'] = (isset($_POST['pedCantidad']) && !isset($_SESSION['pedCantidadF'])) ? $_POST['pedCantidad'] : $_SESSION['pedCantidadF'];
        $_SESSION['pedCantidadF'] = (!isset($_POST['pedCantidad']) && isset($_SESSION['pedCantidadF'])) ? $_SESSION['pedCantidadF'] : $_POST['pedCantidad']; 
        
        $_SESSION['buscarF'] = (isset($_POST['buscar']) && !isset($_SESSION['buscarF'])) ? $_POST['buscar'] : $_SESSION['buscarF'];
        $_SESSION['buscarF'] = (!isset($_POST['buscar']) && isset($_SESSION['buscarF'])) ? $_SESSION['buscarF'] : $_POST['buscar']; 
    
    }
    
    }