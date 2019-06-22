<?php

class validadorEntrada {

    public function validarFormularioEntrada($datos) {
        $mensajesError = NULL;
        $datosViejos = NULL;
        $marcaCampo = NULL; 
        /*         * ****Validar datos ingresados************************ */
        foreach ($datos as $key => $value) {

            $datosViejos[$key] = $value;

            switch ($key) {

                case 'entId':
                    $patronDocumento = "/^[[:digit:]]+$/";
                    if (!preg_match($patronDocumento, $value)) {
                        $mensajesError['entId'] = "*1-Formato/Dato incorrecto";
                        $marcaCampo['entId'] = "*1";
                    }
                    break;
                case 'entradaCantidad':
                    $patronDocumento = "/^[[:digit:]]+$/";
                    if (!preg_match($patronDocumento, $value)) {
                        $mensajesError['entId'] = "*2-Formato/Dato incorrecto";
                        $marcaCampo['entId'] = "*2";
                    }
                    break;
            }
        }
        if (!is_null($mensajesError)) {
            return array('datosViejos' => $datosViejos, 'mensajesError' => $mensajesError, 'marcaCampo' => $marcaCampo);
        } else {
            $datosViejos = NULL;
            return FALSE;
        }
    }

}
?>