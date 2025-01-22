<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Vendas</title>
    <link rel="stylesheet" href="../css/registrarVendas.css">
</head>
<body>
    <div class="container">
        <h1>Registro de Vendas</h1>
        <form id="vendaForm">
            <div class="form-group">
                <label for="cliente_nome">Nome do Cliente:</label>
                <input type="text" id="cliente_nome" name="cliente_nome" required>
            </div>

            <div class="form-group">
                <label for="cliente_contato">Contato do Cliente:</label>
                <input type="text" id="cliente_contato" name="cliente_contato">
            </div>

            <div class="form-group">
                <label for="cpf_cnpj">CPF/CNPJ:</label>
                <input type="text" id="cpf_cnpj" name="cpf_cnpj" maxlength="14">
            </div>

            <div class="form-group">
                <label for="data_venda">Data da Venda:</label>
                <input type="date" id="data_venda" name="data_venda" required>
            </div>

            <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" maxlength="10" required>
            </div>

            <div class="form-group">
                <label for="rua">Rua:</label>
                <input type="text" id="rua" name="rua" required readonly>
            </div>

            <div class="form-group">
                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" required readonly>
            </div>

            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" required readonly>
            </div>

            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" required readonly>
            </div>

            <div class="form-group">
                <label for="subtotal">Subtotal:</label>
                <input type="number" id="subtotal" name="subtotal" step="0.01" required>
            </div>

            <button type="submit">Registrar Venda</button>
        </form>
    </div>

    <script src="../js/cep.js" defer></script>
</body>
</html>
