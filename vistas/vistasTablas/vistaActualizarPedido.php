<?php
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
if (isset($_SESSION['actualizarDatosPedido'])) {
    $actualizarDatosPedido = $_SESSION['actualizarDatosPedido'];
    unset($_SESSION['actualizarDatosPedido']);
}
if (isset($_SESSION['registroCategoriasPedido'])) { /* * ************************ */
    $registroCategoriasPedido = $_SESSION['registroCategoriasPedido'];
    $cantCategorias = count($registroCategoriasPedido);
}
if (isset($_SESSION['erroresValidacion'])) {
    $erroresValidacion = $_SESSION['erroresValidacion'];
    unset($_SESSION['erroresValidacion']);
}
?>
<div class="panel-heading">
    <h2 class="panel-title">Gestión de Pedido</h2>
    <h3 class="panel-title">Actualización de Pedido.</h3>
</div>
<div>
    <fieldset>
        <form role="form" method="POST" action="controlador.php" id="formRegistro">
            <table>
                <tr>
                    <td>
                        <input class="form-control" placeholder="PREID" name="pedId" type="number" pattern="" required="required" autofocus readonly="readonly" 
                               value="<?php
                           if (isset($actualizarDatosPedido->pedId))
                               echo $actualizarDatosPedido->pedId;
                           if (isset($erroresValidacion['datosViejos']['pedId']))
                               echo $erroresValidacion['datosViejos']['pedId'];
                           if (isset($_SESSION['pedId']))
                               echo $_SESSION['pedId'];
                           unset($_SESSION['pedId']);
                           ?>">
                            <?php if (isset($erroresValidacion['marcaCampo']['pedId'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['pedId'] . "</font>"; ?>
                            <?php if (isset($erroresValidacion['mensajesError']['pedId'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['pedId'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->
                    </td>
                </tr>
                <tr>
                    <td>                
                        <input class="form-control" placeholder="PRODUCTO PEDIDO" name="pedProducto" type="text"   required="required" 
                               value="<?php
                           if (isset($actualizarDatosPedido->pedProducto))
                               echo $actualizarDatosPedido->pedProducto;                           
                           if (isset($erroresValidacion['datosViejos']['pedProducto']))
                               echo $erroresValidacion['datosViejos']['pedProducto'];
                           if (isset($_SESSION['pedProducto']))
                               echo $_SESSION['pedProducto'];
                           unset($_SESSION['pedProducto']);
                           ?>">
                            <?php if (isset($erroresValidacion['marcaCampo']['pedProducto'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['pedProducto'] . "</font>"; ?>                                        
                            <?php if (isset($erroresValidacion['mensajesError']['pedProducto'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['pedProducto'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->                      
                    </td>
                </tr>
                <tr>
                    <td>                  
                        <input class="form-control" placeholder="PEDIDO CANTIDAD" name="pedCantidad" type="text"  required="required" 
                               value="<?php
                           if (isset($actualizarDatosPedido->pedCantidad))
                               echo $actualizarDatosPedido->pedCantidad;                            
                           if (isset($erroresValidacion['datosViejos']['pedCantidad']))
                               echo $erroresValidacion['datosViejos']['pedCantidad'];
                           if (isset($_SESSION['pedCantidad']))
                               echo $_SESSION['pedCantidad'];
                           unset($_SESSION['pedCantidad']);
                           ?>">
                           <?php if (isset($erroresValidacion['marcaCampo']['pedCantidad'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['pedCantidad'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['pedCantidad'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['pedCantidad'] . "</font>"; ?>
                                <!--<p class="help-block">Example block-level help text here.</p>-->                                               
                    </td>
                </tr>                  
        
                <tr>            
                    <td>            
                        <button type="reset" name="ruta" value="cancelarActualizarPedido">Cancelar</button>&nbsp;&nbsp;||&nbsp;&nbsp;
                        <button type="submit" name="ruta" value="confirmaActualizarPedido">Actualizar Entrada</button>
                    </td>
                </tr>             
            </table>
            <?php if (isset($erroresValidacion)) $erroresValidacion = NULL; ?>
        </form>
    </fieldset>
</div>