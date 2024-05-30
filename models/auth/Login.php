<?php

class Login extends DbConnection {

    public function getPessoaIdFromEmail($email) {
        $sql = "SELECT idPessoaFisica from PessoaFisica where email = :email";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array("email" => $email));

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }
    
    // Retorna a senha da tabela Usuário utilizando o id do PessoaFisica
    // Ou falso se por algum motivo não encontrou
    public function getSenhaFromPessoaId($id) {
        $sql = "SELECT senha from Usuario WHERE idPessoaFisica = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array("id" => $id));

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }

    // Retorna Pessoa Física através do id, ou falso caso não encontre
    public function getPessoaFisicaFromId($id) {
        $sql = "SELECT * from PessoaFisica where idPessoaFisica = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array("id" => $id));

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }
}
