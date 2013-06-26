<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];
	$cli = $_GET["cli"];
	$nroAf = $_GET["nroAf"];
	
	$cliIntId = getCliIntId($cli,$nroAf);
	
	switch ($opt) {
		
		case 0:
			if ($cliIntId == 0) {
				echo json_encode(array('paciente'=>0,'hClinica'=>0));
			} else {
				$jPacientes = getPaciente($cliIntId);
				$jHistoria = getHistoriaClinica($cliIntId,0,0);
				echo json_encode(array('paciente'=>$jPacientes,'hClinica'=>$jHistoria));
			}
		break;	
		
		case 1:
			$fDesde = $_GET["fDesde"];
			$fHasta = $_GET["fHasta"];
			$jHistoria = getHistoriaClinica($cliIntId,$fDesde,$fHasta);
			echo json_encode($jHistoria);
		break;
				
	}
	
	function getCliIntId($cli,$nroAf) {
		
		$db = new cDB();
		$db->Connect();
		
		$id = 0;
		$idCli = 0;	
		
		$SQL = "SELECT ID FROM Clientes WHERE AbreviaturaId = '$cli'";
		$db->Query($SQL);
		
		if ($fila = $db->Next()) {
			
			 $idCli = odbc_result($fila,'ID');
		}
		
		$SQL = "SELECT ID FROM ClientesIntegrantes WHERE ClienteId = $idCli AND NroAfiliado = '$nroAf'";
		$db->Query($SQL);
		
		if ($db->numrows > 0 ) {
			if ($fila = $db->Next()) {
				
				$id = odbc_result($fila,'ID');	
				
			}
			
			return $id;
		
		} else {
			
			return 0;
		}
	}
	
	
	function getPaciente($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$fDesde = getFechaHistoria();
		$fHasta = getToday();
		
		$SQL = "SELECT cli.AbreviaturaId as Cliente,ci.NroAfiliado as NroAfiliado, (ci.Apellido + ', ' + ci.Nombre) as Paciente,ci.Sexo as Sexo,";
		$SQL = $SQL . "ci.FecNacimiento as FecNacimiento,ci.Domicilio as Domicilio, loc.AbreviaturaId as Loc,ci.Telefono01 as Telefono,ci.Observaciones as Observ ";
		$SQL = $SQL . " FROM ClientesIntegrantes ci ";
		$SQL = $SQL . " INNER JOIN Clientes cli ON (cli.ID = ci.ClienteId) ";
		$SQL = $SQL . " INNER JOIN Localidades loc ON (loc.ID = ci.LocalidadId) ";
		$SQL = $SQL . " WHERE ci.ID = $id";

		$db->Query($SQL);
		
		if ($db->numrows > 0 ) {
			
			if ($fila = $db->Next()) {
				
				$fecNac = substr(odbc_result($fila,'FecNacimiento'),0,10);
				
				$fecNac = (string)$fecNac;
				
				$edad = getEdad($fecNac);
				
				$datos[] = array(
				
					'Cliente' => odbc_result($fila,'Cliente'),
					'NroAfiliado' => odbc_result($fila,'NroAfiliado'),
					'Paciente' => odbc_result($fila,'Paciente'),
					'Sexo' => odbc_result($fila,'Sexo'),
					'Edad' => $edad,
					'Domicilio' => odbc_result($fila,'Domicilio'),
					'Loc' => odbc_result($fila,'Loc'),
					'Telefono' => odbc_result($fila,'Telefono'),
					'Observ' => odbc_result($fila,'Observ'),
					'FDesde' => $fDesde,
					'FHasta' => $fHasta
				);			
			}
			
			return $datos;	
		
		} else {
			
			return 0;
			
		}
	}
	
	
	function getHistoriaClinica($id,$fDesde,$fHasta) {
	
		$db = new cDB();
		$db->Connect();
		
		if ($fDesde == 0){
		
			$fDesde = getFechaHistoria();
			$fHasta = getToday();
			
		}
	
		$fDesde = modeloDate($fDesde);
		$fHasta = modeloDate($fHasta); 
			
		$SQL = "SELECT inc.ID as ID, inc.FecIncidente as FecIncidente, inc.NroIncidente as NroIncidente, gdo.VisualColor, gdo.AbreviaturaId as Grado, inc.Paciente as Paciente, ";
		$SQL = $SQL . "inc.Sintomas as Sintomas, dig.Descripcion as Diagnostico, mov.Movil as Movil, gdo.ColorHexa as ColorHexa ";
		$SQL = $SQL . "FROM Incidentes inc ";
		$SQL = $SQL . "INNER JOIN IncidentesDomicilios dom ON (inc.ID = dom.IncidenteId) ";
		$SQL = $SQL . "INNER JOIN IncidentesViajes vij ON (dom.ID = vij.IncidenteDomicilioId) ";
		$SQL = $SQL . "INNER JOIN GradosOperativos gdo ON (inc.GradoOperativoId = gdo.ID) ";
		$SQL = $SQL . "INNER JOIN Clientes cli ON (inc.ClienteId = cli.ID) ";
		$SQL = $SQL . "LEFT JOIN Diagnosticos dig ON (vij.DiagnosticoId = dig.ID) ";
		$SQL = $SQL . "LEFT JOIN Moviles mov ON (vij.MovilId = mov.ID) ";
		$SQL = $SQL . "WHERE (inc.FecIncidente BETWEEN convert(datetime,'$fDesde') AND convert(datetime,'$fHasta')) ";
		$SQL = $SQL . "AND (vij.ViajeId <> 'VUE') ";
		$SQL = $SQL . "AND (inc.ClienteIntegranteId = $id) ";
		$SQL = $SQL . "ORDER BY inc.FecIncidente DESC, inc.NroIncidente DESC";
		
		$db->Query($SQL);
		
		if ($db->numrows > 0) {
		
			while ($fila = $db->Next()) {
				
				$datos2[] = array(
					'ID' => odbc_result($fila,'ID'),
					'NroIncidente' => odbc_result($fila,'NroIncidente'),
					'FecIncidente' => odbc_result($fila,'FecIncidente'),
					'Grado' => odbc_result($fila,'Grado'),
					'Paciente' => odbc_result($fila,'Paciente'),
					'Sintomas' => odbc_result($fila,'Sintomas'),
					'Diagnostico' => odbc_result($fila,'Diagnostico'),
					'Movil' => odbc_result($fila,'Movil'),
					'ColorHexa' => odbc_result($fila,'ColorHexa')
				);	
			}
		
			return $datos2;
		
		} else {
			
			return 0;	
		}
	
	}






?>