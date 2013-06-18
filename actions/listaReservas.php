<?php
include '../inc/session.inc';
include '../inc/conexion-functions.php';
$db = conect();

$start = $_POST['start'];
$end = $_POST['end'];
$tipo = $_POST['tipo'];
$rows = $_POST['rows'];

    print "<table class='table table-bordered' style='font-size:12px'>
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
    
      
            $query = "";
            /*-- OBTIENE LOS REGISTROS --*/
            $query = "SELECT *,DESCRIPCION FROM aqw018web alq INNER JOIN aqpartloc local ON alq.`TIPO DE LOCAL` = local.`TIPO DE LOCAL` WHERE (`HORA-MINUTO INICIO EVENTO` > DATE_FORMAT('$start', '%T') AND `HORA-MINUTO FIN EVENTO` < DATE_FORMAT('$end', '%T')) AND `FECHA RESERVA` BETWEEN DATE('$start') AND DATE('$end')";
            if($tipo != ""){
                $query .= " AND alq.`TIPO DE LOCAL` = '$tipo'";
            }
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
                   $html.= "<td style='text-align: center;'> ".$r['FECHA RESERVA']."</td>";
                   $html.= "<td style='text-align: center;'> ".$r['DESCRIPCION']."</td>";
                   $html.= "<td style='text-align: center;'> ".$r['HORA-MINUTO INICIO EVENTO']."</td>";
                   $html.= "<td style='text-align: center;'> ".$r['HORA-MINUTO FIN EVENTO']."</td>";
                   $html.= "<td style='text-align: center;'> ".$ultimoEstado[$r['ULTIMO ESTADO']]."</td>";
                   $html.= "<td style='text-align: center;'> ".$r['NUMERO DE SOLICITUD']."</td>";
                   $html.= "<td style='text-align: center;'> ".$dias[$r['DIA DE LA SEMANA']]."</td>";
                   $html.= "</td></tr>";
                }
                $i++;
             }
            
             $html.= "</tbody>";
         $html.= "</table>";
         $db = null;
         
echo $html;