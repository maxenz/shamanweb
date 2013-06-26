<?php

	require_once("class.shaman.php");
		
	$opt = $_GET["opt"];
	$id = $_GET["id"];
	
	switch ($opt) {
		
		case 0:
			getLog($id);
		break;	
		
		case 1:
			getObserv($id);
		break;		
	}
	
	
	function getLog($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT io.ID as ID,usr.Identificacion as Usuario,io.regFechaHora as FechaHora FROM IncidentesObservaciones io";
		$SQL = $SQL . " INNER JOIN Usuarios usr ON (usr.ID = io.regUsuarioId) ";
		$SQL = $SQL . " WHERE IncidenteId = $id";
		$db->Query($SQL);
		
		if ($db->numrows > 0) {
		
		while ($fila = $db->Next()) {
			
			$fechaHora = odbc_result($fila,'FechaHora');
			$fecha = substr($fechaHora,5,5);
			$hora = substr($fechaHora,11,5);
			$usr = odbc_result($fila,'Usuario');
			
			$desc = "($fecha) $hora - $usr";
			
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'Descripcion' => $desc,
			);			
		}
			echo json_encode($datos);
		
		} else {
			
			echo 0;	
		}
	}
	
	function getObserv($idObserv) {
		
		$db = new cDB();
		$db->Connect();
		
		$vObserv = array();
		
		$SQL = "SELECT io.Observaciones as Descripcion,io.flgReclamo as rec,usr.Identificacion as Usuario FROM IncidentesObservaciones io";
		$SQL = $SQL . " INNER JOIN Usuarios usr ON (usr.ID = io.regUsuarioId) ";
		$SQL = $SQL . " WHERE io.ID = $idObserv";
		$db->Query($SQL);
				
		if ($fila = $db->Next()) {
			
			
			array_push($vObserv,odbc_result($fila,'Descripcion'));
			array_push($vObserv,odbc_result($fila,'Usuario'));
			array_push($vObserv,odbc_result($fila,'rec'));
			
			
		}
		
		echo json_encode($vObserv);
		
	}
	




?>