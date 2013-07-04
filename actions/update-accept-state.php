<?php
require '../inc/session.inc';
assertUser();
require '../inc/conexion-functions.php';
require '../inc/sql-functions.php';
$db = conect();

$ci = $_POST['ci'];

$sql = "UPDATE sys_user SET accept_terms = 1 WHERE ci = :ci";
error_log($sql);
$statement = $db->prepare($sql);
$statement->bindValue(':ci',$ci);
$statement->execute();

$db = null;
