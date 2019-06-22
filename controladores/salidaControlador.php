<?php

include_once  PATH.'modelos/modeloTablas/salidaDAO.php';
include_once PATH . 'modelos/modeloCategoriaTablas/categoriaSalidaDAO.php';

class salidaControlador {

    private $datos;

    public function __construct($datos) {
        $this->datos = $datos;
        $this->salidaControlador();
    }

    public function salidaControlador() {

//        echo __FILE__ . "<br/>" . __CLASS__ . "<br/>" . __METHOD__ . "<br/>" . __LINE__ . "<br/><br/>";

        switch ($this->datos['ruta']) {
            case 'mostrarInsertarSalida':
                //Se alistan datos a desplegar en los campos select con relación a otras tablas
                $gestarCategoriasSalida = new categoriaSalidaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                $registroCategoriasSalida = $gestarCategoriasSalida->seleccionarTodos(); /*                 * *********** */

                session_start();
                $_SESSION['registroCategoriasSalida'] = $registroCategoriasSalida;
                $gestarCategoriasSalida= null;

                header("location:principal.php?contenido=vistas/vistasTablas/vistaInsertarSalida.php");
                break;
            case 'insertarSalida':

                $buscarSalida= new salidaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD); //Se instancia EntradaDAO para insertar
                $salidaHallado = $buscarSalida->seleccionarId(array($this->datos['salId'])); //Se consulta si existe ya el registro
                echo "<pre>";
                print_r($salidaHallado);
                echo "</pre>";
                if (!$salidaHallado['exitoSeleccionId']) {//Si no existe el Entrada en la base se procede a insertar
                    $insertarSalida = new salidaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
                    $insertoSalida = $insertarSalida->insertar($this->datos); //inserción de los campos en la tabla Entradas    
                    $exitoInsercionSalida = $insertoSalida['inserto']; //indica si se logró inserción de los campos en la tabla Entradas
                    $resultadoInsercionSalida = $insertoSalida['resultado']; //Traer el id con que quedó el Entrada de lo contrario la excepción o fallo
                    session_start();
                    $_SESSION['mensaje'] = "Registrado ".$this->datos['salId']." con èxito. Agregado Nuevo Salida: " . $resultadoInsercionEntrada. " "; //mensaje de inserción 

                    header("location:controlador.php?ruta=listarSalida");
                } else {
                    session_start();
                    $_SESSION['salId'] = $this->datos['salId'];
                    $_SESSION['persona_perId'] = $this->datos['persona_perId'];
                    $_SESSION['mensaje'] = "   El código " . $this->datos['salId'] . " ya existe en el sistema.";

                    header("location:controlador.php?ruta=mostrarInsertarSalida");
                }
                break;
            

 
case "listarSalida":
        session_start();
        $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 2;
        $offset = (isset($_GET['pag'])) ? $_GET['pag'] : 0;
        $offset = ($offset < 0 || !isset($_GET['pag'])) ? 0 : $_GET['pag'];

        $filtarBuscar = "";
        $this->conservarFiltroYBuscar(); 

        $filtrarBuscar = $this->armarFiltradoYBusqueda();

        $gestarSalida = new salidaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
        $resultadoConsultaPaginada = $gestarSalida->consultaPaginada($limit, $offset, $filtrarBuscar);
        $totalRegistros = $resultadoConsultaPaginada[0];
        $listaDeSalida = $resultadoConsultaPaginada[1];  


        $totalEnlacesPaginacion = (isset($_GET['limit'])) ? $_GET['limit'] : 2;
        $paginacionVinculos = $this->enlacesPaginacion($totalRegistros, $limit, $offset, $totalEnlacesPaginacion); 

        $gestarCategoriasSalida = new personaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
        $registroCategoriasSalida = $gestarCategoriasSalida->seleccionarTodos();



        $_SESSION['listaDeSalida'] = $listaDeSalida;
        $_SESSION['paginacionVinculos'] = $paginacionVinculos;
        $_SESSION['totalRegistros'] = $totalRegistros;
        $_SESSION['registroPersona'] = $registroPersona;

        $gestarSalida = null; 
        header("location:principal.php?contenido=vistas/vistasTablas/listarRegistrosSalida.php");
        break;
        case "actualizarSalida":

        $gestarSalida = new salidaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
        //                $consultaEntrada = new EntradaVO();
        $consultaDeSalida = $gestarSalida->seleccionarId(array($this->datos["idAct"])); //Se consulta el Entrada para traer los datos.

        $actualizarDatosSalida = $consultaDeSalida['registroEncontrado'][0];

        session_start();
        $_SESSION['actualizarDatosSalida'] = $actualizarDatosSalida;

        header("location:principal.php?contenido=vistas/vistasTablas/vistaActualizarSalida.php");
        break;
        case "confirmaActualizarSalida":
        $gestarSalida = new salidaDAO(SERVIDOR, BASE, USUARIO_BD, CONTRASENIA_BD);
        //                $consultaEntrada = new EntradaVO();
        $actualizarSalida = $gestarSalida->actualizar(array($this->datos)); //Se envía datos del Entrada para actualizar.

        $actualizarSalida = $consultaDeSalida['registroEncontrado'][0];

        session_start();
        $_SESSION['mensaje'] = "Actualización realizada.";
        header("location:controlador.php?ruta=listarSalida");
        break;
                    }
                }

      public function enlacesPaginacion($totalRegistros = NULL, $limit = 2, $offset = 0, $totalEnlacesPaginacion = 2) {

        $ruta = "listarSalida";

        if (isset($offset) && (int) $offset <= 0) {
            $offset = 0;
        }
        if (isset($offset) && ((int) $offset > ($totalRegistros - $limit))) {
            $offset = ($totalRegistros - $limit) + 1;
        }
        $anterior = $offset - $totalEnlacesPaginacion;
        $siguiente = $offset + $totalEnlacesPaginacion;

        $mostrar = array();
        $enlacesProvisional = array();
        $conteoEnlaces = 0;

        $mostrar['inicio'] = "Controlador.php?ruta=" . $ruta . "&pag=0"; 
        $mostrar['anterior'] = "Controlador.php?ruta=" . $ruta . "&pag=" . (($anterior)); 

        for ($i = $offset; $i < ($offset + $limit) && $i < $totalRegistros && $conteoEnlaces < $totalEnlacesPaginacion; $i++) {

            $mostrar[$i+1] = "Controlador.php?ruta=" . $ruta . "&pag=$i";
            $enlacesProvisional[$i] = "Controlador.php?ruta=" . $ruta . "&pag=$i";
            $conteoEnlaces++;
            $siguiente = $i;
        }

        $cantidadProvisional = count($enlacesProvisional);

        if ($offset < $totalRegistros) {
            $mostrar['siguiente'] = "Controlador.php?ruta=" . $ruta . "&pag=" . ($siguiente + 1);
//            $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarLibros&pag=" . ($totalPag - $totalEnlacesPaginacion) . "'>..::BLOQUE FINAL::..</a><br></center>";
            $mostrar ['final'] = "Controlador.php?ruta=" . $ruta . "&pag=" . ($totalRegistros);
        }

        if ($offset >= $totalRegistros) {
            $mostrar[$siguiente + 1] = "Controlador.php?ruta=" . $ruta . "&pag=" . ($siguiente + 1);
            for ($j = 0; $j < $cantidadProvisional; $j++) {
                $mostrar [] = $enlacesProvisional[$j];
            }
            $mostrar [$totalRegistros - $offset] = "Controlador.php?ruta=" . $ruta . "&pag=" . ($totalRegistros - $offset);
        }

        return $mostrar;
    }

    public function armarFiltradoYBusqueda() {

        $planConsulta = "";

        if (!empty($_SESSION['salIdF'])) {
            $planConsulta .= " where salida.salId='" . $_SESSION['salIdF'] . "'";
            $filtros = 0;  // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta        
        } else {
            $where = false; // inicializar $where a falso ( al comenzar la consulta NO HAY condiciones o criterios de búsqueda)
            $filtros = 0;  // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta            
            if (!empty($_SESSION['persona_perIdF'])) {
                $where = true;  // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . " s.persona_perId like upper('%" . $_SESSION['persona_perIdF'] . "%')";
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            /*if (!empty($_SESSION['perNombreF'])) {
                $where = true;  // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . " p.perNombre like upper('%" . $_SESSION['perNombreF'] . "%')";
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }*/
        }
        if (!empty($_SESSION['buscarF'])) {
            $where = TRUE;
            $condicionBuscar = (($where && !$filtros == 0) ? " or " : " where ");
            $filtros++;
            $planConsulta .= $condicionBuscar;
            $planConsulta .= "( salId like '%" . $_SESSION['buscarF'] . "%'";
            $planConsulta .= " or persona_perId like '%" . $_SESSION['buscarF'] . "%'";
            /*$planConsulta .= " or perNombre like '%" . $_SESSION['buscarF'] . "%'";*/
            $planConsulta .= " ) ";
        }
        return $planConsulta; 

        }

        public function conservarFiltroYBuscar() {   
            //        se almacenan en sesion las variables del filtro y buscar para conservarlas en el formulario
                    $_SESSION['salIdF'] = (isset($_POST['salId']) && !isset($_SESSION['salIdF'])) ? $_POST['salId'] : $_SESSION['salIdF']; 
                    $_SESSION['salIdF'] = (!isset($_POST['salId']) && isset($_SESSION['salIdF'])) ? $_SESSION['salIdF'] : $_POST['salId'];  
                    
                    $_SESSION['persona_perIdF'] = (isset($_POST['persona_perId']) && !isset($_SESSION['persona_perIdF'])) ? $_POST['persona_perId'] : $_SESSION['persona_perIdF']; 
                    $_SESSION['persona_perIdF'] = (!isset($_POST['persona_perId']) && isset($_SESSION['persona_perIdF'])) ? $_SESSION['persona_perIdF'] : $_POST['persona_perId'];
                    
                    $_SESSION['buscarF'] = (isset($_POST['buscar']) && !isset($_SESSION['buscarF'])) ? $_POST['buscar'] : $_SESSION['buscarF'];
                    $_SESSION['buscarF'] = (!isset($_POST['buscar']) && isset($_SESSION['buscarF'])) ? $_SESSION['buscarF'] : $_POST['buscar']; 
            
        }
}
   
