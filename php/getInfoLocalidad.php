<?php

	require_once("class.shaman.php");
		
	$db = new cDB();
	$db->Connect();
	
	$SQL = "SELECT loc1.ID as LocId,loc1.AbreviaturaId as Codigo, loc1.Descripcion as Loc,loc2.Descripcion as Partido FROM Localidades loc1 LEFT JOIN Localidades loc2 ON (loc1.PartidoId = loc2.ID) ";
	
	if (isset($_GET["loc"])) {
		
		$loc = filter_input(INPUT_GET,'loc',FILTER_SANITIZE_STRING);
		
		$SQL = $SQL . " WHERE loc1.AbreviaturaId = '".$loc."' ";
			
	}
	
	$db->Query($SQL);
	if ($db->numrows > 0) {
		while($fila = $db->Next()) {
			
			$datos[] = array(
			'Localidad' => odbc_result($fila,'Loc'),
			'Partido' => odbc_result($fila,'Partido'),
			'LocId' => odbc_result($fila,'LocId'),
			'Codigo' => odbc_result($fila,'Codigo')
			);
			
		}
		
			echo json_encode($datos);
		
	} else {
		
			echo 0;	
		
		}
		
	$db->Disconnect();	

?>