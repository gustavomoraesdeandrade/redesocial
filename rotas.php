
<?php

require_once __DIR__ . "/../controllers/usuariocontrollers.php";
require_once __DIR__ . "/../controllers/PublicacaoController.php";
require_once __DIR__ . "/../controllers/CurtidaController.php";

$rota = $_GET["rota"] ?? "";
$metodo = $_SERVER["REQUEST_METHOD"];
$id = $_GET["id"] ?? null;

if($rota === "usuario"){

    switch($metodo){

        case "POST":
            createUsuario($con);
            break;

        case "GET":
            readUsuario($con);
            break;

        case "PUT":
            updateUsuario($con);
            break;

        case "DELETE":
            deleteUsuario($con);
            break;

        default:
            http_response_code(405);
            echo json_encode(["erro" => "Metodo nao permitido"]);
            break;
    }

} elseif($rota === "login" && $metodo === "POST"){

    loginUsuario($con);

} elseif($rota === "publicacao"){

    $controller = new PublicacaoController($con);
    $resultado = $controller->processar($metodo, $id);

    echo json_encode($resultado);

} elseif($rota === "curtida"){

    $controller = new CurtidaController($con);
    $resultado = $controller->processar($metodo, $id);

    echo json_encode($resultado);

} else {

    http_response_code(404);

    echo json_encode([
        "erro" => "Rota nao encontrada"
    ]);
}


