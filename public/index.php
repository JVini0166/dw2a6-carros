<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karanga</title>
    <link rel="stylesheet" href="css/auth/style.css">
</head>

<body>
    <h1>Página placeholder</h1>
    <?php
    if (!isset($_SESSION["PessoaFisica"]["idPessoaFisica"])) {
        // Deslogado
        echo "<h2>Cadastro</h2>";
        include "../views/auth/CadastroForm.php";
        echo "<h2>Login</h2>";
        include "../views/auth/LoginForm.php";
    } else {
        // Logado
        echo "<a href=\"/controllers/auth/LogoutController.php\">Deslogar</a><br><br>";
        echo "Logado como " . $_SESSION["PessoaFisica"]["nome"] .
            ", email " . $_SESSION["PessoaFisica"]["email"] .
            " e CPF " . $_SESSION["PessoaFisica"]["cpf"];
    }
    ?>
</body>

</html>