<?php
include_once PATH.'modelos/ConBdMysql.php';

//http://www.mustbebuilt.co.uk/php/insert-update-and-delete-with-pdo/

class categoriaEntradaDAO extends ConBdMySql {

    private $cantidadTotalRegistros;

    public function __construct($servidor, $base, $loginBD, $passwordBD) {

        parent::__construct($servidor, $base, $loginBD, $passwordBD);
    }

    public function seleccionarTodos() {
        
        $planConsulta = "select * from entrada ";


        $registrosCategoriaEntrada = $this->conexion->prepare($planConsulta);
        $registrosCategoriaEntrada->execute(); //Ejecución de la consulta 

        $listadoRegistrosCategoriasEntrada = array();

        while ($registro = $registrosCategoriaEntrada->fetch(PDO::FETCH_OBJ)) {
            $listadoRegistrosCategoriasEntrada[] = $registro;
        }

        $this->cierreBd();

        return $listadoRegistrosCategoriasEntrada;
    }

}
?>