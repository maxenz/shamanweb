<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];
	$fecha = filter_input(INPUT_GET,'fecha',FILTER_SANITIZE_STRING);
	$idViaje = filter_input(INPUT_GET,'idViaje',FILTER_SANITIZE_STRING);
	$mov = filter_input(INPUT_GET,'mov',FILTER_SANITIZE_STRING);
	$tServ = filter_input(INPUT_GET,'tServ',FILTER_SANITIZE_STRING);
	$user = getUserId();
	$fechaActual = date("Y-d-m H:i:s");
	
	switch ($opt) {
	
		case 0:
			preasignar($idViaje,$mov);
		break;
		
		case 1:
			$cond = filter_input(INPUT_GET,'cond',FILTER_SANITIZE_STRING);
			despachar($idViaje,$mov,$fechaActual,$tServ,$cond);
		break;
	}
	
	function preasignar($idViaje,$mov) {

		$db = new cDB();
		$db->Connect();
		
		if ($mov == "0") {

			$idMov = 0;

		} else {

			$SQL = "SELECT ID FROM Moviles WHERE Movil = '$mov' ";
			$idMov = getID($SQL,$db);
		}

	
		$SQL = "UPDATE IncidentesViajes SET MovilPreasignadoId = $idMov WHERE ID = $idViaje";
		$db->Query($SQL);
		$db->Disconnect();
	
	}
	
	function despachar($idViaje,$mov,$fechaActual,$tServ,$cond){

		try {

  			$conn = new PDO('odbc:shamanexpress', 'dbaadmin', 'yeike', 
      		array(PDO::ATTR_PERSISTENT => true));
  			
		} catch (Exception $e) {

  			die("No se pudo conectar: " . $e->getMessage());

		}

		try { 

		 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->beginTransaction();

			$idMov = getMovilId($mov);

			insertIncidentesSucesos($conn,$tServ,$idMov,$cond,$idViaje,$fechaActual);
			updateMovilesActuales($conn,$tServ,$idMov,$cond,$idViaje,$fechaActual);
			updateIncidentesViajes($conn,$idMov,$fechaActual,$idViaje);
			//insertMovilesSucesos($conn,$idMov,$fechaActual);
			$conn->commit();

		  
		} catch (Exception $e) {

		  	$conn->rollBack();
		  	echo "Fallo: " . $e->getMessage();
		}
	
	}

	function insertMovilesSucesos($conn,$idMov,$fechaActual) {

		$idSucesoInc = getLastSucesoInc($conn);
		$SQL = "INSERT INTO MovilesSucesos ";
		$SQL .= "(MovilId,FechaHoraSuceso,IncidenteSucesoId,regUsuarioid) VALUES ";
		$SQL .= "($idMov,'".$fechaActual."',$idSucesoInc,1)";
		$conn->exec($SQL);

	}

	function updateIncidentesViajes($conn,$idMov,$fechaActual,$idViaje) {

		$SQL = "UPDATE IncidentesViajes SET ";
		$SQL.= " MovilId = $idMov, horSalida = '".$fechaActual."', horDespacho = '".$fechaActual."'";
		$conn->exec($SQL);
	}

	function insertIncidentesSucesos($conn,$tServ,$idMov,$cond,$idViaje,$fechaActual) {

		$sucIncId = getSucesoIncidenteId($tServ);
		$SQL = "INSERT INTO IncidentesSucesos ";
		$SQL.= "(IncidenteViajeId,FechaHoraSuceso,SucesoIncidenteId,MovilId,Condicion,regUsuarioId) ";
		$SQL.= "VALUES ($idViaje,'".$fechaActual."',$sucIncId,$idMov,'".$cond."',1)";
		$conn->exec($SQL);

	}

	function updateMovilesActuales($conn,$tServ,$idMov,$cond,$idViaje,$fechaActual) {

		if ($tServ == 'S') {			//Si es un movil..

			$sucIncId = getSucesoIncidenteId($tServ);
			$localidadId = getLocalidadId($idViaje);
			$SQL = "UPDATE MovilesActuales SET ";
			$SQL.= " SucesoIncidenteId = $sucIncId, IncidenteViajeId = $idViaje, LocalidadId = $localidadId,  ";
			$SQL.= " FechaHoraMovimiento = '".$fechaActual."'";
			$SQL.= " WHERE MovilId = $idMov";
			$conn->exec($SQL);

		}	
	}

	function getLastSucesoInc($conn) {

		$idLastSucesoInc = 0;
		$SQL = "SELECT TOP 1 ID FROM IncidentesSucesos ORDER BY ID DESC ";
		foreach ($conn->query($SQL) as $row) {
			$idLastSucesoInc = $row['ID'];
    	}

		return $idLastSucesoInc;

	}

	function getLocalidadId($idViaje) {

		$db = new cDB();
		$db->Connect();

		$SQL = "SELECT incdom.LocalidadId AS ID FROM IncidentesViajes vij ";
		$SQL.= "LEFT JOIN IncidentesDomicilios incdom  ON (incdom.ID = vij.IncidenteDomicilioId) ";
		$SQL.= " WHERE vij.ID = $idViaje ";
		$idLoc = getID($SQL,$db);

		$db->Disconnect();

		return $idLoc;
	}

	function getMovilId($mov) {

		$db = new cDB();
		$db->Connect();

		$SQL = "SELECT ID FROM Moviles WHERE Movil = '$mov'";
		$idMov = getID($SQL,$db);

		$db->Disconnect();

		return $idMov;
			
	}

	function getSucesoIncidenteId($tServ) {

		$db = new cDB();
		$db->Connect();

		$SQL = "SELECT ID FROM SucesosIncidentes WHERE AbreviaturaId = '".$tServ."'";
		$idSucInc = getID($SQL,$db);

		$db->Disconnect();

		return $idSucInc;
			
	}

?>