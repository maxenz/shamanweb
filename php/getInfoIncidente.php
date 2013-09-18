<?php

		require_once("class.shaman.php");
		require_once("class.shaman.cache.php");
		
		if(!isset($_SESSION)){
		    session_start();
		}
		
		if(isset($_GET["opt"])) {
			
			$opt = $_GET["opt"];
			$id = 0;
			$tel = 0;
			
			if (isset($_GET["id"])) {
				
				$id = $_GET["id"];
												
			}
			
			if (isset($_GET["tel"])) {
			
				$tel = $_GET["tel"];
					
			}
		
			switch ($opt) {
				
				case 0:
					getIncidente($id,$tel);
				break;	
				
				case 1:
					getNroIncidenteNuevo();
				break;
			}
		
		}

		function getQuery($id,$tel,$version) {

			if ($version == 'express') {

				$db = new cDB();
				$db->Connect();
				
				$SQL = "SELECT TOP 1 inc.ID as ID,inc.NroAfiliado as NroAfiliado,inc.TelefonoFix as TelefonoFix,";
				$SQL .= "inc.NroIncidente as NroIncidente,inc.Observaciones as Observaciones,inc.Aviso as Aviso,";
				$SQL .= "inc.Sexo as Sexo,inc.Edad as Edad,inc.Sintomas as Sintomas,";
				$SQL .= "gOp.AbreviaturaId as Grado,inc.PlanId,Paciente,CoPago,inc.flgIvaGravado as IVA";
				$SQL .= ",dom.dmCalle as Calle , dom.dmAltura as Altura, dom.dmEntreCalle1 as EntreCalle1,";
				$SQL .= "dom.dmEntreCalle2 as EntreCalle2 ,dom.dmPiso as Piso, dom.dmDepto as Depto,";
				$SQL .= "loc.AbreviaturaId as locAbr,loc.Descripcion as locDesc,loc2.Descripcion as Partido,";
				$SQL .= "cli.AbreviaturaId as Cliente, inc.FecIncidente as FechaIncidente, dom.dmReferencia as Referencia";
				$SQL .= " FROM Incidentes inc ";
				$SQL .= "INNER JOIN GradosOperativos gOp ON (gOp.ID = GradoOperativoId) ";
				$SQL .= "INNER JOIN IncidentesDomicilios dom ON (dom.IncidenteId = inc.ID) ";
				$SQL .= "INNER JOIN Localidades loc ON (loc.ID = dom.LocalidadId) ";
				$SQL .= "INNER JOIN Localidades loc2 ON (loc2.id = loc.PartidoId) ";
				$SQL .= "INNER JOIN Clientes cli ON (inc.ClienteId = cli.ID) ";
				
				if ($tel <> 0) {
					
					$tel = filter_input(INPUT_GET,'tel',FILTER_SANITIZE_STRING);
					$tel = preg_replace("/[^0-9]+/", "", $tel);
					$SQL .= " WHERE TelefonoFix = '" .$tel. "' ";	

					
				} else {
					
					$SQL = $SQL . " WHERE inc.ID = " .$id ;	
				}
				
					$SQL = $SQL . " ORDER BY ID DESC  ";
					
				$db->Query($SQL);

				return $db;				

			} else {

				$db = new cDBCache();
				$db->Connect();

				$SQL =  "SELECT A.IncidenteId ID,A.IncidenteId->IntegranteId NroAfiliado,A.IncidenteId->Sexo,A.IncidenteId->Edad,";
				$SQL .= "A.IncidenteId->Plan PlanId,A.IncidenteId->Nombre Paciente,A.IncidenteId->CoPago,";
				$SQL .= "A.IncidenteId->IvaAfiliadoId IVA,B.dm_calle as Calle,B.dm_altura as Altura,";
				$SQL .= "B.dm_EntreCalle1 as EntreCalle1,B.dm_EntreCalle2 as EntreCalle2,B.dm_piso as Piso,";
				$SQL .= "B.dm_departamento as Depto,B.LocalidadId->Descripcion as locDesc,";
				$SQL .= "B.LocalidadId->AbreviaturaId as locAbr,B.LocalidadId->PartidoId->Descripcion as Partido,";
				$SQL .= "A.IncidenteId->ClienteId->facRazonSocial as Cliente,A.IncidenteId->Telefono as TelefonoFix,";
				$SQL .= "A.IncidenteId->NroIncidente as NroIncidente,A.GradoServicioId->Grid as Grado,";
				$SQL .= "A.IncidenteId->Tip01 Aviso,NULL Observaciones, A.IncidenteId->FecIncidente as FechaIncidente,";
				$SQL .= "B.dm_referencia as Referencia,A.virSintoma Sintomas ";
				$SQL .= "FROM Emergency.IncPendientesPropios A, Emergency.IncidentesDomicilios B WHERE ";
				$SQL .= "(A.IncidenteId = B.IncidenteId) AND (A.GradoServicioId->flgReducido = 0) AND (B.flgScreen = 1) ";
				$SQL .= "AND (A.flgPendienteResolucion = 0) AND (A.IncidenteId->CentroOperativoId = 1) ";
				$SQL .= "AND A.IncidenteId = '" .$id."' ";
				$SQL .= "ORDER BY A.OrdenId, A.GradoServicioId->OrdenId, A.IncidenteId->HorInicial ";

				$db->Query($SQL);

				return $db;	

			}
		}
	
		function getIncidente($id,$tel) {
			
			$db = getQuery($id,$tel,$_SESSION["v"]);

			if ($fila = $db->Next()) {
			
				$datos[] = array(
					'ID' => odbc_result($fila,'ID'),
					'NroAfiliado' => odbc_result($fila,'NroAfiliado'),
					'Sexo' => odbc_result($fila,'Sexo'),
					'Edad' => odbc_result($fila,'Edad'),
					'Plan' => odbc_result($fila,'PlanId'),
					'Paciente' => odbc_result($fila,'Paciente'),
					'CoPago' => odbc_result($fila,'CoPago'),
					'IVA' => odbc_result($fila,'IVA'),
					'Calle' => odbc_result($fila,'Calle'),
					'Altura' => odbc_result($fila,'Altura'),
					'EntreCalle1' => odbc_result($fila,'EntreCalle1'),
					'EntreCalle2' => odbc_result($fila,'EntreCalle2'),
					'Piso' => odbc_result($fila,'Piso'),
					'Depto' => odbc_result($fila,'Depto'),
					'Localidad' => odbc_result($fila,'locDesc'),
					'LocAbr' => odbc_result($fila,'locAbr'),
					'Partido' => odbc_result($fila,'Partido'),
					'Cliente' => odbc_result($fila,'Cliente'),
					'Telefono' => odbc_result($fila,'TelefonoFix'),
					'NroIncidente' => odbc_result($fila,'NroIncidente'),
					'Grado' => odbc_result($fila,'Grado'),
					'Aviso' => odbc_result($fila,'Aviso'),
					'Observaciones' => odbc_result($fila,'Observaciones'),
					'FechaIncidente' => odbc_result($fila,'FechaIncidente'),
					'Referencia' => odbc_result($fila,'Referencia'),
					'Sintomas' => odbc_result($fila,'Sintomas')
				);

				echo json_encode($datos);
					
			}
				
			$db->Disconnect();			
	}
	
	function getNroIncidenteNuevo() {
	
		$hoy = date("Y-d-m");
		$strHoy = "" . $hoy;
		$db = new cDB();
		$db->Connect();
		$rtaInc = "";
		
		$SQL = "SELECT TOP 1 NroIncidente FROM Incidentes WHERE FecIncidente = cast('$hoy' as datetime) AND NroIncidente <> '' ORDER BY NroIncidente DESC";
		
		$db->Query($SQL);
		
		if ($fila = $db->Next()) {

			$nroInc = odbc_result($fila,'NroIncidente');
			$inc = (int) $nroInc;
			$rtaInc = getSecuencial($inc);
			
		} else {

			$rtaInc = "001";
		
		}		
		
		echo $rtaInc;
	
	}

	function getSecuencial($inc) {

		$strInc = "";

		switch ($inc) {

			case ($inc < 9) :
				$inc++;
				$strInc = "00" . $inc;
			break;

			case (($inc >=9) && ($inc < 999)) :
				$inc++;
				$strInc = "0" . $inc;
			break;

		}

		return $strInc;

	}
	
	
?>