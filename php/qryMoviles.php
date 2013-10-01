<?php

	if (isset($_GET["opt"])) {
	
		require_once("class.shaman.php");
		require_once("class.shaman.cache.php");	
		require_once("genericas.php");	
	
		$opt = $_GET["opt"];
		
		switch ($opt) {
		
			case 0:
				echo getMoviles();
			break;
		
		}
	
	}

	function getQueryMoviles() {

		if(!isset($_SESSION)){

		    session_start();
		}

		if ($_SESSION["v"] == 'express') {

			$db = new cDB();
			$db->Connect();

			$SQL = "SELECT A.ID, B.Movil as Movil, E.ColorHexa as ColorMovil, F.ValorGrilla as Situacion,";
			$SQL .= "F.ColorHexa as ColorSituacion, G.AbreviaturaId as Loc FROM MovilesActuales A ";
			$SQL .= "INNER JOIN Moviles B ON (A.MovilId = B.ID) ";
			$SQL .= "INNER JOIN BasesOperativas C ON (A.BaseOperativaId = C.ID) ";
			$SQL .= "INNER JOIN Localidades D ON (C.LocalidadId = D.ID) ";
			$SQL .= "INNER JOIN ZonasGeograficas E ON (D.ZonaGeograficaId = E.ID) ";
			$SQL .= "INNER JOIN SucesosIncidentes F ON (A.SucesoIncidenteId = F.ID) ";
			$SQL .= "INNER JOIN Localidades G ON (A.LocalidadId = G.ID) ";
			$SQL .= "ORDER BY B.Movil";

			$db->Query($SQL);

			return $db;

		} else {

			$db = new cDBCache();
			$db->Connect();

			$SQL = "SELECT MovilId Movil,MovilId->BaseOperativaId->LocalidadId->ZonaGeograficaId->VisualColor ColorLoc,";
 			$SQL .= "CASE EstadoId WHEN 'L' THEN CASE MovilId->BaseOperativaId->LocalidadId->AbreviaturaId ";
 			$SQL .= "WHEN LocalidadId->AbreviaturaId THEN 'Bas' ELSE EstadoId->Abreviatura END ELSE ";
 			$SQL .= "EstadoId->Abreviatura END Situacion,EstadoId->VisualColor Colorsituacion,";
 			$SQL .= "CASE ISNULL(MotivoCondicionalId, 0) WHEN 0 THEN CASE EstadoId WHEN 'L' THEN ";
			$SQL .= "CASE MovilId->BaseOperativaId->LocalidadId->AbreviaturaId WHEN LocalidadId->AbreviaturaId ";
			$SQL .= "THEN MovilId->BaseOperativaId->AbreviaturaId ELSE LocalidadId->AbreviaturaId END ELSE ";
			$SQL .= "LocalidadId->AbreviaturaId END ELSE MotivoCondicionalId->MotivoCondicionalId END Loc ";
			$SQL .= "FROM Emergency.MovilesActuales WHERE (MovilId->TipoMovilOpeId->flgDespachable = 1) ";
			$SQL .= "ORDER BY MovilId->BaseOperativaId->LocalidadId->ZonaGeograficaId, EstadoId->OrdenDespacho,";
			$SQL .= "EstadoId, MovilId";

			$db->Query($SQL);

			return $db;

		}
	}
	
	function getMoviles() {
	
		$db = getQueryMoviles();
				
			while($fila = $db->Next()) {

				//$colLoc = odbc_result($fila,'ColorLoc');
				//$colLoc = getColor($colLoc);
				$colSituacion = odbc_result($fila,'ColorSituacion');
				$colSituacion = getColor($colSituacion);
				
				$datos[] = array(
					'Movil' => odbc_result($fila,'Movil'),
					'ColorMovil' => odbc_result($fila,'ColorMovil'),
					'ColorSituacion' => $colSituacion,
					'Localidad' => odbc_result($fila,'Loc'),
					'Situacion' => odbc_result($fila,'Situacion'),	
					//'ColorLocalidad' => $colLoc,    
				);
				
			}
		
			return json_encode($datos);
					
		$db->Disconnect();	
	
	}

?>