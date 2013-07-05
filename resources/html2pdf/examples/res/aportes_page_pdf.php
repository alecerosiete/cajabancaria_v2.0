

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
    addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Descarga Aportes PDF");
    $db = conect();
    $aportes = getAportes($user['CI']);
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
    <H3 style="text-align:right;color:#E35300;margin-bottom:10px;margin-top: -30px">Aportes</H3>
        
    <hr style="border: 1px solid #E35300">
    <br>
    <br>
    
    
   <?php if (count($aportes)):?>
      <table style="font-size:12px" class="table table-bordered table-hover">
            <thead>
            <tr>
                
                <th style="text-align:center;width: 25%">Años Trabajados</th>
                <th style="text-align:center;width: 25%">Meses Trabajados</th>
                <th style="text-align:center;width: 25%">Dias Trabajados</th>
                <th style="text-align:right;width: 25%">TOTAL APORTADO</th>
            </tr>
            </thead>
            <tbody>
            
            <?php foreach ($aportes as $a):?>
            <tr>
                
                <td style="text-align:center"><?=$a['ANOS TRABAJADOS']?></td>
                <td style="text-align:center"><?=$a['MESES TRABAJADOS']?></td>
                <td style="text-align:center"><?=$a['DIAS TRABAJADOS']?></td>
                <td style="text-align:right"><?=number_format($a['TOTAL APORTADO'],0,'','.')?></td>
            </tr>
                
            <?php endforeach;?>
            </tbody>
            
        </table>
            
        <br>
        <H4 style="text-align:right;color:#E35300;margin-bottom:10px;margin-top: 30px">Detalle ultimos 3 meses</H4>
        <hr style="border: 1px solid #E35300">
        <br>
        <br>
        <!-- Get Datos de los ultimos 3 meses -->
        <?php $aportes3ultimosMeses = getAportes3ultimosMeses($user['CI']);?>
        <table cellspacing="0" style="font-size:12px" class="table table-bordered">
            <thead>
            <tr>

                <th  style="text-align:center;width: 33%">Mes/Año</th>
                <th  style="text-align:right;width: 33%">Aporte</th>
                <th  style="text-align:right;width: 33%">Otros Aportes</th>
                
            </tr>
            </thead>
            <tbody>

            <?php $a = $aportes3ultimosMeses?>
            <tr>

                <td  style="text-align:center"><?=  formatoFechaMMAAAA($a[0][4])?></td>
                <td  style="text-align:right"><?=  number_format($a[0][5])?></td>
                <td  style="text-align:right"><?= number_format($a[0][6])?></td>
                
            </tr>
            <tr>

                <td  style="text-align:center"><?=formatoFechaMMAAAA($a[0][7])?></td>
                <td  style="text-align:right"><?=number_format($a[0][8])?></td>
                <td  style="text-align:right"><?=number_format($a[0][9])?></td>
                
            </tr>
            <tr>

                <td style="text-align:center"><?=formatoFechaMMAAAA($a[0][10])?></td>
                <td style="text-align:right"><?=number_format($a[0][11])?></td>
                <td style="text-align:right"><?=number_format($a[0][12])?></td>
                
            </tr>
            
            </tbody>

        </table>
            
        <?php else:?>
            <div class='alert alert-warning'>No existen aportes para mostrar</div>
        <?php endif;?>
            
       
   
</page>
