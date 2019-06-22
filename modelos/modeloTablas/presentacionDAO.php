<?php
    class presentacionDAO extends ConBdMysql {
        private $cantidadTotalRegistros;

        public function __construct($servidor, $base, $loginBD, $passwordBD) {
            parent::__construct($servidor, $base, $loginBD, $passwordBD);
        }
        
        public function seleccionarTodos() {
            $planConsulta = "select * from presentacion";

            $registrosPresentacion = $this->conexion->prepare($planConsulta);
            $registrosPresentacion->execute();

            $listadoRegistrosPresentacion = array();

            while ($registro = $registrosPresentacion->fetch(PDO::FETCH_OBJ)){
                $listadoRegistrosPresentacion[] = $registro;
            }
            $this->cierreBd();
            return $listadoRegistrosPresentacion;
        }

       public function seleccionarId ($preId = array()){
            $planConsulta = "select *";
            $planConsulta .="  from presentacion pr";
            $planConsulta .="  where pr.preId = ? ;";

            $listar = $this->conexion->prepare($planConsulta);
            $listar->execute(array($preId[0]));

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
                $query= "INSERT INTO presentacion";
                $query.=" (  preId, preNombre, preDescripcion, preEstado, preUsuSesion, pre_created_at, pre_updated_at) ";
                $query.="  VALUES";
                $query.="(  preId, preNombre, preDescripcion, preEstado, preUsuSesion, pre_created_at, pre_updated_at) ;";
            
                $inserta = $this->conexion->prepare($query);
                $inserta->bindParam(":preId", $registro['preId']);
                $inserta->bindParam(":preNombre", $registro['preNombre']);
                $inserta->bindParam(":preDescripcion", $registro['preDescripcion']);
                $inserta->bindParam(":preEstado", $registro['preEstado']);
                $inserta->bindParam(":preUsuSesion", $registro['preUsuSesion']);
                $inserta->bindParam(":pre_created_at", $registro['pre_created_at']);
                $inserta->bindParam(":pre_updated_at", $registro['pre_updated_at']);
                $insercion_pre = $inserta->execute();
                $clavePrimariaConQueInserto = $this->conexion->lastInsertId();

                return ['inserto' => 1, 'resultado' => $clavePrimariaConQueInserto];

            } catch (PDOExcepcion $pdoExc) {
                return ['inserto' => 0, 'resultado' => $pdoExc];
            }
        }

          public function actualizar($registro) {
            try {
                $preId = $registro['preId']; 
                $preNombre = $registro['preNombre'];
                $preDescripcion = $registro['preDescripcion'];
                $preEstado = $registro['preEstado'];
                $preUsuSesion = $registro['preUsuSesion'];
                $pre_created_at = $registro['pre_created_at'];
                $pre_updated_at = $registro['pre_updated_at'];
                $pedId = $registro['preId']; 
    
                if(isset( $pedId)) {
                    $actualizar = "UPDATE presentacion SET preNombre = ? ,preDescripcion= ? , preEstado = ? , preUsuSesion = ? , pre_created_at = ? , pre_updated_at = ?  WHERE preId= ? ;"; 
                    $actualizacion=$this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($preNombre,$preDescripcion,$preEstado,$preUsuSesion,$pre_created_at, $pre_updated_at, $preId));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Actualización realizada."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
        public function eliminar($preId = array()) {//Recibe llave primaria a eliminar
            $planConsulta = "delete from presentacion ";
            $planConsulta .= " where preId= :preId ;";
            $eliminar = $this->conexion->prepare($planConsulta);
            $eliminar->bindParam(':preId', $preId[0], PDO::PARAM_INT);
            $eliminar->execute();
    
            $this->cierreBd();
    
            if (!empty($resultado)) {
                return ['eliminar' => TRUE, 'registroEliminado' => array($preId[0])];
            } else {
                return ['eliminar' => FALSE, 'registroEliminado' => array($preId[0])];
            }
        }
        public function eliminarLogico($preId = array()) {// Se deshabilita un registro cambiando su estado a 0
            try {
    
                $cambiarEstado = 0;
    
                if (isset($preId[0])) {
                    $actualizar = "UPDATE presentacion SET preEstado = ? WHERE preId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $preId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Inactivado."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
        public function habilitar($preId = array()) {// Se habilita un registro cambiando su estado a 1
            try {
    
                $cambiarEstado = 1;
    
                if (isset($preId[0])) {
                    $actualizar = "UPDATE presentacion SET preEstado = ? WHERE preId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $preId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Inactivado."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
        
    }
    ?> 
