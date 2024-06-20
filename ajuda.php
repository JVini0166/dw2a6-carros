<?php

session_save_path(__DIR__ . '/sessions');
session_start();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajuda - Projeto Karanga</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #D9D9D9;
        }
        .header, .footer {
            background-color: #100E75;
            color: white;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .nav-link {
            color: white;
        }
        .nav-link:hover {
            color: #E37611;
        }
        .form-container {
            background-color: #100E75;
            padding: 30px;
            border-radius: 10px;
            margin: 20px;
            color: white;
        }
        .form-container h3 {
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #E37611;
            color: white;
            border: none;
            margin-top: 10px;
        }
        .btn-custom:hover {
            background-color: #ff9d47;
        }
        .footer {
            background-color: #ff7f00;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header class="header py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">LOGO</div>
            <nav>
                <a class="nav-link d-inline-block mx-2" href="comprar.php">Comprar</a>
                <a class="nav-link d-inline-block mx-2" href="vender.php">Vender</a>
                <a class="nav-link d-inline-block mx-2" href="perfil.php">Serviços</a>
                <a class="nav-link d-inline-block mx-2" href="ajuda.php">Ajuda</a>
            </nav>
            <a class="nav-link d-inline-block" href="#">Entrar</a>
        </div>
    </header>

    <div class="container my-5">
        <div class="form-container">
            <h3>Sobre o Projeto Karanga</h3>
            <p>O Projeto Karanga é uma loja de carros desenvolvida como parte do trabalho da matéria DW2A6. Este projeto foi criado por um grupo de estudantes dedicados e entusiastas por tecnologia e inovação, composto por:</p>
            <ul>
                <li>José Vinícius</li>
                <li>Andrew</li>
                <li>Murilo</li>
                <li>William</li>
                <li>Lucas</li>
                <li>Gonzaga</li>
                <li>Flavio</li>
            </ul>
            <p>Neste site, você pode explorar uma ampla variedade de carros disponíveis para compra e venda. Nosso objetivo é proporcionar uma plataforma amigável e eficiente para facilitar a negociação de veículos entre os usuários.</p>
            <p>Se você tiver alguma dúvida ou precisar de ajuda, não hesite em entrar em contato conosco. Estamos aqui para ajudar!</p>
        </div>
    </div>

    <footer class="footer mt-5">
        <p>@criador</p>
    </footer>
</body>
</html>
