<?php

require './inc/session.inc';
require './inc/conexion-functions.php';
require './inc/sql-functions.php';

$db = conect();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Terminos y condiciones - Caja Bancaria</title>
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
              <!--div class="btn-logout">
                Conectado como: <?=$user['data']['nombre']?> <a href="<?= "./login.php"; ?>" class="btn btn-warning">Salir</a>
              </div-->
              <div class="alert-msg-show">
                <?php include("./tmpl/success_panel.inc")?>
                  
              </div>
          </div>
          <div class="masthead" style="min-height: 60px">
            <!--Menu -->
            <?php //require './inc/menu.php'; ?>
            <!-- end menu -->
          </div>
          
    <div class="hero-unit">
         <H3 style="text-align:right;color:#E35300;margin-bottom:50px;">Terminos y Condiciones</H3>
        <hr style="border: 1px solid #E35300">
                   <pre>DO NOT ALTER OR REMOVE COPYRIGHT NOTICES OR THIS HEADER.
Copyright © 1997, 2012, Oracle and/or its affiliates. All rights reserved.
Oracle and Java are registered trademarks of Oracle and/or its affiliates. Other names may be trademarks of their respective owners.
The contents of this file are subject to the terms of either the GNU General Public License Version 2 only ("GPL") or the Common Development and Distribution License("CDDL") (collectively, the "License"). You may not use this file except in compliance with the License. You can obtain a copy of the License at http://www.netbeans.org/cddl-gplv2.html or nbbuild/licenses/CDDL-GPL-2-CP. See the License for the specific language governing permissions and limitations under the License. When distributing the software, include this License Header Notice in each file and include the License file at nbbuild/licenses/CDDL-GPL-2-CP. Oracle designates this particular file as subject to the "Classpath" exception as provided by Oracle in the GPL Version 2 section of the License file that accompanied this code. If applicable, add the following below the License Header, with the fields enclosed by brackets [] replaced by your own identifying information: "Portions Copyrighted [year] [name of copyright owner]"
Contributor(s):
The original software is NetBeans. The initial developer of the original software was Sun Microsystems, Inc.; portions copyright 1997-2006 Sun Microsystems, Inc. All rights reserved.
If you wish your version of this file to be governed by only the CDDL or only the GPL Version 2, indicate your decision by adding "[Contributor] elects to include this software in this distribution under the [CDDL or GPL Version 2] license." If you do not indicate a single choice of license, a recipient has the option to distribute your version of this file under either the CDDL, the GPL Version 2 or to extend the choice of license to its licensees as provided above. However, if you add GPL Version 2 code and therefore, elected the GPL Version 2 license, then the option applies only if the new code is made subject to such option by the copyright holder.
Oracle is not responsible for the availability of third-party Web sites mentioned in this document. Oracle does not endorse and is not responsible or liable for any content, advertising, products, or other materials on or available from such sites or resources. Oracle will not be responsible or liable for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods, or services available on or through any such sites or resources.
                   </pre>
       
        <hr>
        <footer>
            <div class="footer">
                Caja de Jubilaciones y Pensiones de Empleados de Bancos y Afines del Paraguay &copy; 2012 - <a href="./terminos-y-condiciones.php">Terminos y Condiciones</a>
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
