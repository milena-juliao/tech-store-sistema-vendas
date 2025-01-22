<?php
session_start();
require '../../src/config/conn.php';

$connect = new Connect();
$pdo = $connect->connectDB();

$termo_pesquisa = isset($_GET['search']) ? $_GET['search'] : '';

$query_produtos = "SELECT * FROM produtos WHERE nome LIKE :termo_pesquisa";
$stmt_produtos = $pdo->prepare($query_produtos);
$stmt_produtos->bindValue(':termo_pesquisa', '%' . $termo_pesquisa . '%');
$stmt_produtos->execute();
$produtos = $stmt_produtos->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['adicionar_ao_carrinho'])) {
    $produto_id = $_POST['produto_id'];
    $produto_nome = $_POST['produto_nome'];
    $produto_preco = $_POST['produto_preco'];
    $quantidade = 1;

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    if (isset($_SESSION['carrinho'][$produto_id])) {
        $_SESSION['carrinho'][$produto_id]['quantidade'] += $quantidade;
    } else {
        $_SESSION['carrinho'][$produto_id] = [
            'nome' => $produto_nome,
            'preco' => $produto_preco,
            'quantidade' => $quantidade
        ];
    }
}

$subtotal = 0;
if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
    foreach ($_SESSION['carrinho'] as $produto) {
        $subtotal += $produto['preco'] * $produto['quantidade'];
    }
    
    $_SESSION['subtotal'] = $subtotal;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="assets/css/exibeProdutos.css">
    <style>
        #modalFinalizarCompra {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            overflow: auto;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <h1>Lista de Produtos</h1>

    <form method="get" action="">
        <input type="text" name="search" placeholder="Pesquisar produtos..." value="<?php echo htmlspecialchars($termo_pesquisa); ?>">
        <button type="submit">Pesquisar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nome do Produto</th>
                <th>Preço</th>
                <th>Adicionar ao Carrinho</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                    <td><?php echo number_format($produto['valor'], 2, ',', '.'); ?></td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                            <input type="hidden" name="produto_nome" value="<?php echo htmlspecialchars($produto['nome']); ?>">
                            <input type="hidden" name="produto_preco" value="<?php echo $produto['valor']; ?>">
                            <button type="submit" name="adicionar_ao_carrinho">Adicionar ao Carrinho</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Carrinho de Compras</h2>
    <?php
    if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
        echo "<table><tr><th>Produto</th><th>Preço</th><th>Quantidade</th><th>Total</th></tr>";
        $subtotal = 0;
        foreach ($_SESSION['carrinho'] as $produto) {
            $total_produto = $produto['preco'] * $produto['quantidade'];
            $subtotal += $total_produto;
            echo "<tr><td>" . htmlspecialchars($produto['nome']) . "</td>";
            echo "<td>" . number_format($produto['preco'], 2, ',', '.') . "</td>";
            echo "<td>" . $produto['quantidade'] . "</td>";
            echo "<td>" . number_format($total_produto, 2, ',', '.') . "</td></tr>";
        }
        echo "<tr><td colspan='3'><strong>Subtotal</strong></td><td><strong>" . number_format($subtotal, 2, ',', '.') . "</strong></td></tr>";
        echo "</table>";
        echo "<button type='submit' name='finalizar_compra' id='finalizar_compra'>Finalizar Compra</button>";
    } else {
        echo "<p>Seu carrinho está vazio.</p>";
    }
    ?>

    <script>
        document.getElementById('finalizar_compra').addEventListener('click', function(event) {
            event.preventDefault(); 

            window.location.href = "./vendas.php";
        });
    </script>
</body>

</html>