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

/* Guarda los datos en la BD*/
$titulo = $_POST["titulo-banner"];
$texto = $_POST["texto-banner"];
$nombre_imagen = string2url(basename($_FILES['banner']['name']));

 $db = conect();
    $sql = "INSERT INTO news (news_banner_name,news_banner_title,news_banner_text,registered) VALUES ('$nombre_imagen','$titulo','$texto',now())";
    $statement = $db->prepare($sql);
    $statement->execute();
    
    //print_r($rowInfo);
    $db = null;
/* Fin */
    
setSuccess("Nuevo banner guardado con exito");

//exec("chmod 777 ../audio/*");
$url = "../banner-admin.php";
//redirect($url);
header('Location: '.$url);