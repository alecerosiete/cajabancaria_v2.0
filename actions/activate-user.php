<?php
require '../inc/session.inc';
assertUser();
require '../inc/conexion-functions.php';
require '../inc/sql-functions.php';


$ci = $_POST['ci'];

$action = activateUserState($ci);
setSuccess($action > 0 ? "Activado con exito" : "Desactivado con exito");
echo $action;
?>
