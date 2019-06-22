<!--https://preview.themeforest.net/item/metronic-responsive-admin-dashboard-template/full_screen_preview/4021469?clickid=wUaXmhygcxyJTFawUx0Mo3Y3Ukl17bwP%3ARMrUQ0&iradid=275988&iradtype=ONLINE_TRACKING_LINK&irgwc=1&irmptype=mediapartner&irpid=369282&mp_value1=&utm_campaign=af_impact_radius_369282&utm_medium=affiliate&utm_source=impact_radius-->
<!--https://colorlib.com/wp/free-bootstrap-admin-dashboard-templates/-->
<!--https://www.wrappixel.com/templates/pixel-admin-lite/?ref=23-->
<!--https://colorlib.com/polygon/notika/index.html-->
<?php
session_start();
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
    $mensaje = NULL;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Su Proyecto</title>
        <link rel="stylesheet" href="login.css">
        
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Funciones JavaScript propias del sistema -->
        <script type="text/javascript" src="javascript/funciones.js"></script>
        <!-- Funciones JavaScript propias del sistema -->
        <script type="text/javascript" src="javascript/md5.js"></script>        
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
 
    </head>
    <body>
        <fieldset>
            <div class="container">
                <div class="row">
                    <h2 class="panel-title">Ingrese sus credenciales de Accesso a <br/> Fruver</h2>
                </div>
                <div class="row">
                    <form class="col-12" role="form" method="POST" action="controlador.php" name="formLogin" >
                    <div class="form-group" id="user-group">
                        <input id="InputCorreo" class="form-control" placeholder="&#128100; Correo Electrónico" name="email" type="email" autofocus>
                    </div>
                     <div class="form-group" id="contrasena-group">
                        <input id="InputPassword" class="form-control" placeholder="&#128272; Password " name="password" type="password" value="">
                     </div>
                     
                        <input type="hidden" name="ruta" value="gestionDeAcceso">
                        <!--<p style="color:red;" id="error"></p>-->
                        <input type="button" class="btn btn-lg btn-success btn-block" onclick="validar_logueo()" value="Ingresar"><i class="fas fa-sign-in-alt"></i>
                        <div class="">
                         <h5>   Aún no se ha registrado? </h5>
                            <a href="registro.php">
                                Registrese Aquí
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </fieldset>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>        
    </body>
</html>
<!--https://www.tutorialrepublic.com/snippets/preview.php?topic=bootstrap&file=crud-data-table-for-database-with-modal-form-->
<!--PARA LOGIN O REGISTRARSE https://plantillas-gratis.net/2018/02/09/3-elegantes-formularios-bootstrap-gratis/-->

