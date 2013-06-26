<?php

	require_once("class.shaman.php");
	require_once("genericas.php");
		
	$opt = $_GET["opt"];

	switch($opt) {
		
		case 0:
			$act = $_GET["act"];
			$pFtr = $_GET["filtro"];
			getMoviles($act,$pFtr);
		break;
		
		case 1:
			$id = $_GET["id"];
			deleteMovil($id);
		break;
		
		case 2:
			$id = $_GET["id"];
			getHistorialMovil($id);
		break;
		
		case 3:
			$id = $_GET["id"];
			getMovil($id);
		break;
		
		case 4:
			$bSel = $_GET["sel"];
			$idMov = $_GET["idMov"];
			getLocalidades($bSel,$idMov);
		break;
		
		case 5:
			$pArray = $_POST["pArray"];
			insertoMovil($pArray);
		break;
		
		case 6:
			$dom = $_GET["dom"];
			getDataVehiculo($dom);
		break;
		
		case 7:
			$id = $_GET["idTipMov"];
			getGdosCobertura($id);
		break;
		
	}
	
	function getMoviles($act,$ftr) {
	
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT mov.ID as idMov, mov.Movil as Movil, tmv.Descripcion as descTipMov, veh.Dominio as Dominio, (mar.Marca + ' - ' + mar.Modelo) as MM,";
		$SQL = $SQL . " veh.Situacion as sitMov FROM Moviles mov ";
        $SQL = $SQL . "INNER JOIN TiposMoviles tmv ON (mov.TipoMovilId = tmv.ID) ";
        $SQL = $SQL . "LEFT JOIN Vehiculos veh ON (mov.VehiculoId = veh.ID) ";
        $SQL = $SQL . "LEFT JOIN MarcasModelos mar ON (veh.MarcaModeloId = mar.ID) ";
        if ($act == 1) $SQL =  SQLWhere($SQL) . " (mov.Activo = 1) "; 
		if ($ftr <> -1) $SQL =  SQLWhere($SQL). " (mov.relTabla = $ftr)";
		$SQL = $SQL . " ORDER BY mov.Movil";
		
		$db->Query($SQL);
		
		while($fila = $db->Next()) {
			$datos[] = array(
			
				'ID' => odbc_result($fila,'idMov'),
				'Movil' => odbc_result($fila,'Movil'),
				'descTipMov' => odbc_result($fila,'descTipMov'),
				'Dominio' => odbc_result($fila,'Dominio'),
				'MM' => odbc_result($fila,'MM'),
				'sitMov' => odbc_result($fila,'sitMov')
			);	
		
		}
	
		echo json_encode($datos);
		$db->Disconnect();		
	}
	
	function deleteMovil($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "DELETE FROM Moviles WHERE ID = $id";
		
		$db->Query($SQL);
		$db->Disconnect();	
	}
	
	function getHistorialMovil($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT his.ID, his.VigenciaDesde, his.VigenciaHasta, his.Movil, tmv.Descripcion, veh.Dominio FROM MovilesHistorias his ";
        $SQL = $SQL . "INNER JOIN TiposMoviles tmv ON (his.TipoMovilId = tmv.ID) ";
        $SQL = $SQL . "LEFT JOIN Vehiculos veh ON (his.VehiculoId = veh.ID) ";
        $SQL = $SQL . "WHERE (his.MovilId = " . $id . ") ";
        $SQL = $SQL . " ORDER BY his.VigenciaDesde DESC";
		
		$db->Query($SQL);
		echo $SQL;
		
		while($fila = $db->Next()) {
			
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'Desde' => odbc_result($fila,'VigenciaDesde'),
				'Hasta' => odbc_result($fila,'VigenciaHasta'),
				'Movil' => odbc_result($fila,'Movil'),
				'TipoMovil' => odbc_result($fila,'Descripcion'),
				'Dominio' => odbc_result($fila,'Dominio')				
			);
				
		}
		
		echo json_encode($datos);
		$db->Disconnect();			
	}
	
	function getMovil($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT mov.ID as ID, mov.Movil as Movil, tmv.ID as TipoMovil,";
		$SQL = $SQL . "veh.Dominio as Dominio,mar.Marca as Marca,mar.Modelo as Modelo,";
		$SQL = $SQL . "bO.ID as BaseOperativa,tmv.ID as TipoMovilId,veh.ID as vehID, veh.flgPropio as flgPropio ";
		$SQL = $SQL . "FROM Moviles mov ";
		$SQL = $SQL . "INNER JOIN TiposMoviles tmv ON (mov.TipoMovilId = tmv.ID) ";
		$SQL = $SQL . "LEFT JOIN Vehiculos veh ON (mov.VehiculoId = veh.ID) ";
		$SQL = $SQL . "LEFT JOIN MarcasModelos mar ON (veh.MarcaModeloId = mar.ID) ";
		$SQL = $SQL . "LEFT JOIN BasesOperativas bO ON (bO.ID = mov.BaseOperativaId) ";
		$SQL = $SQL . " WHERE mov.ID = $id";
		
		$db->Query($SQL);
		
		$arr = array();
		$tmId = 0;
		$vehID = 0;
		$flgPropio = 0;
		
		if($fila = $db->Next()) {
			
			$tmId = odbc_result($fila,'TipoMovilId');
			$vehID = odbc_result($fila,'vehID');
			$flgPropio = odbc_result($fila,'flgPropio');
			array_push($arr,odbc_result($fila,'ID'));
			array_push($arr,odbc_result($fila,'Movil'));
			array_push($arr,odbc_result($fila,'TipoMovil'));
			array_push($arr,odbc_result($fila,'Dominio'));
			array_push($arr,odbc_result($fila,'Marca'));
			array_push($arr,odbc_result($fila,'Modelo'));
			array_push($arr,odbc_result($fila,'BaseOperativa'));
				
		}
		
		$SQL = "SELECT cf.AbreviaturaId as Grado FROM ConceptosFacturacion cf";
		$SQL = $SQL . " INNER JOIN GradosOperativos gdo ON (gdo.ConceptoFacturacion1Id = cf.ID)";
		$SQL = $SQL . " INNER JOIN TiposMovilesGrados tmg ON (tmg.GradoOperativoId = gdo.ID)";
		$SQL = $SQL . " WHERE tmg.TipoMovilId = $tmId";
		$db->Query($SQL);
		$gdosCob = "";
		
		while ($fila = $db->Next()) {
			
			$gdo = odbc_result($fila,'Grado');
			
			if ($gdosCob == "") {
				
				$gdosCob = $gdo;
					
			} else {
				
				$gdosCob = $gdosCob . " - " . $gdo;
				
			}
					
		}
		
		array_push($arr,$gdosCob);
		
		
		if ($flgPropio == 1) {
			
			array_push($arr,'MOVIL PROPIO');
			
		} else {
		
			$SQL = "SELECT pre.RazonSocial as rz FROM Prestadores pre INNER JOIN Vehiculos veh ON (veh.PrestadorId = pre.ID) ";
			$SQL = $SQL . "INNER JOIN Moviles mov ON (mov.VehiculoId = veh.ID)";
			$SQL = $SQL . "WHERE mov.ID = $id";
			
			$db->Query($SQL);
			if ($fila = $db->Next()) {
				
				$rz = odbc_result($fila,'rz');
				array_push($arr,$rz);	
				
			}		
		}
		
		array_push($arr,$vehID);
		echo json_encode($arr);	
		$db->Disconnect();		
	}
	
	function getLocalidades($bSel,$idMov) {
		
		$db = new cDB();
		$db->Connect();
		
		if ($bSel == 0) {
			
			$SQL = "SELECT ID, Descripcion, AbreviaturaId FROM Localidades";
			$SQL = $SQL . " WHERE(ID NOT IN(SELECT LocalidadId FROM MovilesLocalidades WHERE (MovilId = $idMov )))";
			$SQL = $SQL . " ORDER BY Descripcion";
				
		} else {
			
		    $SQL = "SELECT loc.ID as ID,loc.Descripcion as Descripcion,loc.AbreviaturaId as AbreviaturaId FROM MovilesLocalidades ml";
			$SQL = $SQL . " INNER JOIN Localidades LOC ON (loc.ID = ml.LocalidadId)";
			$SQL = $SQL . " WHERE (ml.MovilId = $idMov ) ORDER BY Descripcion";
		}
			
		$db->Query($SQL);
		
		while ($fila = $db->Next()) {
			$desc = odbc_result($fila,'Descripcion');
			$abr = odbc_result($fila,'AbreviaturaId');
			$datos[] = array(
				'ID' => odbc_result($fila,'ID'),
				'Localidad' => $desc . ' ('.$abr.')',
			);	
			
		}
		
		echo json_encode($datos);
		$db->Disconnect();
	}	
	
	
	function insertoMovil($pArray) {
		
		$db = new cDB();
		$db->Connect();
		
		$vLoc = array();
		for ($i = 5; $i < sizeOf($pArray); $i++) {
			
			array_push($vLoc,$pArray[$i]);	
			
		}
		
		$movil = filter_var($pArray[0],FILTER_SANITIZE_STRING);
		$vehId = $pArray[1];
		$tipMovId = $pArray[2];
		$bOp = $pArray[3];
		$userId = getUserId();
		
		if ($_GET["optInsModif"] == 0) {
		
			$SQL = "INSERT INTO Moviles (Movil,relTabla,TipoMovilId,BaseOperativaId,VehiculoId,PrestadorId,PersonalId,Activo,regUsuarioId) ";
			$SQL = $SQL . "VALUES ($movil,0,$tipMovId,$bOp,$vehId,0,0,1,$userId)";
			$db->Query($SQL);
			echo 0;		
			
		} else {
				
			$idMov = $pArray[4];
			$SQL = "UPDATE Moviles SET Movil = '$movil', TipoMovilId = '$tipMovId', BaseOperativaId = '$bOp', VehiculoId = $vehId, regUsuarioId = $userId";
			$SQL = $SQL . " WHERE ID = $idMov";	
			$db->Query($SQL);
			$SQL = "DELETE FROM MovilesLocalidades WHERE MovilId = $idMov";
			$db->Query($SQL);
			setGrados($idMov,$vLoc,$db,$userId);	
			echo 1;
			
		}
		$db->Disconnect();
	}
	
	function setGrados($id,$arr,$db,$userId) {
		
		for ($i = 0; $i < sizeOf($arr); $i++) {
			$loc = $arr[$i];
			$SQL = "INSERT INTO MovilesLocalidades (MovilId,LocalidadId,regUsuarioId) VALUES ($id,$loc,$userId)";	
			$db->Query($SQL);		
		}
		
		$db->Disconnect();
	}
	
	function getDataVehiculo($dom) {
		
		$db = new cDB();
		$db->Connect();
		
		$arr = array();
		$flgPropio = 0;
		$id = 0;
		
		$SQL = "SELECT mm.Marca as Marca, mm.Modelo as Modelo,veh.ID as ID, veh.flgPropio as flgPropio FROM Vehiculos veh";
		$SQL = $SQL . " INNER JOIN MarcasModelos mm ON (mm.ID = veh.MarcaModeloId)";
		$SQL = $SQL . " WHERE veh.Dominio = '$dom' ";
		
		$db->Query($SQL);
		
		if ($fila = $db->Next()) {
			
			$marca = odbc_result($fila,'Marca');
			$modelo = odbc_result($fila,'Modelo');
			$flgPropio = odbc_result($fila,'flgPropio');
			$id = odbc_result($fila,'ID');
			array_push($arr,$marca);
			array_push($arr,$modelo);
				
		}
		
		if ($flgPropio == 1) {
			
			array_push($arr,'MOVIL PROPIO');	
			
		} else {
			
			$SQL = "SELECT pre.RazonSocial as rz FROM Prestadores pre ";
			$SQL = $SQL . "INNER JOIN Vehiculos veh ON (veh.PrestadorId = pre.ID) ";
			$SQL = $SQL . "WHERE veh.ID = $id";
			
			$db->Query($SQL);
			
			if ($fila = $db->Next()) {
				
				$rz = odbc_result($fila,'rz');
				array_push($arr,$rz);	
			}				
		}
		
		array_push($arr,$id);
		
		echo json_encode($arr);

		$db->Disconnect();
	}
	
	function getGdosCobertura($id) {
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT cf.AbreviaturaId as Grado FROM ConceptosFacturacion cf";
		$SQL = $SQL . " INNER JOIN GradosOperativos gdo ON (gdo.ConceptoFacturacion1Id = cf.ID)";
		$SQL = $SQL . " INNER JOIN TiposMovilesGrados tmg ON (tmg.GradoOperativoId = gdo.ID)";
		$SQL = $SQL . " WHERE tmg.TipoMovilId = $id";
		$db->Query($SQL);
		$gdosCob = "";
		
		while ($fila = $db->Next()) {
			
			$gdo = odbc_result($fila,'Grado');
			
			if ($gdosCob == "") {
				
				$gdosCob = $gdo;
					
			} else {
				
				$gdosCob = $gdosCob . " - " . $gdo;
				
			}
					
		}
		
		echo $gdosCob;	
		$db->Disconnect();	
	}
		
?>