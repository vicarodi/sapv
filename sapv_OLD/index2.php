<? session_start();
include ("includes/conectar.php");

		 if(isset($_GET['doc'])){
		 	include($_GET['doc'].'.php');
		 }


