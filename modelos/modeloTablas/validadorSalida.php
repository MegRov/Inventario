<?php

class validadorSalida {

    public function validarFormularioSalida($datos) {
        $mensajesError = NULL;
        $datosViejos = NULL;
        $marcaCampo = NULL; 
        /*         * ****Validar datos ingresados************************ */
        foreach ($datos as $key => $value) {

            $datosViejos[$key] = $value;

            switch ($key) {

                case 'salId':
                    $patronDocumento = "/^[[:digit:]]+$/";
                    if (!preg_match($patronDocumento, $value)) {
                        $mensajesError['salId'] = "*1-Formato/Dato incorrecto";
                        $marcaCampo['salId'] = "*1";
                    }
                    break;
                case 'persona_perId':
                    $patronDocumento = "/^[[:digit:]]+$/";
                    if (!preg_match($patronDocumento, $value)) {
                        $mensajesError['persona_perId'] = "*2-Formato/Dato incorrecto";
                        $marcaCampo['persona_perId'] = "*2";
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