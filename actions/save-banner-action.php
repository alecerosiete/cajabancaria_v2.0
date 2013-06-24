<?php
require '../inc/session.inc';
assertUser();
require '../inc/conexion-functions.php';
require '../inc/sql-functions.php';

$uploaddir = '../resources/images/banner/'; 
//exec("rm ../audio/introduction.*");
$file = $uploaddir.string2url(basename($_FILES['banner']['name'])); 
//echo("nombre: ".$file);
if (!move_uploaded_file($_FILES['banner']['tmp_name'], $file)) { 
   addError("Error al cargar el Banner, intentelo nuevamente");
} 
//exec("chmod 777 ../audio/*");
$url = "../banner-admin.php";
//redirect($url);
header('Location: '.$url);