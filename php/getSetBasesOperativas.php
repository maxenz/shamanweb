<?php
	
	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];
	
	switch ($opt) {
		
		case 0:
			getBases();
		break;
		
		case 1:
			$id = $_GET["id"];
			deleteBase($id);
		break;
		
		case 2:
			$pArray = $_POST["pArray"];
			insertoBase($pArray);
		break;
		
		case 3:
			$id = $_GET["id"];
			getBase($id);
		break;

	}
	
	function getBases() {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT bas.ID as ID,bas.AbreviaturaId as AbreviaturaID,bas.Descripcion as Descripcion ,bas.Domicilio as Domicilio,loc.AbreviaturaId as Localidad";
		$SQL = $SQL . " FROM BasesOperativas bas";
		$SQL = $SQL . " INNER JOIN Localidades loc ON (loc.ID = bas.LocalidadId)";
		
		$db->Query($SQL);
		
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {
				
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'AbreviaturaId' => odbc_result($fila,'AbreviaturaId'),
				'Descripcion' => odbc_result($fila,'Descripcion'),
				'Domicilio' => odbc_result($fila,'Domicilio'),
				'Localidad' => odbc_result($fila,'Localidad')
				);
			}
				
				echo json_encode($datos);
				$db->Disconnect();	
		}			
	}
	
	function deleteBase($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "DELETE FROM BasesOperativas WHERE ID = $id";
		
		$db->Query($SQL);
		$db->Disconnect();	
		
	}
	
	function insertoBase($pArray) {
		
		$db = new cDB();
		$db->Connect();
		
		$codigo = filter_var($pArray[0],FILTER_SANITIZE_STRING);
		$desc = filter_var($pArray[1],FILTER_SANITIZE_STRING);
		$loc = filter_var($pArray[2],FILTER_SANITIZE_STRING);
		$SQL = "SELECT ID FROM Localidades WHERE AbreviaturaId = '$loc'"; 
		$locId = filter_var(getID($SQL,$db),FILTER_SANITIZE_NUMBER_INT);
		$calle = filter_var($pArray[4],FILTER_SANITIZE_STRING);
		$alt = filter_var($pArray[5], FILTER_SANITIZE_NUMBER_INT);
		$piso = filter_var($pArray[6],FILTER_SANITIZE_STRING);
		$depto = filter_var($pArray[7],FILTER_SANITIZE_STRING);
		$codPost = filter_var($pArray[8],FILTER_SANITIZE_STRING);
		$eCalle1 = filter_var($pArray[9],FILTER_SANITIZE_STRING);
		$eCalle2 = filter_var($pArray[10],FILTER_SANITIZE_STRING);
		$ref = filter_var($pArray[11],FILTER_SANITIZE_STRING);
		$tel1 = filter_var($pArray[12],FILTER_SANITIZE_STRING);
		$tel2 = filter_var($pArray[13],FILTER_SANITIZE_STRING);
		$tel3 = filter_var($pArray[14],FILTER_SANITIZE_STRING);
		$obs = filter_var($pArray[15],FILTER_SANITIZE_STRING);
		$domicilio = $calle . " " . $alt . " " . $piso . " " . $depto;
		$userId = getUserId();
		
		if ($_GET["optInsModif"] == 0) {
		
			$SQL = "INSERT INTO BasesOperativas (AbreviaturaId,Descripcion,dmCalle,dmAltura,dmPiso,dmDepto,Domicilio,LocalidadId,CodigoPostal,";
			$SQL = $SQL . "dmEntreCalle1,dmEntreCalle2,dmReferencia,Telefono01,Telefono02,Telefono03,Observaciones,regUsuarioId) ";
			$SQL = $SQL . "VALUES ('$codigo','$desc','$calle','$alt','$piso','$depto','$domicilio',$locId,$codPost,'$eCalle1','$eCalle2',";
			$SQL = $SQL . "'$ref','$tel1','$tel2','$tel3','$obs',$userId)";
			echo 0;
		} else {
				
			$idBase = $pArray[16];
			$SQL = "UPDATE BasesOperativas SET AbreviaturaId = '$codigo', Descripcion = '$desc', dmCalle = '$calle', dmAltura = '$alt',";
			$SQL = $SQL . "dmPiso = '$piso',dmDepto = '$depto', Domicilio = '$domicilio',LocalidadId = '$locId',CodigoPostal = '$codPost',";
			$SQL = $SQL . "dmEntreCalle1 = '$eCalle1', dmEntreCalle2 = '$eCalle2', dmReferencia = '$ref',Telefono01 = '$tel1',Telefono02 = '$tel2',";
			$SQL = $SQL . "Telefono03 = '$tel3',Observaciones = '$obs',regUsuarioId = $userId";
			$SQL = $SQL . " WHERE ID = $idBase";		
			echo 1;
		}
		
			$db->Query($SQL);
			$db->Disconnect();	
		
	}
	
	function getBase($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT bas.ID as ID,bas.AbreviaturaId as AbreviaturaID,bas.Descripcion as DescripcionBase,loc.AbreviaturaId as AbrLoc,loc.Descripcion as Localidad,";
		$SQL = $SQL . "bas.dmCalle as Calle, bas.dmAltura as Altura, bas.dmPiso as Piso, bas.dmDepto as Depto,bas.CodigoPostal as CP,bas.dmEntreCalle1 as ECalle1,";
		$SQL = $SQL . "bas.dmEntreCalle2 as ECalle2,bas.dmReferencia as Ref,bas.Telefono01 as Tel1, bas.Telefono02 as Tel2, bas.Telefono03 as Tel3,";
		$SQL = $SQL . "bas.Observaciones as Obser";
		$SQL = $SQL . " FROM BasesOperativas bas";
		$SQL = $SQL . " INNER JOIN Localidades loc ON (loc.ID = bas.LocalidadId)";
		$SQL = $SQL . " WHERE bas.ID = $id";
		
		$db->Query($SQL);
		
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {
				
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'AbreviaturaId' => odbc_result($fila,'AbreviaturaId'),
				'DescripcionBase' => odbc_result($fila,'DescripcionBase'),
				'AbrLoc' => odbc_result($fila,'AbrLoc'),
				'Localidad' => odbc_result($fila,'Localidad'),
				'Calle' => odbc_result($fila,'Calle'),
				'Altura' => odbc_result($fila,'Altura'),
				'Piso' => odbc_result($fila,'Piso'),
				'Depto' => odbc_result($fila,'Depto'),
				'CP' => odbc_result($fila,'CP'),
				'ECalle1' => odbc_result($fila,'ECalle1'),
				'ECalle2' => odbc_result($fila,'ECalle2'),
				'Ref' => odbc_result($fila,'Ref'),
				'Tel1' => odbc_result($fila,'Tel1'),
				'Tel2' => odbc_result($fila,'Tel2'),
				'Tel3' => odbc_result($fila,'Tel3'),
				'Obser' => odbc_result($fila,'Obser')
				);
			}
			
			echo json_encode($datos);
			$db->Disconnect();	
		}			
	}

?>