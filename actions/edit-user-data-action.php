<?php
require_once '../inc/session.inc';
require_once '../inc/conexion-functions.php';
require '../inc/sql-functions.php';
$db = conect();
$user = getUser();
//$ci = $user['data']['CEDULA DE IDENTIDAD'];
//$pin = $user['data']['PINWEB'];
$ci = $_POST['ci'];
addEventAudit($ci, $_SERVER['REQUEST_URI'],"Menu Principal - Edito datos personales");

$numeroDeCasa = $_POST['numeroDeCasa'];
$barrio = $_POST['barrio'];
$ciudad = $_POST['ciudad'];
$calle = $_POST['calle'];
$localidad = $_POST['localidad'];
$celular1= $_POST['celular1'];
$celular2 = $_POST['celular2'];
$lineaBaja1 = $_POST['lineaBaja1'];
$lineaBaja2 = $_POST['lineaBaja2'];
$email = $_POST['email'];
//error_log(print_r($user));
$sql = "";

$sql .= "UPDATE pddirweb SET";

$sql .= strlen($numeroDeCasa) > 0 ? " `NUMERO DE LA CASA` = '$numeroDeCasa', " : "`NUMERO DE LA CASA` = '', ";

$sql .= strlen($barrio) > 0 ? " BARRIO = '$barrio', " : "BARRIO = '',";

$sql .= strlen($ciudad) > 0 ? " CIUDAD = '$ciudad', " : "CIUDAD = '',";

$sql .= strlen($calle) > 0 ? " `NOMBRE DE LA CALLE` = '$calle', " : "LOCALIDAD = '',";

$sql .= strlen($localidad) > 0 ? " LOCALIDAD = '$localidad', " : "";

$sql .= strlen($celular1) > 0 ? " `CELULAR 1` = '$celular1', " : "`CELULAR 1` = '',";

$sql .= strlen($celular2) > 0 ? " `CELULAR 2` = '$celular2', " : "`CELULAR 2` = '',";

$sql .= strlen($lineaBaja1) > 0 ? " `TELEFONO 1` = '$lineaBaja1', " : "`TELEFONO 1` = '',";

$sql .= strlen($lineaBaja2) > 0 ? " `TELEFONO 2` = '$lineaBaja2', " : " `TELEFONO 2` = '',";

$sql .= strlen($email) > 0 ? " `CORREO ELECTRONICOWEB` = '$email', " : "`CORREO ELECTRONICOWEB` = '',";

$sql .= "`CEDULA DE IDENTIDAD` = $ci WHERE `CEDULA DE IDENTIDAD` = $ci";

if($db->query($sql)){
   //redirect(ROOT_PATH."/index.php");
    echo "ok";
}else{
    error_log($sql);
}