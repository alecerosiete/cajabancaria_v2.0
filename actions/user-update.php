<?php
require '../inc/session.inc';
assertUser();
require '../inc/conexion-functions.php';
require '../inc/sql-functions.php';

$db = conect();

$ci = $_POST['ci'];
$perfil = consultaPerfil($ci);

if(empty($perfil)){
    //echo "Esta vacio";
    echo false;
    die();
}
$datos_de_padron = getDatosDePadron($ci);
$perfil = consultaPerfil($ci);

?>


  <table class="table table-bordered" cellspacing="0" rules="rows" cellpadding="5" width="90%">
    <thead>
      <tr>
        <th style="text-align: center">Usuario</th>
        <th style="text-align: center">Nombre completo</th>
        <th style="text-align: center">Grupo</th>
        <th style="text-align: center">Perfil</th>
        <th style="text-align: center">Estado</th>
        <th style="text-align: center">Editar</th>
      </tr>
    </thead>

    <tbody>
      <?php        
      $activeLabel = $perfil['active']==1 ? 'Desactivar' : 'Activar';
      ?>
        <tr>
          <td style="text-align: center"><?=$perfil['nombre']?></td>
          <td style="text-align: center" class="grey"><?=$datos_de_padron['NOMBRE']." ".$datos_de_padron['APELLIDO']?>&nbsp;</td>
          <td style="text-align: center"><?=$perfil['tipo_de_usuario']?>&nbsp;</td>
          <td style="text-align: center"><?=$perfil['perfil_de_usuario']?>&nbsp;</td>
          <td style="text-align: center"><a class="btn" id='activate-user-acount' href="#"><?=$activeLabel?></a>&nbsp;</td>
          <td style="text-align: center">
            <a id="modal-update-user-data"  data-toggle="modal" href="#modalUserData" class="btn">Editar</a>
            <a id="modal-generate-pin"  data-toggle="modal" href="#modalGeneratePin" class="btn">Generar PIN</a>
            
          </td>
        </tr>


      </tbody>
    </table>
    <a href="./index.php" class="btn btn-success"> Salir </a>
    
    
    <!-- Modal Modificar datos -->
       
        <div id="modalUserData" class="modal hide fade in" style="display: none;">
          <div class="modal-header">
              <a data-dismiss="modal" class="close">×</a>
              <h3>Actualizacion de usuarios</h3>
              <input type="hidden" id="ci-update" value="<?=$ci?>">
           </div>
           <div class="modal-body">
               <table class="table table-striped">
                  <tr>
                      
                      <td><strong>Nombre: </strong></td>
                      <td><input type="text" required id="nombre-update" value="<?=$perfil['nombre']?>"> </td>
                      <td><strong>Tipo de Usuario: </strong></td>
                      <td>
                        <select name="tipo_de_usuario" id="tipo_de_usuario">
                          <?php
                            $tipo_de_usuario = array("Activo","Jubilado","Pensionado");
                            $selected = "";
                            foreach ($tipo_de_usuario as $tipo){
                                if($tipo == $perfil['tipo_de_usuario']){
                                    $selected = 'selected';
                                }else{
                                    $selected = "";
                                }
                                echo "<option $selected name='".$tipo."'>".$tipo."</option>";
                            }
                          ?>
                        </select>
                      </td>                   
                  </tr>
                  
                    <tr>
                      
                      
                      <td><strong>Perfil </strong></td>
                      <td>
                          
                         <select name="perfil_de_usuario" id="perfil_de_usuario">
                          <?php
                            $perfiles = array("Activo","Directivo","Administrador");
                            $selected = "";
                            foreach ($perfiles as $p){
                                if($p == $perfil['perfil_de_usuario']){
                                    $selected = 'selected';
                                }else{
                                    $selected = "";
                                }
                                echo "<option $selected name='".$p."'>".$p."</option>";
                            }
                          ?>
                        </select>
                          
                      </td>

                      <td><strong>Padron: </strong></td>
                      <td><input disabled type="text" id="padron-update" value="<?= $perfil['padron'] ?>"></td>


                    </tr>
                    <!--tr>
                     
                      <td><strong>Contrase&ntilde;a: </strong></td>
                      <td><input required type="password" id="password-update" value=""></td>
                          
                      <td><strong>Confirmar: </strong></td>
                      <td><input required type="password" id="password-update-re" value=""></td>
                          
                    </tr-->
                    
                    </table>
                <div class="modal-footer">
                   <button href="#" id="btn-update-user-data" class="btn btn-success">Guardar</button>
                   <button href="#" id="user-data-edit-close" data-dismiss="modal" class="btn">Cerrar</button>
               </div>
               </div>
             </div>

             <!-- Fin Modal-->
             
              <!-- Modal Generar PIN -->
       
        <div id="modalGeneratePin" class="modal hide fade in" style="display: none;">
          <div class="modal-header">
              <a data-dismiss="modal" class="close">×</a>
              <h3>Generacion de PIN</h3>
           </div>
           <div class="modal-body">
                <table class="table table-striped" style="alignment-adjust: center">
                    <div align="center">
                      <input type="hidden" id="ci-update" value="<?=$ci?>">
                      <div id='btn-generate-pin' class='btn btn-success'>Generar PIN</div>
                      <div id='show-pin'></div><br>
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

             <!-- Fin Modal-->
<?php require '../inc/footer.php'; ?>
<script src="./resources/ajax/ajaxFunctions.js"></script>