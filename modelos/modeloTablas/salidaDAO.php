<?php
include_once PATH.'modelos/ConBdMysql.php';
    class salidaDAO extends ConBdMysql {
        private $cantidadTotalRegistros;

        public function __construct($servidor, $base, $loginBD, $passwordBD) {
            parent::__construct($servidor, $base, $loginBD, $passwordBD);
        }
        
        public function seleccionarTodos() {
            $planConsulta = "select * from persona";

            $registrosSalida = $this->conexion->prepare($planConsulta);
            $registrosSalida->execute();

            $listadoRegistrosSalida = array();

            while ($registro = $registrosSalida->fetch(PDO::FETCH_OBJ)){
                $listadoRegistrosSalida[] = $registro;
            }
            $this->cierreBd();
            return $listadoRegistrosSalida;
        }

        public function seleccionarId ($salId = array()){
            $planConsulta = "select *";
            $planConsulta .="  from salida s";
            $planConsulta .="  where s.salId = ? ;";

            $listar = $this->conexion->prepare($planConsulta);
            $listar->execute(array($salId[0]));

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
                $query= "INSERT INTO salida";
                $query.="(  salId, persona_perId) ";
                $query.="  VALUES";
                $query.="(  :salId, :persona_perId);";
            
                $inserta = $this->conexion->prepare($query);
                $inserta->bindParam(":salId", $registro['salId']);
                $inserta->bindParam(":persona_perId", $registro['persona_perId']);

                $insercion = $inserta->execute();
                $clavePrimariaConQueInserto = $this->conexion->lastInsertId();

                return ['inserto' => 1, 'resultado' => $clavePrimariaConQueInserto];

            } catch (PDOExcepcion $pdoExc) {
                return ['inserto' => 0, 'resultado' => $pdoExc];
            }
        }

         public function actualizar($registro) {
            try {
                $persona_perId = $registro[0]['persona_perId'];
                $salId = $registro[0]['salId']; 
    
                if(isset( $salId)) {
                    $actualizar = "UPDATE salida SET persona_perId = ?  WHERE salId= ? ;"; 
                    $actualizacion=$this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($persona_perId, $salId));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Actualización realizada."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
          }
          public function eliminar($salId = array()) {//Recibe llave primaria a eliminar
            $planConsulta = "delete from salida ";
            $planConsulta .= " where salId= :salId ;";
            $eliminar = $this->conexion->prepare($planConsulta);
            $eliminar->bindParam(':salId', $salId[0], PDO::PARAM_INT);
            $eliminar->execute();
    
            $this->cierreBd();
    
            if (!empty($resultado)) {
                return ['eliminar' => TRUE, 'registroEliminado' => array($salId[0])];
            } else {
                return ['eliminar' => FALSE, 'registroEliminado' => array($salId[0])];
            }
        }
    
        public function eliminarLogico($salId = array()) {// Se deshabilita un registro cambiando su estado a 0
            try {
    
                $cambiarEstado = 0;
    
                if (isset($salId[0])) {
                    $actualizar = "UPDATE salida SET salidaEstado = ? WHERE salId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $salId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Inactivado."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
        public function habilitar($salId = array()) {// Se habilita un registro cambiando su estado a 1
            try {
    
                $cambiarEstado = 1;
    
                if (isset($salId[0])) {
                    $actualizar = "UPDATE salida SET persona_perId = ? WHERE salId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $salId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Inactivado."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
        public function consultaPaginada($limit = NULL, $offset = NULL,$filtrarBuscar = "") {

            $planConsulta = "select * from salida ";

           
            echo $planConsulta;
            echo "<br/><br/>";
            $planConsulta .= $filtrarBuscar;

            
        $planConsulta .= "  order by salida.salId asc";
        $planConsulta .= " LIMIT " . $limit . " OFFSET " . $offset . " ; ";
        

        $listar = $this->conexion->prepare($planConsulta);
        $listar->execute();

        $listadoSalida = array();

        while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
            $listadoSalida[] = $registro;
        }

        $listar2 = $this->conexion->prepare("SELECT FOUND_ROWS() as total;");
        $listar2->execute();
        while ($registro = $listar2->fetch(PDO::FETCH_OBJ)) {
            $totalRegistros = $registro->total;
        }
        $this->cantidadTotalRegistros = $totalRegistros;

        return array($totalRegistros, $listadoSalida);
    
            //echo $planConsulta;
        }
        public function totalRegistros() {

            $planConsulta = "SELECT count(*) as total from salida; ";
    
            $cantidadSalida = $this->conexion->prepare($planConsulta);
            $cantidadSalida->execute(); //Ejecución de la consulta 
    
            $totalRegistrosSalida = "";
    
            $totalRegistrosSalida = $cantidadSalida->fetch(PDO::FETCH_OBJ);
    
            $this->cierreBd();
    
            return $totalRegistrosSalida;
        }
    
    
    
     }
    
    ?>
    