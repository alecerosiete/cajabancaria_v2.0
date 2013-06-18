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
$tipo_usuario = getTipoDeUsuario($ci);
$datos_de_padron = getDatosDePadron($ci);
$aportes = getAportes($ci);
$jubilaciones = getJubilados($ci);
$prestamos = getPrestamos($ci);
$tarjetas = getTarjetas($ci);


?>



<table id="info-de-consulta" class="table table-striped" style="font-size:12px">
            <tbody>
              <tr>
                  <th width='15%'>Tipo de Usuario: </th><td width='20%'><?= strtoupper($tipo_usuario) ?></td>
                <th>Padron: </th><td><?= $datos_de_padron['PADRON']?></td>
                <th>Banco: </th><td colspan="2"><?= $datos_de_padron['NOMBREBANCO']?></td>
                
              </tr>
              <tr>
                <th width='15%'>Cedula de Id: </th><td width='20%'><?=$ci?></td>
                <th>Nombre: </th><td><?= $datos_de_padron['NOMBRE']?></td>
                <th>Apellido: </th><td colspan="2"><?= $datos_de_padron['APELLIDO']?></td>
                
              </tr>
              <tr>
                <th width='15%'>Direccion: </th><td width='20%'><?= $datos_de_padron['NOMBRE DE LA CALLE']?></td>
                <th>Numero: </th><td ><?= $datos_de_padron['NUMERO DE LA CASA']?></td> 
                <th>Barrio: </th><td><?= getBarrio($datos_de_padron['BARRIO'])?></td>
                
              </tr>
              <tr>
                  <th width='15%'>Ciudad: </th><td width='20%'><?= getCiudad($datos_de_padron['CIUDAD'])?></td>
                  <th>Localidad: </th><td ><?= getLocalidad($datos_de_padron['LOCALIDAD'])?></td>
                  <th>Linea Baja 1: </th><td><?= $datos_de_padron['TELEFONO 1']?></td>
                
              </tr>
              <tr>
                  <th width='15%'>Celular 1: </th><td width='20%'><?= $datos_de_padron['CELULAR 1']?></td>
                  <th>Celular 2: </th><td ><?= $datos_de_padron['CELULAR 2']?></td>
                  <th width='15%'>Linea Baja 2: </th><td width='20%'><?= $datos_de_padron['TELEFONO 2']?></td>
                  
              </tr>
              
              <tr>
                  
                  <th>Email: </th><td colspan="5"><?= $datos_de_padron['CORREO ELECTRONICO']?></td>
                  
              </tr>
             
            </tbody>
          </table>

<hr style="border: 1px solid #E35300">

