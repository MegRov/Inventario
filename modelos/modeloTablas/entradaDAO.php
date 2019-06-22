<?php
include_once PATH.'modelos/ConBdMysql.php';
/*http://www.mustbebuilt.co.uk/php/insert-update-and-delete-with-pdo*/

     class entradaDAO extends ConBdMysql{ 
        private $cantidadTotalRegistros;

        public function __construct($servidor, $base, $loginBD, $passwordBD) {
            parent::__construct($servidor, $base, $loginBD, $passwordBD);
        }
        
        public function seleccionarTodos() {
            $planConsulta = "select * from entrada";

            $registrosEntrada = $this->conexion->prepare($planConsulta);
            $registrosEntrada->execute();

            $listadoRegistrosEntrada = array();

            while ($registro = $registrosEntrada->fetch(PDO::FETCH_OBJ)){
                $listadoRegistrosEntrada[] = $registro;
            }
            $this->cierreBd();
            return $listadoRegistrosEntrada;
        }

        public function seleccionarId ($sId = array()){
            $planConsulta = "select *";
            $planConsulta .="  from entrada e";
            $planConsulta .="  where e.entId = ? ;";

            $listar = $this->conexion->prepare($planConsulta);
            $listar->execute(array($sId[0]));

            $registroEncontrado = array();
            while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
                $registroEncontrado[] = $registro;
            }
            $this->cierreBd();

            if (!empty($registroEncontrado)) {
                return ['exitoSeleccionId' => 1 , 'registroEncontrado' => $registroEncontrado ];
           } else {
                return ['exitoSeleccioId'=> FALSE, 'registroEncontrado' => $registroEncontrado];
            }

        }
        
      public function insertar($registro){
            try {
                $query= "INSERT INTO entrada";
                $query.=" (  entId, entradaCantidad) ";
                $query.="  VALUES";
                $query.="(  :entId, :entradaCantidad);";
            
                $inserta = $this->conexion->prepare($query);
                $inserta->bindParam(":entId", $registro['entId']);
                $inserta->bindParam(":entradaCantidad", $registro['entradaCantidad']);
                //$inserta->bindParam(":entradaEstado", $registro['entradaEstado']);
                $insercion = $inserta->execute();
                $clavePrimariaConQueInserto = $this->conexion->lastInsertId();

                return ['inserto' => 1, 'resultado' => $clavePrimariaConQueInserto];

            } catch (PDOExcepcion $pdoExc) {
                return ['inserto' => 0, 'resultado' => $pdoExc];
            }
        }

          public function actualizar($registro) {
            try {
                $entradaCantidad = $registro[0]['entradaCantidad'];
                $entId = $registro[0]['entId']; 
    
               
    
                if(isset( $entId)) {
                    $actualizar = "UPDATE entrada SET entradaCantidad = ?  WHERE entId= ? ;"; 
                    $actualizacion=$this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($entradaCantidad, $entId));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Actualización realizada."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
        public function eliminar($entId = array()) {//Recibe llave primaria a eliminar
            $planConsulta = "delete from entrada ";
            $planConsulta .= " where entId= :entId ;";
            $eliminar = $this->conexion->prepare($planConsulta);
            $eliminar->bindParam(':entId', $entId[0], PDO::PARAM_INT);
            $eliminar->execute();
    
            $this->cierreBd();
    
            if (!empty($resultado)) {
                return ['eliminar' => TRUE, 'registroEliminado' => array($entId[0])];
            } else {
                return ['eliminar' => FALSE, 'registroEliminado' => array($entId[0])];
            }
        }

        public function eliminarLogico($entId = array()) {// Se deshabilita un registro cambiando su estado a 0
            try {
    
                $cambiarEstado = 0;
    
                if (isset($entId[0])) {
                    $actualizar = "UPDATE entrada SET entradaEstado = ? WHERE entId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $entId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Inactivado."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
        public function habilitar($entId = array()) {// Se habilita un registro cambiando su estado a 1
            try {
    
                $cambiarEstado = 1;
    
                if (isset($entId[0])) {
                    $actualizar = "UPDATE entrada SET entradaEstado = ? WHERE entId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $entId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Inactivado."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }

       public function consultaPaginada($limit = NULL, $offset = NULL, $filtrarBuscar = "") {

            $planConsulta = "select * from entrada ";

            $planConsulta .=$filtrarBuscar;

    
            echo $planConsulta;
            echo "<br/><br/>";

            
        $planConsulta .= "  order by entrada.entId asc";
        $planConsulta .= " LIMIT " . $limit . " OFFSET " . $offset . " ; ";
        

        $listar = $this->conexion->prepare($planConsulta);
        $listar->execute();

        $listadoEntrada = array();

        while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
            $listadoEntrada[] = $registro;
        }

        $listar2 = $this->conexion->prepare("SELECT FOUND_ROWS() as total;");
        $listar2->execute();
        while ($registro = $listar2->fetch(PDO::FETCH_OBJ)) {
            $totalRegistros = $registro->total;
        }
        $this->cantidadTotalRegistros = $totalRegistros;

        return array($totalRegistros, $listadoEntrada);
    
            //echo $planConsulta;
        }
        public function totalRegistros() {

            $planConsulta = "SELECT count(*) as total from entrada; ";
    
            $cantidadEntrada = $this->conexion->prepare($planConsulta);
            $cantidadEntrada->execute(); //Ejecución de la consulta 
    
            $totalRegistrosEntrada = "";
    
            $totalRegistrosEntrada = $cantidadEntrada->fetch(PDO::FETCH_OBJ);
    
            $this->cierreBd();
    
            return $totalRegistrosEntrada;
        }
    
    
    
     }
    
    ?>