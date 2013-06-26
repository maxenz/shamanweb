<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];
	$idCli = $_GET["id"];
	
	$idUser = getUserId();
	
	switch ($opt){
		
		case 0:			
			getContactos($idCli);
		break;
		
		case 1:
			$nom = filter_input(INPUT_GET,'nom',FILTER_SANITIZE_STRING);
			$tel = filter_input(INPUT_GET,'tel',FILTER_SANITIZE_STRING);
			$email = filter_input(INPUT_GET,'email',FILTER_SANITIZE_STRING);
			setContacto($nom,$tel,$email,$idCli,$idUser);
		break;
		
		case 2:
			$contactoId = $_GET["ctId"];
			deleteContacto($contactoId);
		break;	
		case 3:
			$nom = filter_input(INPUT_GET,'nom',FILTER_SANITIZE_STRING);
			$tel = filter_input(INPUT_GET,'tel',FILTER_SANITIZE_STRING);
			$email = filter_input(INPUT_GET,'email',FILTER_SANITIZE_STRING);
			$ctId = $_GET["idCt"];
			updateContacto($ctId,$nom,$tel,$email);
		break;
		
	}
	
	function updateContacto($ctId,$nom,$tel,$email) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "UPDATE ClientesContactos SET Email = '$email', Telefono = '$tel', Nombre = '$nom' WHERE ID = $ctId";
		$db->Query($SQL);

		$db->Disconnect();	
		
	}
	
	function deleteContacto($contactoId) {
		
		$db = new cDB();
		$db->Connect();	
		
		$SQL = "DELETE FROM ClientesContactos WHERE ID = $contactoId";
		
		$db->Query($SQL);
		
		$db->Disconnect();
	}
	
	function getContactos($idCli) {

		$db = new cDB();
		$db->Connect();
	
		$SQL = "SELECT ID, Nombre, Email, Telefono FROM ClientesContactos WHERE ClienteId = $idCli";

		$db->Query($SQL);
		if ($db->numrows > 0) {
			while ($fila = $db->Next()) {
		
				$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'Nombre' => odbc_result($fila,'Nombre'),
				'Email' => odbc_result($fila,'Email'),
				'Telefono' => odbc_result($fila,'Telefono')	
				);
			}
		
			echo json_encode($datos);
		}
		
		$db->Disconnect();
	}
	
	function setContacto($nom,$tel,$email,$idCli,$idUser) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "INSERT INTO ClientesContactos (ClienteId,Nombre,Email,Telefono,regUsuarioId) ";
		$SQL = $SQL . " VALUES ($idCli,'$nom','$email','$tel',$idUser)";
		
		$db->Query($SQL);
		
		$db->Disconnect();
		
	}

?>