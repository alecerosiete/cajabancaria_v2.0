<?php

require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';
addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Menu Prestamos");
$db = conect();
$prestamos = getPrestamos($user['CI']);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Pr&eacute;stamos - Caja Bancaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php require './inc/header.php'; ?>
    <style type="text/css">
      .table-edit-data th, .table-edit-data td {
        padding: 8px;
        line-height: 20px;
        text-align: right;
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
                Conectado como: <?=$user['data']['nombre']?> <a href="./login.php" class="btn btn-warning">Salir</a>
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
    <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Pr&eacute;stamos</H3>
        
    <hr style="border: 1px solid #E35300">
      <div style="float:right;display: inherit" class="btn btn-mini">
        <i class="icon-download" ></i>
              
        
        <a href="./resources/html2pdf/examples/prestamos_pdf.php" target="_blank">Descargar/Imprimir</a>
    </div>
     <?php if(count($prestamos)):?>
  
    
        <table style="font-size:12px" class="table table-hover">
        <thead >
        <tr>
            <th style="text-align:left">Nº</th>
            <th style="text-align:left">Tipo</th>
            <th style="text-align:center">Fecha de Liquid.</th>
            <th style="text-align:center">Plazo</th>
            <th style="text-align:center">Interes</th>
            <th style="text-align:center">Monto</th>
            <th style="text-align:center">Cuota</th>
            <th style="text-align:center">Fecha Pago</th>
            <th style="text-align:center">Cuotas Pagadas</th>
            <th style="text-align:center">Saldo</th>
        </tr>
        </thead>
        <tbody>
        <?php $monto = $cuota = $saldo = 0;?>
        <?php foreach ($prestamos as $p):?>
        <tr>
            <td style="text-align:left"><?=$p['NUMERO DE PRESTAMO']?></td>
            <!--td style="text-align:left"><?= getTipoDePrestamo($p['D']) != '' ? getTipoDePrestamo($p['D']): $p['TIPO DE PRESTAMO'];?></td-->
			<td style="text-align:left"><?= $p['D']?></td>
            <td style="text-align:center"><?=formatoFecha($p['FECHA DE LIQUIDACION'])?></td>
            <td style="text-align:right"><?=$p['PLAZO']?></td>
            <td style="text-align:right"><?=$p['PORCENTAJE DE INTERES']?> %</td>
            <td style="text-align:right"><?=number_format($p['MONTO DEL PRESTAMO'],0,'','.')?></td>
            <td style="text-align:right"><?=number_format($p['IMPORTE DE CUOTA'],0,'','.')?></td>
            <td style="text-align:center"><?=formatoFecha($p['FECHA DE PAGO'])?></td>
            <td style="text-align:center"><?=number_format($p['CUOTAS PAGADAS'],0,'','.')?></td>
            <td style="text-align:right"><?=number_format($p['SALDO'],0,'','.')?></td>
        </tr>
            <?php $monto+=$p['MONTO DEL PRESTAMO'];?>
            <?php $cuota+=$p['IMPORTE DE CUOTA'];?>
            <?php $saldo+=$p['SALDO'];?>
        <?php endforeach;?>
        </tbody>
        <tfoot style="font-weight:bold">
            <td  colspan="5"><div style="text-align: left;">TOTALES</div></td>
            <td style="text-align:right"><div><?=number_format($monto,0,'','.')?></div></td>
            <td style="text-align:right"><div><?=number_format($cuota,0,'','.')?></div></td>
            <td style="text-align:right" colspan="2"></td>
            <td style="text-align:right"><div><?=number_format($saldo,0,'','.')?></div></td>
        </tfoot>
    </table>
      <?php else:?>
    <div class='alert alert-warning'>No existen ningun pr&eacute;stamo ligada al Cliente</div>
      <?php endif;?>     
          

</div><!-- /end hero-unit -->
           
          </div> <!-- /container -->
    
    <?php require './inc/footer.php'; ?>
     <footer>
		<div class="fluid">
		<hr>
		<div class="footer-full" style="color:#ffffff;width:100%;text-align:center;font-size:12px;background:url(./resources/images/bg.png) repeat-x; background: url(./resources/images/bg.png) repeat-x;background-position: bottom;height: 57px;padding-top: 20px;">
             Caja de Jubilaciones y Pensiones de Empleados de Bancos y Afines del Paraguay &copy; 2013 - Todos los Derechos Reservados - <a href="./terminos-y-condiciones.php" style="color:#ffffff" >Terminos y Condiciones</a> -
			<a href="http://www.cajabancaria.gov.py" style="color:#ffffff" target="_blank">www.cajabancaria.gov.py</a> <br> Humaita 357 e/Chile y Alberdi |(595 21) 492 051 / 052 / 053 / 054
        </div> 
        </div> 
    </footer>
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
