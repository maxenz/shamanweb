<?php
	
	require_once("class.shaman.php");	
	
	if (isset($_GET["opt"])) {
		
		$opt = $_GET["opt"];
		
		switch ($opt) {
		
			case 0 :
				
				echo getGrados();
			
			break;
			
			case 1 :
			
				$idGrado = filter_input(INPUT_GET,'idGrado',FILTER_SANITIZE_NUMBER_INT);
				echo setChartData($idGrado);
			
			break;
					
		}
		
			
	}

	function setChartData($idGrado) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT gdo.Descripcion as descGrado, gdo.Orden,";
		$SQL = $SQL . "IF(ISNULL(AVG(vij.virTpoDespacho)),0,AVG(vij.virTpoDespacho)) as Despacho,";
		$SQL = $SQL . "IF(ISNULL(AVG(vij.virTpoSalida)),0,AVG(vij.virTpoSalida)) as Salida,";
		$SQL = $SQL . "IF(ISNULL(AVG(vij.virTpoDesplazamiento)),0,AVG(vij.virTpoDesplazamiento)) as Desplazamiento, ";
		$SQL = $SQL . "IF(ISNULL(AVG(vij.virTpoAtencion)),0,AVG(vij.virTpoAtencion)) as Atencion ";
		$SQL = $SQL . "FROM Incidentes inc "; 
		$SQL = $SQL . "INNER JOIN IncidentesDomicilios dom ON (inc.ID = dom.IncidenteId) ";
		$SQL = $SQL . "INNER JOIN IncidentesViajes vij ON (dom.ID = vij.IncidenteDomicilioId) ";
		$SQL = $SQL . "INNER JOIN GradosOperativos gdo ON (inc.GradoOperativoId = gdo.ID) ";
		$SQL = $SQL . "WHERE (inc.FecIncidente = '2013-02-28') AND (gdo.ID = '".$idGrado."')  ";
		$SQL = $SQL . "GROUP BY gdo.Descripcion, gdo.Orden ";
		$SQL = $SQL . "ORDER BY gdo.Orden";

		$db->Query($SQL);
		if ($db->numrows > 0) {
			while ($fila = $db->Next()) {
				
				$datos[] = array(
					'Despacho' => odbc_result($fila,'Despacho'),
					'Salida' => odbc_result($fila,'Salida'),
					'Desplazamiento' => odbc_result($fila,'Desplazamiento'),
					'Atencion' => odbc_result($fila,'Atencion')						
				);			
			}			
		}
		
		$db->Disconnect();
		
		return json_encode($datos);
		
		
		
	}
							
	function getGrados() {

		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT ID,Descripcion,AbreviaturaId,ColorHexa FROM GradosOperativos";
		
		if (isset($_GET["pInc"])) {
			
			$SQL = $SQL . " WHERE (flgIntDomiciliaria = 0) AND (flgTraslado = 0) ORDER BY Orden";			
			
		}

		$db->Query($SQL);
		if ($db->numrows > 0 ) {
			while ($fila = $db->Next()) {

				$datos[] = array(
					'ID' => odbc_result($fila,'ID'),
					'Descripcion' => odbc_result($fila,'Descripcion'),
					'AbreviaturaId' => odbc_result($fila,'AbreviaturaId'),
					'ColorHexa' => odbc_result($fila,'ColorHexa')						
				);					
			}				
		}

		$db->Disconnect();
		return json_encode($datos);

	}

?>