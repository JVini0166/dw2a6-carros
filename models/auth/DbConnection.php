<?php

class DbConnection {
    private $server = "mysql";
    private $host = "br424.hostgator.com.br";
    private $db = "alsoac40_vrum";
    private $user = "alsoac40_dw2a6";
    private $senha = "MaçãComPaçoca2024";
    protected function connect() {
        try {
            $conn = new PDO(
                $this->server . ":host=" . $this->host . ";dbname=" . $this->db,
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
