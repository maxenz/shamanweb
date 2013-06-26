<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$idPlan = $_GET["id"];
	
	$SQL = "SELECT planGr.ID as ID,gdo.AbreviaturaId as Grado, gdo.ColorHexa as ColorGrado, CASE WHEN planGr.flgCubierto = 1 THEN 'SI' ELSE 'NO' END AS Cub,";
	$SQL = $SQL . " planGr.CoPago as CoPago, planGr.GradoOperativoId as gOpId "; 
	$SQL = $SQL . " FROM PlanesGradosOperativos planGr ";
	$SQL = $SQL . " INNER JOIN GradosOperativos gdo ON (gdo.ID = planGr.GradoOperativoId) ";
	$SQL = $SQL . " WHERE planGr.PlanId = $idPlan";
	
	$db = new cDB();
	$db->Connect();
	
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

?>