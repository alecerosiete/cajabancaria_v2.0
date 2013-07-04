<?php

require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';
addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Menu Contactos");
$db = conect();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Formulario de Contactos - Caja Bancaria</title>
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
          <div class="masthead">
            <!--Menu -->
            <?php require './inc/menu.php'; ?>
            <!-- end menu -->
          </div>
          
    <div class="hero-unit">
         <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Formulario de contacto</H3>
        <hr style="border: 1px solid #E35300">
                   
                <?php 
                    include_once './resources/securimage/securimage.php';
                    $securimage = new Securimage();
                    
                    
                    $destinatario = "aruizdiaz@gmail.com";
                    if (isset ($_POST['enviar'])) {
                        if ($securimage->check($_POST['captcha_code']) == false) {
                            // the code was incorrect
                            // you should handle the error so that the form processor doesn't continue

                            // or you can use the following code if there is no validation or you do not know how
                            echo "<div class='alert alert-danger'>El codigo de seguridad ingresado no es valido, por favor intentelo nuevamente volviendo atras.<br><a class='btn' href='javascript:history.go(-1)'>Atras</a></div>";
                            
                            exit;
                          }
                        
                        
                        $headers = "From: ".$_POST['email']. "rn";
                        if ( mail ($destinatario, "Nombre y apellidos : ".stripcslashes ($_POST['nombre'])." ".stripcslashes ($_POST['apellido'])."\nCedula de Identidad: ".stripcslashes ($_POST['ci'])."\nTelefono: ".stripcslashes ($_POST['telefono'])."\nEmail: ".stripcslashes ($_POST['email'])."\n Consulta: ".stripcslashes ($_POST['consulta']), $headers )){
                                setSuccess("Enviado correctamente");
                        }else {
                                addError("No se pudo enviar su mensaje, intentelo nuevamente");
                                include("./tmpl/error_panel.inc");
                        }    

                   }
                        
                ?> 
                <p>Si desea hacernos alguna consulta o sugerencia, le invitamos a completar el siguiente formulario, su consulta nos interesa.</p>
                <div class="formulario_contactos" style='margin-left:20%;'>
                   <form class="form-horizontal" action='./contacto.php' method='post' name='contacto.php' id='contacto.php'>
                    <div class="control-group">
                      <!-- /Nombres -->
                      <label class="control-label"  for="nombres">Nombres: </label>
                      <div class="controls" ><input name='nombre' type="text" class="input-xlarge" id="nombre" placeholder="Nombres" required></div>
                      <!-- /Apellidos -->
                      <label class="control-label" for="apellidos">Apellidos: </label>
                      <div class="controls"><input name='apellido' type="text" id="apellido" class="input-xlarge" required placeholder="Apellidos"></div>
                      <!-- /Empresa -->                      
                      <label class="control-label" for="ci">Cedula de Identidad:</label>
                      <div class="controls"><input name='ci' type="text" id="ci" class="input-xlarge" required placeholder="Cedula de identidad"></div>
                      <!-- /Telefono -->                      
                      <label class="control-label" for="telefono">Teléfono:</label>
                      <div class="controls"><input name='telefono' type="text" id="telefono" class="input-xlarge" placeholder="Telefono"></div>
                      <!-- /Email -->                      
                      <label class="control-label" for="email">Email:</label>
                      <div class="controls"><input name='email' type="email" id="email" class="input-xlarge" placeholder="Email" required></div>
                      <!-- /Consulta -->                      
                      <label class="control-label" for="consulta">Consulta:</label>
                      <div class="controls"><textarea rows="4" id="consulta" class="input-xlarge" name="consulta" required ></textarea>
                      </div>
                      <!-- /captcha -->                      
                      <label class="control-label" for="captcha">Captcha:</label>
                      <div class="controls"><img style="border:2px #ff9933 solid;border-radius: 10px 10px 10px 10px" id="captcha" src="./resources/securimage/securimage_show.php" alt="CAPTCHA Image" />
                          <a href="#ayudaCaptcha" class="label label-info btn-info" style='display:inline;' data-toggle="popover" data-placement="bottom" data-content="Evita enviarse de forma automática con algún programa, robot o con clicks automátizados.." title="" data-original-title="" id="ayudaCaptcha">¿Que es esto?</a>
                      </div>
                      
                      <label class="control-label" for="codigo" style="margin-top:10px">Codigo:</label>
                      <div class="controls" style="margin-top:10px"><input type="text" id="codigo" name="captcha_code" size="10" maxlength="6" />
                      <a class="label label-info btn-warning" href="#" onclick="document.getElementById('captcha').src = './resources/securimage/securimage_show.php?' + Math.random(); return false"> Cambiar la imagen </a>                 
                      <!-- /Enviar -->         
                      <br><br><button class="btn btn-large" id="btn-enviar" name="enviar" type="submit">Enviar</button>
                      </div>
                    </div>
                 </form>
                    
          



      
                <div class="clearfix"></div>
            </div>
                     
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
       <script>
        $('#myTab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })
        $('#ayudaCaptcha').popover()
          </script>

  </body>
</html>
