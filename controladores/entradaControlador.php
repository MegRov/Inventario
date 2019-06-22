<?php

include_once  PATH.'modelos/modeloTablas/entradaDAO.php';
include_once PATH . 'modelos/modeloCategoriaTablas/categoriaEntradaDAO.php';

class entradaControlador {

    private $datos;

    public function __construct($datos) {
        $this->datos = $datos;
        $this->entradaControlador();
    }

    public function entradaControlador() {

//        echo __FILE__ . "<br/>" . __CLASS__ . "<br/>" . __METHOD__ . "<br/>" . __LINE__ . "<br/><br/>";

        switch ($this->datos['ruta']) {
            case 'mostrarInsertarEntrada':
                //Se alistan datos a desplegar en los campos select con relación a otras tablas
                $gestarCategoriasEntrada = new categoriaEntradaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                $registroCategoriasEntrada = $gestarCategoriasEntrada->seleccionarTodos(); /*                 * *********** */

                session_start();
                $_SESSION['registroCategoriasEntrada'] = $registroCategoriasEntrada;
                $gestarCategoriasEntrada= null;

                header("location:principal.php?contenido=vistas/vistasTablas/vistaInsertarEntrada.php");
                break;
            case 'insertarEntrada':

                $buscarEntrada = new entradaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD); //Se instancia EntradaDAO para insertar
                $entradaHallado = $buscarEntrada->seleccionarId(array($this->datos['entId'])); //Se consulta si existe ya el registro
                echo "<pre>";
                print_r($entradaHallado);
                echo "</pre>";
                if (!$entradaHallado['exitoSeleccionId']) {//Si no existe el Entrada en la base se procede a insertar
                    $insertarEntrada = new entradaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                    $insertoEntrada = $insertarEntrada->insertar($this->datos); //inserción de los campos en la tabla Entradas    
                    $exitoInsercionEntrada = $insertoEntrada['inserto']; //indica si se logró inserción de los campos en la tabla Entradas
                    $resultadoInsercionEntrada = $insertoEntrada['resultado']; //Traer el id con que quedó el Entrada de lo contrario la excepción o fallo
                    session_start();
                    $_SESSION['mensaje'] = "Registrado ".$this->datos['entId']." con èxito. Agregado Nuevo entrada: " . $resultadoInsercionEntrada. " "; //mensaje de inserción 

                    header("location:controlador.php?ruta=listarEntrada");
                } else {
                    session_start();
                    $_SESSION['entId'] = $this->datos['entId'];
                    $_SESSION['entradaCantidad'] = $this->datos['entradaCantidad'];
                    $_SESSION['mensaje'] = "   El código " . $this->datos['entId'] . " ya existe en el sistema.";

                    header("location:controlador.php?ruta=mostrarInsertarEntrada");
                }
                break;
            

 
case "listarEntrada":
session_start();
// PARA LA PAGINACIÒN SE VERIFICA Y VALIDA QUE EL LIMIT Y EL OFFSET ESTÈN EN LOS RANGOS QUE CORRESPONDAN//
$limit = (isset($_GET['limit'])) ? $_GET['limit'] : 2;
$offset = (isset($_GET['pag'])) ? $_GET['pag'] : 0;
$offset = ($offset < 0 || !isset($_GET['pag'])) ? 0 : $_GET['pag'];


    $filtrarBuscar = "";
    $this->conservarFiltroYBuscar();

    $filtrarBuscar = $this->armarFiltradoYBusqueda();

// SE HACE LA CONSULTA A LA BASE PARA TRAER LA CANTIDAD DE REGISTROS SOLICITADOS Y EL TOTAL PARA PAGINARLOS//
$gestarEntrada = new entradaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
$resultadoConsultaPaginada = $gestarEntrada->consultaPaginada($limit, $offset,$filtrarBuscar);


$totalRegistros = $resultadoConsultaPaginada[0];
$listaDeEntrada = $resultadoConsultaPaginada[1];

//SE CONSTRUYEN LOS ENLACES PARA LA PAGINACIÓN QUE SE MOSTRARÀ EN LA VISTA//
$totalEnlacesPaginacion = (isset($_GET['limit'])) ? $_GET['limit'] : 2;
$paginacionVinculos = $this->enlacesPaginacion($totalRegistros, $limit, $offset, $totalEnlacesPaginacion); //Se obtienen los enlaces de paginación
//SE ALISTA LA CONSULTA DE CATEGORIAS DE EntradaS PARA FUTURO FORMULARIO DE FILTRAR//
$gestarCategoriasEntrada = new CategoriaEntradaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
$registroCategoriasEntrada = $gestarCategoriasEntrada->seleccionarTodos(); /*                 * *********** */

//SE SUBEN A SESION LOS DATOS NECESARIOS PARA QUE LA VISTA LOS IMPRIMA O UTILICE//
session_start();
$_SESSION['listaDeEntrada'] = $listaDeEntrada;
$_SESSION['paginacionVinculos'] = $paginacionVinculos;
$_SESSION['totalRegistros'] = $totalRegistros;
$_SESSION['registroCategoriasEntrada'] = $registroCategoriasEntrada; /*                 * *********** */

$gestarEntrada = null; //CIERRE DE LA CONEXIÓN CON LA BASE DE DATOS//
header("location:principal.php?contenido=vistas/vistasTablas/listarRegistrosEntrada.php");
break;
case "actualizarEntrada":

$gestarEntrada = new entradaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
//                $consultaEntrada = new EntradaVO();
$consultaDeEntrada = $gestarEntrada->seleccionarId(array($this->datos["idAct"])); //Se consulta el Entrada para traer los datos.

$actualizarDatosEntrada = $consultaDeEntrada['registroEncontrado'][0];

session_start();
$_SESSION['actualizarDatosEntrada'] = $actualizarDatosEntrada;

header("location:principal.php?contenido=vistas/vistasTablas/vistaActualizarEntrada.php");
break;
case "confirmaActualizarEntrada":
$gestarEntrada = new entradaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
//                $consultaEntrada = new EntradaVO();
$actualizarEntrada = $gestarEntrada->actualizar(array($this->datos)); //Se envía datos del Entrada para actualizar.

$actualizarEntrada = $consultaDeEntrada['registroEncontrado'][0];

session_start();
$_SESSION['mensaje'] = "Actualización realizada.";
header("location:controlador.php?ruta=listarEntrada");
break;
            }
        }

