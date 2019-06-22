<?php
include_once PATH.'modelos/ConBdMysql.php';

//http://www.mustbebuilt.co.uk/php/insert-update-and-delete-with-pdo/

class categoriaProductoDAO extends ConBdMySql {

    private $cantidadTotalRegistros;

    public function __construct($servidor, $base, $loginBD, $passwordBD) {

        parent::__construct($servidor, $base, $loginBD, $passwordBD);
    }

    public function seleccionarTodos() {
        
        $planConsulta = "select * from producto ";


        $registrosCategoriaProducto = $this->conexion->prepare($planConsulta);
        $registrosCategoriaProducto->execute(); //Ejecución de la consulta 

        $listadoRegistrosCategoriasProducto = array();

        while ($registro = $registrosCategoriaProducto->fetch(PDO::FETCH_OBJ)) {
            $listadoRegistrosCategoriasProducto[] = $registro;
        }

        $this->cierreBd();

        return $listadoRegistrosCategoriasProducto;
    }

}
?>