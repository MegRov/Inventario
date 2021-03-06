<?php
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
if (isset($_SESSION['actualizarDatosEntrada'])) {
    $actualizarDatosEntrada = $_SESSION['actualizarDatosEntrada'];
    unset($_SESSION['actualizarEntrada']);
}
if (isset($_SESSION['registroCategoriasEntrada'])) { /* * ************************ */
    $registroCategoriasEntrada = $_SESSION['registroCategoriasEntrada'];
    $cantCategorias = count($registroCategoriasEntrada);
}
if (isset($_SESSION['erroresValidacion'])) {
    $erroresValidacion = $_SESSION['erroresValidacion'];
    unset($_SESSION['erroresValidacion']);
}
?>
<div class="panel-heading">
    <h2 class="panel-title">Gestión de Entrada</h2>
    <h3 class="panel-title">Actualización de Entrada.</h3>
</div>
<div>
    <fieldset>
        <form role="form" method="POST" action="controlador.php" id="formRegistro">
            <table>
            <tr>
                    <td>
                        <input class="form-control" placeholder="ENTID" name="entId" type="number" pattern="" required="required" autofocus readonly="readonly" 
                               value="<?php
                           if (isset($actualizarDatosEntrada->entId))
                               echo $actualizarDatosEntrada->entId;
                           if (isset($erroresValidacion['datosViejos']['entId']))
                               echo $erroresValidacion['datosViejos']['entId'];
                           if (isset($_SESSION['entId']))
                               echo $_SESSION['entId'];
                           unset($_SESSION['entId']);
                           ?>">
                            <?php if (isset($erroresValidacion['marcaCampo']['entId'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['entId'] . "</font>"; ?>
                            <?php if (isset($erroresValidacion['mensajesError']['entId'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['entId'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->
                    </td>
                    </tr>

                    <tr>
                    <td>
                    <input class="form-control" placeholder="ENTRADA CANTIDAD" name="entradaCantidad" type="text"   required="required" 
                               value="<?php
                           if (isset($actualizarDatosEntrada->entradaCantidad))
                               echo $actualizarDatosEntrada->entradaCantidad;
                           if (isset($erroresValidacion['datosViejos']['entradaCantidad']))
                               echo $erroresValidacion['datosViejos']['entradaCantidad'];
                           if (isset($_SESSION['entradaCantidad']))
                               echo $_SESSION['entradaCantidad'];
                           unset($_SESSION['entradaCantidad']);
                           ?>">
                            <?php if (isset($erroresValidacion['marcaCampo']['entradaCantidad'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['entradaCantidad'] . "</font>"; ?>
                            <?php if (isset($erroresValidacion['mensajesError']['entradaCantidad'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['entradaCantidad'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->
                    </td>
                    </tr>
           

                      
      
                <tr>            
                    <td>            
                        <button type="reset" name="ruta" value="cancelarActualizarEntrada">Cancelar</button>&nbsp;&nbsp;||&nbsp;&nbsp;
                        <button type="submit" name="ruta" value="confirmaActualizarEntrada">Actualizar Entrada</button>
                    </td>
                </tr>             
            </table>
            <?php if (isset($erroresValidacion)) $erroresValidacion = NULL; ?>
        </form>
    </fieldset>
</div>