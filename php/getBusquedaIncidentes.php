<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
	
	$opt = $_GET["opt"];
	
	switch($opt) {
		
		case 0:
			$fDesde = $_GET["fdesde"];
			$fHasta = $_GET["fhasta"];
			getBusquedaClientes($fDesde,$fHasta);
		break;		
	}
	
	function getBusquedaClientes($fDesde,$fHasta) {
		
		$db = new cDB();
		$db->Connect();
		
		$fDesdeRta = $fDesde;
		$fHastaRta = $fHasta;
		
		if ($fDesde == 0) {
			
			$fHasta = getToday();
			$fHastaRta = $fHasta;
			$fHasta = modeloDate($fHasta);
			
			$fDesde = date('Y-m-d', strtotime($fHasta. ' - 30 days'));
			$fDesdeRta = $fDesde;
			$fDesde = modeloDate($fDesde); 
			
			
		} else {
			
			$fDesde = modeloDate($fDesde);
			$fHasta = modeloDate($fHasta);	
			
		}
		
		$SQL = "SELECT inc.ID as ID, inc.FecIncidente as Fecha, inc.NroIncidente as NroInc, gdo.AbreviaturaId as Grado, cli.AbreviaturaId as Cliente, inc.NroAfiliado as NroAf, ";
		$SQL = $SQL . "inc.Paciente as Paciente, dom.Domicilio as Domicilio, loc.AbreviaturaId as Localidad,gdo.ColorHexa as ColorHexa ";
		$SQL = $SQL . "FROM Incidentes inc ";
		$SQL = $SQL . "INNER JOIN IncidentesDomicilios dom ON (inc.ID = dom.IncidenteId) ";
		$SQL = $SQL . "INNER JOIN IncidentesViajes vij ON (dom.ID = vij.IncidenteDomicilioId) ";
		$SQL = $SQL . "INNER JOIN GradosOperativos gdo ON (inc.GradoOperativoId = gdo.ID) ";
		$SQL = $SQL . "INNER JOIN Clientes cli ON (inc.ClienteId = cli.ID) ";
		$SQL = $SQL . "LEFT JOIN Localidades loc ON (dom.LocalidadId = loc.ID) ";
		$SQL = $SQL . "WHERE (inc.FecIncidente BETWEEN convert(datetime,'$fDesde') AND convert(datetime,'$fHasta')) ";
		$SQL = $SQL . "ORDER BY inc.FecIncidente, inc.NroIncidente";
		
		$db->Query($SQL);
		
		while ($fila = $db->Next()) {
			
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'Fecha' => odbc_result($fila,'Fecha'),
				'NroInc' => odbc_result($fila,'NroInc'),
				'Grado' => odbc_result($fila,'Grado'),
				'Cliente' => odbc_result($fila,'Cliente'),
				'NroAf' => odbc_result($fila,'NroAf'),
				'Paciente' => odbc_result($fila,'Paciente'),
				'Domicilio' => odbc_result($fila,'Domicilio'),
				'Localidad' => odbc_result($fila,'Localidad'),
				'ColorHexa' => odbc_result($fila,'ColorHexa')
			);		
		}
		
		$datos2[] = array(
			'fDesde' => $fDesdeRta,
			'fHasta' => $fHastaRta
		);
		
		echo json_encode(array('servicios'=>$datos,'fechas'=>$datos2));
		
			
	}
		
?>