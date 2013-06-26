<?php

		
	$opt = $_GET["opt"];
	$loc = filter_input(INPUT_GET,'loc',FILTER_SANITIZE_STRING);
	$gdo = filter_input(INPUT_GET,'gdo',FILTER_SANITIZE_STRING);
	$vecID = getGradoLocID($loc,$gdo);
	$locID = $vecID[0];
	$gdoID = $vecID[1];

	switch ($opt) {
		
		case 0:
			echo getMovilesSugerencia($locID,$gdoID);
		break;	
		
		case 1:
			echo getEmpresasSugerencia($locID,$gdoID);
		break;	
	
	}
	
	function getGradoLocID($loc,$gdo) {
		
		$gdoID = 0;
		$locID = 0;
		
		require_once("class.shaman.php");
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT ID FROM Localidades WHERE AbreviaturaId = '" .$loc . "'";
		
		$db->Query($SQL);
		if ($db->numrows > 0) {
			if($fila = $db->Next()) {
				
				$locID= odbc_result($fila,'ID');
				
			}
			
		}
		
		$SQL = "SELECT ID FROM GradosOperativos WHERE AbreviaturaId = '" .$gdo ."'";
		
		$db->Query($SQL);
		if ($db->numrows > 0) {
			if($fila = $db->Next()) {
				
				$gdoID = odbc_result($fila,'ID');
					
			}
			
		}
		
		$vecID = array();
		
		array_push($vecID,$locID);
		array_push($vecID,$gdoID);
		$db->Disconnect();
		return $vecID;
		
	}


	function getMovilesSugerencia($locID,$gdoID) {
		
		require_once("class.shaman.php");

		$db = new cDB();
		$db->Connect();
			
		$SQL = "SELECT A.ID, B.Movil, C.Descripcion as TipoMovil, D.Descripcion as EstMovil FROM MovilesActuales A ";
		$SQL = $SQL . "INNER JOIN Moviles B ON (A.MovilId = B.ID) ";
		$SQL = $SQL . "INNER JOIN TiposMoviles C ON (A.TipoMovilId = C.ID) ";
		$SQL = $SQL . "INNER JOIN SucesosIncidentes D ON (A.SucesoIncidenteId = D.ID) ";
		$SQL = $SQL . "WHERE A.MovilId IN(SELECT MovilId FROM MovilesLocalidades WHERE (LocalidadId =  " . $locID . ")) ";
		$SQL = $SQL . "AND A.TipoMovilId IN(SELECT TipoMovilId FROM TiposMovilesGrados WHERE (GradoOperativoId =  " . $gdoID . ")) ";
		$SQL = $SQL . "ORDER BY D.Orden";

		$db->Query($SQL);
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {
				
				$datos[] = array(
					'ID' => odbc_result($fila,'ID'),
					'Movil' => odbc_result($fila,'Movil'),
					'TipoMovil' => odbc_result($fila,'TipoMovil'),
					'EstMovil' => odbc_result($fila,'EstMovil')	
				);
				
			}
			$db->Disconnect();	
			return json_encode($datos);
			
		} else {
		
			$db->Disconnect();	
		}
	}


	function getEmpresasSugerencia($locID,$gdoID) {
		
		
		require_once("class.shaman.php");
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT A.ID, B.Movil, A.RazonSocial, C.Descripcion FROM Prestadores A ";
		$SQL = $SQL . "INNER JOIN Moviles B ON (A.ID = B.PrestadorId) ";
		$SQL = $SQL . "INNER JOIN TiposMoviles C ON (B.TipoMovilId = C.ID) ";
		$SQL = $SQL . "WHERE B.ID IN(SELECT MovilId FROM MovilesLocalidades WHERE (LocalidadId =  " . $locID . ")) ";
		$SQL = $SQL . "AND B.TipoMovilId IN(SELECT TipoMovilId FROM TiposMovilesGrados WHERE (GradoOperativoId =  " . $gdoID . ")) ";
		$SQL = $SQL . "ORDER BY B.Movil";

		$db->Query($SQL);
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {
				
				$datos[] = array(
					'ID' => odbc_result($fila,'ID'),
					'AbreviaturaId' => odbc_result($fila,'Movil'),
					'RazonSocial' => odbc_result($fila,'RazonSocial'),
					'TipoCobertura' => odbc_result($fila,'Descripcion')	
				);
				
			}
				$db->Disconnect();	
				return json_encode($datos);
			
		} else {
		
				$db->Disconnect();	
		}
	}

?>