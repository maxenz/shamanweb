<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];
	
	switch ($opt) {
		
		case 0:
			getPlanesCobertura();
		break;	
		
		case 1:
			setDefaultPlan();
		break;
		
		case 2:
			$cod = filter_input(INPUT_GET,'cod',FILTER_SANITIZE_STRING);
			$desc = filter_input(INPUT_GET,'desc',FILTER_SANITIZE_STRING);
			$obs = filter_input(INPUT_GET,'obs',FILTER_SANITIZE_STRING);
			$id = $_GET["id"];
			$pArray = $_GET["pArray"];
			setPlan($cod,$desc,$obs,$pArray,$id);
		break;
		
		case 3:
			$idPlan = $_GET["id"];
			deletePlan($idPlan);
		break;
		
		case 4:
			$idPlan = $_GET["id"];
			getPlanes($idPlan);
		break;
						
	}
	
	function getPlanesCobertura() {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT ID,AbreviaturaId,Descripcion,Observaciones FROM Planes";
		
		$db->Query($SQL);
		
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {
				
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'AbreviaturaId' => odbc_result($fila,'AbreviaturaId'),
				'Descripcion' => odbc_result($fila,'Descripcion'),
				'Observaciones' => odbc_result($fila,'Observaciones')
				);
			}
			
			echo json_encode($datos);
		}
		
		$db->Disconnect();
	}
	
	function setDefaultPlan(){
		
		$db = new cDB();
		$db->Connect();
		
		$vecGrados = array();
		$user = getUserId();
		
		$SQL = "SELECT DISTINCT ID,AbreviaturaId,ColorHexa FROM GradosOperativos WHERE ID < 13";
		$db->Query($SQL);
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {
				$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'AbreviaturaId' => odbc_result($fila,'AbreviaturaId'),
				'ColorHexa' => odbc_result($fila,'ColorHexa')
				);
			}
			
			echo json_encode($datos);
			
		}
		
		$db->Disconnect();
	}
	
		
	function setPlan($cod,$desc,$obs,$pArray,$id) {
		
		$db = new cDB();
		$db->Connect();
		$user = getUserId();
		
		
		if ($id == 0) {
		$idPlan = 0;			
		$SQL = "INSERT INTO Planes (AbreviaturaId,Descripcion,Observaciones,regUsuarioId)";
		$SQL = $SQL . " VALUES ('$cod','$desc','$obs',$user)";
		$db->Query($SQL);
		
		$SQL = "SELECT TOP 1 ID FROM Planes ORDER BY ID DESC";
		$db->Query($SQL);
		
		if ($db->numrows > 0) {
			if($fila = $db->Next()) {
			
				$idPlan = odbc_result($fila,'ID');
							
			}		
		}
	
		for ($i = 0; $i < sizeof($pArray); $i++) {
		
			$flgCub = 0;
			$gOp = $pArray[$i]["gOpId"];
			$strFlgCub = $pArray[$i]["Cub"];
			if ($strFlgCub == 'SI') $flgCub = 1;		
			$coPago = $pArray[$i]["CoPago"];
			$SQL = "INSERT INTO PlanesGradosOperativos (PlanId,GradoOperativoId,flgCubierto,CoPago,regUsuarioId) ";
			$SQL = $SQL . " VALUES ($idPlan,$gOp,$flgCub,$coPago,$user) ";
			
			$db->Query($SQL);
						
		}	
		
	} else {
		
		$SQL = "UPDATE Planes SET AbreviaturaId = '$cod', Descripcion = '$desc', Observaciones = '$obs' WHERE ID = $id";
		$db->Query($SQL);
		
		for ($i = 0; $i < sizeof($pArray); $i++) {
		
			$flgCub = 0;
			$gOp = $pArray[$i]["gOpId"];
			$strFlgCub = $pArray[$i]["Cub"];
			if ($strFlgCub == 'SI') $flgCub = 1;		
			$coPago = $pArray[$i]["CoPago"];
			$idOpt = $pArray[$i]["ID"];
			
			$SQL = "UPDATE PlanesGradosOperativos SET GradoOperativoId = $gOp,flgCubierto = $flgCub,CoPago = $coPago,regUsuarioId = $user ";
			$SQL = $SQL . " WHERE PlanId = $id AND ID = $idOpt";
			$db->Query($SQL);	
						
		}		
	}
	
	$db->Disconnect();
}
			
	function deletePlan($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "DELETE FROM Planes WHERE ID = " . $id;
		$db->Query($SQL);
		$db->Disconnect();

	}

	
	function getPlanes($idPlan) {
		
		$db = new cDB();
		$db->Connect();
			
		$SQL = "SELECT planGr.ID as ID,gdo.AbreviaturaId as Grado, gdo.ColorHexa as ColorGrado, CASE WHEN planGr.flgCubierto = 1 THEN 'SI' ELSE 'NO' END AS Cub,";
		$SQL = $SQL . " planGr.CoPago as CoPago, planGr.GradoOperativoId as gOpId "; 
		$SQL = $SQL . " FROM PlanesGradosOperativos planGr ";
		$SQL = $SQL . " INNER JOIN GradosOperativos gdo ON (gdo.ID = planGr.GradoOperativoId) ";
		$SQL = $SQL . " WHERE PlanId = $idPlan";
	
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
?>