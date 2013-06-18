<?php
require_once '../inc/session.inc';
require_once '../inc/conexion-functions.php';
$db = conect();
$ci = $_POST['ci'];
$pin = $_POST['pin'];
if( !empty($ci) && !empty($pin) ) {
    /*Preparamos la sentencia*/
    //$statement = $db->prepare("SELECT pw.*, pb.NOMBRE AS NOMBREBANCO FROM pddirweb pw INNER JOIN prparban pb ON pw.BANCO = pb.BANC AND `CEDULA DE IDENTIDAD` = ? AND PINWEB = ?");
      
    /* Implementar pin con md5
     * SELECT *, u.username as id  
     * FROM sys_user AS u, sys_group AS g 
     * WHERE u.active = 1 AND u.groupname=g.groupname AND u.username=? AND u.password=md5(?));
     * 
     */
    //$sql = "SELECT *, u.ci as ci FROM sys_user AS u, sys_group AS g WHERE u.active = 1 AND u.tipo_de_usuario = g.nombre_de_grupo AND u.ci = ? AND u.password=?";
    
    $sql = "SELECT *,u.ci as ci FROM sys_user AS u, sys_group AS g, sys_profile AS p WHERE u.active = 1 AND u.tipo_de_usuario = g.nombre_de_grupo AND u.perfil_de_usuario = p.perfil AND u.ci = ? AND u.password = ?";
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
        setSuccess("Ha ingresado Correctamente!");
        //setUser($item['PADRON'], $item);
        setUser($item['ci'], $item);
        $db = null;
        redirect(ROOT_PATH."/index.php");
      } else {
          //error_log($statement);  
        addError("Debe ingresar un usuario existente, activo y con contrase&ntilde;a vigente ");
        $db = null;
        redirect(ROOT_PATH."/login.php");
      }

} else {
  addError("Debe ingresar un nombre de usuario y su contrase&ntilde;a");
  $db = null;
  redirect(ROOT_PATH."/login.php");
}