public function enlacesPaginacion($totalRegistros = NULL, $limit = 2, $offset = 0, $totalEnlacesPaginacion = 2) {

//        $consultarCantidadRegistros = new EntradaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD); //Se instancia EntradaDAO para conocer la cantidad de registros de Entradas //  SE ACTIVAN ESTAS LINEAS PARA TESTING
//        $totalRegistros = $consultarCantidadRegistros->totalRegistros();//  SE ACTIVAN ESTAS LINEAS PARA TESTING
//        $totalRegistros = $totalRegistros->total;//  SE ACTIVAN ESTAS LINEAS PARA TESTING
$ruta = "listarEntrada";

if (isset($offset) && (int) $offset <= 0) {
$offset = 0;
}
if (isset($offset) && ((int) $offset > ($totalRegistros - $limit))) {
$offset = ($totalRegistros - $limit) + 1;
}
$anterior = $offset - $totalEnlacesPaginacion; /*         * **** */
$siguiente = $offset + $totalEnlacesPaginacion; /*         * **** */

$mostrar = array();
$enlacesProvisional = array();
$conteoEnlaces = 0;

$mostrar['inicio'] = "controlador.php?ruta=" . $ruta . "&pag=0"; //Enlace a enviar para páginas Iniciales
$mostrar['anterior'] = "controlador.php?ruta=" . $ruta . "&pag=" . (($anterior)); //Enlace a enviar para páginas anteriores

for ($i = $offset; $i < ($offset + $limit) && $i < $totalRegistros && $conteoEnlaces < $totalEnlacesPaginacion; $i++) {

$mostrar[$i+1] = "controlador.php?ruta=" . $ruta . "&pag=$i";
$enlacesProvisional[$i] = "controlador.php?ruta=" . $ruta . "&pag=$i";
$conteoEnlaces++;
$siguiente = $i;
}

$cantidadProvisional = count($enlacesProvisional);

if ($offset < $totalRegistros) {
$mostrar['siguiente'] = "controlador.php?ruta=" . $ruta . "&pag=" . ($siguiente + 1);
//            $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarEntradas&pag=" . ($totalPag - $totalEnlacesPaginacion) . "'>..::BLOQUE FINAL::..</a><br></center>";
$mostrar ['final'] = "controlador.php?ruta=" . $ruta . "&pag=" . ($totalRegistros);
}

if ($offset >= $totalRegistros) {
$mostrar[$siguiente + 1] = "controlador.php?ruta=" . $ruta . "&pag=" . ($siguiente + 1);
for ($j = 0; $j < $cantidadProvisional; $j++) {
$mostrar [] = $enlacesProvisional[$j];
}
$mostrar [$totalRegistros - $offset] = "controlador.php?ruta=" . $ruta . "&pag=" . ($totalRegistros - $offset);
}

return $mostrar;
}
public function armarFiltradoYBusqueda() {

    $planConsulta = "";

    if (!empty($_SESSION['entIdF'])) {
        $planConsulta .= " where entrada.entId='" . $_SESSION['entIdF'] . "'";
        $filtros = 0;  // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta        
    } else {
        $where = false; // inicializar $where a falso ( al comenzar la consulta NO HAY condiciones o criterios de búsqueda)
        $filtros = 0;  // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta            
        if (!empty($_SESSION['entradaCantidadf'])) {
            $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
            $planConsulta .= (($where && !$filtros) ? " where " : " and ") . "entrada.entradaCantidad like upper('%" . $_SESSION['entradaCantidadf'] . "%')"; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
            $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
        }

    }
    if (!empty($_SESSION['buscarF'])) {
        $where = TRUE;
        $condicionBuscar = (($where && !$filtros == 0) ? " or " : " where ");
        $filtros++;
        $planConsulta .= $condicionBuscar;
        $planConsulta .= "( entId like '%" . $_SESSION['buscarF'] . "%'";
        $planConsulta .= " or entradaCantidad like '%" . $_SESSION['buscarF'] . "%'";
        $planConsulta .= " ) ";
    }
    return $planConsulta;
}

