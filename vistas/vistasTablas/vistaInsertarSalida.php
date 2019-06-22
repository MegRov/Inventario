<?php

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}

if (isset($_SESSION['registroCategoriasSalida'])) {
    $registroCategoriasSalida = $_SESSION['registroCategoriasSalida'];
    $cantCategorias = count($registroCategoriasSalida);
    
}
if (isset($_SESSION['erroresValidacion'])) {
    $erroresValidacion = $_SESSION['erroresValidacion'];
    unset($_SESSION['erroresValidacion']);
}
?>
<div class="panel-heading">
    <h2 class="panel-title">Gestión de Salida</h2>
    <h3 class="panel-title">Inserción de Salida.</h3>
</div>
<div>
    <fieldset>
        <form role="form" method="POST" action="controlador.php" id="formRegistro">
            <table>
                <tr>
                    <td>
                        <input class="form-control" placeholder="SALID" name="salId" type="number" pattern="" required="required" autofocus
                               value=<?php if (isset($erroresValidacion['datosViejos']['salId'])) echo "\"".$erroresValidacion['datosViejos']['salId']."\""; 
                                           if (isset($_SESSION['salId'])) echo "\"".$_SESSION['salId']."\""; unset($_SESSION['salId']); ?>><!--Datos salvados en caso de ya estar en base de datos-->
                                     <div><?php if (isset($erroresValidacion['marcaCampo']['salId'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['salId'] . "</font>"; ?>
                                     <?php if (isset($erroresValidacion['mensajesError']['salId'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['salId'] . "</font>"; ?> </div>               
                                <!--<p class="help-block">Example block-level help text here.</p>-->
                    </td>
                </tr>
                 
                <tr>
                    <td>
                        <select id="persona_perId" name="persona_perId">                    
                            <?php
                            for ($j = 0; $j < $cantCategorias; $j++) {
                                ?>
                                <option value = "<?php echo $registroCategoriasSalida[$j]->perId; ?>" ><?php echo $registroCategoriasSalida[$j]->perId . " - " . $registroCategoriasSalida[$j]->perDocumento. "-" .$registroCategoriasSalida[$j]->perNombre; ?></option>             
                                <?php
                            }
                            ?>
                        </select> 
                    </td>
                </tr>         
          
                <tr>
                    <td>            
                        <button type="reset" name="ruta" value="cancelarInsertarSalida">Cancelar</button>&nbsp;&nbsp;||&nbsp;&nbsp;
                        <button type="submit" name="ruta" value="insertarSalida">Agregar Salida</button>
                    </td>
                </tr>  
            </table>
            <?php if (isset($erroresValidacion)) $erroresValidacion = NULL; ?>
        </form>
    </fieldset>
</div>

