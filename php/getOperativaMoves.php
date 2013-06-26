<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
	require_once("getInfoIncidente.php");
		
	$mov = $_GET["mov"];
	$fec = modeloDate($_GET["fec"]);
	$id = $_GET["id"];
	$pPos = $_GET["pPos"];
	
	switch ($mov) {
		
		case 0:
			moveOne($id,$fec,$pPos);
		break;
		
		case 1:
			moveAll($id,$fec,$pPos);
		break;
			
	}
	
	function moveOne($id,$fec,$pPos) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT NroIncidente FROM Incidentes WHERE ID = $id";
		$db->Query($SQL);
		$inc = 0;
		
		if ($fila = $db->Next()) {
			
			$inc = odbc_result($fila,'NroIncidente');	
		}
		
		$SQL = "SELECT TOP 1 A.ID as idInc FROM Incidentes A INNER JOIN GradosOperativos B ON (A.GradoOperativoId = B.ID) ";
		$SQL = $SQL . "WHERE (A.FecIncidente = convert(datetime,'$fec')) AND (B.flgIntDomiciliaria = 0) ";
		$SQL = $SQL . "AND (B.flgTraslado = 0) ";
		$SQL = $SQL . "AND (A.NroIncidente $pPos '$inc') ";
		$SQL = $SQL . "ORDER BY A.NroIncidente";
		if ($pPos == '<') $SQL = $SQL . " DESC ";
			
		$db->Query($SQL);
		
		if ($fila = $db->Next()) {
			
			$idInc = odbc_result($fila,'idInc');
			getIncidente($idInc,0);
			
		} else {
			
			echo 0;	
		}
	
	}
	
		function moveAll($id,$fec,$pPos) {
		
			$db = new cDB();
			$db->Connect();
			
			$SQL = "SELECT NroIncidente FROM Incidentes WHERE ID = $id";
			$db->Query($SQL);
			$inc = 0;
			
			if ($fila = $db->Next()) {
				
				$inc = odbc_result($fila,'NroIncidente');	
			}
			
			$SQL = "SELECT TOP 1 A.ID as idInc FROM Incidentes A INNER JOIN GradosOperativos B ON (A.GradoOperativoId = B.ID) ";
			$SQL = $SQL . "WHERE (A.FecIncidente = convert(datetime,'$fec')) AND (B.flgIntDomiciliaria = 0) ";
			$SQL = $SQL . "AND (B.flgTraslado = 0) ";
			$SQL = $SQL . "ORDER BY A.NroIncidente";
			if ($pPos == 1) $SQL = $SQL . " DESC ";
				
			$db->Query($SQL);
			
			if ($fila = $db->Next()) {
				
				$idInc = odbc_result($fila,'idInc');
				getIncidente($idInc,0);
				
			} else {
				
				echo 0;	
			}
		
	}
	
	

?>