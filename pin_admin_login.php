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
        
      <form class="form-signin" action="./actions/pin_admin_login.do.php" method="post">
        <h2 style="text-align:center"><span style="font-size:26px">Administracion de PIN</span></h2>
        <input id="ci" type="text" class="input-block-level" placeholder="Cedula de Identidad" name="ci">
        <input id="pin" type="password" class="input-block-level" placeholder="Pin.." name="pin">
        <img align="left" style="width:172px;margin-bottom: 10px" id="captcha" src="./resources/securimage/securimage_show.php" alt="CAPTCHA Image" />
        <a style="margin-top:20px;margin-left: 10px;" class="label label-info btn-warning" href="#" onclick="document.getElementById('captcha').src = './resources/securimage/securimage_show.php?' + Math.random(); return false"> Cambiar la imagen </a>                 
        <input  type="text" id="codigo" placeholder="Codigo de seguridad" name="captcha_code" size="10" maxlength="6" style="width:180px"/>
        <a href="#ayudaCaptcha" class="label label-info btn-info" style='display:inline;float:right;margin-top: 8px;' data-toggle="popover" data-placement="bottom" data-content="Verifica la interaccion Humano - Sistema evitando asi el ingreso de informacion de forma automática con algún programa, robot o con clicks automátizados.." title="" data-original-title="" id="ayudaCaptcha">¿Que es esto?</a>
        <button class="btn btn-large btn-primary" type="submit">Entrar</button>
        <!--
        <input type="checkbox" name="accept-term" id="acept-term" style="display:inline-block;margin-left:15px;">
        <a href="#popUpAcceptTerm" id="popUpAcceptTermid" data-toggle="modal" class="label label-info btn-info" style='display:inline;float:right;margin-top: 10px;'  >Estoy aceptando <br> los Terminos y Condiciones</a>
        -->
      </form>
        <div  style="width: 500px;margin-left: auto;margin-right: auto;">
            <?php include("./tmpl/error_panel.inc")?>
            <?php include("./tmpl/success_panel.inc")?>
        </div>
    </div> <!-- /container -->
        
        <div id="popUpAcceptTerm" class="modal hide fade in" style="display: none;">
           <div class="modal-header">
              <a data-dismiss="modal" class="close">×</a>
              <h3 style='display:inline'>Terminos y Condiciones </h3>
           </div>
           <div class="modal-body" style="max-height: 200px">
               <div>
                   <pre>DO NOT ALTER OR REMOVE COPYRIGHT NOTICES OR THIS HEADER.
Copyright © 1997, 2012, Oracle and/or its affiliates. All rights reserved.
Oracle and Java are registered trademarks of Oracle and/or its affiliates. Other names may be trademarks of their respective owners.
The contents of this file are subject to the terms of either the GNU General Public License Version 2 only ("GPL") or the Common Development and Distribution License("CDDL") (collectively, the "License"). You may not use this file except in compliance with the License. You can obtain a copy of the License at http://www.netbeans.org/cddl-gplv2.html or nbbuild/licenses/CDDL-GPL-2-CP. See the License for the specific language governing permissions and limitations under the License. When distributing the software, include this License Header Notice in each file and include the License file at nbbuild/licenses/CDDL-GPL-2-CP. Oracle designates this particular file as subject to the "Classpath" exception as provided by Oracle in the GPL Version 2 section of the License file that accompanied this code. If applicable, add the following below the License Header, with the fields enclosed by brackets [] replaced by your own identifying information: "Portions Copyrighted [year] [name of copyright owner]"
Contributor(s):
The original software is NetBeans. The initial developer of the original software was Sun Microsystems, Inc.; portions copyright 1997-2006 Sun Microsystems, Inc. All rights reserved.
If you wish your version of this file to be governed by only the CDDL or only the GPL Version 2, indicate your decision by adding "[Contributor] elects to include this software in this distribution under the [CDDL or GPL Version 2] license." If you do not indicate a single choice of license, a recipient has the option to distribute your version of this file under either the CDDL, the GPL Version 2 or to extend the choice of license to its licensees as provided above. However, if you add GPL Version 2 code and therefore, elected the GPL Version 2 license, then the option applies only if the new code is made subject to such option by the copyright holder.
Oracle is not responsible for the availability of third-party Web sites mentioned in this document. Oracle does not endorse and is not responsible or liable for any content, advertising, products, or other materials on or available from such sites or resources. Oracle will not be responsible or liable for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods, or services available on or through any such sites or resources.
                   </pre>
               </div>
                
               
                
          </div>
            <div class="modal-footer" style="position:static">
             <a href="#" id="btn-modal-accept-term-close" data-dismiss="modal" class="btn">Cerrar</a>
            </div>
        </div>
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
