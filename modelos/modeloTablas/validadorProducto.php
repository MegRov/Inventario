<?php

class validadorProducto{

    public function validarFormularioProducto($datos) {
        $mensajesError = NULL;
        $datosViejos = NULL;
        $marcaCampo = NULL; 
        /*         * ****Validar datos ingresados************************ */
        foreach ($datos as $key => $value) {

            $datosViejos[$key] = $value;

            switch ($key) {

                case 'proId':
                    $patronDocumento = "/^[[:digit:]]+$/";
                    if (!preg_match($patronDocumento, $value)) {
                        $mensajesError['pro'] = "*1-Formato/Dato incorrecto";
                        $marcaCampo['proId'] = "*1";
                    }
                    break;
                    case 'pedProducto':
                    $patronDocumento = "/^[^ ][a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ ]*$/";
                    if (!preg_match($patronDocumento, $value)) {
                        $mensajesError['pedProducto'] = "*2-Formato/Dato incorrecto";
                        $marcaCampo['pedProducto'] = "*2";
                    }
                    break;
                    case 'pedCantidad':
                    $patronDocumento = "/^[[:digit:]]+$/";
                    if (!preg_match($patronDocumento, $value)) {
                        $mensajesError['pedCantidad'] = "*3-Formato/Dato incorrecto";
                        $marcaCampo['pedCantidad'] = "*3";
                    }
                    
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