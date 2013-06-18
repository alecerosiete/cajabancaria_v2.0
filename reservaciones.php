<?php

require './inc/session.inc';
assertUser();
$user = getUser();
require './inc/conexion-functions.php';
require './inc/sql-functions.php';
$db = conect();
//$prestamos = getReservas($user['CI']);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Pr&eacute;stamos - Caja Bancaria</title>
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

            <div class="hero-unit" style="min-height: 500px">
                     <?php include ('./inc/userInfo.php');?>
                <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Consulta de Local - Sede Social</H3>
                <hr style="border: 1px solid #E35300">
                
                   <table class='table table-bordered' >
                        <thead >
                            <tr>
                                <th >Inicio de Fecha/Hora</th>
                                <th>Fin de Fecha/Hora</th>
                                <th>Tipo de local</th>
                                <th>Mostrar</th>
                            </tr>
                        </thead>
                        <tbody>

                             <link rel="stylesheet" type="text/css" media="screen"
                                   href="./resources/bootstrap/assets/css/bootstrap-datetimepicker.min.css">
                             <tr>
                                 <td>
                                     <div id="startDate" class="input-append date">
                                        <input type="text" id="startDateConsulta" value="<?= date('Y-m-d')." 00:00:00"?>"></input>
                                        <span class="add-on">
                                          <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                                        </span>
                                      </div>
                                 </td>
                                  <td><div id="endDate" class="input-append date">
                                        <input type="text" id="endDateConsulta" value="<?= date('Y-m-d H:m:s')?>"></input>
                                        <span class="add-on">
                                          <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                                        </span>
                                      </div>
                                  </td>
                                   <td>
                                      <select name="tipoLocal" id="tipoLocal"> 
                                          <option value=''>Todos</option>
                                          <?php
                                            $locales = getLocales();
                                            foreach ($locales as $local) {
                                                print_r($local);
                                                echo " <option value='".$local['TIPO DE LOCAL']."'>".$local['DESCRIPCION']."</option>";
                                            }
                                          ?>
                                       </select> 
                                  </td>                                           
                                  <td>
                                    <select style="width:80px" name="cantidadRegistros" id="cantidadRegistros"> 
                                          <option value=''>Todo</option>
                                          <option value='5'>5</option>
                                          <option value='10'>10</option>
                                          <option value='20'>20</option>
                                          <option value='40'>40</option>
                                          <option value='100'>100</option>
                                          
                                    </select> 
                                  </td>
                             </tr>
                             <tr>
                                 <td colspan="4" style="text-align:center">
                                     
                                     <div  id="btn-get-reservas" class="btn btn-primary btn-large">
                                            Consultar
                                    </div>
                                 </td>
                             </tr>
                            <script type="text/javascript"
                                    src="./resources/bootstrap/assets/js/jquery.min.js">
                            </script>
                            <script type="text/javascript"
                                    src="./resources/bootstrap/assets/js/bootstrap.min_1.js">
                            </script>

                            <script type="text/javascript"
                                    src="./resources/bootstrap/assets/js/bootstrap-datetimepicker.min.js">
                            </script>
                            <script type="text/javascript"
                                    src="./resources/bootstrap/assets/js/bootstrap-datetimepicker.pt-BR.js">
                            </script>
                            <script src="./resources/bootstrap/assets/js/bootstrap-datepicker.js"></script>
                            <script type="text/javascript">

                              $('#startDate').datetimepicker({
                                format: 'yyyy-MM-dd hh:mm:ss',
                                language: 'pt-BR'
                              });
                              $('#endDate').datetimepicker({
                                format: 'yyyy-MM-dd hh:mm:ss',
                                language: 'pt-BR'
                              });

                              // disabling dates

                            </script>
                        </tbody>
                   </table>


                <div id="lista-reservas">

                </div>

            </div>   





            </div><!-- /end hero-unit -->
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
  </body>
</html>
