<?php

	function obtengoAccesoNodo($usr,$nodo) {

		require_once("class.shaman.php");

		$db2 = new cDB();
		$db2->Connect();

		$db = new cDB();
		$db->Connect();

		$acceso = 0;

		$SQL = "SELECT TOP 1 prf.ID FROM UsuariosPerfiles usr INNER JOIN Perfiles prf ON (usr.PerfilId = prf.ID) WHERE (usr.UsuarioId = ".$usr.") AND (prf.flgAdministrador = 1) ";



		$db->Query($SQL) or die (odbc_error());

		if ($db->numrows > 0) {
							
			$acceso = 3;	
							
							
		} else {
		
			$qryAccesoNodo = "SELECT TOP 1 prf.Acceso as acc FROM PerfilesNodos prf INNER JOIN UsuariosPerfiles usr ON (prf.PerfilId = usr.PerfilId) WHERE (usr.UsuarioId ='".$usr."') AND (prf.sysNodoId = ".$nodo.") ORDER BY prf.Acceso DESC ";
		
			$db2->Query($qryAccesoNodo) or die (odbc_error());

			if ($db2->numrows > 0) {
							
				if ($nodosUnico = $db2->Next()) {
										
					$acceso = odbc_result($nodosUnico,'acc');	
								
				}		
			}
		}
		
		
		return $acceso;
						
			
	}
?>