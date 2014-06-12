<?php

	require_once("class.shaman.php");

	$db = new cDB();

	$db->Connect();

	echo $db->IsConnected();



?>