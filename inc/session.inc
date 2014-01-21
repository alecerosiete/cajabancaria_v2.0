<?php

session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'caja');
define('DB_USER', 'caja');
define('DB_PASSWORD', 'caja');

define('ROLE_SYSTEM', 'Administrador');
define('ROLE_AFILIADO', 'Activo');
define('ROLE_DIRECTIVO', 'Directivo');
define('ROLE_JUBILADO', 'Jubilado');
define('ROLE_PENSIONADO', 'Pensionado');
define('ROLE_AUDITOR', 'Auditor');
define('ROLE_OPERATOR','Operador');

define('S_USER', 'user');
define('S_ERROR_LIST', 'errors');
define('S_SUCCESS', 'success_msg');

//web page - path
define('ROOT_PATH', '/portal2');

function hasUser() {
    return isset($_SESSION[S_USER]) ;
}

function getUser() {
    return $_SESSION[S_USER];
}

//function setUser($padron, $data) {
//    $_SESSION[S_USER] = array('PADRON' => $padron, 'data' => $data);
//}

function setUser($ci, $data) {
    $_SESSION[S_USER] = array('CI' => $ci, 'data' => $data);
}


function assertUser() {
    if (!hasUser()) {
        redirect(ROOT_PATH.'/login.php');
    }
}

function isTimeOutLogin() {
    if (!hasUser()) {
        return true;
    }
    return false;
}

function getRole($role) {
    $user = getUser();
    
    return strstr($role, $user['data']['tipo_de_usuario']);
}

function getPerfil($perfil) {
    $user = getUser();
    
    return strstr($perfil, $user['data']['perfil_de_usuario']);
}

function assertRole($role) {
    if (!getRole($role))
        redirect(ROOT_PATH.'/error/go-error-page.php');
}

function redirect($url, $post_data = null) {
    header('Location: ' . $url . $post_data);
    exit(0);
}

function hasErrors() {
    return isset($_SESSION[S_ERROR_LIST]);
}

function addError($msg) {
    if (!hasErrors())
        $_SESSION[S_ERROR_LIST] = array();
    array_push($_SESSION[S_ERROR_LIST], $msg);
}

function addErrorAndExit($msg, $url) {
    addError($msg);
    redirect($url);
}

function clearErrors() {
    unset($_SESSION[S_ERROR_LIST]);
}

function hasSuccess() {
    return isset($_SESSION[S_SUCCESS]);
}

function setSuccess($msg) {
    if (!hasSuccess())
        $_SESSION[S_SUCCESS] = array();
    array_push($_SESSION[S_SUCCESS], $msg);
}

function clearSuccess() {
    unset($_SESSION[S_SUCCESS]);
}

function getDataForm($name) {
    $df = null;
    if (isset($_SESSION['data_form.' . $name]))
        $df = $_SESSION['data_form.' . $name];
    else
        $df = array();
    return $df;
}

function attachDataForm($name, $value) {
    if (isset($value)) {
        $_SESSION['data_form.' . $name] = $value;
    } else {
        $_SESSION['data_form.' . $name] = array();
    }
}

function deattachDataForm($name) {
    unset($_SESSION['data_form.' . $name]);
}

//Variable glogal para exportar un tabla a excel
function getTableExportXls($str) {
    $df = null;
    if (isset($_SESSION['table_export_xls.' . $str]))
        $df = $_SESSION['table_export_xls.' . $str];
    else
        $df = "";
    return $df;
}

function attachTableExportXls($name, $value) {
    if (isset($value)) {
        $_SESSION['table_export_xls.' . $name] = $value;
    } else {
        $_SESSION['table_export_xls.' . $name] = array();
    }
}

function deattachTableExportXls($name) {
    unset($_SESSION['table_export_xls.' . $name]);
}

function DaysMonth($month, $year) {
    switch ($month) {
        case 1:return 31; //enero
        case 2: if (($year % 4 == 0) && ($year % 100 != 0) || ($year % 400 == 0))
                return 29; else
                return 28; //febrero
        case 3:return 31; //marzo
        case 4:return 30; //abril
        case 5:return 31; //mayo
        case 6:return 30; //junio
        case 7:return 31; //julio
        case 8:return 31; //agosto
        case 9:return 30; //septiembre
        case 10:return 31; //ocubre
        case 11:return 30; //noviembre
        case 12:return 31; //diciembre
    }
}

