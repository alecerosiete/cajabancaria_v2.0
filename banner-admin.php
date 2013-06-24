<?php
require './inc/session.inc';
assertUser();
$user = getUser();
//print_r($user);
require './inc/conexion-functions.php';
require './inc/sql-functions.php';


$role = getRole(ROLE_PENSIONADO);

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
    <link rel="stylesheet" type="text/css" href="./resources/bootstrap/assets/css/bootstrap-fileupload.css" media="all" />
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
        
        .banner-preview .fileupload{
            width: auto;
            margin-left: 50px;
            margin-right: 0px;
            margin-top: 23px;
            float:left;
            
        }
        .text-novedades-preview{
            width: autopx;
            margin-left: 50px;
            float:left;
        }
        .preview-novedades{
            width:600px;
            display: block;
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
             <?php if(getPerfil(ROLE_SYSTEM)) { ?>
            
            <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Administracion de Novedades</H3>
            <hr style="border: 1px solid #E35300">
        <!-- Edicion de banner -->
        <?include("./inc/upload-file-functions.php");?>
        <div class="span9">
            
            <div class="tabbable" style="font-size: 16px">
         
                <ul class="nav nav-pills">
                  <li  class="active"><a href="#intro" data-toggle="tab">Introduccion</a></li>  

                  <li><a href="#banners" data-toggle="tab">Banners</a></li>

                  <li><a href="#nuevo-banner" data-toggle="tab">Agregar Nuevo Banner</a></li>

                  <!--li><a href="#aportes" data-toggle="tab"></a></li-->

                </ul>

                <div class="tab-content">
                  <div id="intro" class="tab-pane  active">
                    <div class="hero-unit-interno">
                        <H3>Agregar informacion general</H3>
                    <hr style="border: 1px solid #E35300">
                        

                        <div class="text-novedades-preview">
                            <label>Titulo</label><input type="text" id="titulo-novedades" style="width:300px" value="<?= getTituloNovedades() ?>">
                            <label>Descripcion</label><textarea id="texto-novedades" style="width:300px" rows="8"><?= getTextoNovedades() ?></textarea>
                            <div>

                                <input type="button"  class="btn"  id="btn-guardar-novedades" value="Guardar">
                                <div style="clear: both"></div>
                            </div>
                            <p></p>
                        </div>
                        <div class="banner-preview">
                            <div class="alert alert-info" style="width:300px;float:right; margin-top: 50px; margin-right: 50px">
                                Esta seccion se mostrara al lado izquierdo del banner, incluya un resumen de alguna novedad resaltante del dia, de la semana, etc.
                            </div>



                        </div>

                        <div style="clear: both"></div>
                          <hr style="border: 1px solid #E35300">
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
                        </div>
                  </div>
                    
                    
                  <div id="banners" class="tab-pane ">
                    <div class="hero-unit-interno">
                        <H3>Banners</H3>
                            <hr style="border: 1px solid #E35300">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <?php 
                                        $a_getAllBanners = getBannerNovedades();
                                        if(empty($a_getAllBanners)){
                                               echo "<div class='alert alert-danger'>No se encontraron registros </div>";
                                        }else{
                                        ?>
                                        <th width="20%">ID</th>
                                        <th width="80%">Nombre</th>
                                        <th width="20%">Borrar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                           foreach ($a_getAllBanners as $banner) {

                                                   echo "<tr id='".$banner['id']."'><td >".$banner['id']."</td><td>".$banner['news_banner_title']."</td><td><input type='button' class='btn' value='Borrar' onclick='(btn_borrar_banner(".$banner['id']."))'/></td></tr>";

                                            }    
                                        }
                                    ?>
                                </tbody>
                                
                            </table>   
                    </div>
                  </div>
                    
                    
                    
                  <div id="nuevo-banner" class="tab-pane">
                    <div class="hero-unit-interno">
                        <H3>Agregar contenido de banner</H3>
                        <hr style="border: 1px solid #E35300">
                        
                        <form action="./actions/save-banner-action.php" method="POST" id="form-upload-banner" enctype="multipart/form-data">
                            <div class="text-novedades-preview">
                                <label>Titulo para el banner</label><input type="text" id="titulo-banner" style="width:300px" placeholder="Ingrese un titulo">
                                <label>Descripcion para el banner</label><textarea id="texto-banner" style="width:300px" rows="8"></textarea>
                                 <div>

                                    <input type="submit" class="btn"  id="btn-guardar-banner" value="Guardar">
                                    <div style="clear: both"></div>
                                </div>
                            </div>

                            <div class="banner-preview">
                                <div class="fileupload fileupload-new" data-provides="fileupload" id="box-banner">
                                     <div id="banner-thumbnail"class="fileupload-preview thumbnail" style="width: 350px; height: 190px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
                                     <div>
                                       <span class="btn btn-file">
                                           <span class="fileupload-new"  >Seleccione un banner</span>
                                           <span class="fileupload-exists">Cambiar
                                       </span>
                                         <input type="file" id="banner" accept='image/*' name="banner"/>
                                     </span>
                                       <a href="#" id="btn-banner-preview-remove" class="btn fileupload-exists" data-dismiss="fileupload">Remover</a>
                                       <span class="label label-info"> Formatos: .jpg .png .gif .jpeg</span>
                                     </div>
                                     
       
                                   </div>
                                    
                                     
                                    
                            </div>
                       
                            <div style="clear: both"></div>
                        <div style="text-align:center">
                            Suba una imagen con un tamaño aproximado de <span class="label label-info">670x300 pixeles</span> para su mejor visualizacion.
                            <div style="clear: both"></div>
                        </div>
                      </form>
                    </div>
                     
                  </div>
                  <!--div id="aportes" class="tab-pane">
                     <div class="hero-unit-interno">

                                        <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Aportes</H3>
                                        <hr style="border: 1px solid #E35300">

                     </div>
                  </div-->
                </div><!-- /.tab-content -->
              </div><!-- /.tabbable -->
            
            
        </div>
        
            <!-- /Fin edicion de banner -->
             <div style="clear: both"></div>
        </div> <!-- /End Hero-unit-->
      
            
       <?php }else{
                echo "<div class='hero-unit'>";
                $msj = getAccesDenied();
                echo $msj;
                echo "</div>";
          }
          ?>    
      
      <hr>
    <footer>
        <div class="footer">
             Caja de Jubilaciones y Pensiones de Empleados de Bancos y Afines del Paraguay &copy; 2012 - Todos los Derechos Reservados
     www.cajabancaria.gov.py <br> Humaita 357 e/Chile y Alberdi |(595 21) 492 051 / 052 / 053 / 054
        </div> 


    </footer>
            <hr>
    </div> <!-- /container -->
    
    <!-- Modal -->
    <div style="z-index: 100000" id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Upload de archivos</h3>
      </div>
      <div class="modal-body">
          <p>
          <span>Aguarde, convirtiendo audio...</span>
          </p>
       <progress id="progressBar" value="0" max="100" class="progress" > </progress> 
        <div id="percentageCalc" style="display:inline; float: right"></div>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
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
        <script src="./resources/bootstrap/assets/js/bootstrap-fileupload.js"></script>
  </body>
</html>

