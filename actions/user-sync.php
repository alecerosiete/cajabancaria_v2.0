<?php
require '../inc/session.inc';
assertUser();
require '../inc/conexion-functions.php';
require '../inc/sql-functions.php';
$user = getUser();

$db = conect();

//$ci = $user['CI'];
//addEventAudit($ci, $_SERVER['REQUEST_URI'],"Menu Buscar - Sincronizacion de usuarios");

$rowsAffected = syncUser();


if ($rowsAffected > 0)
    $sync = $rowsAffected;
else
    $sync = 0;
echo $sync;

?>
