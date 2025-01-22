<?php
require '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Connect
{
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_psw;
    public $conn;

    public function __construct()
    {
        $this->db_host = $_ENV['DB_HOST'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->db_user = $_ENV['DB_USER'];
        $this->db_psw = $_ENV['DB_PASSWORD'];
    }

    public function connectDB()
    {

        try {

            $this->conn = new PDO("mysql:host={$this->db_host};dbname={$this->db_name}", $this->db_user, $this->db_psw);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}
