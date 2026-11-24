<?php

require_once __DIR__ . "/../models/UsuarioModel.php";

function teste(){
    echo json_encode([
        "mensagem" => "Back-end respondedo com sucesso!"
        ]);
    exit;
}
function receberDadosUsuario(){
    $dados = json_decode(file_get_contents("php://input"), true);

    if(!is_array($dados)){
        https_response_code(400);
        echo json_encode([
            "erro" => "Envie um objeto JSON com o dados do usuario"
        ]);
        return null;
    }
    foreach(["nome","username","email","senha"] as $campo){
        if(!isset($dados[$campo]) ||
            !is_string($dados[$campo]) ||
            trim($dados[$campo]) === "") {
                https_response_code(400);
                echo json_encode([
                    "erro" =>
                    "O campo $campo e obrigatorio e deve ser um texto nao vazio"
                ]);
                return null
            }
    }

    return $dados;
}

function receberIDUsuario(){
    $id = filter_var($_GET["id"]  ?? null, FILTER_VALIDATE_INT,
         ["options" => ["min_range"=> 1]] );
    if($id === false){
        http_response_code(400);
        echo_json_encode([
            "erro" => "Informe um id de usuario valido"
        ]);
        return null;
    }
    return $id;
}

function createUsuario($con){
    $dados = receberDadosUsuario();
    if($dados === null) return;

    $id = inserirUsuario($con, $dados);
    http_response_code(201);
    echo json_encode([
        "mensagem" => "Usuario criado com sucesso!",
        "id_usuario" => $id
    ]);
}
function readUsuario($con){
    echo json_encode(listarUsuario($con));
    }
    function updateUsuario($con){
        $id = receberIDUsuario();
        if($id === null) {
            return;
    }
    $dados = receberDadosUsuario();
    atualizarUsuario($con, $id, $dados);
    echo json_encode([
        "mensagem" => "Senha atualizado com sucesso!"
    ]);

}
function deleteUsuario($con){
    $id = receberIDUsuario();
    if($id === null)
         return;
}

