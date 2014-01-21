<?php
//assertUser();
//$user = getUser();

?>
<style type="text/css">
    .navigation li ul li {
        width:159px;
    }
    

    
</style>
    <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul class="navigation">
                    <li><a href="./index.php">Inicio</a></li>
                    
                    <li><a href="#">Consultas</a>
                        <ul>
                            <?php if(getRole(ROLE_JUBILADO) || getRole(ROLE_PENSIONADO)) echo "<li><a href='./jubilados.php'>Pagos</a></li>"; ?>
                            <li><a href="./prestamos.php">Prestamos</a></li>
                            <li><a href="./tarjetas-de-credito.php">Tarjetas de Credito</a></li>
                            <li><a style="font-size:13px" href="./simulador-de-prestamos.php">Simulador de Pr&eacute;stamo</a></li>
                            <?php if(getRole(ROLE_JUBILADO) || getRole(ROLE_AFILIADO)){
                              echo "<li><a href='./aportes.php'>Aportes</a></li>";  
                            } else if(getRole(ROLE_PENSIONADO)){
                                
                            } ?>
                        </ul>
                        <div class="clear"></div>
                    </li>
                   
                    <li><a href="./estados-de-cuenta.php">Estados de Cuenta</a></li>
                    <?php if(getPerfil(ROLE_DIRECTIVO)){
                        echo "<li><a href='./consultas.php'>Buscar</a></li>";  
                    }else if(getPerfil(ROLE_SYSTEM)){ ?>
                        <li><a href='./users.php'>Usuarios</a>
                        <ul>
                            <li><a href="./banner-admin.php">Banner</a></li>
                            
                        </ul>
                         <div class="clear"></div>
                         </li>
                    <?php
                    } 
                    ?>
                         
                    <li><a href="#">Links de interes</a>
                        <ul>
                            <li><a href="./reservaciones.php">Reservaciones</a></li>
                            <li><a href="http://raulaguilera.info/caja/" target="_blank" >Inmuebles</a></li>
                        </ul>
                    </li>
                    <?php if(getPerfil(ROLE_AUDITOR)){?>
                     <li><a href='./auditoria.php'>Auditoria</a></li>
                    <?php } ?>
                    <?php if(getPerfil(ROLE_OPERATOR)){?>
                     <li><a href='./pin_admin_index.php'>Administrar Pin</a></li>
                    <?php } ?>
                    <li><a href='./contacto.php'>Contacto</a></li>
                    
                </ul>

                <div class="clear"></div>
            </div>
          </div>
        </div>
