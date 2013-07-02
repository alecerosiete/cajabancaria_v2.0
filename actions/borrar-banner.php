<?php
require '../inc/session.inc';
assertUser();
require '../inc/conexion-functions.php';
require '../inc/sql-functions.php';
$user = getUser();
$id = $_POST['id'];

$db = conect();
$sql = "DELETE FROM news WHERE id = $id";
error_log($sql);
$statement = $db->prepare($sql);
$statement->execute();
$db = null;
setSuccess("Banner borrado con èxito!");
addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Banner eliminado");
exit();
?>