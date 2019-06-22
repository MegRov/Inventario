<?php
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
if (isset($_SESSION['listaDeSalida'])) {
    $listaDeSalida = $_SESSION['listaDeSalida'];
}

if (isset($_SESSION['paginacionVinculos'])) {
    $paginacionVinculos = $_SESSION['paginacionVinculos'];
}
if (isset($_SESSION['totalRegistros'])) {
    $totalRegistros = $_SESSION['totalRegistros'];
    unset($_SESSION['totalRegistros']);
}
if (isset($_SESSION['registroCategoriasSalida'])) { /* * ************************ */
    $registroCategoriasSalida = $_SESSION['registroCategoriasSalida'];
    $cantCategorias = count($registroCategoriasSalida);
}

//http://www.forosdelweb.com/f18/notice-session-had-already-been-started-ignoring-session_start-1021808/
//http://ajpdsoft.com/modules.php?name=News&file=print&sid=486
?>
<style type="text/css">
    .derecha   { float: right; }
    .izquierdo { float: left;  }
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;

    }  
    table th {
        text-align: center;
    }
    table tr {
        text-align: center;
    }
    thead th{
        color: #79008E;
        font-weight: normal;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gestión de Salida.</h1>
        </div>                        
        <!-- /.col-lg-12 -->    
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<div>
    <fieldset class="scheduler-border"><legend class="scheduler-border">FILTRO</legend>

        <form name="formBuscarSalida" action="Controlador.php" method="POST">
            <input type="hidden" name="ruta" value="listarSalida"/>
            <table> 
                <tr><td>SALIDAID:</td>
                    <td><input type="number" name="salId" onclick="" value="<?php
                        if (isset($_SESSION['salIdF'])) {
                            echo $_SESSION['salIdF'];
                        } ?>"/>
                    </td>                      
                </tr> 

                <tr><td>PERSONA ID </td>
                    <td>
                        <select id="persona_perId" name="persona_perId">
                            <option value = "">Seleccionar</option>
                        <?php
                            for ($j = 0; $j < $cantCategorias; $j++) {
                        ?>
                                <option value = "<?php echo $registroCategoriasSalida[$j]->perId; ?>" <?php
                                if (isset($_SESSION['persona_perId']) && $_SESSION['persona_perId'] == $registroCategoriasSalida[$j]->perId) {
                                    echo " selected";
                                }
                                ?> > <?php echo $registroCategoriasSalida[$j]->perId . " - " . $registroCategoriasSalida[$j]->perDocumento. " - " . $registroCategoriasSalida[$j]->perNombre; ?></option>             
                                <?php
                                    }
                                ?>
                        </select> 
                    </td>
                    <td></td>                          
                </tr>               
                                              
                <tr><td><input type="submit" value="Filtrar" name="enviar" title="Si es necesario limpie 'Buscar'"/></td>
                    <td><input type="reset" value="limpiar" onclick="
                            javascript:document.formBuscarSalida.salId.value = '';
                            javascript:document.formBuscarSalida.persona_perId.value = '';
                            javascript:document.formBuscarSalida.buscar.value = '';
                            javascript:document.formBuscarSalida.submit();"/>
                    </td>
                    <td></td>
                </tr> 
                
            </table>
            <fieldset class="scheduler-border"><legend class="scheduler-border">BUSCAR</legend>
                <div style="width: 800">
                        
                            <input type="text" name="buscar" placeholder="Término a Buscar" value="<?php
                            if (isset($_SESSION['buscarF'])) {
                                echo $_SESSION['buscarF'];
                            }
                            ?>">
                </div>        
            </fieldset>             
        </form>
    </fieldset>
</div>


<!-- -------------------NUEVA LINEA-----------------------------------------------------------------------------------------  -->




<br>
<div style="width: 800">
    <span class="izquierdo">
        <!--NUEVO BOTÓN PARA DARLE FUNCIONALIDAD*************************-->

        <input type="button" onclick="javascript:location.href = 'principal.php?contenido=vistas/vistasTablas/vistaInsertarSalida.php'" value="Nuevo Salida">

    </span>
</div>
<br>
<a name="listaDeSalida" id="a"></a>
<div style="width: 800">
    <p>Total de Registros: <?php if (isset($totalRegistros)) echo $totalRegistros; ?></p>
    <table border='1'>
        <thead>
            <tr>
                <td style="width: 70">SALID</td>
                <td style="width: 70">PERSONA ID</td>
                <td style="width: 70">SALIDA ESTADO</td>
                <td style="width: 70">SALIDA UsuSesion</td>
                <td style="width: 70">FECHA CREADA</td>
                <td style="width: 70">FECHA ACTUALIZADA</td>
            </tr>
        </thead> 

        <?php

        $i = 0;
        foreach ($listaDeSalida as $key => $value) {
     
            ?>
            <tr>
                <td style="width: 100"><?php echo $listaDeSalida[$i]->salId; ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeSalida[$i]->persona_perId); ?></td>
                <td style="width: 100"><?php echo $listaDeSalida[$i]->salidaEstado; ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeSalida[$i]->salidaUsuSesion); ?></td>
                <td style="width: 100"><?php echo $listaDeSalida[$i]->salida_created_at; ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeSalida[$i]->salida_updated_at); ?></td>
         
                <td style="width: 100"><a href="controlador.php?ruta=actualizarSalida&idAct=<?php echo $listaDeSalida[$i]->salId; ?>" >Actualizar</a></td>
                <td style="width: 100">  <a href="controlador.php?ruta=eliminarSalida&idAct=<?php echo $listaDeSalida[$i]->salId; ?>">Eliminar</a>   </td>
                <?php
                $i++;
                ?>
            
                <?php
        }
            ?>
        <tfoot> 
            <tr>
                <td colspan="8">
                    <nav aria-label="Page navigation example">
                        <?php $i = 0; ?>
                        <ul class="pagination justify-content-center">
                            <?php foreach ($paginacionVinculos as $key => $value) { ?>    
                                <li class="page-item"><a class="page-link" href="<?php echo $value; ?>"><?php echo $key; ?></a></li>
                                <?php } ?>
                        </ul>
                    </nav>
                </td>
            </tr>
        </tfoot>
    </table>
    </div>
