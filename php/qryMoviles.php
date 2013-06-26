<?php

		
	
	if (isset($_GET["opt"])) {
	
		require("class.shaman.php");
	
		$opt = $_GET["opt"];
		
		switch ($opt) {
		
			case 0:
				echo getMoviles();
			break;
		
		
		}
	
	}
	
	function getMoviles() {
	
		$db = new cDB();
		$db->Connect();
		
			$SQLMOV = "SELECT A.ID, B.Movil as Movil, E.ColorHexa as ColorMovil, F.ValorGrilla as Situacion, F.ColorHexa as ColorSituacion, G.AbreviaturaId as Loc FROM MovilesActuales A ";
			$SQLMOV = $SQLMOV . "INNER JOIN Moviles B ON (A.MovilId = B.ID) ";
			$SQLMOV = $SQLMOV . "INNER JOIN BasesOperativas C ON (A.BaseOperativaId = C.ID) ";
			$SQLMOV = $SQLMOV . "INNER JOIN Localidades D ON (C.LocalidadId = D.ID) ";
			$SQLMOV = $SQLMOV . "INNER JOIN ZonasGeograficas E ON (D.ZonaGeograficaId = E.ID) ";
			$SQLMOV = $SQLMOV . "INNER JOIN SucesosIncidentes F ON (A.SucesoIncidenteId = F.ID) ";
			$SQLMOV = $SQLMOV . "INNER JOIN Localidades G ON (A.LocalidadId = G.ID) ";
			$SQLMOV = $SQLMOV . "ORDER BY B.Movil";

		$db->Query($SQLMOV);
		
		if ($db->numrows > 0) {
			
			while($fila = $db->Next()) {
				
				$datos[] = array(
					'Movil' => odbc_result($fila,'Movil'),
					'ColorMovil' => odbc_result($fila,'ColorMovil'),
					'ColorSituacion' => odbc_result($fila,'ColorSituacion'),
					'Localidad' => odbc_result($fila,'Loc'),
					'Situacion' => odbc_result($fila,'Situacion'),	    
				);
				
			}
		
			return json_encode($datos);
			
			
		} else {
			return "La tabla regiones está vacía.<br />";
		}
		
		$db->Disconnect();	
	
	}

?>