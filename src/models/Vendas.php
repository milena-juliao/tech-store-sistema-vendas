<?php
class Venda {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar() {
        $query = "SELECT * FROM vendas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar($dados) {
        $query = "INSERT INTO vendas (cliente_nome, data_venda, subtotal, cep, rua, bairro, cidade, estado) 
                  VALUES (:cliente_nome, :data_venda, :subtotal, :cep, :rua, :bairro, :cidade, :estado)";
        $stmt = $this->conn->prepare($query);

        foreach ($dados as $chave => $valor) {
            $stmt->bindParam(":$chave", $dados[$chave]);
        }

        return $stmt->execute();
    }
}
?>