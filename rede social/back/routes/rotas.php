<?php

$rota = $_GET["rota"] ?? "";
$metedo = $_SERVER["RESQUEST_METHOD"];

if ($rota === "usuario")
 {
    switch($metodo){
        case "POST":
            createCliente($con);
            break;
        case "GET":
            readUsuario($con);
            break;
        case "PUT":
            updateUsuario($con);
            break;
        case "DELET":
            deleteUsuario($con);
            break;
        default:
            teste();
               
    }
}