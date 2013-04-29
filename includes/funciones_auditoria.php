<?
	
	function audi_parametro($nombre='',$unidad_m='',$valor_minimo='',$valor_maximo='',$status='',$grupo='',$precio='',$acction){
	if ($acction=='1'){$after="<b>Nuevo Parametro:</b><br>";}else{$after="<b>Despues:</b><br>";}
		$arrunidad=devuelve_valor($unidad_m,'Nombre','unimedida');
		$arrgrupo=devuelve_valor($grupo,'nombre','grupos_examenes','id_grupo');	
		if ($status==1){$st='Activo';}else{$st='Inactivo';}
		
		$after.="<b>Nombre</b> = ".$nombre."<br>";
		$after.="<b>Unidad de Medida</b> = ".$arrunidad."<br>";
		$after.="<b>Valor Minimo</b> = ".$valor_minimo."<br>";
		$after.="<b>Valor Maximo</b> = ".$valor_maximo."<br>";
		$after.="<b>Estatus</b> = ".$st."<br>";
		$after.="<b>Grupo</b> = ".$arrgrupo."<br>";
		$after.="<b>Precio</b> = ".$precio."<br>";
		//$after.="<b></b> = ".."<br>";
			return $after;
	}
	
	function audi_parametro2($id){
		$result=mysql_fetch_assoc(mysql_query("select * from parametros where id=".$id));
		$arrunidad=devuelve_valor($result[unidad_medida],'Nombre','unimedida');
		$arrgrupo=devuelve_valor($result[id_grupo_ex],'nombre','grupos_examenes','id_grupo');
		if ($result[st]==1){$st='Activo';}else{$st='Inactivo';}
		
		$before.="<b>Antes:</b><br>";
		$before.="<b>Nombre</b> = ".$result[nombre]."<br>";
		$before.="<b>Unidad de Medida</b> = ".$arrunidad."<br>";
		$before.="<b>Valor Minimo</b> = ".$result[valor_minimo]."<br>";
		$before.="<b>Valor Maximo</b> = ".$result[valor_maximo]."<br>";
		$before.="<b>Estatus</b> = ".$st."<br>";
		$before.="<b>Grupo</b> = ".$arrgrupo."<br>";
		$before.="<b>Precio</b> = ".$result[precio]."<br>";
			return $before;
	}	
?>