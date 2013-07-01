<?php
include '../inc/session.inc';
require_once '../inc/conexion-functions.php';
include '../inc/sql-functions.php';
//guarda los datos para auditoria
addUserAuditInfo("logout");
redirect(ROOT_PATH."/login.php");

?>
