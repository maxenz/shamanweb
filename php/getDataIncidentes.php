<?php

	require_once("class.shaman.cache.php");
	require_once("class.shaman.php");
	require_once("genericas.php");

	if(!isset($_SESSION)){
		session_start();
	}

	if (isset($_GET["opt"])) {

		$opt = $_GET["opt"];
		
		switch ($opt) {
			
			case 0:

				$optGrillaInc = $_GET["optGrillaInc"];
                
				echo getIncidentes($optGrillaInc,$_SESSION["v"]);
				
			break;
			
		}
	}

	function getQuery($optGrillaInc,$version) {

		if ($version == 'express') {

			$db = new cDB();
			$db->Connect();		

			$SQLINC = "SELECT inc.ID as incID,vij.ID,gdo.ColorHexa as gdoColor,inc.FecIncidente as FechaIncidente,";
			$SQLINC .="gdo.AbreviaturaId as gdoAbrID,inc.Paciente as incPaciente, cli.AbreviaturaId as cliAbrID,";

			if ($optGrillaInc == 0) {

				$SQLINC .= "inc.NroIncidente as incNro,vij.horLlamada as llam, dom.dmReferencia,";
				$SQLINC .= "pre.Movil as MovilPreasignado, san.AbreviaturaId, vij.ID as ViajeId,";
				$SQLINC .= "vij.virTpoDespacho as tpoDesp, vij.virTpoSalida as tpoSal,";
				$SQLINC .= "vij.virTpoDesplazamiento, vij.virTpoAtencion as tpoAte,";	

			} else {

				$SQLINC .= "inc.TrasladoId as incTraslado,vij.reqHorLlegada as HorLleg, dom.dmReferencia as Referencia,";
				$SQLINC .= "pre.Movil as preMovil,san.AbreviaturaId as sanAbrID, vij.ViajeId as viajeID,";	

			}

			$SQLINC .= "dom.Domicilio as dom, inc.Sintomas as sint, zon.ColorHexa as zonColor, Loc.AbreviaturaId as locAbrID,";
			$SQLINC .= "inc.Sexo as incSexo,inc.Edad as incEdad, mov.Movil as MovilDespachado, inc.Aviso as Aviso,";
			$SQLINC .= "inc.Observaciones as Observaciones FROM IncidentesViajes vij ";
			$SQLINC .= "INNER JOIN IncidentesDomicilios dom ON (vij.IncidenteDomicilioId = dom.ID) ";
			$SQLINC .= "INNER JOIN Incidentes inc ON (dom.IncidenteId = inc.ID) ";
			$SQLINC .= "INNER JOIN GradosOperativos gdo ON (inc.GradoOperativoId = gdo.ID) ";
			$SQLINC .= "INNER JOIN Clientes cli ON (inc.ClienteId = cli.ID) ";
			$SQLINC .= "INNER JOIN Localidades loc ON (dom.LocalidadId = loc.ID) ";
			$SQLINC .= "INNER JOIN ZonasGeograficas zon ON (loc.ZonaGeograficaId = zon.ID) ";
			$SQLINC .= "LEFT JOIN Moviles mov ON (vij.MovilId = mov.ID) ";
			$SQLINC .= "LEFT JOIN Moviles pre ON (vij.MovilPreasignadoId = pre.ID) ";
			$SQLINC .= "LEFT JOIN Sanatorios san ON (dom.SanatorioId = san.ID) ";
			$SQLINC .= "WHERE vij.flgStatus = 0 AND gdo.flgIntDomiciliaria = 0 ";
			$SQLINC .= "ORDER BY gdo.Orden, vij.ViajeId ";
            
			$db->Query($SQLINC);

			return $db;

		} else {

			$db = new cDBCache();
			$db->Connect();

			$SQLINC = "SELECT "; 
			$SQLINC .= "A.IncidenteId incID,A.GradoServicioId->VisualColor gdoColor,A.IncidenteId->FecIncidente FechaIncidente,";
			$SQLINC .= "A.GradoServicioId->Grid gdoAbrID,A.IncidenteId->Nombre incPaciente,";
			$SQLINC .= "A.IncidenteId->ClienteId->ClienteId cliAbrID,A.IncidenteId->NroIncidente incNro,";
			$SQLINC .= "A.IncidenteId->HorInicial llam,B.dm_referencia dmReferencia,";
			$SQLINC .= "CASE ISNULL(B.MovilId->MovilId, 0) WHEN 0 THEN CASE ISNULL(B.PrestadorId->AbreviaturaId, 0) ";
			$SQLINC .= "WHEN 0 THEN MovilPreasignadoId ELSE NULL END ELSE NULL END AS MovilPreasignado,";
			$SQLINC .= "A.ViajeId ViajeId,A.IncidenteId->virTpoDespacho tpoDesp,A.IncidenteId->virTpoSalida tpoSal,";
			$SQLINC .= "A.IncidenteId->virTpoDesplazamiento virTpoDesplazamiento,A.IncidenteId->virTpoAtencion tpoAte,";
			$SQLINC .= "B.virDomicilio dom,A.virSintoma sint,B.LocalidadId->ZonaGeograficaId->VisualColor zonColor,";
			$SQLINC .= "B.LocalidadId->ZonaGeograficaId->AbreviaturaId zonColor,NULL Observaciones,";
			$SQLINC .= "B.LocalidadId->ZonaGeograficaId->AbreviaturaId locAbrID,A.IncidenteId->Sexo incSexo,";
			$SQLINC .= "A.IncidenteId->Edad incEdad,B.MovilId->MovilId movilDespachado,A.IncidenteId->Tip01 Aviso ";
			$SQLINC .= "FROM Emergency.IncPendientesPropios A, Emergency.IncidentesDomicilios B ";
			$SQLINC .= "WHERE (A.IncidenteId = B.IncidenteId) AND (A.GradoServicioId->flgReducido = 0) AND (B.flgScreen = 1) ";
			$SQLINC .= "AND (A.flgPendienteResolucion = 0) AND (A.IncidenteId->CentroOperativoId = 1) ";
			$SQLINC .= "ORDER BY A.OrdenId, A.GradoServicioId->OrdenId, A.IncidenteId->HorInicial";

			$db->Query($SQLINC);

			return $db;

		}
	}
	
	function getIncidentes($optGrillaInc,$version) {
		
		$db = getQuery($optGrillaInc,$version);	

			while($fila = $db->Next()) {		
				if ($optGrillaInc == 0) {
					
					if (odbc_result($fila,'llam') <> null) {	

						$vecLlamada = array();
						$vecLlamada = explode(" ",odbc_result($fila,'llam'));
						$llamada = str_split($vecLlamada[1],5);
 
					} else {

						$llamada = array();
						$llamada[0] = 0;
					}

					$id = odbc_result($fila,'incID');
					$reclamo = tieneReclamo($id);

					$gdoColor = odbc_result($fila,'gdoColor');
					$zonColor = odbc_result($fila,'zonColor');

					if ($version == 'full') {

						$gdoColor = getColor($gdoColor);
						$zonColor = getColor($zonColor);

					}
					
					$datos[] = array(
						'ID' => odbc_result($fila,'incID'),
						'Grado' => odbc_result($fila,'gdoAbrID'),
						'NroIncidente' => odbc_result($fila,'incNro'),
						'Domicilio' => odbc_result($fila,'dom'),
						'Sintomas' => odbc_result($fila,'sint'),
						'Localidad' => odbc_result($fila,'locAbrID'),
						'SexoEdad' => odbc_result($fila,'incSexo').intval(odbc_result($fila,'incEdad')),
						'ColorGrado' => $gdoColor,
						'ColorZona' => $zonColor,
						'Cliente' => odbc_result($fila,'cliAbrID'),
						'Despacho' => odbc_result($fila,'tpoDesp'),
						'Salida' => odbc_result($fila,'tpoSal'),
						'Atencion' => odbc_result($fila,'tpoAte'),
						'Paciente' => odbc_result($fila,'incPaciente'),	 
						'HorLlam' => $llamada[0],  
						'FechaIncidente' => odbc_result($fila,'FechaIncidente'),
						'Aviso' => odbc_result($fila,'Aviso'),
						'Observaciones' => odbc_result($fila,'Observaciones'),
						'ViajeId' => odbc_result($fila,'ViajeId'),
						'MovilPreasignado' => odbc_result($fila,'MovilPreasignado'),
						'MovilDespachado' => odbc_result($fila,'MovilDespachado'),
						'Reclamo' => $reclamo
					);				
				} else {
						
					$vecLlegada = array();
					$vecLlegada = explode(" ",odbc_result($fila,'HorLleg'));
					$fecha = $vecLlegada[0];
					$horario = str_split($vecLlegada[1],5);
						
					$datos[] = array(
						'ID' => odbc_result($fila,'incID'),
						'Grado' => odbc_result($fila,'gdoAbrID'),
						'Traslado' => odbc_result($fila,'incTraslado'),
						'HoraLlegada' => $horario[0],
						'Fecha' => $fecha,
						'Domicilio' => odbc_result($fila,'dom'),
						'Sintomas' => odbc_result($fila,'sint'),
						'Localidad' => odbc_result($fila,'locAbrID'),
						'SexoEdad' => odbc_result($fila,'incSexo').intval(odbc_result($fila,'incEdad')),
						'ColorGrado' => odbc_result($fila,'gdoColor'),
						'ColorZona' => odbc_result($fila,'zonColor'),
						'Cliente' => odbc_result($fila,'cliAbrID'),
						'Movil' => odbc_result($fila,'movNro'),
						'Referencia' => odbc_result($fila,'Referencia'),
						'Paciente' => odbc_result($fila,'incPaciente'),	 
						'PreMovil' => odbc_result($fila,'preMovil'),
						'Sanatorio' => odbc_result($fila,'sanAbrID'),
						'ViajeID' => odbc_result($fila,'viajeID'),  
						'Aviso' => odbc_result($fila,'Aviso'),
						'Observaciones' => odbc_result($fila,'Observaciones')
					);						
				}
					
			}
				return json_encode($datos);
				
			
		
		
		$db->Disconnect();
	
	}

	function tieneReclamo($id){
	
		$db = new cDB();
		$db->Connect();
		$SQL = "SELECT * FROM IncidentesObservaciones WHERE (IncidenteId = $id) AND (flgReclamo = 1)";
		$db->Query($SQL);
		if ($fila = $db->Next()) {	

			return 1;

		} else {

			return 0;
		}
		
		$db->Disconnect();			
	}

?>