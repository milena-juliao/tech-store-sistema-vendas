<?php
require_once '../models/Vendas.php';

class VendasController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listar() {
        echo json_encode($this->db->listar());
    }

    public function registrar($dados) {
        $query = "INSERT INTO vendas (cliente_nome, cliente_contato, cpf_cnpj, data_venda, cep, rua, bairro, cidade, estado, subtotal) 
                  VALUES (:cliente_nome, :cliente_contato, :cpf_cnpj, NOW(), :cep, :rua, :bairro, :cidade, :estado, :subtotal)";
        
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':cliente_nome', $dados['cliente_nome']);
        $stmt->bindParam(':cliente_contato', $dados['cliente_contato']);
        $stmt->bindParam(':cpf_cnpj', $dados['cpf_cnpj']);
        $stmt->bindParam(':cep', $dados['cep']);
        $stmt->bindParam(':rua', $dados['rua']);
        $stmt->bindParam(':bairro', $dados['bairro']);
        $stmt->bindParam(':cidade', $dados['cidade']);
        $stmt->bindParam(':estado', $dados['estado']);
        $stmt->bindParam(':subtotal', $dados['subtotal']);

        if ($stmt->execute()) {
            echo "Venda registrada com sucesso!";
        } else {
            echo "Erro ao registrar a venda!";
        }
    }
}

?>