<?php

	
	require_once("class.shaman.php");

	$db = new cDB();
	$db->Connect();
	
	$SQL = "SELECT ID,AbreviaturaId,Descripcion FROM Diagnosticos ";
    
	if (isset($_GET["pDiag"])) {
		
		$diagAbr = filter_input(INPUT_GET,'pDiag',FILTER_SANITIZE_STRING);
		$SQL = $SQL . "WHERE AbreviaturaId = '" . $diagAbr . "' ";  	
	}
		
	$SQL = $SQL . "ORDER BY AbreviaturaId";
	
	$db->Query($SQL);
	if ($db->numrows > 0) {
		while ($fila = $db->Next()) {
		
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'AbreviaturaId' => odbc_result($fila,'AbreviaturaId'),
				'Descripcion' => odbc_result($fila,'Descripcion')
			);
			
		}
		
		echo json_encode($datos);
			
	} else {
			
		echo 0;	
	}
	
	$db->Disconnect();



?>