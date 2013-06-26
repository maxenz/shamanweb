<?php

	require_once("class.shaman.php");
		
	$db = new cDB();
	$db->Connect();
	
	$SQL = "SELECT ID,AbreviaturaId FROM TiposDocumentos ";
	
	$db->Query($SQL);
	if ($db->numrows > 0) {
		while($fila = $db->Next()) {
			
		$datos[] = array(
			'ID' => odbc_result($fila,'ID'),
			'Tipo' => odbc_result($fila,'AbreviaturaId')
			);		
		}
		
		echo json_encode($datos);
	
	}
	
	$db->Disconnect();



?>