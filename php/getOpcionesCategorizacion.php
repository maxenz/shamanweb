<?php
		
	if (isset($_GET["opt"])) {
	
		$opt = $_GET["opt"];

		switch ($opt) {
			
			case 0:
				$cli = filter_input(INPUT_GET,'cli',FILTER_SANITIZE_STRING);
				echo getFlgCategorizacion($cli);
			break;
			
			
			case 1:
				echo getFlgPediatria();
			break;	
			
			
			case 2:
				$flgPediatria = filter_input(INPUT_GET,'flgPediatria',FILTER_SANITIZE_NUMBER_INT);
				$idSintoma = filter_input(INPUT_GET,'idSint',FILTER_SANITIZE_NUMBER_INT);
				echo getPreguntas($flgPediatria,$idSintoma);
			break;
			
			case 3:
				$acum = filter_input(INPUT_GET,'acum',FILTER_SANITIZE_NUMBER_INT);
				echo getValorCategorizacion($acum);
			break;
			
			case 4:
				echo getValorEmergencia();
			break;
			

		}
	
	}
			
	function getFlgCategorizacion($cli) {
		
		require_once("class.shaman.php");
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT flgCategorizacionPropia as flgCat FROM Clientes WHERE AbreviaturaId = '".$cli."' ";

		$db->Query($SQL);
		if ($db->numrows > 0) {	
			if ($fila = $db->Next()) {
				
				$flgCat = odbc_result($fila,'flgCat');
				
			}
			
		}
		$db->Disconnect();	
		return $flgCat;

	}
		
	function getFlgPediatria() {
			
		require_once("class.shaman.php");
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT prmLimitePediatrico as Limite FROM Configuracion";

		$db->Query($SQL);
		if ($db->numrows > 0) {
			if ($fila = $db->Next()) {
				
				$limite = odbc_result($fila,'Limite');
				
			}	
		}
		$db->Disconnect();	
		return $limite;
			
	}
		
		
	function getPreguntas($flgPediatria,$idSintoma) {
			
		require_once("class.shaman.php");
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT ID,PreguntaId,TipoFrase,Frase,Respuesta1,Respuesta2 FROM SintomasPreguntas";
		$SQL = $SQL . " WHERE SintomaId = ".$idSintoma." AND flgPediatrico = ".$flgPediatria." ORDER BY PreguntaId";
			
		$db->Query($SQL);
		if ($db->numrows > 0) {
			$varHTML = "";
			
			while ($fila = $db->Next()) {
					
				$idPregunta = odbc_result($fila,'PreguntaId');
				$frase = odbc_result($fila,'Frase');
				$tipoFrase = odbc_result($fila,'TipoFrase');
				$respuesta1 = odbc_result($fila,'Respuesta1');
				$respuesta2 = odbc_result($fila,'Respuesta2');

				if ($varHTML == "") {
						
					$varHTML = "<script>var vecPreguntas = [] ; var srcPregunta = [{'Display':'Seleccione...','Valor':0},{'Display':'NO','Valor':".$respuesta2."},{'Display':'SI','Valor':".$respuesta1."}]</script><div id='dataCategorizador'><table><tr>";
					
				} else {
						
					$varHTML = $varHTML . "<script>var srcPregunta = [{'Display':'Seleccione...','Valor':0},{'Display':'NO','Valor':".$respuesta2."},{'Display':'SI','Valor':".$respuesta1."}]</script><table><tr>";
						
				}
					
				switch ($tipoFrase) {
													
					case 'P':
						$varHTML = $varHTML . "<td style='width:520px;color:red'>".$frase."</td><td>";
						$varHTML = $varHTML . "<div id='".$idPregunta."' class='dpDownCateg'></div></td></tr></table>" ;
						$varHTML = $varHTML . "<script type='text/javascript'>$('#".$idPregunta."').jqxDropDownList({source: srcPregunta, width: 100,height: 23, displayMember:'Display', valueMember:'Valor',selectedIndex:0, dropDownHeight:75, theme:'metro'}); vecPreguntas.push(".$idPregunta.")</script>"; 	
					break;	
						
					case 'E':
						$varHTML = $varHTML . "<td style='width:520px;color:green'>".$frase."</td><td>";
						$varHTML = $varHTML . "<div id='".$idPregunta."'></div></td></tr></table>" ;
					break;
						
					case 'C':
						$varHTML = $varHTML . "<td style='width:520px;color:blue;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$frase."</td><td>";
						$varHTML = $varHTML . "<div id='".$idPregunta."' class='dpDownCateg'></div></td></tr></table>" ;
						$varHTML = $varHTML . "<script type='text/javascript'>$('#".$idPregunta."').jqxDropDownList({source: srcPregunta, width: 100,height: 23,displayMember:'Display', valueMember:'Valor', selectedIndex:0 , dropDownHeight:75, theme:'metro'});  vecPreguntas.push(".$idPregunta.") </script>";  
						
					break;
						
				}
			}
				
			$varHTML = $varHTML . "<table style='margin-top:20px;margin-left:450px'><tr><td><span id='btnGradoCateg' class='badge gradoCateg'></span></td><td><a id='btnGuardarCateg' class='btn btnCateg' href='#' ><i class='icon-checkmark-2'></i></a></td><td><a id='btnCancelarCateg' class='btn btnCateg' href='#' ><i class='icon-close'></i></a></td></tr></table><script></script></div>";
				 
			$db->Disconnect();		
			return $varHTML;
			
		}

	}
		
	function getValorCategorizacion($acum) {
				
		require_once("class.shaman.php");
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT grd.AbreviaturaId as Grado , grd.ColorHexa as Color FROM ConfigSACPuntajes cfg LEFT JOIN GradosOperativos grd ON (grd.ID = cfg.GradoOperativoId) ";
		$SQL  = $SQL . "WHERE " . $acum . " BETWEEN punDesde AND punHasta";
			
		$db->Query($SQL);
		if ($db->numrows > 0) {
			if ($fila = $db->Next()) {
					
				$grado = odbc_result($fila,'Grado');
				$color = odbc_result($fila,'Color');
				$vecGrado = array();
				$vecGrado[0] = $grado;
				$vecGrado[1] = $color;
					
			}
			$db->Disconnect();		
			return json_encode($vecGrado);
				
		} 
				
	}
			

	function getValorEmergencia() {
				
		require_once("class.shaman.php");
		
		$db = new cDB();
		$db->Connect();
		
		$SQL = "SELECT TOP 1 punDesde as Valor FROM ConfigSACPuntajes ORDER BY punDesde DESC ";

		$db->Query($SQL);
		if ($db->numrows > 0) {
			if ($fila = $db->Next()) {
					
				$valor = odbc_result($fila,'Valor');
						
			}
			$db->Disconnect();		
			return $valor;
				
		} 
				
	}

?>