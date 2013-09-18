<?php

	require_once("class.shaman.cache.php");

	$db = new cDB();

	$db->Connect();

	echo $db->IsConnected();

	$SQL = "SELECT Descripcion FROM Emergency.Diagnosticos";

	$db->Query($SQL);

	//echo $db->numrows;

	while ($fila = $db->Next()) {

	 	//$descripcion = utf8_encode(odbc_result($fila,'Descripcion'));
	 	$descripcion = odbc_result($fila,'Descripcion');
	 	echo $descripcion;
	}


?>