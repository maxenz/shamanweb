<?php

	require_once("class.shaman.php");
		
	if (isset($_GET["opt"])) {
	
		$opt = $_GET["opt"];
		
		switch ($opt) {
		
			case 0:
				echo getIVA();
			break;
		
		}
	}
	
	function getIVA(){
	
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT ID,AbreviaturaId FROM SituacionesIva ";
		
		$db->Query($SQL);
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {
				
				$datos[] = array(
					'ID' => odbc_result($fila,'ID'),
					'Descripcion' => odbc_result($fila,'AbreviaturaId')
				);
				
			}
			
			return json_encode($datos);
			
		}
		
		$db->Disconnect();	
	
	}
	
?>