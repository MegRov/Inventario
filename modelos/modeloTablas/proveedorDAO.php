<?php
    class proveedorDAO extends ConBdMysql {
        private $cantidadTotalRegistros;

        public function __construct($servidor, $base, $loginBD, $passwordBD) {
            parent::__construct($servidor, $base, $loginBD, $passwordBD);
        }
        
        public function seleccionarTodos() {
            $planConsulta = "select * from proveedor";

            $registrosPedido = $this->conexion->prepare($planConsulta);
            $registrosPedido->execute();

            $listadoRegistrosPedido = array();

            while ($registro = $registrosPedido->fetch(PDO::FETCH_OBJ)){
                $listadoRegistrosPedido[] = $registro;
            }
            $this->cierreBd();
            return $listadoRegistrosPedido;
        }

        public function seleccionarId ($provId = array()){
            $planConsulta = "select *";
            $planConsulta .="  from proveedor prov";
            $planConsulta .="  where prov.provId = ? ;";

            $listar = $this->conexion->prepare($planConsulta);
            $listar->execute(array($provId[0]));

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
                $query= "INSERT INTO proveedor";
                $query.="(  provId, provNombre, provApellido, provTelefono, provDireccion, provContacto,provTelContacto, provEstado, provUsuSesion, prov_created_at, prov_updated_at) ";
                $query.="  VALUES";
                $query.="(  :provId, :provNombre, :provApellido, :provTelefono, :provDireccion, :provContacto, :provTelContacto, :provEstado, :provUsuSesion, :prov_created_at, :prov_updated_at) ;";
                
            
                $inserta = $this->conexion->prepare($query);
                $inserta->bindParam(":provId", $registro['provId']);
                $inserta->bindParam(":provNombre", $registro['provNombre']);
                $inserta->bindParam(":provApellido", $registro['provApellido']);
                $inserta->bindParam(":provTelefono", $registro['provTelefono']);
                $inserta->bindParam(":provDireccion", $registro['provDireccion']);
                $inserta->bindParam(":provContacto", $registro['provContacto']);
                $inserta->bindParam(":provTelContacto", $registro['provTelContacto']);
                $inserta->bindParam(":provEstado", $registro['provEstado']);
                $inserta->bindParam(":provUsuSesion", $registro['provUsuSesion']);
                $inserta->bindParam(":prov_created_at", $registro['prov_created_at']);
                $inserta->bindParam(":prov_updated_at", $registro['prov_updated_at']);
                $insercion = $inserta->execute();
                $clavePrimariaConQueInserto = $this->conexion->lastInsertId();

                return ['inserto' => 1, 'resultado' => $clavePrimariaConQueInserto];

            } catch (PDOExcepcion $pdoExc) {
                return ['inserto' => 0, 'resultado' => $pdoExc];
            }
        }
        public function actualizar($registro) {
            try {
                $provNombre = $registro['provNombre'];
                $provApellido = $registro['provApellido'];
                $provTelefono = $registro['provTelefono'];
                $provDireccion = $registro['provDireccion'];
                $provContacto = $registro['provContacto'];
                $provTelContacto = $registro['provTelContacto'];
                $provEstado = $registro['provEstado'];
                $provUsuSesion = $registro['provUsuSesion'];
                $prov_created_at = $registro['prov_created_at'];
                $prov_updated_at = $registro['prov_updated_at'];
                $provId = $registro['provId'];
    
                if (isset($provId)) {
                    $actualizar = "UPDATE proveedor SET provNombre= ? , provApellido = ? , provTelefono = ? , provDireccion = ?, provContacto = ?, provTelContacto = ?, provEstado = ?, provUsuSesion = ?, prov_created_at = ?, prov_updated_at = ? WHERE provId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($provNombre, $provApellido, $provTelefono, $provDireccion, $provContacto, $provTelContacto, $provEstado, $provUsuSesion, $prov_created_at, $prov_updated_at, $provId));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Actualización realizada."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }

        public function eliminar($provId = array()) {//Recibe llave primaria a eliminar
            $planConsulta = "delete from proveedor ";
            $planConsulta .= " where provId= :provId ;";
            $eliminar = $this->conexion->prepare($planConsulta);
            $eliminar->bindParam(':provId', $provId[0], PDO::PARAM_INT);
            $eliminar->execute();
    
            $this->cierreBd();
    
            if (!empty($resultado)) {
                return ['eliminar' => TRUE, 'registroEliminado' => array($provId[0])];
            } else {
                return ['eliminar' => FALSE, 'registroEliminado' => array($provId[0])];
            }
        }

        public function eliminarLogico($provId = array()) {// Se deshabilita un registro cambiando su estado a 0
            try {
    
                $cambiarEstado = 0;
    
                if (isset($provId[0])) {
                    $actualizar = "UPDATE proveedor SET provEstado = ? WHERE provId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $provId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Inactivado."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }
        public function habilitar($provId = array()) {// Se habilita un registro cambiando su estado a 1
            try {
    
                $cambiarEstado = 1;
    
                if (isset($provId[0])) {
                    $actualizar = "UPDATE proveedor SET provEstado = ? WHERE provId= ? ;";
                    $actualizacion = $this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($cambiarEstado, $provId[0]));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Registro Inactivado."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
        }

        
    

          /* public function actualizar($registro) {
            try {
                $proId = $registro['proId']; 
                $proNombre = $registro['proNombre'];
                $proDescripcion = $registro['proDescripcion'];
                $proCantExistente = $registro['proCantExistente'];
                $proUnidadMedida = $registro['proUnidadMedida'];
                $proEstado = $registro['proEstado'];
                $proUsuSesion = $registro['proUsuSesion'];
                $pro_created_at = $registro['pro_created_at'];
                $pro_updated_at = $registro['pro_updated_at'];
                $pedId = $registro['proId']; 
    
                if(isset( $pedId)) {
                    $actualizar = "UPDATE producto SET proNombre = ? ,proDescripcion= ? , proCantExistente = ? , proUnidadMedida = ? , proEstado = ? , proUsuSesion = ?, pro_created_at = ?, pro_updated_at = ?  WHERE proId= ? ;"; 
                    $actualizacion=$this->conexion->prepare($actualizar);
                    $actualizacion = $actualizacion->execute(array($proNombre,$proDescripcion,$proCantExistente,$proUnidadMedida,$proEstado, $proUsuSesion,$pro_created_at, $pro_updated_at, $proId));
                    return ['actualizacion' => $actualizacion, 'mensaje' => "Actualización realizada."];
                }
            } catch (PDOException $pdoExc) {
                return ['actualizacion' => $actualizacion, 'mensaje' => $pdoExc];
            }
          }*/
    }
    ?> 