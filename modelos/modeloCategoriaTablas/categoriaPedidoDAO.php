<?php
include_once PATH.'modelos/ConBdMysql.php';

//http://www.mustbebuilt.co.uk/php/insert-update-and-delete-with-pdo/

class categoriaPedidoDAO extends ConBdMySql {

    private $cantidadTotalRegistros;

    public function __construct($servidor, $base, $loginBD, $passwordBD) {

        parent::__construct($servidor, $base, $loginBD, $passwordBD);
    }

    public function seleccionarTodos() {
        
        $planConsulta = "select * from pedido ";


        $registrosCategoriaPedido = $this->conexion->prepare($planConsulta);
        $registrosCategoriaPedido->execute(); //Ejecución de la consulta 

        $listadoRegistrosCategoriasPedido = array();

        while ($registro = $registrosCategoriaPedido->fetch(PDO::FETCH_OBJ)) {
            $listadoRegistrosCategoriasPedido[] = $registro;
        }

        $this->cierreBd();

        return $listadoRegistrosCategoriasPedido;
    }

}
?>