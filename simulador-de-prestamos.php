<?php

require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';
addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Menu Simulador de Prestamos");
$db = conect();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Simulador de Prestamos - Caja Bancaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php require './inc/header.php'; ?>
    <style type="text/css">
      .table-edit-data th, .table-edit-data td {
        padding: 8px;
        line-height: 20px;
        text-align: right;
                    
      }
      .input-recaptcha{
        width:170px;   
       }
       
       .controls{
           margin-bottom:4px;
       }
    </style>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
        
    </head>
      <body>
        <div class="container">
          <div class="header-caja-bancaria">
              <div class="btn-logout">
                Conectado como: <?=$user['data']['nombre']?> <a href="<?= "./login.php"; ?>" class="btn btn-warning">Salir</a>
              </div>
              <div class="alert-msg-show">
                <?php include("./tmpl/success_panel.inc")?>
                  
              </div>
          </div>
          <div class="masthead" style="min-height: 60px">
            <!--Menu -->
            <?php require './inc/menu.php'; ?>
            <!-- end menu -->
          </div>
          
    <div class="hero-unit">
        <div id="msg-status" class="alert alert-danger" style="display:none;position:fixed ;top:230px;"></div>
        <H3 style="text-align:right;color:#E35300;margin-bottom:40px;">Simulador de Cr&eacute;dito</H3>
        <hr style="border: 1px solid #E35300">
        <div style="text-align: center;">
        <table class="table table-bordered" style="width:580px;" align="center">
            <tr style="margin-bottom: -10px">
                <td style="width:50%;"><label>Tasa</label></td><td><input type="text" id="taza" value="7.5 %" disabled></td>
            </tr>
            <tr>
                <td style="width:50%"><label>Plazo</label></td><td><input type="text" id="plazo" value="" placeholder="Ej.: 12" required> Meses</td>
            </tr>
            <tr>
                <td style="width:50%"><label>Monto Solicitado</label></td><td><input type="text" id="monto" value="" placeholder="Ej.: 25000000" required> Gs.</td>
            </tr>
            <tr>
                <td style="width:50%"><label>Valor de Cuota Total</label></td><td><input type="text" id="cuota" value="" disabled> Gs.</td>
            </tr>
            <tr>
                <td style="width:50%"><label>Valor total del Pr&eacute;stamo</label></td><td><input type="text" id="prestamo" value="" disabled> Gs.</td>
            </tr>
        </table>      
        </div>
        
        <hr>
        <footer>
            <div class="footer">
                Caja de Jubilaciones y Pensiones de Empleados de Bancos y Afines del Paraguay &copy; 2012 - <a href="./terminos-y-condiciones.php">Terminos y Condiciones</a>
         www.cajabancaria.gov.py <br> Humaita 357 e/Chile y Alberdi |(595 21) 492 051 / 052 / 053 / 054
            </div> 
        </footer>
        <hr>   
        
    </div> <!-- /container -->
    
    <?php require './inc/footer.php'; ?>
    
    <script type="text/javascript">
            // Executes the function when DOM will be loaded fully
            $(document).ready(function () {	
                    // hover property will help us set the events for mouse enter and mouse leave
                    $('.navigation li').hover(
                            // When mouse enters the .navigation element
                            function () {
                                    //Fade in the navigation submenu
                                    $('ul', this).fadeIn(); 	// fadeIn will show the sub cat menu
                            }, 
                            // When mouse leaves the .navigation element
                            function () {
                                    //Fade out the navigation submenu
                                    $('ul', this).fadeOut();	 // fadeOut will hide the sub cat menu		
                            }
                    );
            });
        </script>
        <script src="./resources/ajax/ajaxFunctions.js"></script>
       <script>
        $('#myTab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })
        $('#ayudaCaptcha').popover()
          </script>

  </body>
</html>
