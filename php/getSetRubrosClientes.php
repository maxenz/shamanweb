<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];
	$user = getUserId();
	
	switch ($opt) {
		
		case 0:
			getRubrosClientes();
		break;	
		
		case 1:
			$cod = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_STRING);
			$desc = filter_input(INPUT_GET, "desc", FILTER_SANITIZE_STRING);
			setRubroCliente($cod,$desc,$user);
		break;
		
		case 2:
			$id = $_GET["id"];
			deleteRubroCliente($id);
		break;
		
		case 3:
			$id = $_GET["id"];
			$value = filter_input(INPUT_GET, "value", FILTER_SANITIZE_STRING);
			$campo = filter_input(INPUT_GET, "campo", FILTER_SANITIZE_STRING);
			updateRubroCliente($id,$value,$campo);
		break;
		
	}

	function getRubrosClientes() {

		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT ID,AbreviaturaId,Descripcion FROM RubrosClientes";
		
		$db->Query($SQL);
		if ($db->numrows > 0) {
			while ($fila = $db->Next()) {
		
				$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'AbreviaturaId' => odbc_result($fila,'AbreviaturaId'),
				'Descripcion' => odbc_result($fila,'Descripcion')
				);	
			}
			
			echo json_encode($datos);
		}
		
		$db->Disconnect();
	}
	
	function setRubroCliente($cod,$desc,$user) {
		
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "INSERT INTO RubrosClientes (AbreviaturaId,Descripcion,regUsuarioId) VALUES ('$cod','$desc',$user)";
		$db->Query($SQL);
		$db->Disconnect();
					
	}
	
	function deleteRubroCliente($id) {
	
		$db = new cDB();
		$db->Connect();
		
		$SQL = "DELETE FROM RubrosClientes WHERE ID = $id";
		
		$db->Query($SQL);
		$db->Disconnect();		
		
		
	}
	
	function updateRubroCliente($id,$value,$campo) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "UPDATE RubrosClientes SET " .$campo . " = '$value' WHERE ID = $id";
		
		$db->Query($SQL);	
		$db->Disconnect();	
	}



?>