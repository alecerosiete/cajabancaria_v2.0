<?php
include '../inc/session.inc';
include '../inc/conexion-functions.php';
require '../inc/sql-functions.php';
$db = conect();
$user = getUser();
addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Menu Auditoria - Realizo Consultas");

$start = $_POST['start'];
$end = $_POST['end'];
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



$user_filter = $_POST['user_filter'];
$rows = $_POST['rows'];

    print "<table class='table table-bordered' style='font-size:12px'>
            <thead>
                <tr>
                    <th style='text-align: center;'>C.I.</th>
                    <th style='text-align: center;'>Perfil</th>
                    <th style='text-align: center;'>Grupo</th>
                    <th style='text-align: center;'>Fecha/Hora Ingreso</th>
                    <th style='text-align: center;'>Fecha/Hora Salida</th>
                    <th style='text-align: center;'>IP</th>
                    <th style='text-align: center;'>Detalles</th>
                    
                </tr>
            </thead>
            <tbody>";
    
       //STR_TO_DATE('$start', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$end', '%d-%m-%Y %H:%i:%s')
            $query = "";
            /*-- OBTIENE LOS REGISTROS --*/
            $query = "SELECT * FROM audit WHERE (`conexion_date` > STR_TO_DATE('$start', '%d-%m-%Y %H:%i:%s') AND desconexion_date < STR_TO_DATE('$end', '%d-%m-%Y %H:%i:%s'))";
            if($user_filter != ""){
                $query .= " AND user_id = '".$user_filter."'";
            }
            $conn = $db->prepare($query);
            $conn->execute();
            error_log("CONSULTA ".$query);
            
            
            
            $i = 0;
            $html = "";
            while( $r = $conn->fetch(PDO::FETCH_ASSOC)){
              
                if($i < $rows || $rows == "" ){
                   $html.= "<tr>";
                   
                   $html.= "<td style='text-align: center;'> ".$r['user_id']."</td>";
                   $html.= "<td style='text-align: center;'> ".$r['profile']."</td>";
                   $html.= "<td style='text-align: center;'> ".$r['group']."</td>";
                   $html.= "<td style='text-align: center;'> ".$r['conexion_date']."</td>";
                   $html.= "<td style='text-align: center;'> ".$r['desconexion_date']."</td>";
                   $html.= "<td style='text-align: center;'> ".$r['terminal_ip']."</td>";
                   $html.= "<td style='text-align: center;'> <a href='./lista-eventos-auditoria.php?user_id=".$r['user_id']."' class='btn'>Detalles</div></td>";
                   $html.= "</td></tr>";
                }
                $i++;
             }
            
             $html.= "</tbody>";
         $html.= "</table>";
         $db = null;
         
echo $html;