<?php

	require_once("class.shaman.php");
	
	$db = new cDB();
	$db->Connect();
	
	$SQL = "SELECT san.ID as sanID, san.AbreviaturaId as abrSan, san.Descripcion as descSan, san.Domicilio as sanDom, loc.AbreviaturaId as locAbr ";
    $SQL = $SQL . "FROM Sanatorios san ";
    $SQL = $SQL . "INNER JOIN Localidades loc ON (san.LocalidadId = loc.ID) ";
	
	if (isset($_GET["pAbr"])) {
		
		$sanAbr = filter_input(INPUT_GET,'pAbr',FILTER_SANITIZE_STRING);
		$SQL = $SQL . "WHERE san.AbreviaturaId = '" . $sanAbr . "' ";  	
	}
	
	$SQL = $SQL . "ORDER BY san.AbreviaturaId";
	
	$db->Query($SQL);
	if ($db->numrows > 0) {
		while ($fila = $db->Next()) {
		
			$datos[] = array(
			'ID' => odbc_result($fila,'sanID'),
			'Sanatorio' => odbc_result($fila,'abrSan'),
			'Descripcion' => odbc_result($fila,'descSan'),
			'Domicilio' => odbc_result($fila,'sanDom'),
			'Localidad' => odbc_result($fila,'locAbr')
			);
			
		}
		
			echo json_encode($datos);
			
	} else {
			
			echo 0;	
	}
	
	$db->Disconnect();	



?>