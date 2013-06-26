s<?php

	require_once("class.shaman.php");
	
	$db = new cDB();
	$db->Connect();
	
	$SQL = "SELECT DISTINCT IncidenteId FROM IncidentesObservaciones WHERE flgReclamo = 1";
	$db->Query($SQL);
	$vecReclamos = array();
	
	while($fila = $db->Next()) {
		
		$idInc = odbc_result($fila,'IncidenteId');
		array_push($vecReclamos,$idInc);
	}
	
	echo json_encode($vecReclamos);
	$db->Disconnect();	
?>