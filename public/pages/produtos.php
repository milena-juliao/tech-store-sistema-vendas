<?php
require '../../src/config/conn.php';
$connect = new Connect();
$connect->connectDB();

$query = "SELECT * FROM produtos";
$stmt = $connect->conn->prepare($query);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="assets/css/exibeProdutos.css">
</head>
<body>

<h1>Lista de Produtos</h1>

<table>
    <thead>
        <tr>
            <th>Nome do Produto</th>
            <th>Preço</th>
            <th>Fornecedor</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><?php echo htmlspecialchars($produto['nome']); ?></td>
            <td><?php echo number_format($produto['valor'], 2, ',', '.'); ?></td>
            <td>
                <?php
                $query_fornecedores = "SELECT f.nome AS nome_fornecedor
                                       FROM fornecedores f
                                       JOIN fornecedor_produto fp ON f.id = fp.id_fornecedor
                                       WHERE fp.id_produto = :id_produto";
                $stmt_fornecedores = $connect->conn->prepare($query_fornecedores);
                $stmt_fornecedores->bindParam(':id_produto', $produto['id']);
                $stmt_fornecedores->execute();
                $fornecedores = $stmt_fornecedores->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($fornecedores as $fornecedor) {
                    echo htmlspecialchars($fornecedor['nome_fornecedor']) . "<br>";
                }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
