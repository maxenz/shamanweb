<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];

	switch($opt) {
		
		case 0:
			$id = $_GET["id"];
			getVehiculos($id);
		break;
		
		case 1:
			setGrilla($cliente);
		break;	
		
		case 2:
			getMarcasModelos();
		break;
		
		case 3:
			$pArray = $_POST["pArray"];
			insertoVehiculo($pArray);
		break;
		
		case 4:
			$id = $_GET["id"];
			deleteVehiculo($id);
		break;
		
	}
	
	function getVehiculos($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT veh.ID,veh.Dominio, veh.Situacion, veh.flgPropio, veh.PrestadorId, veh.NroMotor, veh.NroChasis, veh.Anio, veh.TipoCombustible, ";
		$SQL = $SQL . "(mm.Marca + ' - ' + mm.Modelo) as MarcaModelo, veh.MarcaModeloId as MarcaModeloId ";
		$SQL = $SQL . " FROM Vehiculos veh  ";
		$SQL = $SQL . " INNER JOIN MarcasModelos mm ON (mm.ID = veh.MarcaModeloId) ";
		if ($id <> 0) $SQL = $SQL . " WHERE veh.ID  = $id";
		
		$db->Query($SQL);
		
		while($fila = $db->Next()) {
			$sit = odbc_result($fila,'Situacion');
			$sit = getSituacion($sit);
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'Dominio' => odbc_result($fila,'Dominio'),
				'MarcaModelo' => odbc_result($fila,'MarcaModelo'),
				'Situacion' => $sit,
				'flgPropio' => odbc_result($fila,'flgPropio'),
				'NroMotor' => odbc_result($fila,'NroMotor'),
				'NroChasis' => odbc_result($fila,'NroChasis'),
				'Anio' => odbc_result($fila,'Anio'),
				'TipoCombustible' => odbc_result($fila,'TipoCombustible'),
				'MarcaModeloId' => odbc_result($fila,'MarcaModeloId')
			);	
			
		}
		
		echo json_encode($datos);
		$db->Disconnect();
			
	}
	
	  function getSituacion($sit) {
	  
	  	$strSit = "";
	  	switch ($sit) {
		  
			case 0 :
			 	$strSit = "BAJA";
			break;
			
			case 1 : 
				$strSit = "ASIGNADO";
			break;
			
			case 2 :
				 $strSit = "SIN ASIGNAR";
			break;
			
			case 3 :
				 $strSit = "MULETO" ;
			break;
				  
	 	 }
		 
		return $strSit;    
                
    }
	
	function getMarcasModelos() {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT ID, (Marca + ' - ' + Modelo) as MarcaModelo FROM MarcasModelos ";
		
		$db->Query($SQL);
		
		while($fila = $db->Next()) {
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'MarcaModelo' => odbc_result($fila,'MarcaModelo'),	
			);	
			
		}
		
		echo json_encode($datos);
		$db->Disconnect();		
	}
	
	function insertoVehiculo($pArray) {
		
		$db = new cDB();
		$db->Connect();
		
		$dominio = filter_var($pArray[0],FILTER_SANITIZE_STRING);
		$anio = filter_var($pArray[1],FILTER_SANITIZE_STRING);
		$motor = filter_var($pArray[2],FILTER_SANITIZE_STRING);
		$chasis = filter_var($pArray[3],FILTER_SANITIZE_STRING);
		$prop = filter_var($pArray[4],FILTER_SANITIZE_STRING);
		$movil = filter_var($pArray[5],FILTER_SANITIZE_STRING);
		$marcModId = $pArray[6];
	    $combust = $pArray[7];
		$sit = $pArray[8];
		$userId = getUserId();
		
		if ($_GET["optInsModif"] == 0) {
		
			$SQL = "INSERT INTO Vehiculos (Dominio,MarcaModeloId,Situacion,flgPropio,PrestadorId,NroMotor,NroChasis,Anio,TipoCombustible,regUsuarioId) ";
			$SQL = $SQL . "VALUES ('$dominio','$marcModId','$sit',1,0,'$motor','$chasis','$anio','$combust',$userId)";
			echo 0;
			
		} else {
				
			$idVeh = $pArray[9];
			$SQL = "UPDATE Vehiculos SET Dominio = '$dominio', MarcaModeloId = '$marcModId', Situacion = '$sit', NroMotor = '$motor',";
			$SQL = $SQL . "NroChasis = '$chasis',Anio = '$anio', TipoCombustible = '$combust', regUsuarioId = $userId";
			$SQL = $SQL . " WHERE ID = $idVeh";		
			echo 1;
		}

			$db->Query($SQL);
			$db->Disconnect();
	}
	
	function deleteVehiculo($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "DELETE FROM Vehiculos WHERE ID = $id";
		
		$db->Query($SQL);
		$db->Disconnect();
	}
	

?>