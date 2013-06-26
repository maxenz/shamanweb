<?php
	
	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$pNroAf = $_GET["pNroAf"];
	
	getDatos($pNroAf);
	
	function getDatos($pNroAf) {
	
		$db = new cDB();
		$db->Connect();
		
		$cli = filter_input(INPUT_GET,'cli',FILTER_SANITIZE_STRING);
		
		$SQL = "SELECT cliInt.NroAfiliado as NroAfiliado, cliInt.Apellido as Apellido, cliInt.Nombre as Nombre, cliInt.FecNacimiento as FecNacimiento,";
		$SQL = $SQL . " cliInt.Sexo as Sexo, cliInt.dmCalle as Calle, cliInt.dmAltura as Altura, cliInt.dmPiso as Piso, cliInt.dmDepto as Depto, ";
		$SQL = $SQL . " cliInt.dmEntreCalle1 as EntreCalle1, cliInt.dmEntreCalle2 as EntreCalle2, cliInt.dmReferencia as Referencia,cliInt.Telefono01 as Tel,";
		$SQL = $SQL . " cliInt.Observaciones as Observ, loc.AbreviaturaId as CodigoLoc, loc.Descripcion as Localidad,cli.AbreviaturaId as Cliente,";
		$SQL = $SQL . " loc2.Descripcion as Partido, cliInt.TipoIntegrante as Tipo ";
		$SQL = $SQL . " FROM ClientesIntegrantes cliInt";
		$SQL = $SQL . " LEFT JOIN Localidades loc ON (loc.ID = cliInt.LocalidadId) ";
		$SQL = $SQL . " LEFT JOIN Localidades loc2 ON (loc2.PartidoId = loc.ID) ";
		$SQL = $SQL . " LEFT JOIN Clientes cli ON (cli.ID = cliInt.ClienteId) " ;
		
		if ($pNroAf == 0) {
			
			$SQL = $SQL . " WHERE cli.AbreviaturaId = '" . $cli . "' " ;
		
		} else {
			
			$nroAf = filter_input(INPUT_GET,'nroAf',FILTER_SANITIZE_STRING);
			
			$SQL = $SQL . " WHERE cli.AbreviaturaId = '" . $cli . "' AND cliInt.NroAfiliado = '" . $nroAf . "' ";
		
		}
	
		$SQL = $SQL . " ORDER BY cliInt.NroAfiliado";
	
	$db->Query($SQL);
	if ($db->numrows > 0) {
		while ($fila = $db->Next()) {
			
			$fecNacimiento = odbc_result($fila,'FecNacimiento');
			$vecFecha = explode(" ",$fecNacimiento);
			$fecha = $vecFecha[0];
			$edad = getEdad($fecha);
			
			$datos[] = array(
			
				'NroAfiliado' => odbc_result($fila,'NroAfiliado'),
				'Apellido' => odbc_result($fila, 'Apellido'),
				'Nombre' => odbc_result($fila,'Nombre'),
				'Edad' => $edad,
				'Sexo' => odbc_result($fila,'Sexo'),
				'Calle' => odbc_result($fila,'Calle'),
				'Altura' => odbc_result($fila,'Altura'),
				'Piso' => odbc_result($fila,'Piso'),
				'Depto' => odbc_result($fila,'Depto'),
				'EntreCalle1' => odbc_result($fila,'EntreCalle1'),
				'EntreCalle2' => odbc_result($fila,'EntreCalle2'),
				'Referencia' => odbc_result($fila,'Referencia'),
				'Tel' => odbc_result($fila,'Tel'),
				'Observ' => odbc_result($fila,'Observ'),
				'CodigoLoc' => odbc_result($fila,'CodigoLoc'),
				'Localidad' => odbc_result($fila,'Localidad'),
				'Partido' => odbc_result($fila,'Partido'),
				'Cliente' => odbc_result($fila,'Cliente'),
				'Tipo' => odbc_result($fila,'Tipo')
			
			);
				
		}
		
			echo json_encode($datos);
			
			
	} else {
		
			echo 0;	
	}
	
	$db->Disconnect();
	
	}
	
	



?>