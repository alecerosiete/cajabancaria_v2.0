<?php
include '../inc/session.inc';
include '../inc/conexion-functions.php';
require '../inc/sql-functions.php';
$db = conect();
$user = getUser();
addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Menu Reservas - Consulto Reservaciones de local");

//$start = $_POST['start'];
//$end = $_POST['end'];
/*
$fechaHora_i = explode(" ",$start);
$fecha_i = formatoFechaDDMMAAAA($fechaHora_i[0]);
$hora_i = formatoHoraHHMMSS($fechaHora_i[1]);

$fecha_f = formatoFechaDDMMAAAA($fecha);
$hora_f = explode(":", $fechaHora[1]);

$fecha=explode("-","04-05-2011");// convertimos el string a un array
$fecha=array_reverse($fecha);// invertimos cada elemento del array
$fecha=implode("-",$fecha);// volvemos a convertirlo en string separado por "-"
echo $fecha;// probamos su funcionamiento
*/

$AAAAMM_RESERVA_INICIO = $_POST['aaaa_start'].$_POST['mm_start'].$_POST['dia_reserva_start'];
//$DD_INICIO = $_POST['dia_reserva_start'];
//$HHMM_INICIO = $_POST['hh_inicio'].$_POST['mm_inicio'];

$AAAAMM_RESERVA_FINAL = $_POST['aaaa_end'].$_POST['mm_end'].$_POST['dia_reserva_end'];
//$DD_FINAL = $_POST['dia_reserva_end'];
//$HHMM_FINAL = $_POST['hh_final'].$_POST['mm_final'];




$tipo = $_POST['tipo'];
$rows = $_POST['rows'];


   
      //STR_TO_DATE('$start', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$end', '%d-%m-%Y %H:%i:%s')
           $query = "";
           /*-- OBTIENE LOS REGISTROS --*/
           //$query = "SELECT *,DESCRIPCION FROM aqw018web alq INNER JOIN aqpartloc local ON alq.`TIPO DE LOCAL` = local.`TIPO DE LOCAL` WHERE (`FECHA RESERVA` BETWEEN STR_TO_DATE('$start', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$end', '%d-%m-%Y %H:%i:%s'))";
           //$query = "SELECT * FROM aqw018web alq INNER JOIN aqpartloc local ON alq.`TIPO_LOCAL` = local.`TIPO DE LOCAL` WHERE (AAAAMM_RESERVA = $AAAAMM_RESERVA AND DD = $DD AND INICIO_HHMM = $INICIO_HHMM AND FIN_HHMM = $FIN_HHMM)";
           $query = "SELECT * , DESCRIPCION";
$query .= " FROM aqw018web alq";
$query .= " INNER JOIN aqpartloc";
$query .= " local ON alq.`TIPO_LOCAL` = local.`TIPO DE LOCAL`";
$query .= " WHERE AAMD_RESERVA BETWEEN $AAAAMM_RESERVA_INICIO AND $AAAAMM_RESERVA_FINAL";
//$query .= " AND DD  BETWEEN $DD_INICIO AND $DD_FINAL";
//$query .= " AND INICIO_HHMM BETWEEN $HHMM_INICIO AND $HHMM_FINAL";

           
           if($tipo != ""){
               $query .= " AND alq.`TIPO_LOCAL` = '$tipo'";
           }
           /*SELECT *,DESCRIPCION FROM aqw018web alq INNER JOIN aqpartloc local ON alq.`TIPO DE LOCAL` = local.`TIPO DE LOCAL` WHERE AAAAMM_RESERVA = 201307 AND DD = 29 AND INICIO_HHMM = 1500 AND FIN_HHMM = 1600
            */
           $conn = $db->prepare($query);
           $conn->execute();
           error_log("CONSULTA ".$query);
           
           $ultimoEstado = array(
               'ANU' => 'ANULADO',
               'CAN' => 'CANCELADO',
               'CON' => 'CONFIRMADO',
               'DEV' => 'DEVOLUCION',
               'RES' => 'RESERVADO'
           );
           
           $dias = array(
               'DO' => 'DOMINGO',
               'LU' => 'LUNES',
               'MA' => 'MARTES',
               'MI' => 'MIERCOLES',
               'JU' => 'JUEVES',
               'VI' => 'VIERNES',
               'SA' => 'SABADO'
           );
           
           $i = 0;
           $html = "";
           while( $r = $conn->fetch(PDO::FETCH_ASSOC)){
             
               if($i < $rows || $rows == "" ){
                  $html.= "<tr>";
                  $html.= "<td style='text-align: center;'> ".formatoFechaAAAAMMDD($r['AAMD_RESERVA'])."</td>";
                  $html.= "<td style='text-align: center;'> ".$r['DESCRIPCION']."</td>";
                  $html.= "<td style='text-align: center;'> ".formatoHHMM($r['INICIO_HHMM'])."</td>";
                  $html.= "<td style='text-align: center;'> ".formatoHHMM($r['FIN_HHMM'])."</td>";
                  $html.= "<td style='text-align: center;'> ".$ultimoEstado[$r['ULTIMO_ESTADO']]."</td>";
                  $html.= "<td style='text-align: center;'> ".$r['NUM_SOLICITUD']."</td>";
                  $html.= "<td style='text-align: center;'> ".$dias[$r['DIA_SEMANA']]."</td>";
                  $html.= "</td></tr>";
               }
               $i++;
            }
           
           if($html == ""){
if($tipo == ""){
echo "<div class='alert alert-info'> No se encontro ninguna reservaci&oacute;n. </div>";
}else{
echo "<div class='alert alert-info'> El Local esta disponible. </div>";
}
}else{
$results = "";
$results = "
<table class='table table-bordered' style='font-size:12px'>
<thead>
<tr>
<th style='text-align: center;'>Fecha</th>
<th style='text-align: center;'>Tipo de Local</th>
<th style='text-align: center;'>Hora/Min de Incio</th>
<th style='text-align: center;'>Hora/Min de Fin</th>
<th style='text-align: center;'>Ultimo Estado </th>
<th style='text-align: center;'>Numero de Solicitud</th>
<th style='text-align: center;'>Dia de la Semana</th>

</tr>
</thead>
<tbody>";
$results .= $html;
$results .= "</tbody></table>";
echo $results;
}	






        $db = null;
