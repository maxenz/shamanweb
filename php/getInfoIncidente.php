<?php

		require_once("class.shaman.php");
			
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
	
		function getIncidente($id,$tel) {
			
			$db = new cDB();
			$db->Connect();
			
			$SQL = "SELECT TOP 1 inc.ID as ID,inc.NroAfiliado as NroAfiliado,inc.TelefonoFix as TelefonoFix,inc.NroIncidente as NroIncidente,inc.Observaciones as Observaciones,inc.Aviso as Aviso,inc.Sexo as Sexo,inc.Edad as Edad,inc.Sintomas as Sintomas,";
			$SQL = $SQL . "gOp.AbreviaturaId as Grado,inc.PlanId,Paciente,CoPago,inc.flgIvaGravado as IVA";
			$SQL = $SQL . ",dom.dmCalle as Calle , dom.dmAltura as Altura, dom.dmEntreCalle1 as EntreCalle1, dom.dmEntreCalle2 as EntreCalle2 ";
			$SQL = $SQL . ",dom.dmPiso as Piso, dom.dmDepto as Depto, loc.AbreviaturaId as locAbr,loc.Descripcion as locDesc,loc2.Descripcion as Partido,";
			$SQL = $SQL . "cli.AbreviaturaId as Cliente, inc.FecIncidente as FechaIncidente, dom.dmReferencia as Referencia";
			$SQL = $SQL . " FROM Incidentes inc ";
			$SQL = $SQL . "INNER JOIN GradosOperativos gOp ON (gOp.ID = GradoOperativoId) ";
			$SQL = $SQL . "INNER JOIN IncidentesDomicilios dom ON (dom.IncidenteId = inc.ID) ";
			$SQL = $SQL . "INNER JOIN Localidades loc ON (loc.ID = dom.LocalidadId) ";
			$SQL = $SQL . "INNER JOIN Localidades loc2 ON (loc2.id = loc.PartidoId) ";
			$SQL = $SQL . "INNER JOIN Clientes cli ON (inc.ClienteId = cli.ID) ";
			
			if ($tel <> 0) {
				
				$tel = filter_input(INPUT_GET,'tel',FILTER_SANITIZE_STRING);
				$tel = preg_replace("/[^0-9]+/", "", $tel);
				$SQL = $SQL . " WHERE TelefonoFix = '" .$tel. "' ";	
				
			} else {
				
				$SQL = $SQL . " WHERE inc.ID = " .$id ;	
			}
			
				$SQL = $SQL . " ORDER BY ID DESC  ";
				
			$db->Query($SQL);
			if ($db->numrows > 0) {
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
					
				}
				
				echo json_encode($datos);
				
			} else {
				
				echo 0;	
			}
			
				$db->Disconnect();	
			
	}
	
	function getNroIncidenteNuevo() {
	
		$hoy = date("Y-m-d");
	
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT TOP 1 NroIncidente FROM Incidentes WHERE FecIncidente = '$hoy' AND NroIncidente <> '' ORDER BY NroIncidente DESC";
		
		$db->Query($SQL);
		
		if ($fila = $db->Next()) {

			$nroInc = odbc_result($fila,'NroIncidente');
			
		} else {

			$nroInc = "0";
		
		}		
		
		echo $nroInc;
	
	}
	
	

?>