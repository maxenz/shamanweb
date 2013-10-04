<?php

require("class.shaman.php");

/* INICIALIZO DB Y VALIDO SI USUARIO ES CORRECTO, SINO MANDO ERROR A LOGIN */

$db = new cDB();
$db->ConnectLOGIN("mysql_shaman_express","maxenz","elmaxo");

$usuario=$_POST['usuario'];
$usuario = mysql_real_escape_string($usuario);

$password=$_POST['password'];
$password = mysql_real_escape_string($password);

$version=$_POST['version'];
$version = mysql_real_escape_string($version);

if ( !($usuario == "") && !($password == "") ) {

    validateUsuario($db,$usuario,$password,$version);

} else {

    echo 0;

}

/* FUNCIONES GENERALES DEL CONTROL DE INGRESO */

function validateUsuario($db,$usuario,$password,$version) {

    $SQL = "SELECT id,descripcion,password FROM usuarios WHERE descripcion = '$usuario'";
    $db->Query($SQL);
    if($data = $db->Next()) {
        $qPass = odbc_result($data,"password");
        $qId = odbc_result($data,"id");
        if($qPass <> $password) {

            echo 0;

        } else {

            selectClienteAIngresar($usuario,$qId,$db,$version);

        }

    } else {

        echo 0;

    }
}

function selectClienteAIngresar($usuario,$qId,$db,$version) {

    $v = getVersion($version);

    $SQL = "SELECT cli.id AS ID,cli.razonSocial AS CLIENTE,clili.cnn_data_source AS DATASOURCE,";
    $SQL .= "clili.cnn_catalog AS CATALOG,clili.cnn_user AS DBUSER,clili.cnn_pass AS DBPASS, clili.conexion_servidor as CONEX ";
    $SQL .= "FROM usuarios_clientes uscli ";
    $SQL .= "INNER JOIN clientes cli ON (uscli.cliente_id = cli.id) ";
    $SQL .= "INNER JOIN clientes_licencias clili ON (clili.cliente_id = cli.id) ";
    $SQL .= "INNER JOIN licencias_productos licpro ON (licpro.licencia_id = clili.licencia_id) ";
    $SQL .= "WHERE uscli.usuario_id = $qId AND licpro.producto_id = $v ";

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