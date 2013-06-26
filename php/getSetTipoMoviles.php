<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];

	switch($opt) {
		
		case 0:
			$id = $_GET["id"];
			getTipoMoviles($id);
		break;
		
		case 1:
			getGrados();
		break;
		
		case 2:
			$id = $_GET["id"];
			deleteTipoMovil($id);
		break;
		
		case 3:
			$id = $_GET["id"];
			getGradosSel($id);
		break;
		
		case 4:
			$id = $_GET["id"];
			getGradosNoSel($id);
		break;
		
		case 5:
			$id = $_GET["id"];
			$pArray = $_POST["pArray"];
			setUpdateTipoMovil($pArray,$id);
		break;
		
	}
	
	function deleteTipoMovil($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "DELETE FROM TiposMoviles WHERE ID = $id";
		
		$db->Query($SQL);
		$db->Disconnect();
	
	}
	
	function getTipoMoviles($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT ID,AbreviaturaId,Descripcion,flgDespachable FROM TiposMoviles ";
		if ($id <> 0) $SQL = $SQL . " WHERE ID  = $id";
		
		$db->Query($SQL);
		
		while($fila = $db->Next()) {
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'AbreviaturaId' => odbc_result($fila,'AbreviaturaId'),
				'Descripcion' => odbc_result($fila,'Descripcion'),
				'flgDespachable' => odbc_result($fila,'flgDespachable')		
			);	
			
		}
		
		echo json_encode($datos);
		$db->Disconnect();		
	}
	
	function getGrados() {

		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT ID,Descripcion,AbreviaturaId,ColorHexa FROM GradosOperativos";
			
		
		$db->Query($SQL);
		if ($db->numrows > 0 ) {
			
			while ($fila = $db->Next()) {
				
				$datos[] = array(
					'ID' => odbc_result($fila,'ID'),
					'Descripcion' => odbc_result($fila,'Descripcion'),
					'AbreviaturaId' => odbc_result($fila,'AbreviaturaId'),
					'ColorHexa' => odbc_result($fila,'ColorHexa')						
				);	
							
			}			
			
		}

		echo json_encode($datos);
		$db->Disconnect();
	}
	
	function getGradosSel($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT tpmov.GradoOperativoId as ID,gdo.Descripcion as Descripcion FROM TiposMovilesGrados tpmov";
		$SQL = $SQL . " INNER JOIN GradosOperativos gdo ON (gdo.ID = tpMov.GradoOperativoId)";
		$SQL = $SQL . " WHERE tpmov.TipoMovilId = $id";
		
		$db->Query($SQL);
		while ($fila = $db->Next()) {
				
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'Descripcion' => odbc_result($fila,'Descripcion'),						
			);					
		}
		
		echo json_encode($datos);
		$db->Disconnect();
	}
	
	function getGradosNoSel($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT ID,Descripcion FROM GradosOperativos";
		$SQL = $SQL . " WHERE (ID NOT IN (SELECT GradoOperativoId FROM TiposMovilesGrados WHERE (TipoMovilId = $id)))";
		
		$db->Query($SQL);
		while ($fila = $db->Next()) {
				
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'Descripcion' => odbc_result($fila,'Descripcion'),						
			);					
		}
		
		echo json_encode($datos);
		$db->Disconnect();
	}
	
	function setUpdateTipoMovil($pArray,$id) {
		
		$db = new cDB();
		$db->Connect();
		
		$codigo = filter_var($pArray[0],FILTER_SANITIZE_STRING);
		$desc = filter_var($pArray[1],FILTER_SANITIZE_STRING);
		$flgDesp = $pArray[2];
		$userId = getUserId();
		$vGrados = array();
		for ($i = 3; $i < sizeOf($pArray); $i++) {
			
			array_push($vGrados,$pArray[$i]);	
			
		}

		if ($_GET["optInsModif"] == 0) {
		
			$SQL = "INSERT INTO TiposMoviles (AbreviaturaId,Descripcion,flgDespachable,regUsuarioId) ";
			$SQL = $SQL . "VALUES ('$codigo','$desc',$flgDesp,$userId)";
			$db->Query($SQL);
			$SQL = "SELECT TOP 1 ID FROM TiposMoviles ORDER BY ID DESC";
			$db->Query($SQL);
			if ($fila = $db->Next()) {
				
				$idNuevoTipMov = odbc_result($fila,'ID');	
				setGrados($idNuevoTipMov,$vGrados,$db,$userId);
			}
			echo 0;
			
			
		} else {
				
			$SQL = "UPDATE TiposMoviles SET AbreviaturaId = '$codigo', Descripcion = '$desc', flgDespachable = $flgDesp";
			$SQL = $SQL . " WHERE ID = $id";		
			$db->Query($SQL);
			$SQL = "DELETE FROM TiposMovilesGrados WHERE TipoMovilId = $id";
			$db->Query($SQL);
			setGrados($id,$vGrados,$db,$userId);
			echo 1;
		}
		
		$db->Disconnect();
	}
	
	function setGrados($id,$arr,$db,$userId) {
		
		for ($i = 0; $i < sizeOf($arr); $i++) {
			$grado = $arr[$i];
			$SQL = "INSERT INTO TiposMovilesGrados (TipoMovilId,GradoOperativoId,regUsuarioId) VALUES ($id,$grado,$userId)";	
			$db->Query($SQL);
			
		}
		
	}
	
	
	
	
	

?>