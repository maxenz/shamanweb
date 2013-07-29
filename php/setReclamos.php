<?php
	
	$vReclamos = array();
	$vInc = $_POST["pArray"];
	for ($i = 0; $i < $vInc; $i++) {
		$id = $vInc[$i].ID;
		if (incTieneReclamo($id)) $vReclamos.push($id);
	}


	function incTieneReclamo(id){

		
	}
	



?>