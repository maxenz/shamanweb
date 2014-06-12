<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$db = new cDB();
	$db->Connect();
     
	$fecha = filter_input(INPUT_GET,'fecha',FILTER_SANITIZE_STRING);
	$inc = filter_input(INPUT_GET,'inc',FILTER_SANITIZE_STRING);
	$opt = $_GET["opt"];
	
	$idUser = getUserId();
	
	$SQL = "SELECT ID FROM Incidentes WHERE NroIncidente = '$inc' AND FecIncidente = '$fecha'";
	$idInc = getID($SQL,$db);

	
	switch ($opt) {
		
		case 0:	
			$aviso = $_GET["aviso"];
			updateIncidente('Aviso',$aviso,$idInc,$db);
		break;
		
		case 1:
			$observ = $_GET["observ"];
			$flgRec = $_GET["flgRec"];
			$totalObservInc = insertGetObservaciones($observ,$flgRec,$idInc,$idUser,$db);
			if ($totalObservInc == '') {
				$totalObservInc = $observ;	
			} else {
				$totalObservInc = $totalObservInc . " // " . $observ;	
			}
			
			updateIncidente('Observaciones',$totalObservInc,$idInc,$db);
		break;
		
	}
	
	function updateIncidente($pCampo,$dato,$idInc,$db) {
		
		$SQL = "UPDATE Incidentes SET " .$pCampo. " = '$dato' WHERE ID = $idInc ";
		$db->Query($SQL);	
		$db->Disconnect();		
	}
	
	function insertGetObservaciones($observ,$flgRec,$idInc,$idUser,$db) {
		
		$SQL = "INSERT INTO IncidentesObservaciones (IncidenteId,Observaciones,flgReclamo,regUsuarioId) VALUES ($idInc,'$observ',$flgRec,$idUser)";
		$db->Query($SQL);
		
		$SQL = "SELECT Observaciones FROM Incidentes WHERE ID = $idInc";
		$db->Query($SQL);
		
		if ($fila = $db->Next()) {
			
			$obs = odbc_result($fila,'Observaciones');
			return $obs;		
		}
		
		$db->Disconnect();
	}

?>