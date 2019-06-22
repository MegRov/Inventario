<?php
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
if (isset($_SESSION['actualizarDatosProducto'])) {
    $actualizarDatosProducto = $_SESSION['actualizarDatosProducto'];
    unset($_SESSION['actualizarProducto']);
}
if (isset($_SESSION['registroCategoriasProducto'])) { /* * ************************ */
    $registroCategoriasProducto = $_SESSION['registroCategoriasProducto'];
    $cantCategorias = count($registroCategoriasProducto);
}
if (isset($_SESSION['erroresValidacion'])) {
    $erroresValidacion = $_SESSION['erroresValidacion'];
    unset($_SESSION['erroresValidacion']);
}
?>
<div class="panel-heading">
    <h2 class="panel-title">Gestión de Producto</h2>
    <h3 class="panel-title">Actualización de Producto.</h3>
</div>
<div>
    <fieldset>
        <form role="form" method="POST" action="controlador.php" id="formRegistro">
            <table>
            <tr>
                    <td>
                        <input class="form-control" placeholder="Producto ID" name="proId" type="number" pattern="" required="required" autofocus readonly="readonly" 
                               value="<?php
                           if (isset($actualizarDatosProducto->proId))
                               echo $actualizarDatosProducto->proId;
                           if (isset($erroresValidacion['datosViejos']['proId']))
                               echo $erroresValidacion['datosViejos']['proId'];
                           if (isset($_SESSION['proId']))
                               echo $_SESSION['proId'];
                           unset($_SESSION['proId']);
                           ?>">
                            <?php if (isset($erroresValidacion['marcaCampo']['proId'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['entId'] . "</font>"; ?>
                            <?php if (isset($erroresValidacion['mensajesError']['proId'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['entId'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->
                    </td>
                    </tr>

                    <tr>
                    <td>
                    <input class="form-control" placeholder="PRODUCTO CANTIDAD" name="productoCantidad" type="text"   required="required" 
                               value="<?php
                           if (isset($actualizarDatosProducto->productoCantidad))
                               echo $actualizarDatosProducto->productoCantidad;
                           if (isset($erroresValidacion['datosViejos']['productoCantidad']))
                               echo $erroresValidacion['datosViejos']['productoCantidad'];
                           if (isset($_SESSION['productoCantidad']))
                               echo $_SESSION['productoCantidad'];
                           unset($_SESSION['productoCantidad']);
                           ?>">
                            <?php if (isset($erroresValidacion['marcaCampo']['productoCantidad'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['entradaCantidad'] . "</font>"; ?>
                            <?php if (isset($erroresValidacion['mensajesError']['productoCantidad'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['entradaCantidad'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->
                    </td>
                    </tr>
           

                      
      
                <tr>            
                    <td>            
                        <button type="reset" name="ruta" value="cancelarActualizarProducto">Cancelar</button>&nbsp;&nbsp;||&nbsp;&nbsp;
                        <button type="submit" name="ruta" value="confirmaActualizarProducto">Actualizar Producto</button>
                    </td>
                </tr>             
            </table>
            <?php if (isset($erroresValidacion)) $erroresValidacion = NULL; ?>
        </form>
    </fieldset>
</div>