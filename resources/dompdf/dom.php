

<?php
require_once("dompdf_config.inc.php");
require '../../inc/session.inc';
assertUser();
$user = getUser();
require '../../inc/conexion-functions.php';
require '../../inc/sql-functions.php';
$db = conect();
$prestamos = getPrestamos($user['CI']);
$tarjetas = getTarjetas($user['CI']);

$html = "<!DOCTYPE html>";
$html .= "<html lang='en'>";
$html .= "<head>";
    $html .= "<meta charset='utf-8'>";
    $html .= "<title>Estados de Cuenta - Caja Bancaria</title>";
    $html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    $html .= "<meta name='description' content=''>";
    $html .= "<meta name='author' content=''>";
    $html .= "<link href='http://localhost/resources/bootstrap/assets/css/bootstrap.css' rel='stylesheet'>";
    $html .= "<link href='../bootstrap/assets/css/bootstrap-responsive.css' rel='stylesheet'>";
    $html .= "<link href='../menu.css' rel='stylesheet'>";
    $html .= "<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->";
    $html .= "<!--[if lt IE 9]>";
      $html .="<script src='../../resources/bootstrap/assets/js/html5shiv.js'></script>";
    $html .= "<![endif]-->";

    $html .= "<!-- Fav and touch icons -->";
    $html .= "<link rel='apple-touch-icon-precomposed' sizes='144x144' href='../../resources/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png'>";
    $html .= "<link rel='apple-touch-icon-precomposed' sizes='114x114' href='../../resources/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png'>";
      $html .= "<link rel='apple-touch-icon-precomposed' sizes='72x72' href='../../resources/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png'>";
                   $html .="<link rel='apple-touch-icon-precomposed' href='../../resources/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png'>";
                                  $html .="<link rel='shortcut icon' href='../../resources/bootstrap/assets/ico/favicon.png'>";
    $html .="<style type='text/css'>";
      /* Custom container */
        $html .=".container {
          margin: 0 auto;
          max-width: 960px;
          font-size: 11px;
        } 
        .container > hr {
          margin: 60px 0;
        }




    </style>";


        
$html .= "</head>";
    
$html .= "<body>";
        $html .= "<div class='container'>";
        $html .= "  <div class='header-caja-bancaria'>
            <img src='1.jpg' style='width:300px';>
        
        ";
        
       
$html .= "<div class='hero-unit'> ";

$html .= "<table class='table' style='width:200px;font-size:11px'>
        <tr>
            <td width='25%' style='text-align:right;font-weight: bold'>Nombre:</td>
            <td width='25%' colspan='3' style='font-size:11px;'>".$user['data']['nombre']."</td>
            <!--td width='25%' style='text-align:right;font-weight: bold'>Apellido:</td>
            <td width='25%'></td-->
        </tr>    
        <tr>
            <td width='25%' style='text-align:right;font-weight: bold'>C.I.: </td>
            <td width='25%'>".$user['CI']."</td>
            <td wwidth='25%' style='text-align:right;font-weight: bold'>Padron:</td>
            <td width='25%'>".$user['data']['padron']."</td>
        </tr>

    </table>";


$html .= "<H3 style='text-align:right;color:#E35300;margin-bottom:50px'>Préstamos</H3>";
    $html .= "<hr style='border: 1px solid #E35300'>";
   
    if(count($prestamos)):
        $html .= " <table style='font-size:11px' class='table table-hover'>";
        $html .= "<thead >";
        $html .= "<tr>";
            $html .= "<th align='right'>Nº</th>";
            $html .= "<th>Tipo</th>";
            $html .= "<th align='center'>Fecha de Liquid.</th>";
            $html .= "<th align='right'>Plazo</th>";
            $html .= "<th align='right'>Interes</th>";
            $html .= "<th align='right'>Monto</th>";
            $html .= "<th align='right'>Cuota</th>";
            $html .= "<th align='right'>Fecha Pago</th>";
            $html .= "<th align='right'>Cuotas Pagadas</th>";
            $html .= "<th align='right'>Saldo</th>";
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        $monto = $cuota = $saldo = 0;
        foreach ($prestamos as $p):
        $html .= "<tr>";
            $html .= "<td >".$p['NUMERO DE PRESTAMO']."</td>";
            $html .= "<td >";
            $html .= getTipoDePrestamo($p['TIPO DE PRESTAMO']) != '' ? getTipoDePrestamo($p['TIPO DE PRESTAMO']): 'No definido';
            $html .= "</td>";
            $html .= "<td >";
            $html .=  formatoFecha($p['FECHA DE LIQUIDACION']);
            $html .= "</td>";
            $html .= "<td >";
            $html .= $p['PLAZO'];
            $html .= "</td>";
            $html .= "<td >";
            $html .= $p['PORCENTAJE DE INTERES'];
            $html .= "</td>";
            $html .= "<td >";
            $html .= number_format($p['MONTO DEL PRESTAMO'],0,'','.');
            $html .= "</td>";
            $html .= "<td >";
            $html .= number_format($p['IMPORTE DE CUOTA'],0,'','.');
            $html .= "</td>";
            $html .= "<td >";
            $html .= formatoFecha($p['FECHA DE PAGO']);
            $html .= "</td>";
            $html .= "<td >";
            $html .= number_format($p['CUOTAS PAGADAS'],0,'','.');
            $html .= "</td>";
            $html .= "<td >";
            $html .= number_format($p['SALDO'],0,'','.');
            $html .= "</td>";
        $html .= "</tr>";
            $monto+=$p['MONTO DEL PRESTAMO'];
            $cuota+=$p['IMPORTE DE CUOTA'];
            $saldo+=$p['SALDO'];
        endforeach;
        $html .= "</tbody>";
        $html .= "<tfoot style='font-weight:bold'>";
            $html .= "<td class='total' colspan='5'><div style='text-align: left;'>TOTALES</div></td>";
            $html .= "<td class='total'><div>";
            $html .= number_format($monto,0,'','.');
            $html .= "</div></td>";
            $html .= "<td class='total'><div>";
            $html .= number_format($cuota,0,'','.');
            $html .= "</div></td>";
            $html .= "<td class='total' colspan='2'></td>";
            $html .= "<td class='total'><div>";
            $html .= number_format($saldo,0,'','.');
            $html .= "</div></td>";
        $html .= "</tfoot>";
    $html .= "</table>";
      else:
    $html .= "<div class='alert alert-warning'>No existen ningun pr&eacute;stamo ligada al Cliente</div>";
    endif;     
    $html .= "<hr style='border: 1px solid #E35300'>";
    $html .= "<!--/end prestamos -->";
    $html .= "    <div class='footer'>
             Caja de Jubilaciones y Pensiones de Empleados de Bancos y Afines del Paraguay &copy; 2012 - Todos los Derechos Reservados</br>
     www.cajabancaria.gov.py <br> Humaita 357 e/Chile y Alberdi |(595 21) 492 051 / 052 / 053 / 054</br>
        </div> 
 ";
    
$html .= "</div>";


    
         
    
    require '../../inc/footer.php';
    
    
$html .= " <script src='../../resources/ajax/ajaxFunctions.js'></script>";


$html .= "</body>";
$html .= "</html>";


$dompdf = new DOMPDF();
 $dompdf -> set_paper('a4','portrait'); 
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("sample.pdf");

?>
