

<style type="text/css">
<!--
table {
  max-width: 100%;
  background-color: transparent;
  border-collapse: collapse;
  border-spacing: 0;
}

.table {
  width: 100%;
  margin-bottom: 20px;
}
tr    { vertical-align: top; }
td    { vertical-align: top; }
.table-bordered {
  border: 1px solid #dddddd;
  border-collapse: separate;
  *border-collapse: collapse;
  border-left: 0;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
}
.table th,
.table td {
  padding: 8px;
  line-height: 20px;
  text-align: left;
  vertical-align: top;
  border-top: 1px solid #dddddd;
}

.table th {
  font-weight: bold;
}

.table thead th {
  vertical-align: bottom;
}

.table caption + thead tr:first-child th,
.table caption + thead tr:first-child td,
.table colgroup + thead tr:first-child th,
.table colgroup + thead tr:first-child td,
.table thead:first-child tr:first-child th,
.table thead:first-child tr:first-child td {
  border-top: 0;
}

.table tbody + tbody {
  border-top: 2px solid #dddddd;
}

.table .table {
  background-color: #ffffff;
}
-->
</style>
<page backcolor="#FEFEFE" backimg="./res/bas_page.png" backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="30mm" footer="page" style="font-size: 12pt">
    <bookmark title="Lettre" level="0" ></bookmark>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width: 75%;">
                 Caja de Jubilaciones y Pensiones de Empleados de Bancos y Afines del Paraguay
            </td>
            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="./res/logoCaja.jpg" alt="Logo"><br>
               
            </td>
        </tr>
    </table>
    <br>
    <?php
    addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Menu Prestamos");
    $db = conect();
    $prestamos = getPrestamos($user['CI']);
    $userData = getUserInfo($user['CI']);
    ?>
    
    <table class="table table-bordered" style="width: 60%;background: #dfdfdf;border:1px darkgray solid;float:left;">
    <tr >
        <td width="10%" style="text-align:left;font-weight: bold;">Nombre:</td>
        <td width="25%" ><?=$userData[0]['NOMBRE']?></td>
        <td width="10%" style="text-align:left;font-weight: bold;">Apellido:</td>
        <td width="25%" ><?=$userData[0]['APELLIDO']?></td>
    </tr>    
    <tr>
        <td width="10%" style="text-align:left;font-weight: bold;">C.I.: </td>
        <td width="25%"><?=$user['CI']?></td>
        <td width="10%" style="text-align:left;font-weight: bold;">Padron:</td>
        <td width="25%"><?=$user['data']['padron']?></td>
    </tr>

    </table>
    <H3 style="text-align:right;color:#E35300;margin-bottom:10px;margin-top: -30px">Pr&eacute;stamos</H3>
        
    <hr style="border: 1px solid #E35300">
    <br>
    <br>
    
    
   <?php if(count($prestamos)):?>
  
    
        <table style="font-size:11px" class="table table-bordered table-hover">
        <thead >
        <tr>
            <th style="text-align:left">Nº</th>
            <th style="text-align:left">Tipo</th>
            <th style="text-align:center">Fecha de Liquid.</th>
            <th style="text-align:center">Plazo</th>
            <th style="text-align:center">Interes</th>
            <th style="text-align:center">Monto</th>
            <th style="text-align:center">Cuota</th>
            <th style="text-align:center">Fecha Pago</th>
            <th style="text-align:center">Cuotas Pagadas</th>
            <th style="text-align:center">Saldo</th>
        </tr>
        </thead>
        <tbody>
        <?php $monto = $cuota = $saldo = 0;?>
        <?php foreach ($prestamos as $p):?>
        <tr>
            <td style="text-align:left"><?=$p['NUMERO DE PRESTAMO']?></td>
            <td style="text-align:left"><?= getTipoDePrestamo($p['TIPO DE PRESTAMO']) != '' ? getTipoDePrestamo($p['TIPO DE PRESTAMO']): 'No definido';?></td>
            <td style="text-align:center"><?=formatoFecha($p['FECHA DE LIQUIDACION'])?></td>
            <td style="text-align:right"><?=$p['PLAZO']?></td>
            <td style="text-align:right"><?=$p['PORCENTAJE DE INTERES']?> %</td>
            <td style="text-align:right"><?=number_format($p['MONTO DEL PRESTAMO'],0,'','.')?></td>
            <td style="text-align:right"><?=number_format($p['IMPORTE DE CUOTA'],0,'','.')?></td>
            <td style="text-align:center"><?=formatoFecha($p['FECHA DE PAGO'])?></td>
            <td style="text-align:center"><?=number_format($p['CUOTAS PAGADAS'],0,'','.')?></td>
            <td style="text-align:right"><?=number_format($p['SALDO'],0,'','.')?></td>
        </tr>
            <?php $monto+=$p['MONTO DEL PRESTAMO'];?>
            <?php $cuota+=$p['IMPORTE DE CUOTA'];?>
            <?php $saldo+=$p['SALDO'];?>
        <?php endforeach;?>
        <tr>
            <td >TOTALES</td>
            <td > </td>
            <td > </td>
            <td > </td>
            <td > </td>
            <td style="text-align:right"><?=number_format($monto,0,'','.')?></td>
            <td style="text-align:right"><?=number_format($cuota,0,'','.')?></td>
            <td ></td>            
            <td ></td>
            <td style="text-align:right"><?=number_format($saldo,0,'','.')?></td>
        </tr>
        </tbody>
        </table >
    
      <?php else:?>
    <div class='alert alert-warning'>No existen ningun pr&eacute;stamo ligada al Cliente</div>
      <?php endif;?>   
    
     
   
</page>
