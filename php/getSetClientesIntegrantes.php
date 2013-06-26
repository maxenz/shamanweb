<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];
	
	switch($opt) {
		
		case 0:
			$cliente = $_GET["cliente"];
			setGrilla($cliente);
		break;
		
		
		case 1:
			$idInt = $_GET["id"];
			getIntegrante($idInt);
		break;
		
		case 2:
			$pArray = $_POST["pArray"];
			insertoIntegrante($pArray);
		break;
		
		case 3:
			$idInt = $_GET["id"];
			deleteIntegrante($idInt);
		break;
	}
	
	
	function setGrilla($cliente) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT itg.ID as ID, itg.NroAfiliado as NroAf, itg.TipoIntegrante as TipInt, itg.Apellido as Ape, itg.Nombre as Nom FROM ClientesIntegrantes itg";
		$SQL = $SQL . " WHERE (itg.ClienteId = $cliente) ";
		$SQL = $SQL . " ORDER BY itg.TipoIntegrante, itg.Apellido, itg.Nombre";
		
		$db->Query($SQL);
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {
				
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'NroAf' => odbc_result($fila,'NroAf'),
				'TipInt' => odbc_result($fila,'TipInt'),
				'Ape' => odbc_result($fila,'Ape'),
				'Nom' => odbc_result($fila,'Nom')
				);
					
			}
			
			echo json_encode($datos);
				
		} else {
				
			echo "No hay datos";	
		}
		
		$db->Disconnect();	
		
		
	}
	
	function getIntegrante($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT itg.ID as ID, itg.NroAfiliado as NroAf, itg.TipoIntegrante as TipInt, itg.Apellido as Ape, itg.Nombre as Nom,";
		$SQL = $SQL . "itg.TipoDocumentoId as TipoDoc, itg.NroDocumento as NroDoc, itg.FecNacimiento as FecNac, itg.Sexo as Sexo,";
		$SQL = $SQL . "itg.dmCalle as Calle, itg.dmAltura as Altura, itg.dmPiso as Piso, itg.dmDepto as Depto, loc.AbreviaturaId as AbrLoc,";
		$SQL = $SQL . "loc.Descripcion as Localidad, itg.CodigoPostal as CodigoPostal, itg.dmEntreCalle1 as EntreCalle1, itg.dmEntreCalle2 as EntreCalle2,";
		$SQL = $SQL . "itg.dmReferencia as Ref, itg.Telefono01 as Telefono1, itg.Telefono02 as Telefono2, itg.FecIngreso as FecIngreso, itg.Observaciones as Obser"; 
		$SQL = $SQL . " FROM ClientesIntegrantes itg";
		$SQL = $SQL . " INNER JOIN Localidades loc ON (loc.ID = itg.LocalidadId)";
		$SQL = $SQL . " WHERE (itg.ID = $id) ";
		$SQL = $SQL . " ORDER BY itg.TipoIntegrante, itg.Apellido, itg.Nombre";
		
		$db->Query($SQL);
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {
				
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'NroAf' => odbc_result($fila,'NroAf'),
				'TipInt' => odbc_result($fila,'TipInt'),
				'Ape' => odbc_result($fila,'Ape'),
				'Nom' => odbc_result($fila,'Nom'),
				'TipoDoc' => odbc_result($fila,'TipoDoc'),
				'NroDoc' => odbc_result($fila,'NroDoc'),
				'FecNac' => odbc_result($fila,'FecNac'),
				'Sexo' => odbc_result($fila,'Sexo'),
				'Calle' => odbc_result($fila,'Calle'),
				'Altura' => odbc_result($fila,'Altura'),
				'Piso' => odbc_result($fila,'Piso'),
				'Depto' => odbc_result($fila,'Depto'),
				'AbrLoc' => odbc_result($fila,'AbrLoc'),
				'Localidad' => odbc_result($fila,'Localidad'),
				'CodigoPostal' => odbc_result($fila,'CodigoPostal'),
				'EntreCalle1' => odbc_result($fila,'EntreCalle1'),
				'EntreCalle2' => odbc_result($fila,'EntreCalle2'),
				'Ref' => odbc_result($fila,'Ref'),
				'Telefono1' => odbc_result($fila,'Telefono1'),
				'Telefono2' => odbc_result($fila,'Telefono2'),
				'FecIngreso' => odbc_result($fila,'FecIngreso'),
				'Obser' => odbc_result($fila,'Obser')
				);
					
			}
				echo json_encode($datos);
		}
		
		$db->Disconnect();	
			
			
	}
	
	function insertoIntegrante($pArray) {
		
		$db = new cDB();
		$db->Connect();
		
		$nroAf = filter_var($pArray[0],FILTER_SANITIZE_STRING);
		$tipInt = filter_var($pArray[1],FILTER_SANITIZE_STRING);
		$ape = filter_var($pArray[2],FILTER_SANITIZE_STRING);
		$nom = filter_var($pArray[3],FILTER_SANITIZE_STRING);
		$loc = filter_var($pArray[4],FILTER_SANITIZE_STRING);
		$SQL = "SELECT ID FROM Localidades WHERE AbreviaturaId = '$loc'"; 
		$locId = getID($SQL,$db);
		$calle = filter_var($pArray[6],FILTER_SANITIZE_STRING);
		$alt = filter_var($pArray[7],FILTER_SANITIZE_NUMBER_INT);
		$piso = filter_var($pArray[8],FILTER_SANITIZE_STRING);
		$depto = filter_var($pArray[9],FILTER_SANITIZE_STRING);
		$codPost = filter_var($pArray[10],FILTER_SANITIZE_STRING);
		$eCalle1 = filter_var($pArray[11],FILTER_SANITIZE_STRING);
		$eCalle2 = filter_var($pArray[12],FILTER_SANITIZE_STRING);
		$ref = filter_var($pArray[13],FILTER_SANITIZE_STRING);
		$tipDoc = filter_var($pArray[14],FILTER_SANITIZE_STRING);
		$nroDoc = filter_var($pArray[15],FILTER_SANITIZE_STRING);
		$sexo = $pArray[16];
		$fecNac = filter_var($pArray[17],FILTER_SANITIZE_STRING);
		$tel1 = filter_var($pArray[18],FILTER_SANITIZE_STRING);
		$tel2 = filter_var($pArray[19],FILTER_SANITIZE_STRING);
		$fecIng = filter_var($pArray[20],FILTER_SANITIZE_STRING);
		$obser = filter_var($pArray[21],FILTER_SANITIZE_STRING);
		$idCli = $pArray[22];
		$dom = $calle." ".$alt." ".$piso." ".$depto;
		$userId = getUserId();
		
		if ($_GET["optInsModif"] == 0) {
		
			$SQL = "INSERT INTO ClientesIntegrantes (ClienteId,TipoIntegrante,NroAFiliado,Apellido,Nombre,TipoDocumentoId,NroDocumento,FecNacimiento,Sexo,";
			$SQL = $SQL . "dmCalle,dmAltura,dmPiso,dmDepto,Domicilio,LocalidadId,CodigoPostal,dmEntreCalle1,dmEntreCalle2,dmReferencia,Telefono01,Telefono02,";
			$SQL = $SQL . "FecIngreso,Observaciones,regUsuarioId) ";
			$SQL = $SQL . "VALUES ($idCli,'$tipInt','$nroAf','$ape','$nom',$tipDoc,'$nroDoc','$fecNac','$sexo','$calle','$alt','$piso','$depto',";
			$SQL = $SQL . "'$dom',$locId,'$codPost','$eCalle1','$eCalle2','$ref','$tel1','$tel2','$fecIng','$obser',$userId)";
			echo 0;
		} else {
			
			$idInt = $pArray[23];
			$SQL = "UPDATE ClientesIntegrantes SET TipoIntegrante = '$tipInt', NroAfiliado = '$nroAf', Apellido = '$ape', Nombre = '$nom', TipoDocumentoId = $tipDoc,";
			$SQL = $SQL . "NroDocumento = '$nroDoc', FecNacimiento = '$fecNac', Sexo = '$sexo', dmCalle = '$calle', dmAltura = '$alt', dmPiso = '$piso',";
			$SQL = $SQL . "dmDepto = '$depto', Domicilio = '$dom', LocalidadId = $locId, CodigoPostal = '$codPost', dmEntreCalle1 = '$eCalle1',";
			$SQL = $SQL . "dmEntreCalle2 = '$eCalle2',dmReferencia = '$ref', Telefono01 = '$tel1', Telefono02 = '$tel2', FecIngreso = '$fecIng',";
			$SQL = $SQL . "Observaciones = '$obser', regUsuarioId = $userId ";
			$SQL = $SQL . "WHERE ID = $idInt";
			echo 1;
		}
		
		$db->Query($SQL);
		
		$db->Disconnect();	

		
	}
	
	function deleteIntegrante($idInt) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "DELETE FROM ClientesIntegrantes WHERE ID = $idInt ";
		
		$db->Query($SQL);	
		
		$db->Disconnect();	
			
	}
	

         

?>