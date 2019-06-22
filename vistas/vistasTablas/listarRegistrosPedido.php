<?php
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
if (isset($_SESSION['listaDePedido'])) {
    $listaDePedido = $_SESSION['listaDePedido'];
}

if (isset($_SESSION['paginacionVinculos'])) {
    $paginacionVinculos = $_SESSION['paginacionVinculos'];
}
if (isset($_SESSION['totalRegistros'])) {
    $totalRegistros = $_SESSION['totalRegistros'];
    unset($_SESSION['totalRegistros']);
}
if (isset($_SESSION['registroCategoriasPedido'])) { /* * ************************ */
    $registroCategoriasPedido = $_SESSION['registroCategoriasPedido'];
    $cantCategorias = count($registroCategoriasPedido);
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
            <h1 class="page-header">Gestión de Pedido.</h1>
        </div>                        
        <!-- /.col-lg-12 -->    
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<div>
    <fieldset class="scheduler-border"><legend class="scheduler-border">FILTRO</legend>

        <form name="formBuscarPedido" action="controlador.php" method="POST">
            <input type="hidden" name="ruta" value="listarPedido"/>
            <table> 
                <tr><td>PEDID:</td>
                    <td><input type="number" name="pedId" onclick="" value="<?php
                        if (isset($_SESSION['pedIdF'])) {
                            echo $_SESSION['pedIdF'];
                        } ?>"/>
                    </td>                      
                </tr> 
                <tr><td>PEDIDO PRODUCTO:</td>
                    <td><input type="text" name="pedProducto" onclick="" value="<?php
                        if (isset($_SESSION['pedProductoF'])) {
                            echo $_SESSION['pedProductoF'];
                        } ?>"/>
                    </td>                       
                </tr> 
                <tr><td>PEDIDO CANTIDAD:</td>
                    <td><input type="number" name="pedCantidad" onclick="" value="<?php
                        if (isset($_SESSION['pedCantidadF'])) {
                            echo $_SESSION['pedCantidadF'];
                        } ?>"/>
                    </td>                       
                </tr> 
           
                                                
                <tr><td><input type="submit" value="Filtrar" name="enviar" title="Si es necesario limpie 'Buscar'"/></td>
                    <td><input type="reset" value="limpiar" onclick="
                            javascript:document.formBuscarPedido.pedId.value = '';
                            javascript:document.formBuscarPedido.pedProducto.value = '';
                            javascript:document.formBuscarPedido.pedCantidad.value = '';
                            javascript:document.formBuscarPedido.buscar.value = '';
                            javascript:document.formBuscarPedido.submit();"/>
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

        <input type="button" onclick="javascript:location.href = 'controlador.php?ruta=mostrarInsertarPedido'" value="Nuevo Pedido">

    </span>
</div>
<br>
<a name="listaDePedido" id="a"></a>
<div style="width: 800">
    <p>Total de Registros: <?php if (isset($totalRegistros)) echo $totalRegistros; ?></p>
    <table border='1'>
        <thead>
            <tr>
                <td style="width: 70">PREID</td>
                <td style="width: 70">PRODUCTO PEDIDO</td>
                <td style="width: 70">PEDIDO CANTIDAD</td>
                <td style="width: 70">PEDIDO ESTADO</td>
                <td style="width: 70">FECHA CREADA</td>
                <td style="width: 70">FECHA ACTUALIZADA</td>
            </tr>
        </thead> 
        <?php

        $i = 0;
        foreach ($listaDePedido as $key => $value) {
     
            ?>
            <tr>
                <td style="width: 100"><?php echo $listaDePedido[$i]->pedId; ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDePedido[$i]->pedProducto); ?></td>
                <td style="width: 100"><?php echo $listaDePedido[$i]->pedCantidad; ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDePedido[$i]->pedEstado); ?></td>
                <td style="width: 100"><?php echo $listaDePedido[$i]->ped_created_at; ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDePedido[$i]->ped_updated_at); ?></td>
         
                <td style="width: 100"><a href="controlador.php?ruta=actualizarPedido&idAct=<?php echo $listaDePedido[$i]->pedId; ?>" >Actualizar</a></td>
                <td style="width: 100">  <a href="controlador.php?ruta=eliminarPedido&idAct=<?php echo $listaDePedido[$i]->pedId; ?>">Eliminar</a>   </td>
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