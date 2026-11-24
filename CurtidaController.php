
<?php

require_once __DIR__ . "/../models/CurtidaModel.php";

class CurtidaController {

    private $model;

    public function __construct($con) {
        $this->model = new CurtidaModel($con);
    }

    public function processar($metodo, $id = null) {

        switch ($metodo) {

            case "GET":
                return $this->model->listar();

            case "POST":
                $dados = json_decode(file_get_contents("php://input"), true);
                return $this->model->criar($dados);

            case "DELETE":
                return $this->model->excluir($id);

            default:
                http_response_code(405);
                return ["erro" => "Método não permitido"];
        }
    }
}
