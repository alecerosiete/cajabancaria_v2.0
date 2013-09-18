

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
                 
            </td>
            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="./res/logoCaja.jpg" alt="Logo"><br>
               
            </td>
        </tr>
    </table>
    <br>
    <?php

    $db = conect();
	$tarjetas = getTarjetas($user['CI']);
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
    <H3 style="text-align:right;color:#E35300;margin-bottom:50px">Tarjetas de Cr&eacute;dito</H3>
        <hr style="border: 1px solid #E35300">
    <br>
    <br>
    
    
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
                    <td style="text-align:right"><?=number_format($tc['SALDO FINANCIADO'],0,',','.')?></td>
                    <td style="text-align:right"><?=number_format($tc['SALDO FACT. NO VENCIDO'],0,',','.')?></td>
                    <td style="text-align:right"><?=number_format($tc['SALDO A FACTURAR'],0,',','.')?></td>
                    <td style="text-align:right"><?=number_format($tc['SALDO EN MORA'],0,',','.')?></td>
                    <td style="text-align:right"><?=number_format($tc['IMPORTE AUTORIZ. PENDIENT'],0,',','.')?></td>
                    <td style="text-align:right"><?=number_format($deuda,0,',','.')?></td>
                    <td style="text-align:right"><?=number_format($tc['PAGO MINIMO'],0,',','.')?></td>
                    <td style="text-align:right"><?=$tc['DIAS EN MORA']?></td>
              
                    <td ><?=formatoFechaDDMMAAAA($tc['FECHA VENCIM. EXTRACTO'])?></td>
                </tr>
                </tbody>

            </table>
                 <hr>
            <?php endforeach;?>
        <?php else:?>
            <div class='alert alert-warning'>No existen ninguna Tarjeta de Crédito ligada al Cliente</div>
        <?php endif;?>
    
     
   
</page>
