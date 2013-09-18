<?php

	require("class.shaman.php");
	session_start();
	$_SESSION["dsnSistema"] = 'shamanexpress';
	$_SESSION["usr"] = 'dbaadmin';
	$_SESSION["password"] = 'yeike';
	$version = $_POST["version"];
	$_SESSION["v"] = $version;
	$urlError = "Location: ../ingresar/login.php?error=1&v=".$version;
	//$_SESSION["post"] = $_POST[""]

	$db = new cDB();
	$db->Connect();

	if (($_POST['usuario']) == "") {
		$_SESSION['error'] = "Usuario y/o Password incorrecto/s.";
		$db->Disconnect();
		header($urlError);
		exit();

	}

	if (($_POST['password']) == "") {
		$_SESSION['error'] = "Usuario y/o Password incorrecto/s.";
		$db->Disconnect();
		header($urlError);
		exit();
	}

	$usuario=$_POST['usuario'];
	$usuario = mysql_real_escape_string($usuario);

	$password=$_POST['password'];
	$password = mysql_real_escape_string($password);

	$SQL = "SELECT identificacion,PwdCompare('" . $password . "',Password) as verifPass FROM usuarios WHERE identificacion = '" . $usuario . "'";
	$db->Query($SQL);
	if ($db->numrows > 0) {
		if($data = $db->Next()) {		
			if(odbc_result($data,'verifPass') == 0) {
				$_SESSION['error'] = "Usuario y/o Password incorrecto/s.";
				$db->Disconnect();
				header($urlError);
				exit();
			}
		}
	} else {
	
		$_SESSION['error'] = "Usuario y/o Password incorrecto/s.";
		$db->Disconnect();
		header($urlError);
		exit();
				
	}
	
	$db->Query("SELECT identificacion,ID FROM usuarios WHERE identificacion = '$usuario'");
	if ($db->numrows > 0) {
		if ($data = $db->Next()){

			$_SESSION["s_username"] = odbc_result($data,'identificacion');
			$_SESSION["s_id"] = odbc_result($data,'ID');
			$db->Disconnect();
			header('Location: index.php');
			exit();
								
		}
	}
		
?>