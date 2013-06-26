<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];
	
	switch($opt) {
		
		case 0:
			$cli = $_GET["cli"];
			procesoConsulta($cli);	
		break;
		
		case 1:
			$cli = $_GET["cli"];
			$pArray = $_GET["pArray"];
			updateClienteCobertura($cli,$pArray);
		break;		
	}

	function procesoConsulta($cli) {
	
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT * FROM ClientesGradosOperativos WHERE ClienteId = $cli";
		
		$db->Query($SQL);
		if($db->numrows > 0) {
			
			muestroGrados($cli);
			
		} else {
			
			creoGrados($cli);
		}
		
		$db->Disconnect();	
		
	}
	
	function muestroGrados($cli) {
		
		
		$db = new cDB();
		$db->Connect();
			
		$SQL = "SELECT cliGr.ID as ID,gdo.AbreviaturaId as Grado, gdo.ColorHexa as ColorGrado, CASE WHEN cliGr.flgCubierto = 1 THEN 'SI' ELSE 'NO' END AS Cub,";
		$SQL = $SQL . " cliGr.CoPago as CoPago, cliGr.GradoOperativoId as gOpId "; 
		$SQL = $SQL . " FROM ClientesGradosOperativos cliGr ";
		$SQL = $SQL . " INNER JOIN GradosOperativos gdo ON (gdo.ID = cliGr.GradoOperativoId) ";
		$SQL = $SQL . " WHERE cliGr.ClienteId = $cli";
	
		$db->Query($SQL);
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {
				
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'Grado' => odbc_result($fila,'Grado'),
				'ColorGrado' => odbc_result($fila,'ColorGrado'),
				'Cub' => odbc_result($fila,'Cub'),
				'CoPago' => odbc_result($fila,'CoPago'),
				'gOpId' => odbc_result($fila,'gOpId')
				);
			}
			
			echo json_encode($datos);
		}
		
		$db->Disconnect();	
	}
	
	function creoGrados($cli) {
		
		$db = new cDB();
		$db->Connect();
		
		$vecGrados = array();
		$user = getUserId();
		
		$SQL = "SELECT DISTINCT ID FROM GradosOperativos WHERE ID < 13";
		$db->Query($SQL);
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {
				
				$grado = odbc_result($fila,'ID');
				array_push($vecGrados,$grado);
				
			}
			
			for ($i = 0; $i < sizeof($vecGrados);$i++) {
				
				$SQL = "INSERT INTO ClientesGradosOperativos (ClienteId,GradoOperativoId,flgCubierto,CoPago,regUsuarioId)";
				$SQL = $SQL . "VALUES ($cli,$vecGrados[$i],1,0,$user)";
				
				$db->Query($SQL);
				
			}
			
			muestroGrados($cli);
			
		}
		
		$db->Disconnect();	
			
		
	}
	
	function updateClienteCobertura($cli,$pArray) {
		
		$db = new cDB();
		$db->Connect();
		$user = getUserId();
		
		for ($i = 0; $i < sizeof($pArray); $i++) {
			
			$flgCub = 0;
			$gOp = $pArray[$i]["gOpId"];
			$strFlgCub = $pArray[$i]["Cub"];
			if ($strFlgCub == 'SI') {
				
				 $flgCub = 1;
			} else {
				
				$flgCub = 0;	
			}
			$coPago = $pArray[$i]["CoPago"];
			
			$SQL = "UPDATE ClientesGradosOperativos SET flgCubierto = $flgCub, CoPago = $coPago";
			$SQL = $SQL . " WHERE ClienteId = $cli AND GradoOperativoId = $gOp";
			
			$db->Query($SQL);
							
		}
		
		$db->Disconnect();	
		
	}
	


?>