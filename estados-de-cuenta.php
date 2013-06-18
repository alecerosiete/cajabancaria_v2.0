<?php

require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';
$db = conect();
$prestamos = getPrestamos($user['CI']);
$tarjetas = getTarjetas($user['CI']);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Estados de Cuenta - Caja Bancaria</title>
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
    
    <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Estados de cuenta</H3>
    <hr style="border: 1px solid #E35300">
    <div style="float:right;display: inherit" class="btn btn-mini">
        <i class="icon-download" ></i>
        <a href="./resources/print_pdf.php" target="_blank" >IMPRIMIR</a>         
    </div>
    <H4>Prestamos</H4>
    <?php if(count($prestamos)):?>
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
    <hr style="border: 1px solid #E35300">
    <!--/end prestamos -->
    <H4>Tarjetas de Cr&eacute;dito</H4>
    <!-- start tarjetas de credito -->
    <?php if (count($tarjetas)):?>
        <?php foreach ($tarjetas as $tc):?>
            
            <table class="table table-bordered" style="font-size: 12px;background:#f5f5f5">
                 
              
                    <tr>
                        <th align="right">N° de Tarjeta:</th>
                        <td align="right"><?=formatoDeTarjeta($tc['NUMERO DE TARJETA'])?></td>
                        <th align="right">Tipo:</th>
                        <td align="right"><?= $tc['TIPO DE TARJETA'] == 0 ? "PRINCIPAL" : "ADICIONAL"?></td>
                        <th align="right">Vencimiento:</th>
                        <td align="right"><?=formatoFechaMMAA($tc['MES/ANO VENCIM. TARJETA'])?></td>

                    </tr>    
                   <tr>
                        <th align="right">Nombre y Apellido:</th>
                        <td align="right"><?=$tc['NOMBRE Y APELLIDO']?></td>
                        <th align="right">C.I.:</th>
                        <td align="right"><?=number_format($tc['NUMERO DE DOCUMENTO'],0,'','.')?></td>
                        <th align="right">Linea de Credito:</th>
                        <td align="right"><?=number_format($tc['LINEA DE CREDITO'],0,'','.')?></td>
                        
                    </tr> 
              
                
            </table>           
       
             <table class="table table-bordered" style="font-size: 12px">
                 
                <thead>
                <tr style='font-size:10px'>
                    <th align="center">Saldo Financiado</th>
                    <th align="center">Saldo Fact. No Venc.</th>
                    <th align="center">Saldo A Facturar</th>
                    <th align="center">Saldo en Mora</th>
                    <th align="center">Autorizaciones Pend.</th>
                    <th align="center">Deuda</th>
                    <th align="center">Pago Minimo</th>
                    <th align="center">Dias de Mora</th>
                    <th align="center">Venc. Extracto</th>
                </tr>
                </thead>
                <?php $deuda = $tc['SALDO FINANCIADO'] + $tc['SALDO FACT. NO VENCIDO'] + $tc['SALDO A FACTURAR'] + $tc['IMPORTE AUTORIZ. PENDIENT'];?>
                <tbody>
                <tr>
                    <td ><?=number_format($tc['SALDO FINANCIADO'],0,',','.')?></td>
                    <td ><?=number_format($tc['SALDO FACT. NO VENCIDO'],0,',','.')?></td>
                    <td ><?=number_format($tc['SALDO A FACTURAR'],0,',','.')?></td>
                    <td ><?=number_format($tc['SALDO EN MORA'],0,',','.')?></td>
                    <td ><?=number_format($tc['IMPORTE AUTORIZ. PENDIENT'],0,',','.')?></td>
                    <td ><?=number_format($deuda,0,',','.')?></td>
                    <td ><?=number_format($tc['PAGO MINIMO'],0,',','.')?></td>
                    <td ><?=$tc['DIAS EN MORA']?></td>
              
                    <td ><?=formatoFechaDDMMAAAA($tc['FECHA VENCIM. EXTRACTO'])?></td>
                </tr>
                </tbody>

            </table>
                 <hr>
            <?php endforeach;?>
        <?php else:?>
            <div class='alert alert-warning'>No existen ninguna Tarjeta de Crédito ligada al Cliente</div>
        <?php endif;?>
     <!-- end tarjetas de credito -->
    
    
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
