<?php
require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';

/* Guarda informacion de auditoria */
addEventAudit($user['CI'],$_SERVER['REQUEST_URI'],"Ingreso al panel de administracion de pin");
$db = conect();
$tipo_usuario = $user['data']['tipo_de_usuario'];
$userInfo = getUserInfo();
$ciudad = getCiudad($userInfo[0]['CIUDAD']);
$localidad = getLocalidad($userInfo[0]['LOCALIDAD']);
$barrio = getBarrio($userInfo[0]['BARRIO']);
$profile = getPerfil(ROLE_OPERATOR);
if(!$profile){
  print("No tiene perfil de operador");
  redirect(ROOT_PATH."/pin_admin_login.php");
}

$mensajes = getMensajesPersonalizados($user['CI']);
$mensajesLeidos = getMensajesLeidos($user['CI']);
$mensaje = $mensajesLeidos;
if($mensaje > 0 ){
    setSuccess("Tenes   <div class='label label-info' style='font-size:18px;'>".$mensaje."</div> Mensaje".($mensaje==1 ? "" : "s")."</a> por leer");
}
//print_r($role);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Caja Bancaria - Caja de Jubilaciones y Pensiones de Empleados de Bancos y Afines</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php require './inc/header.php'; ?>
    <link href="./resources/bootstrap/assets/css/jquery-ui.css" rel="stylesheet">
    <link href="./resources/bootstrap/assets/css/keyboard.css" rel="stylesheet">
    <style type="text/css">
        
      .carousel {
        margin-left: 0px;
        margin-right: 0px;
      }
      .carousel .container {

      }
      .carousel .item {
        height: 300px;
      }
      .carousel img {
        height: 300px;
      }
      .carousel-caption {
        width: 100%;
        padding: 10px;
        margin-top: 70px;
        color:#DDD;
      }
      .carousel-caption h1 {
        font-size: 20px;
      }
      .carousel-caption .lead,
      .carousel-caption .btn {
        font-size: 14px;
      }
      .table-edit-data th, .table-edit-data td {
        padding: 8px;
        line-height: 20px;
        text-align: right;
        }
       
      body {
          margin-top: 0px;

        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
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
              Conectado como: <?=$user['data']['nombre'] ?>  <a href="./pin_admin_login.php" class="btn btn-warning">Salir</a>
          </div>
          <div class="alert-msg-show">
            <?php include("./tmpl/success_panel.inc")?>
          </div>
      </div>
      <div class="masthead">
        <!--Menu -->
        <br>
        <!-- end menu -->
      </div>

      <!-- Formulario de Datos Personales -->         
      <div class="hero-unit">
          
        <H3 style="text-align:right;color:#E35300;margin-bottom:-20px">Administrar Pin</h3>
            <hr style="border: 1px solid #E35300">
        
        
        <p align="center">
          
          <input type="text" placeholder="CI del usuario" id='ci'>
          <label>
             <a id="modal-generate-pin"  data-toggle="modal" href="#modalGeneratePin" class="btn">Generar PIN</a>
          </label>
        </p>
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
      
        <hr>
   
    

        
        
        <div id="modalGeneratePin" class="modal hide fade in" style="display: none;">
          <div class="modal-header">
              <a data-dismiss="modal" class="close">×</a>
              <h3>Generacion de PIN</h3>
           </div>
           <div class="modal-body">
                <table class="table table-striped" style="alignment-adjust: center">
                    <div align="center">
                      <div id='btn-generate-pin' class='btn btn-success'>Generar PIN</div>
                      <div id='show-pin'></div><br><br>
                      <div id="btn-save-pin" class='btn btn-success'>Guardar</div>
                    </div>
                </table>
               <hr>
               <h6>
                   Una vez guardado el PIN generado ya puede ser utilizado para acceder a la cuenta
               </h6>
                <div class="modal-footer">
                    
                    <button href="#" id="modal-generate-pin-close" data-dismiss="modal" class="btn">Cerrar</button>
                </div>
            </div>
          </div>

        
        
        
        
    <?php require './inc/footer.php'; ?>
    <script>
      !function ($) {
        $(function(){
          // carousel demo
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
    </script>
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
        <script src="./resources/bootstrap/assets/js/jquery.keyboard.js"></script>
        <script src="./resources/bootstrap/assets/js/jquery.mousewheel.js"></script>
        <script src="./resources/bootstrap/assets/js/jquery.keyboard.extension-typing.js"></script>
        <script type="text/javascript">
	$('#pin').keyboard({ 
	  layout : 'num', 
	  lockInput    : true,
	  restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in 
	  preventPaste : true,  // prevent ctrl-v and right click 
	  autoAccept : true 
	 }) 
         $('#newPin').keyboard({ 
	  layout : 'num', 
	  lockInput    : true,
	  restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in 
	  preventPaste : true,  // prevent ctrl-v and right click 
	  autoAccept : true 
	 }) 
         $('#confirmNewPin').keyboard({ 
	  layout : 'num', 
	  lockInput    : true,
	  restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in 
	  preventPaste : true,  // prevent ctrl-v and right click 
	  autoAccept : true 
	 }) 
	 .addTyping();
        
        </script>
  </body>
</html>
