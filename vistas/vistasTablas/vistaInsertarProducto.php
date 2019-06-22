<?php

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}

if (isset($_SESSION['registroCategoriasProducto'])) {
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
    <h3 class="panel-title">Inserción de Producto.</h3>
</div>
<div>
    <fieldset>
        <form role="form" method="POST" action="controlador.php" id="formRegistro">
            <table>
                <tr>
                    <td>
                        <input class="form-control" placeholder="N_PED" name="pedId" type="number" pattern="" required="required" autofocus
                               value=<?php if (isset($erroresValidacion['datosViejos']['pedId'])) echo "\"".$erroresValidacion['datosViejos']['pedId']."\""; 
                                           if (isset($_SESSION['pedId'])) echo "\"".$_SESSION['pedId']."\""; unset($_SESSION['pedId']); ?>><!--Datos salvados en caso de ya estar en base de datos-->
                                     <div><?php if (isset($erroresValidacion['marcaCampo']['pedId'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['pedId'] . "</font>"; ?>
                                     <?php if (isset($erroresValidacion['mensajesError']['pedId'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['pedId'] . "</font>"; ?> </div>               
                                <!--<p class="help-block">Example block-level help text here.</p>-->
                    </td>
                </tr>
                
                <tr>
                    <td>                  
                        <input class="form-control" placeholder="PRODUCTO" name="pedProducto" type="text"  required="required" 
                               value=<?php if (isset($erroresValidacion['datosViejos']['pedProducto'])) echo "\"".$erroresValidacion['datosViejos']['pedProducto']."\""; 
                                               if (isset($_SESSION['pedProducto'])) echo "\"".$_SESSION['pedProducto']."\""; unset($_SESSION['pedProducto']); ?>><!--Datos salvados en caso de ya estar en base de datos-->                        
                        <div><?php if (isset($erroresValidacion['marcaCampo']['pedProducto'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['pedProducto'] . "</font>"; ?>                                        
                                     <?php if (isset($erroresValidacion['mensajesError']['pedProducto'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['pedProducto'] . "</font>"; ?> </div>
                    </td>
                </tr>  
                <tr>
                    <td>
                        <input class="form-control" placeholder="PED_CANTIDAD" name="pedCantidad" type="number" pattern="" required="required" autofocus
                               value=<?php if (isset($erroresValidacion['datosViejos']['pedCantidad'])) echo "\"".$erroresValidacion['datosViejos']['pedCantidad']."\""; 
                                           if (isset($_SESSION['pedCantidad'])) echo "\"".$_SESSION['pedCantidad']."\""; unset($_SESSION['pedCantidad']); ?>><!--Datos salvados en caso de ya estar en base de datos-->
                                     <div><?php if (isset($erroresValidacion['marcaCampo']['pedCantidad'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['pedCantidad'] . "</font>"; ?>
                                     <?php if (isset($erroresValidacion['mensajesError']['pedCantidad'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['pedCantidadd'] . "</font>"; ?> </div>               
                                <!--<p class="help-block">Example block-level help text here.</p>-->
                    </td>
                </tr>
          
                <tr>
                    <td>            
                        <button type="reset" name="ruta" value="cancelarInsertarProducto">Cancelar</button>&nbsp;&nbsp;||&nbsp;&nbsp;
                        <button type="submit" name="ruta" value="insertarProducto">Agregar Producto</button>
                    </td>
                </tr>  
            </table>
            <?php if (isset($erroresValidacion)) $erroresValidacion = NULL; ?>
        </form>
    </fieldset>
</div>