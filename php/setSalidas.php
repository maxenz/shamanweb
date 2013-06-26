<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];
	$fecha = filter_input(INPUT_GET,'fecha',FILTER_SANITIZE_STRING);
	$idViaje = filter_input(INPUT_GET,'idViaje',FILTER_SANITIZE_STRING);
	$mov = filter_input(INPUT_GET,'mov',FILTER_SANITIZE_STRING);
	$user = getUserId();
	$fechaActual = date("Y-m-d H:i:s");
	
	switch ($opt) {
	
		case 0:
			preasignar($idViaje,$mov);
		break;
		
		case 1:
		break;
	
	}
	
	function preasignar($idViaje,$mov) {
	
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT ID FROM Moviles WHERE Movil = '$mov' ";
		$idMov = getID($SQL,$db);
	
		$SQL = "UPDATE IncidentesViajes SET MovilPreasignadoId = $idMov WHERE ID = $idViaje";
		$db->Query($SQL);
		$db->Disconnect();
	
	}
	
	function despachar(){
	
		$db = new cDB();
		$db->Connect();
	
	}

	
	
	

	
	
	// $SQL = "INSERT INTO IncidentesSucesos (IncidenteViajeId,FechaHoraSuceso,SucesoIncidenteId,MovilId,Condicion,regUsuarioId) VALUES ";
	// $SQL = $SQL . "($idIncVia,'$fechaActual',1,'$idMov','TIT','$user')";
	// echo $SQL . "<br />";
	// $db->Disconnect();

?>