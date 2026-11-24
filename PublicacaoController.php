
<?php

require_once __DIR__ . "/../models/PublicacaoModel.php";

class PublicacaoController {

    private $model;

    public function __construct($con) {
        $this->model = new PublicacaoModel($con);
    }

    public function processar($metodo, $id = null) {

        switch ($metodo) {

            case "GET":
                if ($id) {
                    return $this->model->buscar($id);
                }
                return $this->model->listar();

            case "POST":
                $dados = json_decode(file_get_contents("php://input"), true);
                return $this->model->criar($dados);

            case "PUT":
                $dados = json_decode(file_get_contents("php://input"), true);
                return $this->model->atualizar($id, $dados);

            case "DELETE":
                return $this->model->excluir($id);

            default:
                http_response_code(405);
                return ["erro" => "Método não permitido"];
        }
    }
}
