<?php
include './inc/session.inc';
session_destroy();
?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Acceso - Caja Bancaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="./resources/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
    <link href="./resources/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="./resources/bootstrap/assets/css/jquery-ui.css" rel="stylesheet">
    <link href="./resources/bootstrap/assets/css/keyboard.css" rel="stylesheet">
    <style type="text/css">
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
     </head>

  <body>
<div align="center" style="height: 125px; width: 435px;margin-left: auto;margin-right: auto;background:url('./resources/images/logo.png') no-repeat"></div>
    <div class="container" >
        
      <form class="form-signin" action="./actions/login.do.php" method="post">
        <h2 class="form-signin-heading" >Acceso al sistema</h2>
        <input id="ci" type="text" class="input-block-level" placeholder="Cedula de Identidad" name="ci">
        <input id="pin" type="password" class="input-block-level" placeholder="Pin.." name="pin">
        <img align="left" style="width:172px;margin-bottom: 10px" id="captcha" src="./resources/securimage/securimage_show.php" alt="CAPTCHA Image" />
        <a style="margin-top:20px;margin-left: 10px;" class="label label-info btn-warning" href="#" onclick="document.getElementById('captcha').src = './resources/securimage/securimage_show.php?' + Math.random(); return false"> Cambiar la imagen </a>                 
        <input  type="text" id="codigo" placeholder="Codigo de seguridad" name="captcha_code" size="10" maxlength="6" style="width:180px"/>
        <a href="#ayudaCaptcha" class="label label-info btn-info" style='display:inline;float:right;margin-top: 8px;' data-toggle="popover" data-placement="bottom" data-content="Verifica la interaccion Humano - Sistema evitando asi el ingreso de informacion de forma automática con algún programa, robot o con clicks automátizados.." title="" data-original-title="" id="ayudaCaptcha">¿Que es esto?</a>
        <button class="btn btn-large btn-primary" type="submit">Entrar</button>
        
        
      </form>
        <div  style="width: 500px;margin-left: auto;margin-right: auto;">
            <?php include("./tmpl/error_panel.inc")?>
            <?php include("./tmpl/success_panel.inc")?>
        </div>
    </div> <!-- /container -->
        
        <?php require './inc/footer.php'; ?>
        <script src="./resources/ajax/ajaxFunctions.js"></script>
        
        <script src="./resources/bootstrap/assets/js/jquery.keyboard.js"></script>
        <script src="./resources/bootstrap/assets/js/jquery.mousewheel.js"></script>
        <script src="./resources/bootstrap/assets/js/jquery.keyboard.extension-typing.js"></script>
        <script type="text/javascript">
	$('#pin') 
	 .keyboard({ 
	  layout : 'num', 
	  lockInput    : true,
	  restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in 
	  preventPaste : true,  // prevent ctrl-v and right click 
	  autoAccept : true 
	 }) 
	 .addTyping();
        $('#ayudaCaptcha').popover()
        </script>
  </body>
</html>
