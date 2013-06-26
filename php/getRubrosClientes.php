<?php

	require_once("class.shaman.php");
	$db = new cDB();
	$db->Connect();
	
	$SQL = "SELECT ID,Descripcion FROM RubrosClientes ORDER BY Descripcion ASC ";

	$db->Query($SQL);
	if ($db->numrows > 0) {
		while ($fila = $db->Next()) {
		
			$datos[] = array(
			'ID' => odbc_result($fila,'ID'),
			'Descripcion' => odbc_result($fila,'Descripcion')
			
			);
			
		}
		
		echo json_encode($datos);
		
	}
	
	$db->Disconnect();	

?>