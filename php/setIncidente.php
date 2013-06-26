<?php
		
	require_once("class.shaman.php");
	require_once("genericas.php");
	
	$opt = $_GET["opt"];
	
	$vecInc = $_POST["pArray"];
	
	setIncidente($vecInc,$opt);

/********* DECLARACION DE FUNCIONES *********/

	function showODBCError() {
		
		if (odbc_error()) {
		
			echo odbc_errormsg();
			
		}		
	}
	
/********************************************/

	function setIncidente($vecInc,$opt) {
	
		$db = new cDB();
		$db->Connect();
		
		$fechaInc = filter_var($vecInc[0],FILTER_SANITIZE_STRING);
		$nroInc = filter_var($vecInc[1],FILTER_SANITIZE_STRING);
		$tel = filter_var($vecInc[2],FILTER_SANITIZE_STRING);
		$cli = filter_var($vecInc[3],FILTER_SANITIZE_STRING);
		$nroAf = filter_var($vecInc[4],FILTER_SANITIZE_STRING);
		$aviso = filter_var($vecInc[5],FILTER_SANITIZE_STRING);
		$abrLoc = filter_var($vecInc[6],FILTER_SANITIZE_STRING);
		$loc = filter_var($vecInc[7],FILTER_SANITIZE_STRING);
		$part = filter_var($vecInc[8],FILTER_SANITIZE_STRING);
		$calle = filter_var($vecInc[9],FILTER_SANITIZE_STRING);
		$altura = filter_var($vecInc[10],FILTER_SANITIZE_NUMBER_INT);
		$piso = filter_var($vecInc[11],FILTER_SANITIZE_STRING);
		$depto = filter_var($vecInc[12],FILTER_SANITIZE_STRING);
		$eCalle1 = filter_var($vecInc[13],FILTER_SANITIZE_STRING);
		$eCalle2 = filter_var($vecInc[14],FILTER_SANITIZE_STRING);
		$ref = filter_var($vecInc[15],FILTER_SANITIZE_STRING);
		$sexo = filter_var($vecInc[16],FILTER_SANITIZE_STRING);
		$edad = filter_var($vecInc[17],FILTER_SANITIZE_NUMBER_INT);
		$sint = filter_var($vecInc[18],FILTER_SANITIZE_STRING);
		$gdo = filter_var($vecInc[19],FILTER_SANITIZE_STRING);
		$paciente = filter_var($vecInc[20],FILTER_SANITIZE_STRING);
		$iva = filter_var($vecInc[21],FILTER_SANITIZE_STRING);
		$plan = filter_var($vecInc[22],FILTER_SANITIZE_STRING);
		$coPago = filter_var($vecInc[23],FILTER_SANITIZE_STRING);
		$observ = filter_var($vecInc[24],FILTER_SANITIZE_STRING);
		$user = filter_var($vecInc[25],FILTER_SANITIZE_STRING);
		
		$dom = $calle . " " . $altura . " " . $piso . " " . $depto;
		
		$SQL = "SELECT ID FROM GradosOperativos WHERE AbreviaturaId = '$gdo' ";
		$idGdo = getId($SQL,$db);
		
		$SQL = "SELECT ID FROM SituacionesIVA WHERE AbreviaturaId = '$iva' ";
		$idIVA = getID($SQL,$db);
		
		$SQL = "SELECT ID FROM Clientes WHERE AbreviaturaId = '$cli' ";
		$idCliente = getID($SQL,$db);
		
		$SQL= "SELECT ID FROM ClientesIntegrantes WHERE ClienteId = '$idCliente' ";
		$idClienteInt = getID($SQL,$db);
		
		$SQL = "SELECT ID FROM Usuarios WHERE Identificacion = '$user' ";
		$idUser = getID($SQL,$db);
		
		if ($opt == 0) {
		
			$SQL = "INSERT INTO Incidentes (FecIncidente,NroIncidente,GradoOperativoId,Telefono,TelefonoFix,ClienteId,ClienteIntegranteId,NroAfiliado,Paciente,Sexo,";
			$SQL = $SQL . "Edad,PlanId,Sintomas,CoPago,flgIvaGravado,Aviso,Observaciones,horLlamada,horInicial,horDespacho,horSalida,horLlegada,horSolDerivacion,";
			$SQL = $SQL . "horDerivacion,horInternacion,horFinalizacion,TrasladoId,trsIdaVuelta,regUsuarioId) ";
			$SQL = $SQL . "VALUES ('$fechaInc','$nroInc',$idGdo,'$tel','45556695',$idCliente,$idClienteInt,'$nroAf',";
			$SQL = $SQL . "'$paciente','$sexo',$edad,'$plan','$sint',$coPago,$idIVA,'$aviso','$observ',";
			$SQL = $SQL . "'2013-04-08 00:00:00','2013-04-08 00:00:00','2013-04-08 00:00:00','2013-04-08 00:00:00','2013-04-08 00:00:00','2013-04-08 00:00:00',";
			$SQL = $SQL . "'2013-04-08 00:00:00','2013-04-08 00:00:00','2013-04-08 00:00:00',0,0,$idUser)"; 
					
		} else {
		
			$SQL = "UPDATE Incidentes SET GradoOperativoId = $idGdo, Telefono = '$tel', ";
			$SQL = $SQL . "TelefonoFix = '$tel', ClienteId = $idCliente, ClienteIntegranteId = $idClienteInt, NroAfiliado = '$nroAf', Paciente = '$paciente',";
			$SQL = $SQL . "Sexo = '$sexo', Edad = $edad, PlanId = '$plan', Sintomas = '$sint', CoPago = $coPago, flgIvaGravado = $idIVA,";
			$SQL = $SQL . "Aviso = '$aviso', Observaciones = '$observ' WHERE FecIncidente = '$fechaInc' AND NroIncidente = '$nroInc'";
				
		}
	   
		$db->Query($SQL);
		
		showODBCError();
		
		$SQL = "SELECT ID FROM Localidades WHERE AbreviaturaId = '$abrLoc' ";
		$idLoc = getID($SQL,$db);
		
		if ($opt == 0) {
		
			$SQL = "SELECT TOP 1 ID FROM Incidentes ORDER BY ID DESC";
			$idInc = getID($SQL,$db);
		
			$SQL = "INSERT INTO IncidentesDomicilios(IncidenteId,TipoDomicilio,NroAnexo,dmCalle,dmAltura,dmPiso,dmDepto,Domicilio,LocalidadId,dmEntreCalle1,dmEntreCalle2,dmReferencia,";
			$SQL = $SQL . "dmLatitud,dmLongitud,SanatorioId,regUsuarioId) ";
			$SQL = $SQL . "VALUES ($idInc,0,0,'$calle','$altura','$piso','$depto','SANTO TOME 6141',$idLoc,'$eCalle1','$eCalle2','$ref',0.00000,0.00000,1,$idUser)";
			
			$db->Query($SQL);
			
			showODBCError();
			
			$SQL = "SELECT TOP 1 ID FROM IncidentesDomicilios ORDER BY ID DESC";
			$idIncDom = getID($SQL,$db);
		
			$SQL = "INSERT INTO IncidentesViajes (IncidenteDomicilioId,ViajeId,flgStatus,flgModoDespacho,horLlamada,horInicial,horDespacho,horSalida,horLlegada,horSolDerivacion,";
			$SQL = $SQL . "horDerivacion,horInternacion,horFinalizacion,reqHorLlegada,reqHorInternacion,MovilId,MovilPreasignadoId,DiagnosticoId,MotivoNoRealizacionId,";
			$SQL = $SQL . "Demora,regUsuarioId)";
			$SQL = $SQL . " VALUES ($idIncDom,'IDA',0,0,'2013-04-08 00:00:00','2013-04-08 00:00:00','2013-04-08 00:00:00','2013-04-08 00:00:00',";
			$SQL = $SQL . "'2013-04-08 00:00:00','2013-04-08 00:00:00','2013-04-08 00:00:00','2013-04-08 00:00:00','2013-04-08 00:00:00','2013-04-08 00:00:00',";
			$SQL = $SQL . "'2013-04-08 00:00:00',23,0,3,0,0,$idUser)";

			$db->Query($SQL);
		
			showODBCError();
		
		} else {
		
			$SQL = "SELECT ID FROM Incidentes WHERE NroIncidente = '$nroInc' AND FecIncidente = '$fechaInc'";
			$idInc = getID($SQL,$db);
			
			$SQL = "UPDATE IncidentesDomicilios SET dmCalle = '$calle', dmAltura = '$altura', dmPiso = '$piso', dmDepto = '$depto',";
			$SQL = $SQL . "Domicilio = '$dom',LocalidadId = $idLoc, dmEntreCalle1 = '$eCalle1', dmEntreCalle2 = '$eCalle2', dmReferencia = '$ref' ";
			$SQL = $SQL . " WHERE IncidenteId = $idInc ";
			
			$db->Query($SQL);
		
			showODBCError();
			
		}
		
		$db->Disconnect();
	
	}
   
?>