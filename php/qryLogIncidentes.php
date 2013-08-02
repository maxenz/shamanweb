<?php

		
	
	if (isset($_GET["opt"])) {
		
		require_once("class.shaman.php");
	
		$opt = $_GET["opt"];
		
		switch ($opt) {
		
			case 0:
				$tip = $_GET["tip"];
				echo getLogIncidentes($tip);
			break;
			
		}
	
	}
	
	function getLogIncidentes($tip) {
		
		$db = new cDB();
		$db->Connect();

			$SQLLOG = "SELECT gdo.ColorHexa as Color, gdo.AbreviaturaId as Grado, gdo.Orden as Orden, ISNULL(COUNT(inc.ID), 0) as Cant ";
			$SQLLOG = $SQLLOG . "FROM IncidentesViajes vij ";
			$SQLLOG = $SQLLOG . "INNER JOIN IncidentesDomicilios dom ON (vij.IncidenteDomicilioId = dom.ID) ";
			$SQLLOG = $SQLLOG . "INNER JOIN Incidentes inc ON (dom.IncidenteId = inc.ID) ";
			$SQLLOG = $SQLLOG . "INNER JOIN GradosOperativos gdo ON (inc.GradoOperativoId = gdo.ID) ";
			$SQLLOG = $SQLLOG . "INNER JOIN Clientes cli ON (inc.ClienteId = cli.ID) ";
			$SQLLOG = $SQLLOG . "INNER JOIN Localidades loc ON (dom.LocalidadId = loc.ID) ";
			$SQLLOG = $SQLLOG . "INNER JOIN ZonasGeograficas zon ON (loc.ZonaGeograficaId = zon.ID) ";
			$SQLLOG = $SQLLOG . "LEFT JOIN Moviles mov ON (vij.MovilId = mov.ID) ";
			$SQLLOG = $SQLLOG . "LEFT JOIN Moviles pre ON (vij.MovilPreasignadoId = pre.ID) ";
			$SQLLOG = $SQLLOG . "LEFT JOIN Sanatorios san ON (dom.SanatorioId = san.ID) ";
			if ($tip == 0) {
				$SQLLOG = $SQLLOG . "WHERE (vij.flgStatus = 0) ";
			} else {
				$SQLLOG = $SQLLOG . "WHERE (vij.flgStatus = 2) ";
			}
			
			$SQLLOG = $SQLLOG . "GROUP BY gdo.ColorHexa, gdo.AbreviaturaId, gdo.Orden ";
			$SQLLOG = $SQLLOG . "ORDER BY gdo.Orden";
				
			$db->Query($SQLLOG);
			$log = "";
			if ($db->numrows > 0) {
				while($fila = $db->Next()) {
				
					$datos[] = array(
						'Color' => odbc_result($fila,'Color'),
						'Grado' => odbc_result($fila,'Grado'),
						'Orden' => odbc_result($fila,'Orden'),
						'Cant' => odbc_result($fila,'Cant'),	
					);
				}	
					
				for ($i = 0; $i < sizeOf($datos); $i++) {
							
					$color = $datos[$i]["Color"];
					$grado = $datos[$i]["Grado"];
					$cant = $datos[$i]["Cant"];
							
					$log = $log . "<td class='incLog' ><span class='badge' style='background-color:#".$color."'>".$grado."</span></td>";
					$log = $log . "<td><span style='font-weight:bold;color:black;margin-left:4px;margin-right:4px'>".$cant."</span></td>";
				}
				
				return $log;
													
			} 
							
			
			$db->Disconnect();
		
	}
						
						

		

?>