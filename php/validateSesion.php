<?php

/* VALIDO QUE ESTE INICIADO UNA DE LAS VARIABLES DE SESION, SINO NO ENTRA EN LA PAGINA */

 session_start();
 if (!isset($_SESSION['catalog'])) {
	header("Location: error.php");
	exit(); 
 }

?>