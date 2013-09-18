<?php
require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';
addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Menu Aportes");

$db = conect();
$aportes = getAportes($user['CI']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta   charset="utf-8">
    <title>Aportes - Caja Bancaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php require './inc/header.php'; ?>
    <style type="text/css">
       
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
                Conectado como:  <?=$user['data']['nombre']?> <a href="./login.php" class="btn btn-warning">Salir</a>
              </div>
              <div class="alert-msg-show">
                <?php include("./tmpl/success_panel.inc")?>
              </div>
          </div>
          <div class="masthead">
            <!--Menu -->
            <?php require './inc/menu.php'; ?>
            <!-- end menu -->
          </div>

        <div class="hero-unit">
             <?php include ('./inc/userInfo.php');?>
            <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Aportes</H3>
            <hr style="border: 1px solid #E35300">
            <div style="float:right;display: inherit" class="btn btn-mini">
                <i class="icon-download" ></i>


                <a href="./resources/html2pdf/examples/aportes_pdf.php" target="_blank">Descargar/Imprimir</a>
            </div>
        <?php if (count($aportes)):?>
      <table class="table table-bordered" style="width: 100%; font-size: 12px;background:#f5f5f5">
            <thead>
            <tr>
                
                <th style="text-align:center">Años Trabajados</th>
                <th style="text-align:center">Meses Trabajados</th>
                <th style="text-align:center">Dias Trabajados</th>
                <th style="text-align:right">TOTAL APORTADO</th>
            </tr>
            </thead>
            <tbody>
            
            <?php foreach ($aportes as $a):?>
            <tr>
                
                <td style="text-align:center"><?=$a['ANOS TRABAJADOS']?></td>
                <td style="text-align:center"><?=$a['MESES TRABAJADOS']?></td>
                <td style="text-align:center"><?=$a['DIAS TRABAJADOS']?></td>
                <td style="text-align:right"><?=number_format($a['TOTAL APORTADO'],0,'','.')?></td>
            </tr>
                
            <?php endforeach;?>
            </tbody>
            
        </table>
            
        <br>
        <H4 style="text-align:right;color:#E35300;margin-bottom:25px">Detalle ultimos 3 meses</H4>
        <hr style="border: 1px solid #E35300">
        <!-- Get Datos de los ultimos 3 meses -->
        <?php $aportes3ultimosMeses = getAportes3ultimosMeses($user['CI']);?>
        <table class="table table-bordered" style="font-size: 12px;background:#f5f5f5">
            <thead>
            <tr>

                <th style="text-align:center">Mes/Año</th>
                <th style="text-align:right">Aporte</th>
                <th style="text-align:right">Otros Aportes</th>
                
            </tr>
            </thead>
            <tbody>

            <?php $a = $aportes3ultimosMeses?>
            <tr>

                <td style="text-align:center"><?=  formatoFechaMMAAAA($a[0][4])?></td>
                <td style="text-align:right"><?=  number_format($a[0][5])?></td>
                <td style="text-align:right"><?= number_format($a[0][6])?></td>
                
            </tr>
            <tr>

                <td style="text-align:center"><?=formatoFechaMMAAAA($a[0][7])?></td>
                <td style="text-align:right"><?=number_format($a[0][8])?></td>
                <td style="text-align:right"><?=number_format($a[0][9])?></td>
                
            </tr>
            <tr>

                <td style="text-align:center"><?=formatoFechaMMAAAA($a[0][10])?></td>
                <td style="text-align:right"><?=number_format($a[0][11])?></td>
                <td style="text-align:right"><?=number_format($a[0][12])?></td>
                
            </tr>
            
            </tbody>

        </table>
            
        <?php else:?>
            <div class='alert alert-warning'>No existen aportes para mostrar</div>
        <?php endif;?>
        </div>
 <hr>
    <footer>
        <div class="footer">
             Caja de Jubilaciones y Pensiones de Empleados de Bancos y Afines del Paraguay &copy; 2012 - Todos los Derechos Reservados
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
  </body>
</html>

