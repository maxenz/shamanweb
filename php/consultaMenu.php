<?php 

require_once("class.shaman.php");
require_once("seguridad.php");
$pJer = "";
$pNameJer = "";
$vecNodosPadre = array();

$db = new cDB();
$db2 = new cDB();
$db->Connect();
$db2->Connect();
$qryNodoPadre = "SELECT ID,Jerarquia FROM sysnodos WHERE ((LEN(Jerarquia) = 2) AND ((ID = 45) OR (ID=52) or (ID = 67))) ORDER BY Jerarquia ASC";
$db->Query($qryNodoPadre) or die (odbc_error());
	if ($db->numrows > 0) {
			while ($data = $db->Next()) {
				
				$pJer = odbc_result($data,'ID');
				$pNameJer = odbc_result($data,'Jerarquia');	

				if (obtengoAccesoNodo(7,$pJer) > 0) {
				
							array_push($vecNodosPadre,$pNameJer);
				}
			}	
		}

?> 