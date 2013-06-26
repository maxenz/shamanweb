<?php

	require_once("class.shaman.php");
	session_start();
	
	function getEdad($birthday){
	
			list($year,$month,$day) = explode("-",$birthday);
	
			$year_diff  = date("Y") - $year;
	
			$month_diff = date("m") - $month;
	
			$day_diff   = date("d") - $day;
	
			if ($day_diff < 0 || $month_diff < 0)
	
				$year_diff--;
		
			return $year_diff;
	
	}
	
	function getID($SQL,$db) {
			
		$db->Query($SQL);
		
		if ($fila = $db->Next()) {
			
				$pId = odbc_result($fila,'ID');
				return $pId;
				
			} else {
			
				return 0;	
			}		
		}
		
	function getUserId() {
		
		
		$id = $_SESSION["s_id"];
		return $id;	
		
		
	}
	
		function SQLWhere($SQL) {
			
			if (strlen(strstr($SQL,'WHERE'))>0) {
				
				return $SQL . " AND ";
	
			} else {
				
				return $SQL . " WHERE ";
				
			}
			
		}
		
		
	function limpio($data) {
		if ( !isset($data) or empty($data) ) return '';
		if ( is_numeric($data) ) return $data;
	
		$non_displayables = array(
			'/%0[0-8bcef]/',            // url encoded 00-08, 11, 12, 14, 15
			'/%1[0-9a-f]/',             // url encoded 16-31
			'/[\x00-\x08]/',            // 00-08
			'/\x0b/',                   // 11
			'/\x0c/',                   // 12
			'/[\x0e-\x1f]/'             // 14-31
		);
		foreach ( $non_displayables as $regex )
			$data = preg_replace( $regex, '', $data );
			$data = str_replace("'", "''", $data );
			return $data;
		}
		
	function modeloDate($fecha) {
			
		return str_replace("-","",$fecha);	
			
	}
	
	function getFechaHistoria() {
		
		$db = new cDB();
		$db->Connect();
		
		$dias = 0;
		
		$SQL = "SELECT rcpTpoHC FROM Configuracion WHERE ID = 1";
		$db->Query($SQL);
			
		if ($fila = $db->Next()) $dias = odbc_result($fila,'rcpTpoHC');
		
		$hoy = getdate();
		$anio = $hoy['year'];
		$mes = $hoy['mon'];
		$dia = $hoy["mday"];
		$fecha = "$anio-$mes-$dia";
		
		$db->Disconnect();	
		
		return date('Y-m-d', strtotime($fecha. ' - ' .$dias . ' days')); 
		
	
	}
	
	function getToday() {
		
		$hoy = getdate();
		$anio = $hoy['year'];
		$mes = $hoy['mon'];
		$dia = $hoy["mday"];
		$fecha = "$anio-$mes-$dia";
		
		$fecha = date('Y-m-d', strtotime($fecha));
		
		return (string)$fecha;	
	
	}
	
	function getNormalDate($fecha) {
		
		$vFecha = explode("/",$fecha);
		
		$pFecha = '$vFecha[0]-$vFecha[1]-$vFecha[2]';
		
		return $pFecha;	
		
		
		
		
	}
	
	

	

?>