<?php
require '../inc/session.inc';
assertUser();
require '../inc/conexion-functions.php';
require '../inc/sql-functions.php';
$db = conect();
$user = getUser();
$ci = $user['CI'];

$sql = "UPDATE `mensajeweb` SET `FECHA LECTURA`= date(now()),`HORA LECTURA`= DATE_FORMAT(now(),'%H:%i'),`ESTADO`=1 WHERE `CEDULA DE IDENTIDAD` = :ci";
error_log($sql);
$statement = $db->prepare($sql);
$statement->bindValue(':ci',$ci);
$statement->execute();

$db = null;
