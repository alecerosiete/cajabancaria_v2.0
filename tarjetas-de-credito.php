<?php

require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';
addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Menu Tarjetas de credito");
$db = conect();
$tarjetas = getTarjetas($user['CI']);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta   charset="utf-8">
    <title>Tarjetas de Credito - Caja Bancaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php require './inc/header.php'; ?>
    <style type="text/css">
      table .table-hover th {
        font-size: 10px;
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
             
        <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Tarjetas de Cr&eacute;dito</H3>
        <hr style="border: 1px solid #E35300">
        <div style="float:right;display: inherit" class="btn btn-mini">
        <i class="icon-download" ></i>
              
        
        <a href="./resources/html2pdf/examples/tarjetas_de_credito_pdf.php" target="_blank">Descargar/Imprimir</a>
    </div>
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
                    <td style="text-align:right"><?=number_format($tc['SALDO FINANCIADO'],0,',','.')?></td>
                    <td style="text-align:right"><?=number_format($tc['SALDO FACT. NO VENCIDO'],0,',','.')?></td>
                    <td style="text-align:right"><?=number_format($tc['SALDO A FACTURAR'],0,',','.')?></td>
                    <td style="text-align:right"><?=number_format($tc['SALDO EN MORA'],0,',','.')?></td>
                    <td style="text-align:right"><?=number_format($tc['IMPORTE AUTORIZ. PENDIENT'],0,',','.')?></td>
                    <td style="text-align:right"><?=number_format($deuda,0,',','.')?></td>
                    <td style="text-align:right"><?=number_format($tc['PAGO MINIMO'],0,',','.')?></td>
                    <td style="text-align:right"><?=$tc['DIAS EN MORA']?></td>
              
                    <td ><?=formatoFechaDDMMAAAA($tc['FECHA VENCIM. EXTRACTO'])?></td>
                </tr>
                </tbody>

            </table>
                 <hr>
            <?php endforeach;?>
        <?php else:?>
            <div class='alert alert-warning'>No existen ninguna Tarjeta de Crédito ligada al Cliente</div>
        <?php endif;?>
        </div>

        </div> <!-- /container -->
     <footer>
		<div class="fluid">
		<hr>
		<div class="footer-full" style="color:#ffffff;width:100%;text-align:center;font-size:12px;background:url(./resources/images/bg.png) repeat-x; background: url(./resources/images/bg.png) repeat-x;background-position: bottom;height: 57px;padding-top: 20px;">
             Caja de Jubilaciones y Pensiones de Empleados de Bancos y Afines del Paraguay &copy; 2013 - Todos los Derechos Reservados - <a href="./terminos-y-condiciones.php" style="color:#ffffff" >Terminos y Condiciones</a> -
			<a href="http://www.cajabancaria.gov.py" style="color:#ffffff" target="_blank">www.cajabancaria.gov.py</a> <br> Humaita 357 e/Chile y Alberdi |(595 21) 492 051 / 052 / 053 / 054
        </div> 
        </div> 
    </footer>
    </footer>
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
