<?php
require '../inc/session.inc';
assertUser();
require '../inc/conexion-functions.php';
require '../inc/sql-functions.php';
$db = conect();

$ci = $_POST['ci'];
$pin = $_POST['pin'];
$newPin = $_POST['newPin'];

//Trae password anterior para comparar con el anterior ingresado
$sql = "SELECT * FROM sys_user WHERE ci = ?";
error_log($sql);
$statement = $db->prepare($sql);
$statement->execute(array($ci));
$item = $statement->fetch(PDO::FETCH_ASSOC);
echo $item['password'];
if($item['password'] == sha1($pin)) {
    updateUserPin($ci,$newPin);
    setSuccess("Su Pin se ha modificado con Éxito!");
    echo 1;
} else {
    addError("Su Pin actual es incorrecto, intentelo de nuevo.");
    echo 0;
}
addEventAudit($ci, $_SERVER['REQUEST_URI'],"Menu Usuarios - Proceso de Actualizacion de PIN");
$db = null;
