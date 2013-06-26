
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
$qryNodoPadre = "SELECT ID,Jerarquia FROM sysnodos WHERE LEN(Jerarquia) = 2 ORDER BY Jerarquia ASC";
$db->Query($qryNodoPadre) or die (odbc_error());
	if ($db->numrows > 0) {
			while ($data = $db->Next()) {
				
				$pJer = odbc_result($data,'ID');
				$pNameJer = odbc_result($data,'Jerarquia');	

				if (obtengoAccesoNodo($_SESSION["s_id"],$pJer) > 0) {
				
							array_push($vecNodosPadre,$pNameJer);
				}
			}	
		}

?> 

<table id="tablaMenu">
<tr><td>
<div id='jqxMenu'>
<ul>
	<?php

	for ($i = 0; $i < sizeof($vecNodosPadre) ; $i++) {
	
			$qryNodo = "SELECT Jerarquia,Descripcion,ID FROM sysnodos WHERE (SUBSTRING(Jerarquia, 1, 2 ) = '".$vecNodosPadre[$i]."')  ORDER BY Jerarquia ASC  ";

			$db->Query($qryNodo) or die (odbc_error());
			
			if($db->numrows > 0) {
				
				while ($nodos = $db->Next()) {

					$pJer = odbc_result($nodos,'Jerarquia');
					$pNameJer = utf8_encode(odbc_result($nodos,'Descripcion'));
					$pNodoId = odbc_result($nodos,'ID');
					
							if (obtengoAccesoNodo($_SESSION["s_id"],$pNodoId) > 0) {
					
									if (strlen($pJer) == 2) {
											
										?>
										
										<li><a id='<?php echo $pNodoId; ?>' href="#"><?php echo $pNameJer; ?></a>
										<ul>
										
										 <?php	
									} else {
										
										?>
										<li><a id='<?php echo $pNodoId; ?>' href="#"><?php echo $pNameJer; ?></a></li>
										 <?php	
										
									}				
								}											
							}					
						}
		
		?></ul></li><?php
		
		}

?>


</ul>

</div>
</td>
            <td><div id="userNameHeader"></div></td>
            <td><a id="cerrar"><img src="../images/cerrarSesion.png" id="imgCerrarSesion" /></a></td>
            </tr>
            </table>
            
            <div id="jqxwindow">
            <div>MENSAJE DEL SISTEMA</div>
			<div>
			<table id="tbSesion">
            <tr><td>Su sesi&oacute;n ha finalizado.</td></tr>
            <tr><td><input type="button" id="okButton" value="OK" /></td></tr>
            </table>
            </div>
			</div>
