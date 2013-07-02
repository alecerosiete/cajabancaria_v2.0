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
    <?php if(count($prestamos)):?>
    <div style="float:right;display: inherit" class="btn btn-mini">
        <i class="icon-download" ></i>
    <a href="http://pdfcrowd.com/url_to_pdf/">Descargar/Imprimir</a>
    </div>
    
        <table style="font-size:12px" class="table table-hover">
        <thead >
        <tr>
            <th align="right">Nº</th>
            <th>Tipo</th>
            <th align="center">Fecha de Liquid.</th>
            <th align="right">Plazo</th>
            <th align="right">Interes</th>
            <th align="right">Monto</th>
            <th align="right">Cuota</th>
            <th align="right">Fecha Pago</th>
            <th align="right">Cuotas Pagadas</th>
            <th align="right">Saldo</th>
        </tr>
        </thead>
        <tbody>
        <?php $monto = $cuota = $saldo = 0;?>
        <?php foreach ($prestamos as $p):?>
        <tr>
            <td ><?=$p['NUMERO DE PRESTAMO']?></td>
            <td ><?= getTipoDePrestamo($p['TIPO DE PRESTAMO']) != '' ? getTipoDePrestamo($p['TIPO DE PRESTAMO']): 'No definido';?></td>
            <td ><?=formatoFecha($p['FECHA DE LIQUIDACION'])?></td>
            <td ><?=$p['PLAZO']?></td>
            <td ><?=$p['PORCENTAJE DE INTERES']?></td>
            <td ><?=number_format($p['MONTO DEL PRESTAMO'],0,'','.')?></td>
            <td ><?=number_format($p['IMPORTE DE CUOTA'],0,'','.')?></td>
            <td ><?=formatoFecha($p['FECHA DE PAGO'])?></td>
            <td ><?=number_format($p['CUOTAS PAGADAS'],0,'','.')?></td>
            <td ><?=number_format($p['SALDO'],0,'','.')?></td>
        </tr>
            <?php $monto+=$p['MONTO DEL PRESTAMO'];?>
            <?php $cuota+=$p['IMPORTE DE CUOTA'];?>
            <?php $saldo+=$p['SALDO'];?>
        <?php endforeach;?>
        </tbody>
        <tfoot style="font-weight:bold">
            <td class="total" colspan="5"><div style="text-align: left;">TOTALES</div></td>
            <td class="total"><div><?=number_format($monto,0,'','.')?></div></td>
            <td class="total"><div><?=number_format($cuota,0,'','.')?></div></td>
            <td class="total" colspan="2"></td>
            <td class="total"><div><?=number_format($saldo,0,'','.')?></div></td>
        </tfoot>
    </table>
      <?php else:?>
    <div class='alert alert-warning'>No existen ningun pr&eacute;stamo ligada al Cliente</div>
      <?php endif;?>     
          

</div><!-- /end hero-unit -->
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
