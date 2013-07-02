<?php
include '../inc/session.inc';
require_once '../inc/conexion-functions.php';
include '../inc/sql-functions.php';
//guarda los datos para auditoria
$user = getUser();
addEventAudit($user['CI'], $_SERVER['REQUEST_URI'], "Cerro sesion y salio del sistema");
addUserAuditInfo("logout");
redirect(ROOT_PATH."/login.php");

?>
