<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];
	
	switch ($opt) {
		
		case 0:
			getMarcasModelos();
		break;	
		
		case 1:
			$id = $_GET["id"];
			deleteMarcaModelo($id);
		break;
		
		case 2:
			$marca = filter_input(INPUT_GET,'marca',FILTER_SANITIZE_STRING);
			$modelo = filter_input(INPUT_GET,'modelo',FILTER_SANITIZE_STRING);
			setMarcasModelos($marca,$modelo);
		break;
		
		case 3:
			$id = $_GET["id"];
			$value = filter_input(INPUT_GET,'value',FILTER_SANITIZE_STRING);
			$campo = filter_input(INPUT_GET,'campo',FILTER_SANITIZE_STRING);
			updateMarcasModelos($id,$value,$campo);
		break;
		
		
	}
	
	
	function getMarcasModelos() {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT ID,Marca,Modelo FROM MarcasModelos";
		
		$db->Query($SQL);
		
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {
				
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'Marca' => odbc_result($fila,'Marca'),
				'Modelo' => odbc_result($fila,'Modelo')
				);
			}
			
			echo json_encode($datos);
		}

		$db->Disconnect();
	}
	
	function deleteMarcaModelo($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "DELETE FROM MarcasModelos WHERE ID = $id";
		
		$db->Query($SQL);	
		$db->Disconnect();	
	}
	
	function setMarcasModelos($marca,$modelo) {
		
		$user = getUserId();
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "INSERT INTO MarcasModelos (Marca,Modelo,regUsuarioId) VALUES ('$marca','$modelo',$user)";
		
		$db->Query($SQL);
		$db->Disconnect();	
	}
	
	function updateMarcasModelos($id,$value,$campo) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "UPDATE MarcasModelos SET " .$campo . " = '$value' WHERE ID = $id";
		
		$db->Query($SQL);
		$db->Disconnect();		
	}

?>