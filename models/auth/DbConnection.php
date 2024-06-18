// models/auth/DbConnection.php
<?php
require_once __DIR__ . '/../../config/load_env.php';

class DbConnection {
    private $server;
    private $host;
    private $db;
    private $user;
    private $senha;
    private $port;

    public function __construct() {
        $this->server = getenv('DB_SERVER');
        $this->host = getenv('DB_HOST');
        $this->db = getenv('DB_NAME');
        $this->user = getenv('DB_USER');
        $this->senha = getenv('DB_PASS');
        $this->port = getenv('DB_PORT');
    }

    protected function connect() {
        try {
            $conn = new PDO(
                $this->server . ":host=" . $this->host . ";dbname=" . $this->db . ";port=" . $this->port,
                $this->user,
                $this->senha
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (Exception $ex) {
            die("Erro: Deu ruim no banco de dados, informe o administrador.<br>" . $ex->getMessage() . "<br>");
        }
    }
}
