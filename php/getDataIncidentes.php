<?php

	
	
	if (isset($_GET["opt"])) {
	
		require_once("class.shaman.php");
	
		$opt = $_GET["opt"];
		
		switch ($opt) {
			
			case 0:
				$optGrillaInc = $_GET["optGrillaInc"];
				echo getIncidentes($optGrillaInc);
			break;
			
		
		}
	
	}
	
	function getIncidentes($optGrillaInc) {
		
		$db = new cDB();
		$db->Connect();
			
		$SQLINC = "SELECT inc.ID as incID,vij.ID,gdo.ColorHexa as gdoColor,inc.FecIncidente as FechaIncidente, gdo.AbreviaturaId as gdoAbrID,";
		$SQLINC = $SQLINC . " inc.Paciente as incPaciente, cli.AbreviaturaId as cliAbrID,";
		
		if ($optGrillaInc == 0) {
			$SQLINC = $SQLINC . "inc.NroIncidente as incNro,vij.horLlamada as llam, dom.dmReferencia, pre.Movil as MovilPreasignado, san.AbreviaturaId, vij.ID as ViajeId,";
			$SQLINC = $SQLINC . "vij.virTpoDespacho as tpoDesp, vij.virTpoSalida as tpoSal, vij.virTpoDesplazamiento, vij.virTpoAtencion as tpoAte,";				
		} else {
			$SQLINC = $SQLINC . "inc.TrasladoId as incTraslado,vij.reqHorLlegada as HorLleg, dom.dmReferencia as Referencia, pre.Movil as preMovil,";
			$SQLINC = $SQLINC . " san.AbreviaturaId as sanAbrID, vij.ViajeId as viajeID,";	
		}
		$SQLINC = $SQLINC . "dom.Domicilio as dom, inc.Sintomas as sint, zon.ColorHexa as zonColor, Loc.AbreviaturaId as locAbrID, inc.Sexo as incSexo,";
		$SQLINC = $SQLINC . "inc.Edad as incEdad, mov.Movil as MovilDespachado, inc.Aviso as Aviso, inc.Observaciones as Observaciones ";
		$SQLINC = $SQLINC . "FROM IncidentesViajes vij ";
		$SQLINC = $SQLINC . "INNER JOIN IncidentesDomicilios dom ON (vij.IncidenteDomicilioId = dom.ID) ";
		$SQLINC = $SQLINC . "INNER JOIN Incidentes inc ON (dom.IncidenteId = inc.ID) ";
		$SQLINC = $SQLINC . "INNER JOIN GradosOperativos gdo ON (inc.GradoOperativoId = gdo.ID) ";
		$SQLINC = $SQLINC . "INNER JOIN Clientes cli ON (inc.ClienteId = cli.ID) ";
		$SQLINC = $SQLINC . "INNER JOIN Localidades loc ON (dom.LocalidadId = loc.ID) ";
		$SQLINC = $SQLINC . "INNER JOIN ZonasGeograficas zon ON (loc.ZonaGeograficaId = zon.ID) ";
		$SQLINC = $SQLINC . "LEFT JOIN Moviles mov ON (vij.MovilId = mov.ID) ";
		$SQLINC = $SQLINC . "LEFT JOIN Moviles pre ON (vij.MovilPreasignadoId = pre.ID) ";
		$SQLINC = $SQLINC . "LEFT JOIN Sanatorios san ON (dom.SanatorioId = san.ID) ";
		$SQLINC = $SQLINC . "WHERE vij.flgStatus = 0 AND gdo.flgIntDomiciliaria = 0 ";
		$SQLINC = $SQLINC . "ORDER BY gdo.Orden, vij.ViajeId ";
				
		$db->Query($SQLINC);
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {		
				if ($optGrillaInc == 0) {
						
					$vecLlamada = array();
					$vecLlamada = explode(" ",odbc_result($fila,'llam'));
					$llamada = str_split($vecLlamada[1],5);
						
					$datos[] = array(
						'ID' => odbc_result($fila,'incID'),
						'Grado' => odbc_result($fila,'gdoAbrID'),
						'NroIncidente' => odbc_result($fila,'incNro'),
						'Domicilio' => odbc_result($fila,'dom'),
						'Sintomas' => odbc_result($fila,'sint'),
						'Localidad' => odbc_result($fila,'locAbrID'),
						'SexoEdad' => odbc_result($fila,'incSexo').intval(odbc_result($fila,'incEdad')),
						'ColorGrado' => odbc_result($fila,'gdoColor'),
						'ColorZona' => odbc_result($fila,'zonColor'),
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
						'MovilDespachado' => odbc_result($fila,'MovilDespachado')
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
				
			} else {
				return "La tabla regiones está vacía.<br />";
		}
		
		$db->Disconnect();
	
	}

?>