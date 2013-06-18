<?php

require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';
$db = conect();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Nuevo usuario - Caja Bancaria</title>
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
           <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Nuevo Usuario</H3>
            <hr style="border: 1px solid #E35300">
          <?php if(getPerfil(ROLE_SYSTEM)) { ?>
            <!-- Busqueda de usuarios -->
            <form action="#" method="post">
                <table class="table table-condensed">
                  <tbody>
                    <tr>
                      <td>Cedula de Identidad</td>
                      <td>
                        <input type="text" name="ci" id="ci" value="" size="20" maxlength="20"/>
                      </td>
                    </tr>
                    <tr>
                      <td>Nombre</td>
                      <td>
                        <input type="text" name="nombre" value="" size="60" maxlength="100"/>
                      </td>
                    </tr>
                    <tr>
                      <td>Estado</td>
                      <td>
                        <select name="user_state">
                          <option selected value=1>Activo</option>
                          <option value=2>Inactivo</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>Tipo de usuario</td>
                      <td>
                        <select name="group">
                            <option value=Activo>Activo</option>
                            <option value="Jubilado">Jubilado</option>
                            <option value=Pensionado>Pensionado</option>
                        </select>
                      </td>
                    </tr>
                    
                    <tr>
                      <td>Perfil de usuario</td>
                      <td>
                        <select name="group">
                            <option value=Activo>Activo</option>
                            <option value="Directivo">Directivo</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                      </td>
                    </tr>

                   <tr>
                      <td>Padron</td>
                      <td>
                          <input type="text" name="padron" size="20" maxlength="20" />
                      </td>
                    </tr>

                    <tr>
                      <td>Contrase&ntilde;a</td>
                      <td>
                        <input type="password" name="password" size="20" maxlength="20"/>
                      </td>
                    </tr>

                    <tr>
                      <td>Confirmaci&oacute;n</td>
                      <td>
                        <input type="password" name="confirm-pw" size="20" maxlength="20"/>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="2" class="form-control" align="center">
                        <input class="btn" type="reset" value="Restaurar"/>
                        <input class="btn" type="submit" name="btn_submit" value="Aceptar"/>
                        <input class="btn" type="button" onclick="javascript:window.history.back()" value="Cancelar"/>
                      </td>
                    </tr>

                  </tbody>
                </table>

              </form>

            
          <?php }else{
                echo "<div class='hero-unit'>";
                $msj = getAccesDenied();
                echo $msj;
                echo "</div>";
          }
          ?>    
        </div><!-- /end hero-unit -->
      
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
          </script>
          
       <script>
        function activeUser(username, activate) {
          var msg = "¿Confirma que desea " + activate;
          msg += " el usuario \'" + username + "\'?"

          if(window.confirm(msg)) {
            if (activate == "activar"){
              document.forms["form"]["user-activate"].value = "1";
            }
            if (activate == "desactivar"){
              document.forms["form"]["user-activate"].value = "2";
            }
            var input = document.getElementById("user-id");
            input.value = username;
            input.form.submit();
          }
        }
      </script>
  </body>
</html>

