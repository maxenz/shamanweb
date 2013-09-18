<?php
	
	require_once("class.shaman.php");
	require_once("getIVA.php");
	require_once("getGrados.php");
	require_once("getOpcionesCategorizacion.php");
	require_once("qryMoviles.php");
	require_once("qryLogIncidentes.php");
	require_once("getDataIncidentes.php");

	if(!isset($_SESSION)){
		session_start();
	}
	
	$vec1 = getIVA();
	$vec2 = getGrados();
	$vec3 = getMoviles();
	$vec4 = getLogIncidentes(0);
	$vec5 = getIncidentes(0,$_SESSION["v"]);
	$vec6 = getValorEmergencia();
	
	echo json_encode(array('moviles'=>$vec3,'incidentes'=>$vec5,'iva'=>$vec1,'grados'=>$vec2,'logInc'=>$vec4,'valorEmer'=>$vec6));
	
?>