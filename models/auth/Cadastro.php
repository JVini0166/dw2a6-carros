<?php

class Cadastro extends DbConnection {
    // Inserir novo cadastro no banco (PessoaFisica e Usuario)
    // Retorna idPessoaFisica caso inserção for realizada, e falso caso ocorra algum erro
    public function inserirCadastro($usuario, $cargo = "Cliente") {
        $conn = $this->connect();
        $conn->beginTransaction();

        $sqlPessoa = "INSERT INTO PessoaFisica (nome, cpf, email) VALUES (:nome, :cpf, :email)";
        $sqlUsuario = "INSERT INTO Usuario (idPessoaFisica, senha, cargo) VALUES ((SELECT idPessoaFisica FROM PessoaFisica WHERE cpf = :cpf), :senha, :cargo)";

        $senhaHashed = password_hash($usuario["senha"], PASSWORD_DEFAULT);

        $id = false;
        // Tenta inserir os dois registros no banco, realizando rollback caso algum dê erro
        try {
            $stmtPessoa = $conn->prepare($sqlPessoa);
            $stmtPessoa->execute(array(
                "nome" => $usuario["nome"],
                "cpf" => $usuario["cpf"],
                "email" => $usuario["email"],
            ));
            $id = $conn->lastInsertId();

            $stmtUsuario = $conn->prepare($sqlUsuario);
            $stmtUsuario->execute(array(
                "cpf" => $usuario["cpf"],
                "senha" => $senhaHashed,
                "cargo" => $cargo,
            ));

            $conn->commit();
            return $id;
        } catch (PDOException $e) {
            $conn->rollBack();
            return false;
        }
    }

    // Verifica se alguma coluna "$col" do banco já possui o valor "$val"
    // Retorna true caso positivo, falso se valor for unico
    public function jaExiste($col, $val) {
        $sql = "SELECT $col from PessoaFisica WHERE $col = :val";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array("val" => $val));

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }
}
