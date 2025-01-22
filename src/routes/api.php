<?php
require_once '../config/conn.php';
require_once '../controllers/VendasController.php';

$database = new Connect();
$db = $database->connectDB();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$metodo = $_SERVER['REQUEST_METHOD'];

if (strpos($uri, '/vendas') !== false) {
    $controller = new VendasController($db);

    if ($metodo === 'GET') {
        $controller->listar();
    } elseif ($metodo === 'POST') {
        $dados = json_decode(file_get_contents("php://input"), true);
        $controller->registrar($dados);
    }
}
?>