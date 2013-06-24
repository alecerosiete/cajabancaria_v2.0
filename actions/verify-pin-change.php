<?php
require '../inc/session.inc';
assertUser();
require '../inc/conexion-functions.php';
require '../inc/sql-functions.php';
$db = conect();

$ci = $_POST['ci'];


//Trae password anterior para comparar con el anterior ingresado
$sql = "SELECT * FROM sys_user WHERE ci = ?";
error_log($sql);
$statement = $db->prepare($sql);
$statement->execute(array($ci));
$item = $statement->fetch(PDO::FETCH_ASSOC);

if($item['active'] == 2) {  
    echo 2;
} else {
    echo 1;
}
$db = null;
