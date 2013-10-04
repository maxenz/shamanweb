<?php
    
    session_start();
    
    $_SESSION["usuario"] = $_POST["usuario"];
    $_SESSION["datasource"] = $_POST["datasource"];
    $_SESSION["catalog"] = $_POST["catalog"];
    $_SESSION["dbuser"] = $_POST["dbuser"];
    $_SESSION["dbpass"] = $_POST["dbpass"];
    $_SESSION["cliente"] = $_POST["cliente"];
    $_SESSION["conexion"] = $_POST["conexion"];
    $_SESSION["v"] = $_POST["v"];

    
    echo 0;

?>