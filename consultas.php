<?php

require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';
addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Menu Consultas");
$db = conect();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Consultas - Caja Bancaria</title>
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
                Conectado como: <?=$user['data']['nombre']?> <a href="<?= "./login.php"; ?>" class="btn btn-warning">Salir</a>
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
    <?php if(getPerfil(ROLE_DIRECTIVO)) { ?>

    <table class="table">
        <tr>
            <td>
                <form class="form-search" style="margin-top:30px;" onSubmit="consultar();return false">
                    <input id="input-ci" placeholder="Cedula de identidad.." type="text" class="input-xlarge search-query">
                    <button type="submit" class="btn" id="btn-consultar" >Buscar</button>
                </form>
            </td>
            <td>
                 <H3 style="text-align:right;color:#E35300;margin-top:25px">Consultar una cuenta</H3>
            </td>
        </tr>
    </table>
      
    <hr style="border: 1px solid #E35300">
    <div id="visualizar-consulta"></div>
  
      
     
</div><!-- /end hero-unit -->
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
       <script>
        $('#myTab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })
          </script>
  </body>
</html>
