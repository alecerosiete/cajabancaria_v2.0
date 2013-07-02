<?php
require '../inc/session.inc';
assertUser();
require '../inc/conexion-functions.php';
require '../inc/sql-functions.php';


$ci = $_POST['ci'];

$action = activateUserState($ci);
setSuccess($action > 0 ? "Activado con exito" : "Desactivado con exito");
addEventAudit($ci, $_SERVER['REQUEST_URI'], $action > 0 ? "Activo un usuario" : "Desactivo un usuario");
echo $action;
?>
