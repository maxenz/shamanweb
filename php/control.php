<?php

require("class.shaman.php");

/* INICIALIZO DB Y VALIDO SI USUARIO ES CORRECTO, SINO MANDO ERROR A LOGIN */

$usuario=filter_input(INPUT_GET,'usuario',FILTER_SANITIZE_STRING);
$password =filter_input(INPUT_GET,'password',FILTER_SANITIZE_STRING);
$version =filter_input(INPUT_GET,'version',FILTER_SANITIZE_STRING);

$db = new cDB();
$db->ConnectLOGIN();

if ( !($usuario == "") && !($password == "") ) {

    validateUsuario($db,$usuario,$password,$version);

} else {

    echo 0;

}

/* FUNCIONES GENERALES DEL CONTROL DE INGRESO */

function validateUsuario($db,$usuario,$password,$version) {
       
    $SQL = "SELECT UserID FROM UserProfile WHERE UserName = '$usuario'";
    $db->Query($SQL);
    if ($data = $db->Next()) {
        $qId = odbc_result($data,"UserID");

       // $SQL = "SELECT PWDCOMPARE('$password',Password) as hola FROM webpages_Membership WHERE UserId = $qID ";
        //$db-> Query($SQL);
        
        //if ($data = $db->Next()) {
            
            $passOK = 1;         
            if ($passOK == 1) {
                selectClienteAIngresar($usuario,$qId,$db,$version);
            } else {
                echo 0;
            }
        //}
        
    } else {
        
        echo 0;
    }
     
}

function selectClienteAIngresar($usuario,$qId,$db,$version) {

    $v = getVersion($version);
    
    $SQL = "SELECT cli.ID AS ID,cli.RazonSocial AS CLIENTE,clili.CnnDataSource AS DATASOURCE,";
    $SQL .= "clili.CnnCatalog AS CATALOG,clili.CnnUser AS DBUSER,clili.CnnPassword AS DBPASS, clili.ConexionServidor as CONEX ";
    $SQL .= "FROM ClientesUsuarios uscli ";
    $SQL .= "INNER JOIN Clientes cli ON (uscli.ClienteID = cli.id) ";
    $SQL .= "INNER JOIN ClientesLicencias clili ON (clili.ClienteID = cli.id) ";
    $SQL .= "INNER JOIN Licencias_Productos licpro ON (licpro.LicenciaID = clili.LicenciaID) ";
    $SQL .= "WHERE uscli.UsuarioID = $qId AND licpro.ProductoID = $v ";

    $db->Query($SQL);
      
    $cant = $db->numrows;
    
    if ($cant == 0) {

        echo 1;

    } else {
          
        $vClientes = array();
        while ($data = $db->Next()) {
                     
            $vClientes[] = array(
                $cliente = odbc_result($data,"CLIENTE"),
                $datasource = odbc_result($data,"DATASOURCE"),
                $catalog = odbc_result($data,"CATALOG"),
                $dbuser = odbc_result($data,"DBUSER"),
                $dbpass = odbc_result($data,"DBPASS"),
                $conex = odbc_result($data,"CONEX")
             );
        }


        echo json_encode($vClientes);

    }

}

function getVersion($v) {

    switch ($v)
    {
        case 'express':
            return 1;
            break;

        case 'full':
            return 4;
            break;
    }

}

?>