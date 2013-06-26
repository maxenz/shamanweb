<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];
	$cliente = "";
	if (isset($_GET["cli"])) {
		
		$cliente = filter_input(INPUT_GET,'cli',FILTER_SANITIZE_STRING);	
			
	}
	
	switch($opt) {
		
		case 0:
			buscoCliente($cliente);
		break;
		
		case 1:
			setGrilla($cliente);
		break;	
		
		case 2:
			$pArray = $_POST["pArray"];
			insertoCliente($pArray);
		break;
		
		case 3:
			$idCli = $_GET["id"];
			deleteCliente($idCli);
		break;
		
		case 4:
			$idCli = $_GET["id"];
			$idPlan = filter_input(INPUT_GET,'plan',FILTER_SANITIZE_STRING);
			$obs = filter_input(INPUT_GET,'obs',FILTER_SANITIZE_STRING);
			updatePlan($idCli,$idPlan,$obs);
		break;
				
	}
	
	function buscoCliente($cliente) {
	
		$db = new cDB();
		$db->Connect();	
		
		$SQL = "SELECT ID from Clientes WHERE AbreviaturaId = '" .$cliente. "'";
		
		$db->Query($SQL);
		if($db->numrows > 0) {
			
			echo "ok";	
			
		} else {
			
			echo "error";
				
		}
		
		$db->Disconnect();	
			
	}

	function setGrilla($cliente) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT cli.ID as ID, cli.AbreviaturaId as abrID, cli.RazonSocial as RazonSocial, rub.ID as RubroId,rub.Descripcion as Rubro,";
		$SQL = $SQL . "cli.Domicilio as Domicilio, loc.AbreviaturaId as Localidad, loc.Descripcion as DescLoc,";
		$SQL = $SQL . "cli.dmCalle as Calle, cli.dmAltura as Altura, cli.dmPiso as Piso, cli.dmDepto as Depto,cli.Observaciones as Observ,";
		$SQL = $SQL . "cli.CodigoPostal as CodigoPostal,cli.dmEntreCalle1 as EntreCalle1, cli.dmEntreCalle2 as EntreCalle2, cli.dmReferencia as Referencia, cli.PlanId as PlanId ";
		$SQL = $SQL . " FROM Clientes cli "; 
		$SQL = $SQL . "LEFT JOIN RubrosClientes rub ON (cli.RubroClienteId = rub.ID) ";
		$SQL = $SQL . "LEFT JOIN Localidades loc ON (cli.LocalidadId = loc.ID) ";
		$SQL = $SQL . "WHERE cli.Activo = 1 ";
		if ($cliente <> "") $SQL = $SQL . "AND cli.ID = $cliente ";
		$SQL = $SQL . "ORDER BY cli.AbreviaturaId";
		
		$db->Query($SQL);
		if ($db->numrows > 0) {
			while($fila = $db->Next()) {
				
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'Codigo' => odbc_result($fila,'abrID'),
				'RazonSocial' => odbc_result($fila,'RazonSocial'),
				'RubroId' => odbc_result($fila,'RubroId'),
				'Domicilio' => odbc_result($fila,'Domicilio'),
				'Localidad' => odbc_result($fila,'Localidad'),
				'DescLoc' => odbc_result($fila,'DescLoc'),
				'Calle' => odbc_result($fila,'Calle'),
				'Altura' => odbc_result($fila,'Altura'),
				'Piso' => odbc_result($fila,'Piso'),
				'Depto' => odbc_result($fila,'Depto'),
				'CodigoPostal' => odbc_result($fila,'CodigoPostal'),
				'EntreCalle1' => odbc_result($fila,'EntreCalle1'),
				'EntreCalle2' => odbc_result($fila,'EntreCalle2'),
				'Referencia' => odbc_result($fila,'Referencia'),
				'Rubro' => odbc_result($fila,'Rubro'),
				'PlanId' => odbc_result($fila,'PlanId'),
				'Observ' => odbc_result($fila,'Observ')
				);
					
			}
			
			echo json_encode($datos);
				
		} else {
				
			echo "No hay datos";	
		}
		
		$db->Disconnect();	
		
		
	}


	function insertoCliente($pArray) {
		
		$db = new cDB();
		$db->Connect();
		
		$codigo = filter_var($pArray[0],FILTER_SANITIZE_STRING);
		$rz = filter_var($pArray[1],FILTER_SANITIZE_STRING);
		$rub = filter_var($pArray[2],FILTER_SANITIZE_STRING);
		$boolCatP = $pArray[3];
		if ($boolCatP == 'true') {
			$catP = 1;	
		} else {
			$catP = 0;
		}
		$loc = $pArray[4];
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
		$domicilio = $calle . " " . $alt . " " . $piso . " " . $depto;
		$userId = getUserId();
		
		if ($_GET["optInsModif"] == 0) {
		
			$SQL = "INSERT INTO Clientes (AbreviaturaId,RazonSocial,RubroClienteId,dmCalle,dmAltura,dmPiso,dmDepto,Domicilio,LocalidadId,CodigoPostal,";
			$SQL = $SQL . "dmEntreCalle1,dmEntreCalle2,dmReferencia,flgCategorizacionPropia,regUsuarioId,CUIT) ";
			$SQL = $SQL . "VALUES ('$codigo','$rz',$rub,'$calle','$alt','$piso','$depto','$domicilio',$locId,$codPost,'$eCalle1','$eCalle2',";
			$SQL = $SQL . "'$ref',$catP,$userId,'')";
			echo 0;
		} else {
				
			$idCli = $pArray[14];
			$SQL = "UPDATE Clientes SET AbreviaturaId = '$codigo', RazonSocial = '$rz', RubroClienteId = $rub, dmCalle = '$calle', dmAltura = '$alt',";
			$SQL = $SQL . "dmPiso = '$piso',dmDepto = '$depto', Domicilio = '$domicilio',LocalidadId = '$locId',CodigoPostal = '$codPost',";
			$SQL = $SQL . "dmEntreCalle1 = '$eCalle1', dmEntreCalle2 = '$eCalle2', dmReferencia = '$ref', flgCategorizacionPropia = '$catP',";
			$SQL = $SQL . "regUsuarioId = $userId, CUIT = 0 WHERE ID = $idCli";		
			echo 1;
		}
		
		$db->Query($SQL);
		$db->Disconnect();	
		
			
	}
	
	function deleteCliente($id) {
		
		$db = new cDB();
		$db->Connect();

		$SQL = "DELETE FROM CLIENTES WHERE ID = $id";
		
		$db->Query($SQL);
		$db->Disconnect();	

	}
	
	function updatePlan($idCli,$idPlan,$obs) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "UPDATE Clientes SET PlanId = $idPlan, Observaciones = '$obs' WHERE ID = $idCli";
		
		$db->Query($SQL);
		
		if ($idPlan <> 0) {
		
			$SQL = "DELETE FROM ClientesGradosOperativos WHERE ClienteId = $idCli";
			
			$db->Query($SQL);
			
		}
		
		$db->Disconnect();	
	}
	

?>