<?php
require '../inc/session.inc';
assertUser();
require '../inc/conexion-functions.php';
require '../inc/sql-functions.php';
$user = getUser();
$titulo = $_POST["titulo"];
$texto = $_POST["texto"];

    $db = conect();
 
    $sql = "REPLACE INTO news_gral (id,news_title,news_text,registered) VALUES (1,'$titulo','$texto',now())";
    $statement = $db->prepare($sql);
    $statement->execute();
    
    //print_r($rowInfo);
    $db = null;
    setSuccess("Los datos se guardaron con exito!");
    addEventAudit($user['CI'], $_SERVER['REQUEST_URI'],"Menu Banner - Guardo Informacion de novedades");
?>