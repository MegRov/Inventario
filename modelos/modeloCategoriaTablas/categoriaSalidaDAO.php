<?php
include_once PATH.'modelos/ConBdMysql.php';

//http://www.mustbebuilt.co.uk/php/insert-update-and-delete-with-pdo/

class categoriaSalidaDAO extends ConBdMySql {

    private $cantidadTotalRegistros;

    public function __construct($servidor, $base, $loginBD, $passwordBD) {

        parent::__construct($servidor, $base, $loginBD, $passwordBD);
    }

    public function seleccionarTodos() {
        
        $planConsulta = "select * from persona ";


        $registrosCategoriaSalida = $this->conexion->prepare($planConsulta);
        $registrosCategoriaSalida->execute(); //Ejecución de la consulta 

        $listadoRegistrosCategoriasSalida = array();

        while ($registro = $registrosCategoriaSalida->fetch(PDO::FETCH_OBJ)) {
            $listadoRegistrosCategoriasSalida[] = $registro;
        }

        $this->cierreBd();

        return $listadoRegistrosCategoriasSalida;
    }

}
?>