public function conservarFiltroYBuscar() {   
//        se almacenan en sesion las variables del filtro y buscar para conservarlas en el formulario
    $_SESSION['entIdF'] = (isset($_POST['entId']) && !isset($_SESSION['entIdF'])) ? $_POST['entId'] : $_SESSION['entId']; 
    $_SESSION['entIdF'] = (!isset($_POST['entId']) && isset($_SESSION['entIdF'])) ? $_SESSION['entIdF'] : $_POST['entId']; 
    
    $_SESSION['entradaCantidadF'] = (isset($_POST['entradaCantidad']) && !isset($_SESSION['entradaCantidadF'])) ? $_POST['entradaCantidad'] : $_SESSION['entradaCantidadF'];
    $_SESSION['entradaCantidadF'] = (!isset($_POST['entradaCantidad']) && isset($_SESSION['entradaCantidadF'])) ? $_SESSION['entradaCantidadF'] : $_POST['entradaCantidad']; 
    
    $_SESSION['buscarF'] = (isset($_POST['buscar']) && !isset($_SESSION['buscarF'])) ? $_POST['buscar'] : $_SESSION['buscarF'];
    $_SESSION['buscarF'] = (!isset($_POST['buscar']) && isset($_SESSION['buscarF'])) ? $_SESSION['buscarF'] : $_POST['buscar']; 

}

}

