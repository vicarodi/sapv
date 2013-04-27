<?
// Cargamos variables
require ("includes/config.php");
// le damos un mobre a la sesion (por si quisieramos identificarla)

// iniciamos sesiones
session_start();
// destruimos la session de usuarios.
session_destroy();

header ("Location: index.php");

?>
