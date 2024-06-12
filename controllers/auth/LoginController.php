<?php

class LoginController {
    private $login;

    public function __construct($login) {
        $this->login = $login;
    }

    public function logar() {
        $conn = new Login;

        // Pega id da PessoaFísica no banco utilizando email do formulário
        // Caso não retorne id (email não encontrado), retorna para o index
        $id = $conn->getPessoaIdFromEmail($this->login["email"]);
        if (!isset($id["idPessoaFisica"])) {
            $_SESSION["erro"]["login"]["credenciais"][] = "Credenciais incorretas";
            $conn = null;
            return false;
        }

        // Pega senha do usuário + verifica se corresponde à inserida no formulario
        $senha = $conn->getSenhaFromPessoaId($id["idPessoaFisica"]);
        if (!password_verify($this->login["senha"], $senha["senha"])) {
            $_SESSION["erro"]["login"]["credenciais"][] = "Credenciais incorretas";
            $conn = null;
            return false;
        }

        // Credenciais válidas - realizando login e guardando info na sessão

        $_SESSION["PessoaFisica"] = $conn->getPessoaFisicaFromId($id["idPessoaFisica"]);

        // Confere se sessão foi iniciada
        if (!isset($_SESSION["PessoaFisica"]["idPessoaFisica"])) {
            $_SESSION["erro"]["login"]["outro"][] = "Ocorreu um erro ao tentar iniciar a sessão";
            $conn = null;
            return false;
        }

        $conn = null;
        return true;
    }
}
