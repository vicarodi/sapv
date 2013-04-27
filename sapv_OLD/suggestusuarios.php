<?php
include ("includes/conectar.php");
	if($_GET[tipo]=="cedula"){
		$query=mysql_query("select nombre,cedula,ID from user_list where cedula LIKE '%".$_GET['input']."%'") or die(mysql_error());
	}elseif($_GET[tipo]=="nombre"){
		$query=mysql_query("select cedula,nombre,ID from user_list where nombre LIKE '%".$_GET['input']."%'") or die(mysql_error());
	}

	$input = strtolower( $_GET['input'] );
	$len = strlen($input);
	while($row=mysql_fetch_array($query)){
		$aUsers[]=$row[1];
		$aInfo[]=$row[0];
        $aId[]=$row[2];
	}
	$aResults = array();

	if ($len)
	{
		for ($i=0;$i<count($aUsers);$i++)
		{
			// had to use utf_decode, here
			// not necessary if the results are coming from mysql
			//
			//if (strtolower(substr(utf8_decode($aUsers[$i]),0,$len)) == $input)
				$aResults[] = array( "id"=>$aId[$i] ,"value"=>htmlspecialchars($aUsers[$i]), "info"=>htmlspecialchars($aInfo[$i]) );

			//if (stripos(utf8_decode($aUsers[$i]), $input) !== false)
			//	$aResults[] = array( "id"=>($i+1) ,"value"=>htmlspecialchars($aUsers[$i]), "info"=>htmlspecialchars($aInfo[$i]) );
		}
	}
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0



	if (isset($_REQUEST['json']))
	{
		header("Content-Type: application/json");

		echo "{\"results\": [";
		$arr = array();
		for ($i=0;$i<count($aResults);$i++)
		{
			$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"value\": \"".$aResults[$i]['value']."\", \"info\": \"".$aResults[$i]['info']."\"}";
		}
		echo implode(", ", $arr);
		echo "]}";
	}
	else
	{
		header("Content-Type: text/xml");

		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
		for ($i=0;$i<count($aResults);$i++)
		{
			echo "<rs id=\"".$aResults[$i]['id']."\" info=\"".$aResults[$i]['info']."\">".$aResults[$i]['value']."</rs>";
		}
		echo "</results>";
	}
?>