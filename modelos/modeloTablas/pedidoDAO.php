<?php
include_once PATH.'modelos/ConBdMysql.php';

    class pedidoDAO extends ConBdMysql {
        private $cantidadTotalRegistros;

        public function __construct($servidor, $base, $loginBD, $passwordBD) {
            parent::__construct($servidor, $base, $loginBD, $passwordBD);
        }
        
        public function seleccionarTodos() {
            $planConsulta = "select * from pedido";

            $registrosPedido = $this->conexion->prepare($planConsulta);
            $registrosPedido->execute();

            $listadoRegistrosPedido = array();

            while ($registro = $registrosPedido->fetch(PDO::FETCH_OBJ)){
                $listadoRegistrosPedido[] = $registro;
            }
            $this->cierreBd();
            return $listadoRegistrosPedido;
        }

       public function seleccionarId ($pedId = array()){
            $planConsulta = "select *";
            $planConsulta .="  from pedido p";
            $planConsulta .="  where p.pedId = ? ;";

            $listar = $this->conexion->prepare($planConsulta);
            $listar->execute(array($pedId[0]));

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
                $query= "INSERT INTO pedido";
                $query.="(  pedId, pedProducto, pedCantidad) ";
                $query.="  VALUES";
                $query.="(  :pedId, :pedProducto, :pedCantidad) ;";
            
                $inserta = $this->conexion->prepare($query);
                $inserta->bindParam(":pedId", $registro['pedId']);
                $inserta->bindParam(":pedProducto", $registro['pedProducto']);
                $inserta->bindParam(":pedCantidad", $registro['pedCantidad']);
                $insercion_ped = $inserta->execute();
                $clavePrimariaConQueInserto = $this->conexion->lastInsertId();

                return ['inserto' => 1, 'resultado' => $clavePrimariaConQueInserto];

            } catch (PDOExcepcion $pdoExc) {
                return ['inserto' => 0, 'resultado' => $pdoExc];
            }
        }

          public function actualizar($registro) {
            try {
                $pedProducto = $registro[0]['pedProducto'];
                $pedCantidad = $registro[0]['pedCantidad'];
                $pedId = $registro[0]['pedId']; 
    
                if(isset( $pedId)) {
                    $actualizar = "UPDATE pedido SET pedProducto = ? ,pedCantidad= ?   WHERE pedId= ? ;"; 
                    $actualizacion=$this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($pedProducto,$pedCantidad, $pedId));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Actualización realizada."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
        public function eliminar($pedId = array()) {//Recibe llave primaria a eliminar
            $planConsulta = "delete from pedido ";
            $planConsulta .= " where pedId= :pedId ;";
            $eliminar = $this->conexion->prepare($planConsulta);
            $eliminar->bindParam(':pedId', $pedId[0], PDO::PARAM_INT);
            $eliminar->execute();
    
            $this->cierreBd();
    
            if (!empty($resultado)) {
                return ['eliminar' => TRUE, 'registroEliminado' => array($pedId[0])];
            } else {
                return ['eliminar' => FALSE, 'registroEliminado' => array($pedId[0])];
            }
        }
        public function eliminarLogico($pedId = array()) {// Se deshabilita un registro cambiando su estado a 0
            try {
    
                $cambiarEstado = 0;
    
                if (isset($pedId[0])) {
                    $actualizar = "UPDATE pedido SET pedEstado = ? WHERE pedId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $pedId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Inactivado."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
        public function habilitar($pedId = array()) {// Se habilita un registro cambiando su estado a 1
            try {
    
                $cambiarEstado = 1;
    
                if (isset($pedId[0])) {
                    $actualizar = "UPDATE pedido SET pedEstado = ? WHERE pedId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $pedId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Inactivado."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
        public function consultaPaginada($limit = NULL, $offset = NULL, $filtrarBuscar = "") {

            $planConsulta = "select * from pedido ";

            $planConsulta .="$filtrarBuscar";

    
            echo $planConsulta;
            echo "<br/><br/>";

            
        $planConsulta .= "  order by pedido.pedId asc";
        $planConsulta .= " LIMIT " . $limit . " OFFSET " . $offset . " ; ";
        

        $listar = $this->conexion->prepare($planConsulta);
        $listar->execute();

        $listadoPedido = array();

        while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
            $listadoPedido[] = $registro;
        }

        $listar2 = $this->conexion->prepare("SELECT FOUND_ROWS() as total;");
        $listar2->execute();
        while ($registro = $listar2->fetch(PDO::FETCH_OBJ)) {
            $totalRegistros = $registro->total;
        }
        $this->cantidadTotalRegistros = $totalRegistros;

        return array($totalRegistros, $listadoPedido);
    
            //echo $planConsulta;
        }   
        public function totalRegistros() {

            $planConsulta = "SELECT count(*) as total from pedido; ";
    
            $cantidadPedido = $this->conexion->prepare($planConsulta);
            $cantidadPedido->execute(); //Ejecución de la consulta 
    
            $totalRegistrosPedido = "";
    
            $totalRegistrosPedido = $cantidadPedido->fetch(PDO::FETCH_OBJ);
    
            $this->cierreBd();
    
            return $totalRegistrosPedido;
        }
    
        
    }
    ?> 