<?php

class CadastroController {
    private $usuario;

    public function __construct($usuario) {
        $this->usuario = $usuario;
    }

    // Validação para campos vazios
    // Retorna verdadeiro caso ok
    // Retorna falso e armazena mensagem de erro na sessão caso algum campo esteja vazio
    private function camposPreenchidos($usuario) {
        $erros = 0;
        if (empty($usuario["nome"])) {
            $_SESSION["erro"]["cadastro"]["nome"]["vazio"] = "Nome não pode estar vazio!";
            $erros++;
        }

        if (empty($usuario["email"])) {
            $_SESSION["erro"]["cadastro"]["email"]["vazio"] = "E-Mail não pode estar vazio!";
            $erros++;
        }
        if (empty($usuario["senha"])) {
            $_SESSION["erro"]["cadastro"]["senha"]["vazio"] = "Senha não pode estar vazia!";
            $erros++;
        }
        if (empty($usuario["cpf"])) {
            $_SESSION["erro"]["cadastro"]["cpf"]["vazio"] = "CPF não pode estar vazio!";
            $erros++;
        }

        if ($erros > 0) {
            return false;
        }

        return true;
    }

    // Código de validação de CPF
    // Retorna verdadeiro caso ok
    // Retorna falso e armazena mensagem de erro caso o CPF seja inválido
    private function validarCpf($cpf) {
        // Verifica se o cpf tem 11 dígitos
        if (strlen($cpf) != 11) {
            $_SESSION["erro"]["cadastro"]["cpf"]["invalido"] = "CPF inválido - CPF não contém 11 dígitos!";
            return false;
        }

        // Verifica se todos os digitos são iguais (false/inválido se positivo)
        if ($this->numerosIguais($cpf) == 10) {
            $_SESSION["erro"]["cadastro"]["cpf"]["invalido"] = "CPF inválido - CPF possui todos os números iguais!";
            return false;
        }

        // Obtem o resto1
        $resto1 = $this->obterResto($cpf, 10);

        // Obtem o resto2
        $resto2 = $this->obterResto($cpf, 11);

        // Verifica os digitos
        if ($cpf[9] != $resto1 or $cpf[10] != $resto2) {
            $_SESSION["erro"]["cadastro"]["cpf"]["invalido"] = "CPF inválido!";
            return false;
        }

        return true;
    }

    // Função auxiliar para o validador de CPF
    // Verifica a quantidade de números iguais ao primeiro
    // Utilizada para saber se todos os dígitos do cpf são iguais
    private function numerosIguais($cpf) {
        $primeiroNumero = $cpf[0];
        $iguais = 0;
        for ($i = 1; $i < strlen($cpf); $i++) {
            if ($cpf[$i] == $primeiroNumero) {
                $iguais++;
            }
        }
        return $iguais;
    }

    // Função auxiliar para o validador de CPF
    // Utilizada na obtenção dos restos 1 e 2 para verificar igualdade entre os 10º e 11º dígitos do CPF, respectivamente
    private function obterResto($cpf, $multiplicador) {
        $soma = 0;
        $fimFor = $multiplicador - 1;

        for ($i = 0; $i < $fimFor; $i++) {
            $soma += $cpf[$i] * $multiplicador;
            $multiplicador--;
        }

        $resto = ($soma * 10) % 11;

        if ($resto == 10)
            $resto = 0;

        return $resto;
    }

    // Validação da senha
    // Retorna verdadeiro caso ok
    // Retorna falso e armazena mensagem de erro caso a senha seja considerada fraca
    private function validarSenha($senha) {
        $numero = preg_match('/[0-9]/', $senha);
        if (!$numero or strlen($senha) < 8) {
            $_SESSION["erro"]["cadastro"]["senha"]["fraca"] = "A senha deve conter pelo menos 8 caracteres e um número!";
            return false;
        }

        return true;
    }

    // Guarda valores antigos na sessão para inserir nos respectivos campos em caso de falha no cadastro (UX)
    private function guardarOld($usuario) {
        $_SESSION["old"]["cadastro"]["nome"] = $usuario["nome"];
        $_SESSION["old"]["cadastro"]["email"] = $usuario["email"];
        $_SESSION["old"]["cadastro"]["cpf"] = $usuario["cpf"];
    }

    public function cadastrar() {
        // Validação
        $errosValidacao = 0;

        // Valida preenchimento dos campos
        if (!$this->camposPreenchidos($this->usuario)) {
            $errosValidacao++;
        }

        // Valida nome
        if (strlen($this->usuario["nome"]) < 3) {
            $_SESSION["erro"]["cadastro"]["nome"]["curto"] = "Nome deve possuir pelo menos 3 caracteres!";
            $errosValidacao++;
        }

        // Valida e-mail
        if (!filter_var($this->usuario["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["erro"]["cadastro"]["email"]["invalido"] = "E-mail inválido!";
            $errosValidacao++;
        }

        // Valida cpf
        if (!$this->validarCpf($this->usuario["cpf"])) {
            $errosValidacao++;
        }

        // Valida senha
        if (!$this->validarSenha($this->usuario["senha"])) {
            $errosValidacao++;
        }

        $conn = new Cadastro;
        // Verifica se email já consta no bd
        if ($conn->jaExiste("email", $this->usuario["email"])) {
            $_SESSION["erro"]["cadastro"]["email"]["existe"] = "O E-mail fornecido já está em uso!";
            $errosValidacao++;
        }

        // Verifica se CPF já consta no bd
        if ($conn->jaExiste("cpf", $this->usuario["cpf"])) {
            $_SESSION["erro"]["cadastro"]["cpf"]["existe"] = "O CPF fornecido já está em uso!";
            $errosValidacao++;
        }

        // Verifica se há erros de validação, se sim manda de volta pro index
        if ($errosValidacao > 0) {
            $conn = null;
            $this->guardarOld($this->usuario);
            return false;
        }

        // Tenta realizar o cadastro e manda de volta caso dê erro
        $id = $conn->inserirCadastro($this->usuario);
        if (!$id) {
            $_SESSION["erro"]["cadastro"]["outro"][] = "Ocorreu um erro ao tentar realizar o cadastro";
            $conn = null;
            $this->guardarOld($this->usuario);
            return false;
        }

        $login = new Login;
        $_SESSION["PessoaFisica"] = $login->getPessoaFisicaFromId($id);

        // Confere se sessão foi iniciada
        if (!isset($_SESSION["PessoaFisica"]["idPessoaFisica"])) {
            $_SESSION["erro"]["cadastro"]["outro"][] = "Ocorreu um erro ao tentar iniciar a sessão";
            $conn = null;
            $this->guardarOld($this->usuario);
            return false;
        }

        $conn = null;
        return true;
    }
}
