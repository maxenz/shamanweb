s<?php

	require_once("class.shaman.php");
		
	$db = new cDB();
	$db->Connect();
	
	$SQL = "SELECT ID,Descripcion FROM Sintomas ";
	
	if (isset($_GET["sint"])) {
		
		$sint = filter_input(INPUT_GET,'sint',FILTER_SANITIZE_STRING);
		
		$SQL = $SQL . " WHERE Descripcion = '".$sint."' ";
			
	}

	$db->Query($SQL);
	if ($db->numrows > 0) {
		while($fila = $db->Next()) {
			
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'Descripcion' => odbc_result($fila,'Descripcion')
			);
			
		}
		echo json_encode($datos);
		
	} else {
	
		echo 0;
	}
	
	$db->Disconnect();	

?>