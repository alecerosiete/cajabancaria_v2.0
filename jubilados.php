<?php
require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';
addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Menu Jubilados");
$db = conect();
$jubilaciones = getJubilados($user['CI']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta   charset="utf-8">
    <title>Jubilados - Caja Bancaria</title>
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
            
            
        <?php if(getRole(ROLE_JUBILADO) || getRole(ROLE_PENSIONADO)) { ?>
                
            
        <div class="hero-unit">
             <?php include ('./inc/userInfo.php');?>
            <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Jubilaciones</H3>
            <hr style="border: 1px solid #E35300">
       <?php if (count($jubilaciones)):?>
            <table style="font-size:12px" class="table table-hover">
                <thead>
                <tr>

                    <th width="25%">Operación</th>
                    <th width="25%">Haber</th>
                    <th width="25%">Deducción</th>
                    <th width="25%" style="text-align:center">Mes/Año Liquid.</th>
                </tr>
                </thead>
                <tbody>
                <?php $haber = $deduccion = 0;?>
                <?php foreach ($jubilaciones as $j):?>
                <tr>

                    <td ><?=getCodigoOperacion($j['CODIGO DE OPERACION'])?></td>
                    <td ><?=number_format($j['HABER'],0,'','.')?></td>
                    <td ><?=number_format($j['DEDUCCION'],0,'','.')?></td>
                    <td style="text-align:center"><?=$j['MES LIQUIDACION'].'/'.$j['ANO DE LIQUIDACION']?></td>
                </tr>
                    <?php $haber+= $j['HABER']?>
                    <?php $deduccion+= $j['DEDUCCION']?>
                <?php endforeach;?>
                </tbody>
                <tfoot style="font-weight: bold" class="table table-bordered">
                <td>TOTALES</td>
                <td><?=number_format($haber,0,'','.')?></td>
                <td><?=number_format($deduccion,0,'','.')?></td>
                <td><?=number_format($haber-$deduccion,0,'','.')?></td>
                </tfoot>
            </table>
            <?php else:?>
               <div class='alert alert-warning'>No se encotro ningun registro para mostrar</div>
            <?php endif;?>
            
            
            
        </div>
            <?php }else{
                echo "<div class='hero-unit'>";
                $msj = getAccesDenied();
                echo $msj;
                echo "</div>";
            }
            ?>
  
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
  </body>
</html>

