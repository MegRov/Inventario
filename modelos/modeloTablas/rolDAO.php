<?php
    class rolDAO extends ConBdMysql {
        private $cantidadTotalRegistros;

        public function __construct($servidor, $base, $loginBD, $passwordBD) {
            parent::__construct($servidor, $base, $loginBD, $passwordBD);
        }
        
        public function seleccionarTodos() {
            $planConsulta = "select * from rol";

            $registrosRol = $this->conexion->prepare($planConsulta);
            $registrosRol->execute();

            $listadoRegistrosRol = array();

            while ($registro = $registrosRol->fetch(PDO::FETCH_OBJ)){
                $listadoRegistrosRol[] = $registro;
            }
            $this->cierreBd();
            return $listadoRegistrosRol;
        }

        public function seleccionarId ($rolId = array()){
            $planConsulta = "select *";
            $planConsulta .="  from rol r";
            $planConsulta .="  where r.rolId = ? ;";

            $listar = $this->conexion->prepare($planConsulta);
            $listar->execute(array($rolId[0]));

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
                $query= "INSERT INTO rol";
                $query.="(  rolId, rolNombre, rolDescripcion, rolEstado, rolUsuSesion,rol_created_at,rol_updated_at) ";
                $query.="  VALUES";
                $query.="(  :rolId, :rolNombre, :rolDescripcion, :rolEstado, :rolUsuSesion,:rol_created_at,:rol_updated_at);";
            
                $inserta = $this->conexion->prepare($query);
                $inserta->bindParam(":rolId", $registro['rolId']);
                $inserta->bindParam(":rolNombre", $registro['rolNombre']);
                $inserta->bindParam(":rolDescripcion", $registro['rolDescripcion']);
                $inserta->bindParam(":rolEstado", $registro['rolEstado']);
                $inserta->bindParam(":rolUsuSesion", $registro['rolUsuSesion']);
                $inserta->bindParam(":rol_created_at", $registro['rol_created_at']);
                $inserta->bindParam(":rol_updated_at", $registro['rol_updated_at']);
                $insercion = $inserta->execute();
                $clavePrimariaConQueInserto = $this->conexion->lastInsertId();

                return ['inserto' => 1, 'resultado' => $clavePrimariaConQueInserto];

            } catch (PDOExcepcion $pdoExc) {
                return ['inserto' => 0, 'resultado' => $pdoExc];
            }
        }

          public function actualizar($registro) {
            try {
                $rolId = $registro['rolId']; 
                $rolNombre = $registro['rolNombre'];
                $rolDescripcion = $registro['rolDescripcion'];
                $rolEstado = $registro['rolEstado'];
                $rolUsuSesion = $registro['rolUsuSesion'];
                $rol_created_at = $registro['rol_created_at'];
                $rol_updated_at = $registro['rol_updated_at']; 
                $rolId = $registro['rolId']; 
    
                if(isset( $rolId)) {
                    $actualizar = "UPDATE rol SET rolNombre = ? ,rolDescripcion= ? , rolEstado = ? , rolUsuSesion = ? , rol_updated_at = ?  WHERE rolId= ? ;"; 
                    $actualizacion=$this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($rolNombre,$rolDescripcion,$rolEstado,$rolUsuSesion,$rol_updated_at, $rolId));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Actualización realizada."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
          }
          public function eliminar($rolId = array()) {//Recibe llave primaria a eliminar
            $planConsulta = "delete from rol ";
            $planConsulta .= " where rolId= :rolId ;";
            $eliminar = $this->conexion->prepare($planConsulta);
            $eliminar->bindParam(':rolId', $rolId[0], PDO::PARAM_INT);
            $eliminar->execute();
    
            $this->cierreBd();
    
            if (!empty($resultado)) {
                return ['eliminar' => TRUE, 'registroEliminado' => array($rolId[0])];
            } else {
                return ['eliminar' => FALSE, 'registroEliminado' => array($rolId[0])];
            }
        }
    
        public function eliminarLogico($rolId = array()) {// Se deshabilita un registro cambiando su estado a 0
            try {
    
                $cambiarEstado = 0;
    
                if (isset($rolId[0])) {
                    $actualizar = "UPDATE rol SET rolEstado = ? WHERE rolId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $rolId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Inactivado."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
        public function habilitar($rolId = array()) {// Se habilita un registro cambiando su estado a 1
            try {
    
                $cambiarEstado = 1;
    
                if (isset($rolId[0])) {
                    $actualizar = "UPDATE rol SET rolEstado = ? WHERE rolId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $rolId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Inactivado."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
    }
    ?>