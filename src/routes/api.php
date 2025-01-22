<?php
require_once '../config/conn.php';
require_once '../controllers/VendasController.php';
require_once '../controllers/ProdutosController.php';

$database = new Connect();
$db = $database->connectDB();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$metodo = $_SERVER['REQUEST_METHOD'];

if (strpos($uri, '/registraVendas') !== false) {
    $controller = new VendasController($db);

    if ($metodo === 'GET') {
        $controller->listar();
    } elseif ($metodo === 'POST') {
        $dados = [
            'cliente_nome' => $_POST['cliente_nome'],
            'cliente_contato' => $_POST['cliente_contato'],
            'cpf_cnpj' => $_POST['cpf_cnpj'],
            'cep' => $_POST['cep'],
            'rua' => $_POST['rua'],
            'bairro' => $_POST['bairro'],
            'cidade' => $_POST['cidade'],
            'estado' => $_POST['estado'],
            'subtotal' => $_POST['subtotal']
        ];
        $controller->registrar($dados);
    }
}
