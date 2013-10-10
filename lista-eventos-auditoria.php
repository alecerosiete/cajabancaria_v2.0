<?php

require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';
addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Detalle eventos auditoria");
$db = conect();
$user_id = $_GET['user_id'];
$eventos = getEventosAuditoria($user_id);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Eventos Auditoria - Caja Bancaria</title>
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
    <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Detalle de eventos por usuario</H3>
        
    <hr style="border: 1px solid #E35300">
    
    <div style="float:right;display: inherit" class="btn btn-mini">
        <i class="icon-download" ></i>
    <a href="http://pdfcrowd.com/url_to_pdf/">Descargar/Imprimir</a>
    </div>
    <?php if(getPerfil(ROLE_AUDITOR)) { ?>
        <?php if(count($eventos)):?>
        <table style="font-size:12px" class="table table-hover">
        <thead >
        <tr>
            <th align="right">ID</th>
            <th>Usuario</th>
            <th align="center">Pagina Visitada</th>
            <th align="right">Comentario</th>
            <th align="right">Fecha/Hora</th>

        </tr>
        </thead>
        <tbody>
        
        <?php foreach ($eventos as $e):?>
        <tr>
            <td ><?=$e['id']?></td>
            <td ><?=$e['user_id']?></td>
            <td ><?=$e['event_site']?></td>
            <td ><?=$e['description']?></td>
          
            <td ><?=$e['time']?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
      <?php else:?>
    <div class='alert alert-warning'>No se encontraron registros</div>
      <?php endif;?>     
     <?php } else {
        echo "<div class='hero-unit'>";
        $msj = getAccesDenied();
        echo $msj;
        echo "</div>";

    }
    ?>      

</div><!-- /end hero-unit -->
            
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
