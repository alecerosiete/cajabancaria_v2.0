<?php
require '../inc/session.inc';
assertUser();
require '../inc/conexion-functions.php';
require '../inc/sql-functions.php';

$ci = $_POST['ci'];
$pin = $_POST['pin'];
$db = conect();
$sql = "UPDATE sys_user SET password = '$pin' WHERE ci = '$ci'";
error_log($sql);
$statement = $db->prepare($sql);
$statement->execute();
$db = null;
exit();
?>
