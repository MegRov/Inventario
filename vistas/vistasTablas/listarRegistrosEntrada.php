<?php
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
if (isset($_SESSION['listaDeEntrada'])) {
    $listaDeEntrada = $_SESSION['listaDeEntrada'];
}

if (isset($_SESSION['paginacionVinculos'])) {
    $paginacionVinculos = $_SESSION['paginacionVinculos'];
}
if (isset($_SESSION['totalRegistros'])) {
    $totalRegistros = $_SESSION['totalRegistros'];
    unset($_SESSION['totalRegistros']);
}
if (isset($_SESSION['registroCategoriasEntrada'])) { /* * ************************ */
    $registroCategoriasEntrada = $_SESSION['registroCategoriasEntrada'];
    $cantCategorias = count($registroCategoriasEntrada);
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
            <h1 class="page-header">Gestión de Entrada.</h1>
        </div>                        
        <!-- /.col-lg-12 -->    
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<div>
    <fieldset class="scheduler-border"><legend class="scheduler-border">FILTRO</legend>

        <form name="formBuscarEntrada" action="controlador.php" method="POST">
            <input type="hidden" name="ruta" value="listarEntrada"/>
            <table> 
                <tr><td>ENTID:</td>
                    <td><input type="number" name="entId" onclick="" value="<?php
                        if (isset($_SESSION['entIdF'])) {
                            echo $_SESSION['entIdF'];
                        } ?>"/>
                    </td>                      
                </tr> 
                <tr><td>ENTRADA CANTIDAD:</td>
                    <td><input type="number" name="entradaCantidad" onclick="" value="<?php
                        if (isset($_SESSION['entradaCantidad'])) {
                            echo $_SESSION['entradaCantidad'];
                        } ?>"/>
                    </td>                       
                </tr> 
           
                                                
                <tr><td><input type="submit" value="Filtrar" name="enviar" title="Si es necesario limpie 'Buscar'"/></td>
                    <td><input type="reset" value="limpiar" onclick="
                            javascript:document.formBuscarEntrada.entId.value = '';
                            javascript:document.formBuscarEntrada.entradaCantidad.value = '';
                            javascript:document.formBuscarEntrada.buscar.value = '';
                            javascript:document.formBuscarEntrada.submit();"/>
                    </td>
                    <td></td>
                </tr> 
            </table>
            <fieldset class="scheduler-border"><legend class="scheduler-border">BUSCAR</legend>
                <div style="width: 800">
                        <!--BOTÓN PARA BUSCAR*************************-->
                            <input type="text" name="buscar" placeholder="Término a Buscar" value=''<?php
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

        <input type="button" onclick="javascript:location.href = 'controlador.php?ruta=mostrarInsertarEntrada'" value="Nuevo Entrada">

    </span>
</div>
<br>
<a name="listaDeEntrada" id="a"></a>
<div style="width: 800">
    <p>Total de Registros: <?php if (isset($totalRegistros)) echo $totalRegistros; ?></p>
    <table border='1'>
        <thead>
            <tr>
                <td style="width: 70">ENTID</td>
                <td style="width: 70">ENTRADA CANTIDAD</td>
                <td style="width: 70">ENTRADA ESTADO</td>
                <td style="width: 70">ENTRADA UsuSesion</td>
                <td style="width: 70">FECHA CREADA</td>
                <td style="width: 70">FECHA ACTUALIZADA</td>
            </tr>
        </thead> 

        <?php

        $i = 0;
        foreach ($listaDeEntrada as $key => $value) {
     
            ?>
            <tr>
                <td style="width: 100"><?php echo $listaDeEntrada[$i]->entId; ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeEntrada[$i]->entradaCantidad); ?></td>
                <td style="width: 100"><?php echo $listaDeEntrada[$i]->entradaEstado; ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeEntrada[$i]->entradaUsuSesion); ?></td>
                <td style="width: 100"><?php echo $listaDeEntrada[$i]->entrada_created_at; ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeEntrada[$i]->entrada_updated_at); ?></td>
         
                <td style="width: 100"><a href="controlador.php?ruta=actualizarEntrada&idAct=<?php echo $listaDeEntrada[$i]->entId; ?>" >Actualizar</a></td>
                <td style="width: 100">  <a href="controlador.php?ruta=eliminarEntrada&idAct=<?php echo $listaDeEntrada[$i]->entId; ?>">Eliminar</a>   </td>
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
