<?php
require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';
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
        <?php if (count($aportes)):?>
      <table class="table table-bordered" style="font-size: 12px;background:#f5f5f5">
            <thead>
            <tr>
                <th align="right">Padron</th>
                <th align="right">Nº de Documento</th>
                <th align="center">Años Trabajados</th>
                <th align="center">Meses Trabajados</th>
                <th align="center">Dias Trabajados</th>
                <th align="right">TOTAL APORTADO</th>
            </tr>
            </thead>
            <tbody>
            <?php $totalaportado = 0;?>
            <?php foreach ($aportes as $a):?>
            <tr>
                <td ><?=$a['PADRON']?></td>
                <td ><?=number_format($a['CEDULA DE IDENTIDAD'],0,'','.')?></td>
                <td ><?=$a['ANOS TRABAJADOS']?></td>
                <td ><?=$a['MESES TRABAJADOS']?></td>
                <td ><?=$a['DIAS TRABAJADOS']?></td>
                <td ><?=number_format($a['TOTAL APORTADO'],0,'','.')?></td>
            </tr>
                <?php $totalaportado+=$a['TOTAL APORTADO'];?>
            <?php endforeach;?>
            </tbody>
            <tfoot>
                <td class="total" colspan="5"><div style="text-align: left;">TOTALES</div></td>
                <td class="total"><div><?=number_format($totalaportado,0,'','.')?></div></td>
            </tfoot>
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

