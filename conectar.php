<?
  include_once("config.php");
  $conexion=mysql_connect($Servidor,$Usuario,$Password) or die("Error: El servidor no puede conectar con la base de datos");
  $descriptor=mysql_select_db($BaseDeDatos,$conexion);
  $nivel_acceso=10;
  if ($nivel_acceso < $_SESSION['usuario_nivel']){
  header ("Location: $redir?error_login=5");
  exit;
}
?>