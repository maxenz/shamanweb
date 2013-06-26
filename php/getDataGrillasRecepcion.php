<?php
	
	require_once("class.shaman.php");	
	
	$opt = $_GET["opt"];
	$pInc = filter_input(INPUT_GET,'inc',FILTER_SANITIZE_NUMBER_INT);
		
	switch ($opt) {
		
		case 0 :
			
			echo getHistorial($pInc);
			
		break;
			
		case 1 :
					
			echo getProgramacion($pInc);
			
		break;
					
	}
		
		
	function getHistorial($pInc) {
		
		$db = new cDB();
		$db->Connect();
		
			$SQL = "SELECT inc.ID, inc.FechaHoraSuceso as FechaHora, vij.ViajeId, sus.Descripcion AS Estado, mov.Movil AS Movil,";
			$SQL = $SQL . "usr.Nombre as Usuario, inc.Condicion, gdo.flgTraslado ";
			$SQL = $SQL . "FROM IncidentesSucesos inc ";
			$SQL = $SQL . "INNER JOIN SucesosIncidentes sus ON (inc.SucesoIncidenteId = sus.ID) ";
			$SQL = $SQL . "INNER JOIN IncidentesViajes vij ON (inc.IncidenteViajeId = vij.ID) ";
			$SQL = $SQL . "INNER JOIN IncidentesDomicilios dom ON (vij.IncidenteDomicilioId = dom.ID) ";
			$SQL = $SQL . "INNER JOIN Incidentes cab ON (dom.IncidenteId = cab.ID) ";
			$SQL = $SQL . "INNER JOIN GradosOperativos gdo ON (cab.GradoOperativoId = gdo.ID) ";
			$SQL = $SQL . "LEFT JOIN Moviles mov ON (inc.MovilId = mov.ID) ";
			$SQL = $SQL . "INNER JOIN Usuarios usr ON (inc.regUsuarioId = usr.ID) ";
			$SQL = $SQL . "WHERE (dom.IncidenteId = " . $pInc . ") ";
			$SQL = $SQL . "ORDER BY inc.FechaHoraSuceso";
		
		$db->Query($SQL);
		if ($db->numrows > 0) {
			
			while ($fila = $db->Next()) {
				
				$vecHora = explode(" ",odbc_result($fila,'FechaHora'));
				$vecHora2 = explode(".",$vecHora[1]);
				$hora = $vecHora2[0];
				
				$datos[] = array(
					'Hora' => $hora,
					'Estado' => odbc_result($fila,'Estado'),
					'Movil' => odbc_result($fila,'Movil'),
					'Usuario' => odbc_result($fila,'Usuario')
				);
				
			}
			
			echo json_encode($datos);
			
		} else {
			
			echo "No hay datos";	
		}
		
		$db->Disconnect();
	}
	
	function getProgramacion($pInc) {
		
		$db = new cDB();
		$db->Connect();
		
		$vInc = "";
		$SQL = "SELECT IncidenteId FROM IncidentesProgramaciones WHERE IncidentePrgId = " .$pInc;
	
		$db->Query($SQL);
		if ($db->numrows > 0) {
			
			if ($fila = $db->Next()) {
				
				$vInc = odbc_result($fila,'IncidenteId');
				
			}
			
		}
			
		$SQL = "SELECT prg.IncidentePrgId, inc.FecIncidente as FechaHoraInc, inc.NroIncidente AS prgNroIncidente,";
		$SQL = $SQL . " inc.TrasladoId as NroInc, prg.estFechaHora as FechaHoraEstado ";
		$SQL = $SQL . "FROM IncidentesProgramaciones prg ";
		$SQL = $SQL . "INNER JOIN Incidentes inc ON (prg.IncidentePrgId = inc.ID) ";
		$SQL = $SQL . "WHERE (prg.IncidenteId = " . $vInc . ") ";
		$SQL = $SQL . "ORDER BY prg.estFechaHora"	;
			
		$db->Query($SQL);
		if ($db->numrows > 0) {
			
			while ($fila = $db->Next()) {
				
				$vecFechaInc = explode(" ",odbc_result($fila,'FechaHoraInc'));
				$fechaInc = $vecFechaInc[0];
				
				$vecFechaEst = explode(" ",odbc_result($fila,'FechaHoraEstado'));
				
				$vecFechaEst2 = explode(".",$vecFechaEst[1]);
				$horaEstado = $vecFechaEst2[0];
	
				$dia = date( "w", strtotime($vecFechaEst[0]));
				
				switch($dia) {
					
					case 0:
						$dia = "Domingo";
					break;
					
					case 1:
						$dia = "Lunes";
					break;
					
					case 2:
						$dia = "Martes";
					break;
					
					case 3:
						$dia = "Miercoles";
					break;
					
					case 4:
						$dia = "Jueves";
					break;
					
					case 5: 
						$dia = "Viernes";
					break;
					
					case 6:
						$dia = "Sabado";	
					break;
						
				}
				
				$datos[] = array(
					'Fecha' => $fechaInc,
					'Inc' => odbc_result($fila,'prgNroIncidente'),
					'Prg' => odbc_result($fila,'NroInc'),
					'DiaSem' => $dia,
					'Horario' => $horaEstado 
				);
				
			}
			
			echo json_encode($datos);
			
		} else {
			
			echo "No hay datos";	
			
		}
		
		$db->Disconnect();
	}

?>