<?php
    class productoDAO extends ConBdMysql {
        private $cantidadTotalRegistros;

        public function __construct($servidor, $base, $loginBD, $passwordBD) {
            parent::__construct($servidor, $base, $loginBD, $passwordBD);
        }
        
        public function seleccionarTodos() {
            $planConsulta = "select * from producto";

            $registrosProducto = $this->conexion->prepare($planConsulta);
            $registrosProducto->execute();

            $listadoRegistrosProducto = array();

            while ($registro = $registrosProducto->fetch(PDO::FETCH_OBJ)){
                $listadoRegistrosProducto[] = $registro;
            }
            $this->cierreBd();
            return $listadoRegistrosProducto;
        }

       public function seleccionarId ($proId = array()){
            $planConsulta = "select *";
            $planConsulta .="  from producto pro";
            $planConsulta .="  where pro.proId = ? ;";

            $listar = $this->conexion->prepare($planConsulta);
            $listar->execute(array($proId[0]));

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
                $query= "INSERT INTO producto";
                $query.="(  proId,proNombre, proDescripcion, proUnidadMedida, proCantExistente, proEstado,proUsuSesion,pro_created_at, pro_updated_at) ";
                $query.="  VALUES";
                $query.="(  :proId, :proNombre, :proDescripcion, :proUnidadMedida, :proCantExistente, :proEstado,:proUsuSesion,:pro_created_at, :pro_updated_at) ;";
            
                $inserta = $this->conexion->prepare($query);
                $inserta->bindParam(":proId", $registro['proId']);
                $inserta->bindParam(":proNombre", $registro['proNombre']);
                $inserta->bindParam(":proDescripcion", $registro['proDescripcion']);
                $inserta->bindParam(":proUnidadMedida", $registro['proUnidadMedida']);
                $insercion_pro = $inserta->execute();
                $clavePrimariaConQueInserto = $this->conexion->lastInsertId();

                return ['inserto' => 1, 'resultado' => $clavePrimariaConQueInserto];

            } catch (PDOExcepcion $pdoExc) {
                return ['inserto' => 0, 'resultado' => $pdoExc];
            }
        }

           public function actualizar($registro) {
            try {
                $proId = $registro['proId']; 
                $proNombre = $registro['proNombre'];
                $proDescripcion = $registro['proDescripcion'];
                $proCantExistente = $registro['proCantExistente'];
                $proUnidadMedida = $registro['proUnidadMedida'];
                $pedId = $registro['proId']; 
    
                if(isset( $pedId)) {
                    $actualizar = "UPDATE producto SET proNombre = ? ,proDescripcion= ? , proUnidadMedida = ? , proCantExistente = ? , proEstado = ? , proUsuSesion = ?, pro_created_at = ?, pro_updated_at = ?  WHERE proId= ? ;"; 
                    $actualizacion=$this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($proNombre,$proDescripcion,$proCantExistente,$proUnidadMedida,$proEstado, $proUsuSesion,$pro_created_at, $pro_updated_at, $proId));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Actualización realizada."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
          }
          public function eliminar($proId = array()) {//Recibe llave primaria a eliminar
            $planConsulta = "delete from producto ";
            $planConsulta .= " where proId= :proId ;";
            $eliminar = $this->conexion->prepare($planConsulta);
            $eliminar->bindParam(':proId', $proId[0], PDO::PARAM_INT);
            $eliminar->execute();
    
            $this->cierreBd();
    
            if (!empty($resultado)) {
                return ['eliminar' => TRUE, 'registroEliminado' => array($proId[0])];
            } else {
                return ['eliminar' => FALSE, 'registroEliminado' => array($proId[0])];
            }
        }
        public function eliminarLogico($proId = array()) {// Se deshabilita un registro cambiando su estado a 0
            try {
    
                $cambiarEstado = 0;
    
                if (isset($proId[0])) {
                    $actualizar = "UPDATE producto SET proEstado = ? WHERE proId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $proId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Inactivado."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
        public function habilitar($proId = array()) {// Se habilita un registro cambiando su estado a 1
            try {
    
                $cambiarEstado = 1;
    
                if (isset($proId[0])) {
                    $actualizar = "UPDATE producto SET proEstado = ? WHERE proId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $proId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Activo."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
    }
    ?> 