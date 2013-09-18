<?php
require_once '../inc/session.inc';
require_once '../inc/conexion-functions.php';
require '../inc/sql-functions.php';
$db = conect();
$user = getUser();

$ci = $_POST['ci'];
$nombre = $_POST['nombre'];
$tipo_de_usuario = $_POST['tipo_de_usuario'];
$perfil_de_usuario = $_POST['perfil'];
addEventAudit($ci, $_SERVER['REQUEST_URI'],"Menu Usuarios - Actualizo dato de usuario");

$sql = "";

$sql .= "UPDATE sys_user SET ";

$sql .= "nombre = '$nombre',tipo_de_usuario = '$tipo_de_usuario',perfil_de_usuario = '$perfil_de_usuario'";

$sql .= " WHERE ci = $ci";

if($db->query($sql)){
    setSuccess("Datos de usuario modificado con exito");
    
    /* actualiza datos de session */
    $sql = "SELECT *,u.ci as ci FROM sys_user AS u, sys_group AS g, sys_profile AS p WHERE u.active > 1 AND u.tipo_de_usuario = g.nombre_de_grupo AND u.perfil_de_usuario = p.perfil AND u.ci = ? ";
    $statement = $db->prepare($sql);
    $statement->execute(array($user['CI']));
    $item = $statement->fetch(PDO::FETCH_ASSOC);
    setUser($item['ci'], $item);
    
    echo "ok";
}else{
    addError("Hubo un error al actualizar los datos");
    error_log($sql);
}
