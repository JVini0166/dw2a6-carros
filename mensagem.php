<?php
session_save_path('C:/Apache24/htdocs/seu_projeto/sessions');
if (!file_exists('C:/Apache24/htdocs/seu_projeto/sessions')) {
    mkdir('C:/Apache24/htdocs/seu_projeto/sessions', 0777, true);
}

session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anuncio_id = $_POST['anuncio_id'];
    $nome_remetente = $_POST['nome_remetente'];
    $email_remetente = $_POST['email_remetente'];
    $telefone_remetente = $_POST['telefone_remetente'];
    $mensagem = $_POST['mensagem'];

    // Verifica se o ID do anúncio existe na tabela Anuncios
    $check_sql = "SELECT * FROM Anuncios WHERE id='$anuncio_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $sql = "INSERT INTO Mensagens (id_anuncio, nome_remetente, email_remetente, telefone_remetente, mensagem) 
                VALUES ('$anuncio_id', '$nome_remetente', '$email_remetente', '$telefone_remetente', '$mensagem')";

        if ($conn->query($sql) === TRUE) {
            echo "Mensagem enviada com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Erro: Anúncio não encontrado.";
    }

    $conn->close();
}
?>