<!-- / Bloque de datos de la consulta -->
     <div class="tabbable" style="font-size: 16px">
         
        <ul class="nav nav-pills">
          <li  class="active"><a href="#prestamos" data-toggle="tab">Prestamos</a></li>  
          <?php if(strstr(ROLE_JUBILADO,$perfil['tipo_de_usuario']) || strstr(ROLE_PENSIONADO,$perfil['tipo_de_usuario'])){?>
          
          <li><a href="#pagos" data-toggle="tab">Pagos</a></li>
          <?php }?>
              
          
          <li><a href="#tarjetas-de-credito" data-toggle="tab">Tarjetas de Crédito</a></li>
          <?php if(!(strstr(ROLE_PENSIONADO,$perfil['tipo_de_usuario']))){?>
          <li><a href="#aportes" data-toggle="tab">Aportes</a></li>
          <?php } ?>
        </ul>
         
        <div class="tab-content">
          <div id="pagos" class="tab-pane">
            <div class="hero-unit-interno">
                <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Pagos</H3>
            <hr style="border: 1px solid #E35300">
                <?php if (count($jubilaciones)):?>
                     <table style="font-size:12px" class="table table-hover">
                         <thead>
                         <tr>

                             <th width="25%">Operación</th>
                             <th width="25%">Haber</th>
                             <th width="25%">Deducción</th>
                             <th width="25%" style="text-align:center">Mes/Año Liquid.</th>
                         </tr>
                         </thead>
                         <tbody>
                         <?php $haber = $deduccion = 0;?>
                         <?php foreach ($jubilaciones as $j):?>
                         <tr>

                             <td ><?=getCodigoOperacion($j['CODIGO DE OPERACION'])?></td>
                             <td ><?=number_format($j['HABER'],0,'','.')?></td>
                             <td ><?=number_format($j['DEDUCCION'],0,'','.')?></td>
                             <td style="text-align:center"><?=$j['MES LIQUIDACION'].'/'.$j['ANO DE LIQUIDACION']?></td>
                         </tr>
                             <?php $haber+= $j['HABER']?>
                             <?php $deduccion+= $j['DEDUCCION']?>
                         <?php endforeach;?>
                         </tbody>
                         <tfoot style="font-weight: bold" class="table table-bordered">
                         <td>TOTALES</td>
                         <td><?=number_format($haber,0,'','.')?></td>
                         <td><?=number_format($deduccion,0,'','.')?></td>
                         <td><?=number_format($haber-$deduccion,0,'','.')?></td>
                         </tfoot>
                     </table>
                     <?php else:?>
                        <div class='alert alert-warning'>No se encotro ningun registro para mostrar</div>
                     <?php endif;?>
            </div>
          </div>
          <div id="prestamos" class="tab-pane  active">
            <div class="hero-unit-interno">
                <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Pr&eacute;stamos</H3>
                <hr style="border: 1px solid #E35300">
                <?php if(count($prestamos)):?>
                    <table style="font-size:12px" class="table table-hover">
                    <thead >
                    <tr>
                        <th align="right">Nº</th>
                        <th>Tipo</th>
                        <th align="center">Fecha de Liquid.</th>
                        <th align="right">Plazo</th>
                        <th align="right">Interes</th>
                        <th align="right">Monto</th>
                        <th align="right">Cuota</th>
                        <th align="right">Fecha Pago</th>
                        <th align="right">Cuotas Pagadas</th>
                        <th align="right">Saldo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $monto = $cuota = $saldo = 0;?>
                    <?php foreach ($prestamos as $p):?>
                    <tr>
                        <td ><?=$p['NUMERO DE PRESTAMO']?></td>
                        <td ><?= getTipoDePrestamo($p['TIPO DE PRESTAMO']) != '' ? getTipoDePrestamo($p['TIPO DE PRESTAMO']): 'No definido';?></td>
                        <td ><?=formatoFecha($p['FECHA DE LIQUIDACION'])?></td>
                        <td ><?=$p['PLAZO']?></td>
                        <td ><?=$p['PORCENTAJE DE INTERES']?></td>
                        <td ><?=number_format($p['MONTO DEL PRESTAMO'],0,'','.')?></td>
                        <td ><?=number_format($p['IMPORTE DE CUOTA'],0,'','.')?></td>
                        <td ><?=formatoFecha($p['FECHA DE PAGO'])?></td>
                        <td ><?=number_format($p['CUOTAS PAGADAS'],0,'','.')?></td>
                        <td ><?=number_format($p['SALDO'],0,'','.')?></td>
                    </tr>
                        <?php $monto+=$p['MONTO DEL PRESTAMO'];?>
                        <?php $cuota+=$p['IMPORTE DE CUOTA'];?>
                        <?php $saldo+=$p['SALDO'];?>
                    <?php endforeach;?>
                    </tbody>
                    <tfoot style="font-weight:bold">
                        <td class="total" colspan="5"><div style="text-align: left;">TOTALES</div></td>
                        <td class="total"><div><?=number_format($monto,0,'','.')?></div></td>
                        <td class="total"><div><?=number_format($cuota,0,'','.')?></div></td>
                        <td class="total" colspan="2"></td>
                        <td class="total"><div><?=number_format($saldo,0,'','.')?></div></td>
                    </tfoot>
                </table>
                  <?php else:?>
                <div class='alert alert-warning'>No existen ningun pr&eacute;stamo ligada al Cliente</div>
                  <?php endif;?>     
                
            </div>
          </div>
          <div id="tarjetas-de-credito" class="tab-pane">
            <div class="hero-unit-interno">
                <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Tarjetas de Cr&eacute;dito</H3>
                    <hr style="border: 1px solid #E35300">
                    <?php if (count($tarjetas)):?>
                    <?php foreach ($tarjetas as $tc):?>

                        <table class="table table-bordered" style="font-size: 12px;background:#f5f5f5">


                                <tr>
                                    <th align="right">N° de Tarjeta:</th>
                                    <td align="right"><?=formatoDeTarjeta($tc['NUMERO DE TARJETA'])?></td>
                                    <th align="right">Tipo:</th>
                                    <td align="right"><?= $tc['TIPO DE TARJETA'] == 0 ? "PRINCIPAL" : "ADICIONAL"?></td>
                                    <th align="right">Vencimiento:</th>
                                    <td align="right"><?=formatoFechaMMAA($tc['MES/ANO VENCIM. TARJETA'])?></td>

                                </tr>    
                               <tr>
                                    <th align="right">Nombre y Apellido:</th>
                                    <td align="right"><?=$tc['NOMBRE Y APELLIDO']?></td>
                                    <th align="right">C.I.:</th>
                                    <td align="right"><?=number_format($tc['NUMERO DE DOCUMENTO'],0,'','.')?></td>
                                    <th align="right">Linea de Credito:</th>
                                    <td align="right"><?=number_format($tc['LINEA DE CREDITO'],0,'','.')?></td>

                                </tr> 


                        </table>           

                         <table class="table table-bordered" style="font-size: 12px">

                            <thead>
                            <tr style='font-size:10px'>
                                <th align="center">Saldo Financiado</th>
                                <th align="center">Saldo Fact. No Venc.</th>
                                <th align="center">Saldo A Facturar</th>
                                <th align="center">Saldo en Mora</th>
                                <th align="center">Autorizaciones Pend.</th>
                                <th align="center">Deuda</th>
                                <th align="center">Pago Minimo</th>
                                <th align="center">Dias de Mora</th>
                                <th align="center">Venc. Extracto</th>
                            </tr>
                            </thead>
                            <?php $deuda = $tc['SALDO FINANCIADO'] + $tc['SALDO FACT. NO VENCIDO'] + $tc['SALDO A FACTURAR'] + $tc['IMPORTE AUTORIZ. PENDIENT'];?>
                            <tbody>
                            <tr>
                                <td ><?=number_format($tc['SALDO FINANCIADO'],0,',','.')?></td>
                                <td ><?=number_format($tc['SALDO FACT. NO VENCIDO'],0,',','.')?></td>
                                <td ><?=number_format($tc['SALDO A FACTURAR'],0,',','.')?></td>
                                <td ><?=number_format($tc['SALDO EN MORA'],0,',','.')?></td>
                                <td ><?=number_format($tc['IMPORTE AUTORIZ. PENDIENT'],0,',','.')?></td>
                                <td ><?=number_format($deuda,0,',','.')?></td>
                                <td ><?=number_format($tc['PAGO MINIMO'],0,',','.')?></td>
                                <td ><?=$tc['DIAS EN MORA']?></td>

                                <td ><?=formatoFechaDDMMAAAA($tc['FECHA VENCIM. EXTRACTO'])?></td>
                            </tr>
                            </tbody>

                        </table>
                             <hr>
                        <?php endforeach;?>
                    <?php else:?>
                        <div class='alert alert-warning'>No existen ninguna Tarjeta de Crédito ligada al Cliente</div>
                    <?php endif;?>
            </div>
          </div>
          <div id="aportes" class="tab-pane">
             <div class="hero-unit-interno">
             
            <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Aportes</H3>
            <hr style="border: 1px solid #E35300">
                <?php if (count($aportes)):?>
              <table class="table table-bordered" style="font-size: 12px;background:#f5f5f5">
                    <thead>
                    <tr>
                        <th align="right">Padron</th>
                        <th align="right">Nº de Documento</th>
                        <th align="center">Años Trabajados</th>
                        <th align="center">Meses Trabajados</th>
                        <th align="center">Dias Trabajados</th>
                        <th align="right">TOTAL APORTADO</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $totalaportado = 0;?>
                    <?php foreach ($aportes as $a):?>
                    <tr>
                        <td ><?=$a['PADRON']?></td>
                        <td ><?=number_format($a['CEDULA DE IDENTIDAD'],0,'','.')?></td>
                        <td ><?=$a['ANOS TRABAJADOS']?></td>
                        <td ><?=$a['MESES TRABAJADOS']?></td>
                        <td ><?=$a['DIAS TRABAJADOS']?></td>
                        <td ><?=number_format($a['TOTAL APORTADO'],0,'','.')?></td>
                    </tr>
                        <?php $totalaportado+=$a['TOTAL APORTADO'];?>
                    <?php endforeach;?>
                    </tbody>
                    <tfoot>
                        <td class="total" colspan="5"><div style="text-align: left;">TOTALES</div></td>
                        <td class="total"><div><?=number_format($totalaportado,0,'','.')?></div></td>
                    </tfoot>
                </table>

                <?php else:?>
                    <div class='alert alert-warning'>No existen aportes para mostrar</div>
                <?php endif;?>
             </div>
          </div>
        </div><!-- /.tab-content -->
      </div><!-- /.tabbable -->


     
     <!-- / Fin bloque datos de consulta -->