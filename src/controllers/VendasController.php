<?php
require_once '../models/Venda.php';

class VendasController {
    private $venda;

    public function __construct($db) {
        $this->venda = new Venda($db);
    }

    public function listar() {
        echo json_encode($this->venda->listarTodas());
    }

    public function registrar($dados) {
        $resultado = $this->venda->registrar($dados);
        echo json_encode(['mensagem' => $resultado ? 'Venda registrada com sucesso!' : 'Erro ao registrar venda.']);
    }
}
?>