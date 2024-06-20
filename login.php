<?php
session_save_path('C:/Apache24/htdocs/seu_projeto/sessions');
if (!file_exists('C:/Apache24/htdocs/seu_projeto/sessions')) {
    mkdir('C:/Apache24/htdocs/seu_projeto/sessions', 0777, true);
}

session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM Usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: home.html");
            exit();
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }

    $conn->close();
}
?>
