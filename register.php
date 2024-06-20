<?php
session_save_path('C:/Apache24/htdocs/seu_projeto/sessions');
if (!file_exists('C:/Apache24/htdocs/seu_projeto/sessions')) {
    mkdir('C:/Apache24/htdocs/seu_projeto/sessions', 0777, true);
}

session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO Usuarios (nome, email, telefone, senha) VALUES ('$nome', '$email', '$telefone', '$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
