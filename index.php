<?php
require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';

/* Guarda informacion de auditoria */
addEventAudit($user['CI'],$_SERVER['REQUEST_URI'],"Ingreso a la pagina principal");
$db = conect();
$tipo_usuario = $user['data']['tipo_de_usuario'];
$userInfo = getUserInfo();
$ciudad = getCiudad($userInfo[0]['CIUDAD']);
$localidad = getLocalidad($userInfo[0]['LOCALIDAD']);
$barrio = getBarrio($userInfo[0]['BARRIO']);
$role = getRole(ROLE_PENSIONADO);
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
              Conectado como: <?=$user['data']['nombre'] ?> <a class="btn" href="<?=$mensaje == 0 ? "#" : "#popUpMensaje"?>" id="idPopUpMensaje" data-toggle="modal"> Tiene: <div class="label label-info" style="font-size:18px;"><?=$mensaje?></div> Mensaje<?=$mensaje==1 ? "" : "s"?>.</a>   <a href="./actions/login.exit.php" class="btn btn-warning">Salir</a>
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

      <!-- Formulario de Datos Personales -->         
      <div class="hero-unit">
          
        <H3 style="text-align:right;color:#E35300;margin-bottom:-20px">Datos personales</h3>
            <hr style="border: 1px solid #E35300">
        <table id="personal-data" class="table table-striped data-user-info" style="font-size:12px">
            <tbody>
              <tr>
                <th style="text-align:left">Tipo de usuario: </th><td><?= $user['data']['tipo_de_usuario']?> </td>
                <th style="text-align:left">Padron: </th><td><?= $userInfo[0]['PADRON'] ?></td>
                <th style="text-align:left">Banco: </th><td colspan="2"><?= $userInfo[0]['NOMBREBANCO'] ?></td>
                
              </tr>
              <tr>
                <th style="text-align:left">Cedula de Id: </th><td><?= $userInfo[0]['CEDULA DE IDENTIDAD'] ?></td>
                <th style="text-align:left">Nombre: </th><td><?= $userInfo[0]['NOMBRE'] ?></td>
                <th style="text-align:left">Apellido: </th><td colspan="2"><?= $userInfo[0]['APELLIDO'] ?></td>
                
              </tr>
              <tr>
                <th style="text-align:left">Direccion: </th><td><?= $userInfo[0]['NOMBRE DE LA CALLE'] ?></td>
                <th style="text-align:left">Numero: </th><td ><?= $userInfo[0]['NUMERO DE LA CASA'] ?></td> 
                <th style="text-align:left">Barrio: </th><td><?= $barrio ?></td>
                
              </tr>
              <tr>
                <th style="text-align:left">Ciudad: </th><td><?= $ciudad ?></td>
                <th style="text-align:left">Localidad: </th><td ><?= $localidad ?></td>
                <th style="text-align:left">Perfil: </th><td><?= strtoupper($user['data']['perfil_de_usuario']) ?></td>
                
              </tr>
              <tr>
                  <th style="text-align:left">Celular 1: </th><td ><?= $userInfo[0]['CELULAR 1'] ?></td>
                  <th style="text-align:left">Celular 2: </th><td ><?= $userInfo[0]['CELULAR 2'] ?></td>
                  <th style="text-align:left">Linea Baja 1: </th><td><?= $userInfo[0]['TELEFONO 1'] ?></td>
                  
              </tr>
              
              <tr>
                  <th style="text-align:left">Linea Baja 2: </th><td><?= $userInfo[0]['TELEFONO 2'] ?></td>
                  <th style="text-align:left">Email: </th><td colspan="3"><?= $userInfo[0]['CORREO ELECTRONICOWEB'] ?></td>
                  
              </tr>
             
            </tbody>
          </table>
        <input type="hidden" value='<?=$userInfo[0]['CEDULA DE IDENTIDAD']?>' id='ci-info'>
        <p align="right">
        <a id="modal-change-pin"  data-toggle="modal" href="#modalChangePin" class="btn btn-primary">Cambiar mi PIN</a>
            <a id="modal-edit-user-data"  data-toggle="modal" href="#modalUserData" class="btn btn-primary">Modificar mis datos</a>
        </p>
      </div>
      
      <!-- Modal Modificar datos -->
       
        <div id="modalUserData" class="modal hide fade in" style="display: none;">
          <div class="modal-header">
              <a data-dismiss="modal" class="close">×</a>
              <h3>Edicion de datos de usuario</h3>
           </div>
           <div class="modal-body">
               <table class="table-edit-data">
                  <tr>
                      <td><label>Direccion: </label></td>
                      <td><input type="text" id="nombre-de-la-calle" value="<?= $userInfo[0]['NOMBRE DE LA CALLE'] ?>"></td>
                      <td><label>Numero: </label></td>
                      <td><input type="text" id="numero-de-la-casa" value="<?= $userInfo[0]['NUMERO DE LA CASA'] ?>"> </td>
                                         
                  </tr>
                  
                    <tr>
                      <td><label>Barrio: </label></td>
                      <td>
                        <select name="nombre-del-barrio" id="nombre-del-barrio">
                          <?php
                            $barrios = getBarrios();
                            $selected = "";
                            foreach ($barrios as $item){
                                if($barrio == $item['DESCRIPCION']){
                                    $selected = 'selected';
                                }else{
                                    $selected = "";
                                }
                                echo "<option $selected name='".$item['BARRIO']."'>".$item['DESCRIPCION']."</option>";
                            }
                          ?>
                        </select>
                      </td>
                      
                      <td><label>Ciudad: </label></td>
                      <td>
                          
                          <select name="nombre-de-la-ciudad" id="nombre-de-la-ciudad">
                          <?php
                            $selected = "";
                            $ciudades = getCiudades();
                            
                            foreach ($ciudades as $item){
                                if($ciudad == $item['DESCRIPCION']){
                                    $selected = 'selected';
                                }else{
                                    $selected = "";
                                }
                                echo "<option $selected name='".$item['CIUDAD']."'>".$item['DESCRIPCION']."</option>";
                            }
                          ?>
                        </select>
                          
                    </tr>
                     
                    <tr>
                        <td><label>Localidad: </label></td>
                        
                        <td>
                            <select name="nombre-de-localidad" id="nombre-de-localidad">
                                <?php
                                  $localidades = getLocalidades();
                                    $selected = "";
                                    
                                  foreach ($localidades as $item){
                                      if($localidad == $item['DESCRIPCION']){
                                        $selected = 'selected';
                                        }else{
                                            $selected = "";
                                        }
                                      echo "<option $selected name='".$item['LOCALIDAD']."'>".$item['DESCRIPCION']."</option>";
                                  }
                                ?>
                            </select>
                            
                        
                        </td>
                        <td><label>Celular 1: </label></td>
                        <td><input type="text" id="celular-1" value="<?= $userInfo[0]['CELULAR 1'] ?>"></td>
                   
                    </tr>
                    <tr>
                        <td><label>Celular 2: </label></td>
                        <td><input type="text" id="celular-2" value="<?= $userInfo[0]['CELULAR 2'] ?>"></td>
                        <td><label>Linea Baja 1: </label></td>
                        <td><input type="text" id='linea-baja-1' value="<?= $userInfo[0]['TELEFONO 1'] ?>"></td>
                    </tr>
                        
                     <tr> 
                        <td><label>Linea Baja 2: </label></td>
                        <td><input type="text" id='linea-baja-2' value="<?= $userInfo[0]['TELEFONO 2'] ?>"></td>
                        <td><label>Email: </label></td>
                        <td><input type="text" id="e-mail" value="<?= $userInfo[0]['CORREO ELECTRONICOWEB'] ?>"></td>
               
                    </tr>
               </table>
           <div class="modal-footer">
              <a href="#" id="btn-edit-user-data" class="btn btn-success">Guardar</a>
              <a href="#" id="user-data-edit-close" data-dismiss="modal" class="btn">Cerrar</a>
          </div>
          </div>
        </div>
        <!-- Fin Modal-->
                        
                        
      <!-- Fin formulario -->
      
      
      <!-- Example row of columns -->
      <!--
      <div class="row-fluid ">
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
       </div>
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
      </div>
      -->
      <!-- SECCION BANNER DE NOVEDADES Y NOTICIAS -->
      <div class="row-fluid ">
          <div class="span4">
            <h2><?= getTituloNovedades() ?></h2>
            <p><?= getTextoNovedades() ?> </p>

          </div>
        <div class="span8">
                    
        <!-- Carousel
           ================================================== -->
           <div id="myCarousel" class="carousel slide">
             <div class="carousel-inner">
               
                 <!-- Obtiene las imagenes -->
                 <?php
                 
                    $a_banner = getBannerNovedades();
                    //print_r($a_banner);
                    $active = 0;
                    foreach ($a_banner as $banner) {
                        
                        if($active == 0){
                           echo "<div class='item active'>";
                           $active = -1;
                        }else{
                           echo "<div class='item'>";
                        }
                                   
                        echo "<img src='./resources/images/banner/".$banner['news_banner_name']."' alt='$banner'>";
                        echo "<div class='container'></div>";
                        ?>
                        <div class="carousel-caption">
                            <h1><?= $banner['news_banner_title'] ?></h1>
                            <p class="lead"> <?= $banner['news_banner_text'] ?></p>

                        </div>
                      
                        
                        <?php
                        echo "</div>";
                        
                    }                      
                  
                 ?>                                        
             </div>
              <?php
                if (empty($a_banner)){
                        echo "<div class='alert alert-danger'>No se encontro ningun banner </div>";

                }else{                        
                ?>
                  <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                  <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
                 <?php
                }
                ?>
           </div>
           <!-- /.carousel -->
           </div>
      </div>
      <!-- Fin Novedades -->
      <hr>
         <footer>
        <div class="footer">
             Caja de Jubilaciones y Pensiones de Empleados de Bancos y Afines del Paraguay &copy; 2012 - Todos los Derechos Reservados - <a href="./terminos-y-condiciones.php">Terminos y Condiciones</a> -
     www.cajabancaria.gov.py <br> Humaita 357 e/Chile y Alberdi |(595 21) 492 051 / 052 / 053 / 054
        </div> 


    </footer>
            <hr>
    </div> <!-- /container -->
    
    
    <input type="hidden" id="ci" value="<?= $userInfo[0]['CEDULA DE IDENTIDAD'] ?>">
    
    <!-- MENSAJES -->
    <div id="popUpMensaje" class="modal hide fade in" style="display: none;">
           <div class="modal-header">
              <a data-dismiss="modal" class="close">×</a>
              <h3 style='display:inline'>Mensaje de la Caja Bancaria</h3>
           </div>
           <div class="modal-body" style="max-height: 250px">
               <div>
                  
                  <?php if(count($mensajes)):?>
                     
                        <?php foreach ($mensajes as $key => $value) { ?>
                   <table class="table table-bordered">
                       <tr style="background: #ff9933">
                            <td style="text-align:left"><strong>Fecha:</strong> <?=formatoFechaDDMMAAAA($mensajes[$key][3])?> <?=substr($mensajes[$key][4],0,2).":".substr($mensajes[$key][4],2,2)?></td>
                            
                        </tr>
                        <tr style="background: #fff">
                            <td style="text-align:leftr"><strong>Mensaje: </strong></td>
                        </tr>
                        <tr style="background: #fff">
                            <td>
                       
                                <?=$mensajes[$key][5]?>
                        
                            </td>
                        </tr>
                    </table>
                        <?php }?>
                   
                   <?php else:?>
                        <div class='alert alert-warning'>No existen ningun mensaje</div>
                  <?php endif;?>     
               </div>
            </div>
            <div class="modal-footer" style="position:static">
             <a href="#" id="btn-modal-mensaje-close" data-dismiss="modal" class="btn">Cerrar</a>
            </div>
        </div>
    <!-- Fin MEnsajes -->
    
    
    <!-- Modal Modificar pin -->
       
        <div id="modalChangePin" class="modal hide fade in" style="display: none;">
           <div class="modal-header">
              <a data-dismiss="modal" class="close">×</a>
              <h3 style='display:inline'>Modificacion del PIN de acceso </h3><a style='display:inline;s' href="#" class="btn btn-mini" data-toggle="popover" data-placement="bottom" data-content="Para aumentar la seguridad de su cuenta, le solicitamos el cambio de su PIN actual. Al cambiarlo guarde en un lugar seguro." title="" data-original-title="" id="ayudaCambioDePin">¿Que es esto?</a>
           </div>
            <div class="modal-body">
                <form class="form-signin" > 
                    <label>Pin Actual: </label>
                    <input id="pin" type="password" class="input-block-level" placeholder="Pin actual..">
                    <label>Nuevo Pin: </label>
                    <input id="newPin" type="password" class="input-block-level" placeholder="Nuevo Pin..">
                    <label>Confirme su nuevo Pin: </label>
                    <input id="confirmNewPin" type="password" class="input-block-level" placeholder="Confirme su nuevo Pin.." name="pin">

                </form>
                
                <div  style="width: 500px;margin-left: auto;margin-right: auto;">
                   
                    <?php include("./tmpl/error_panel.inc")?>
                    <?php include("./tmpl/success_panel.inc")?>
                </div>
            </div> <!-- /container -->
           <div class="modal-footer">
               <div class="alert alert-info" style="width:500px;float:left;font-size:11px">Al guardar estoy aceptando todos los terminos y condiciones de uso del portal de la Caja Bancaria. <a href="#">Terminos y Condiciones</a></div>
                <a href="#" id="btn-save-new-pin" class="btn btn-success">Guardar</a>
                <a href="#" id="user-change-pin-close" data-dismiss="modal" class="btn">Cerrar</a>
           </div>
          </div>
        
        <!-- Fin Modal Cambio de pin-->
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
        <script type="text/javascript">
		verifyChangePin();
        </script>
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