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
                    
                    <li><a href="#">Beneficiarios</a>
                        <ul>
                            <?php if(getRole(ROLE_JUBILADO) || getRole(ROLE_PENSIONADO)) echo "<li><a href='./jubilados.php'>Pagos</a></li>"; ?>
                            <li><a href="./prestamos.php">Prestamos</a></li>
                            <li><a href="./tarjetas-de-credito.php">Tarjetas de Credito</a></li>
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
                    <li><a href="./reservaciones.php">Reservaciones</a></li>
                    <li><a href="#">Inmuebles</a></li>
                    
                </ul>

                <div class="clear"></div>
            </div>
          </div>
        </div>