function MonthEs($month) {
    switch ($month) {
        case 1:return 'Enero'; //enero
        case 2: return 'Febrero';
        case 3:return 'Marzo'; //marzo
        case 4:return 'Abril'; //abril
        case 5:return 'Mayo'; //mayo
        case 6:return 'Junio'; //junio
        case 7:return 'Julio'; //julio
        case 8:return 'Agosto'; //agosto
        case 9:return 'Setiembre'; //septiembre
        case 10:return 'Octubre'; //ocubre
        case 11:return 'Noviembre'; //noviembre
        case 12:return 'Diciembre'; //diciembre
    }
}


function xhtmlOptions($list, $selected) {
  $options = '';
  foreach($list as $val => $label ) {
    if( $val == $selected ) {
      $options .= sprintf("<option selected='true' value='%s'>%s</option>", $val, $label);
    } else {
      $options .= sprintf("<option value='%s'>%s</option>", $val, $label);
    }
  }
  return $options;
}

function formatoFecha($fecha)
{
    $yyyy = substr($fecha, 0,4);
    $mm = substr($fecha, 4, 2);
    $dd = substr($fecha, 6, 2);
    return $dd."/".$mm."/".$yyyy;
}


function formatoFechaMMAA($fecha)
{
    if(strlen($fecha) == 4){
        return substr($fecha, 0, 2)."-".substr($fecha, 2, 2);
    }else{
        return "0".substr($fecha, 0, 1)."-".substr($fecha, 1, 2);
    }
}

function formatoFechaMMAAAA($fecha)
{
    if(strlen($fecha) == 6){
        return substr($fecha, 0, 2)."/".substr($fecha, 2, 4);
    }else{
        return "0".substr($fecha, 0, 1)."/".substr($fecha, 1, 4);
    }
}

function formatoFechaAAAAMMDD($fecha){
	if(strlen($fecha) == 8){
        return substr($fecha, 6, 2)."/".substr($fecha, 4, 2)."/".substr($fecha, 0, 4);
    }else{
        return substr($fecha, 6, 2)."/".substr($fecha, 4, 2)."/".substr($fecha, 0, 4);
    }
}

function formatoDeTarjeta($tc)
{
    return substr($tc, 0,4)."-".substr($tc, 4,4)."-".substr($tc, 8,4)."-".substr($tc,12,4);
}

function 
formatoFechaDDMMAAAA($fecha)
{
    if(strlen($fecha) == 7){
        $fecha = "0".$fecha;
    }else{
        if(strlen($fecha) == 5){
            return substr($fecha, 0,1)."-".substr($fecha, 1, 2)."-".substr($fecha, 3, 2);
        }
    }
        
    return substr($fecha, 0,2)."-".substr($fecha, 2, 2)."-".substr($fecha, 4, 4);
}



function getAccesDenied()
{
   $html = "<div class='alert alert-danger'>No tiene privilegios para acceder a esta p&aacute;gina, contactese con el administrador del sistema.</div>";
   return $html;
}   


function string2url($cadena) {
	$cadena = trim($cadena);
	$cadena = strtr($cadena,
"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
"aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
	$cadena = strtr($cadena,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz");
	$cadena = preg_replace('#([^.a-z0-9]+)#i', '-', $cadena);
        $cadena = preg_replace('#-{2,}#','-',$cadena);
        $cadena = preg_replace('#-$#','',$cadena);
        $cadena = preg_replace('#^-#','',$cadena);
	return $cadena;
}

function formatoHHMM($hhmm){
	$hh_mm = $hhmm;
	if(strlen($hhmm) == 4){
		$hh_mm = substr($hhmm,0,2);
		$hh_mm .= ":".substr($hhmm,2,2);
	}else if(strlen($hhmm) == 3){
		$hh_mm = substr($hhmm,0,1);
		$hh_mm .= ":".substr($hhmm,1,2);
	}
	return $hh_mm;

	
}
