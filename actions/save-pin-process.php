<?php
require '../inc/session.inc';
assertUser();
require '../inc/conexion-functions.php';
require '../inc/sql-functions.php';

$ci = $_POST['ci'];

addEventAudit($ci, $_SERVER['REQUEST_URI'],"Menu Usuarios - Guardo nuevo PIN generado");
    
    
$pin = $_POST['pin'];
$db = conect();
$sql = "UPDATE sys_user SET password = '$pin' WHERE ci = '$ci'";
error_log($sql);
$statement = $db->prepare($sql);
$statement->execute();
setSuccess("Cambio de pin Exitoso");
$db = null;
exit();
?>
