 <?php

require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';
addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Menu Simulador de Prestamos");
$db = conect();
$tarjetas = getTarjetas($user['CI']);
$deuda = 0;
foreach ($tarjetas as $tc){
	//$deuda += $tc['SALDO FINANCIADO'] + $tc['SALDO FACT. NO VENCIDO'] + $tc['SALDO A FACTURAR'] + $tc['IMPORTE AUTORIZ. PENDIENT'];
	$deuda += $tc['PAGO MINIMO'];
}

$prestamos = getPrestamos($user['CI']);

$cuota_prestamos = 0;
 foreach ($prestamos as $p){
            $cuota_prestamos+=$p['IMPORTE DE CUOTA'];
 };?>
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
        <table class="table table-bordered" style="width:580px;font-size: 14px" align="center">
            <label>Calculo de la cuota segun el tipo de prestamo</label>
            <tr style="margin-bottom: -10px">
                <td style="width:5%;">
                    <input type="radio" id="personal" value="personal" name="tipo_prestamo"  >
                </td>
                <td>
                    <label>Personal</label>
                </td>
                 <td style="width:5%;">
                     <input type="radio" id="promocion_personal" value="promocion" name="tipo_prestamo"  >
                 </td>
                 <td>
                     <label>Promocion Personal</label>
                 </td>
            </tr>
            <tr style="margin-bottom: -10px">
                <td style="width:5%;">
                    <input type="radio" id="hipotecario" value="hipotecario" name="tipo_prestamo"  >
                </td>
                <td>
                    <label>Hipotecario</label>
                </td>
                <td style="width:5%;">
                    <input type="radio" id="educacion" value="educacion" name="tipo_prestamo"  >
                </td>
                <td>
                    <label>Educacion</label>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:50%">
                    <label>Capital</label>
                </td>
                <td colspan="2">
                    <input type="text" id="monto_capital" value="" placeholder="Ej.: 25000000" required> Gs.
                </td>
            </tr>
            
            
            <tr>
                <td colspan="2" style="width:50%">
                    <label>Plazo</label>
                </td>
                <td colspan="2" id="plazo">
                </td>
            </tr>
            <tr style="margin-bottom: -10px">
                <td colspan="2" style="width:50%;">
                    <label>Tasa</label>
                </td>
                <td colspan="2">
                    <input type="text" id="tasa"  disabled>%
                </td>
            </tr>            
            <tr>
                <td  colspan="2"  style="width:50%">
                    <label class="btn" id="btn_calcular_cuota">Calcular Valor de la Cuota</label>
                </td>
                <td colspan="2">
                    <input type="text" id="cuota"  disabled> Gs.
                </td>
            </tr>
            <tr>
                <td  colspan="2" style="width:50%">
                    <label>Seguro*</label>
                </td>
                <td colspan="2">
                    <input type="text" id="seguro" disabled> Gs.
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:50%">
                    <label>Total de la cuota</label>
                </td>
                <td colspan="2">
                    <input type="text" id="total_cuota"  disabled> Gs.
                </td>
            </tr>
             
            
        </table>      
            <hr>
           
            Calculo de porcentaje de endeudamiento
        <table class="table table-bordered" style="width:580px;font-size: 14px" align="center">
           <tr>
                <td  colspan="2"  style="width:50%">
                    <label>Sueldo</label>
                </td>
                <td colspan="2">
                    <input type="text" id="sueldo"> Gs.
                </td>
                
            </tr>
            
            <tr>
                <td  colspan="2"  style="width:50%">
                    <label>Aporte</label>
                </td>
                <td colspan="2">
                    <input type="text" id="aporte" disabled> Gs.
                </td>
           </tr> 
           <tr>
                <td  colspan="2"  style="width:50%">
                    <label>Cuota de otros prestamos (Si hubiere)</label>
                </td>
                <td colspan="2">
                    <input type="text" id="cuota_otros_prestamos" value="<?=$cuota_prestamos;?>"> Gs.
                </td>
           </tr> 
           <tr>
                <td  colspan="2"  style="width:50%">
                    <label>Tarjeta de Cr&eacute;dito</label>
                </td>
                <td colspan="2">
                    <input type="text" id="tarjeta_de_credito" value="<?=$deuda;?>"> Gs.
                </td>
           </tr> 
           <tr>
                <td  colspan="2"  style="width:50%">
                    <label>Codeudor</label>
                </td>
                <td colspan="2">
                    <input type="text" id="codeudor" > Gs.
                </td>
           </tr> 
            <tr>
                <td  colspan="2"  style="width:50%">
                    <label class="btn" id="btn_calcular_disponibilidad">Calcular la Disponibilidad</label>
                </td>
                <td colspan="2">
                    <input type="text" id="disponibilidad" disabled> Gs.
                </td>
           </tr>  
           <tr>
                <td  colspan="2"  style="width:50%">
                    <label>% Endeudamiento</label>
                </td>
                <td colspan="2">
                    <input type="text" id="endeudamiento" disabled> %.
                </td>
           </tr> 
           <tr>
                <td  colspan="2"  style="width:50%">
                    <label>Monto maximo de cuota permitida</label>
                </td>
                <td colspan="2">
                    <input type="text" id="max_cuota_permitida" disabled> Gs.
                </td>
           </tr>
        </table>      
            <hr>
            RESULTADO: <div id="result"></div>
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
