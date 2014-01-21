<?php
require_once '../inc/session.inc';
require_once '../inc/conexion-functions.php';
include '../inc/sql-functions.php';
include_once '../resources/securimage/securimage.php';

//Verifica captcha
$securimage = new Securimage();
if ($securimage->check($_POST['captcha_code']) == false) {
    //echo "<div class='alert alert-danger'>El codigo de seguridad ingresado no es valido, por favor intentelo nuevamente volviendo atras.<br><a class='btn' href='javascript:history.go(-1)'>Atras</a></div>";
    addError("El codigo de seguridad ingresado no es valido, por favor intentelo nuevamente.");
    redirect(ROOT_PATH."/pin_admin_login.php");
    exit;
}


$db = conect();
$ci = $_POST['ci'];
$pin = $_POST['pin'];

if( !empty($ci) && !empty($pin)) {
    /*Preparamos la sentencia*/
    //$statement = $db->prepare("SELECT pw.*, pb.NOMBRE AS NOMBREBANCO FROM pddirweb pw INNER JOIN prparban pb ON pw.BANCO = pb.BANC AND `CEDULA DE IDENTIDAD` = ? AND PINWEB = ?");
      
    /* Implementar pin con md5
     * SELECT *, u.username as id  
     * FROM sys_user AS u, sys_group AS g 
     * WHERE u.active = 1 AND u.groupname=g.groupname AND u.username=? AND u.password=md5(?));
     * 
     */
    //$sql = "SELECT *, u.ci as ci FROM sys_user AS u, sys_group AS g WHERE u.active = 1 AND u.tipo_de_usuario = g.nombre_de_grupo AND u.ci = ? AND u.password=?";
    
    $sql = "SELECT *,u.ci as ci FROM sys_user AS u, sys_group AS g, sys_profile AS p WHERE u.active > 0 AND u.tipo_de_usuario = g.nombre_de_grupo AND u.perfil_de_usuario = p.perfil AND u.ci = ? AND u.password = sha1(?) AND u.perfil_de_usuario = 'Operador'";
    $statement = $db->prepare($sql);
    /*Nueva consulta para acceso por roles
     * 
     * SELECT *, u.ci as ci 
     * FROM sys_user AS u, sys_group AS g 
     * WHERE u.active = 1 AND u.tipo_de_usuario = g.nombre_de_grupo AND u.ci = ? AND u.password=md5(?);
     */
    
    
    /*Ejecutamos la consulta con los parametros*/
    $statement->execute(array($ci,$pin));

    if( $item = $statement->fetch(PDO::FETCH_ASSOC) ) {
        
        //guarda los datos en sesion
        setUser($item['ci'], $item);
        //guarda los datos para auditoria
        addUserAuditInfo("login");
        addEventAudit($ci, $_SERVER['REQUEST_URI'], "Acceso exitoso al sistema");
        //misma hora para desconexion
        addUserAuditInfo("logout");
        $db = null;
        $user = getUser();
        
        setSuccess("Ha ingresado Correctamente!");
        redirect(ROOT_PATH."/pin_admin_index.php");
        
        
       
      } else {
          //error_log($statement);  
        addError("Debe ingresar un usuario existente, activo y con contrase&ntilde;a vigente ");
        $db = null;
        redirect(ROOT_PATH."/pin_admin_login.php");
      }

} else {

  addError("Debe ingresar un nombre de usuario y su contrase&ntilde;a");
  $db = null;
  redirect(ROOT_PATH."/pin_admin_login.php");
}
