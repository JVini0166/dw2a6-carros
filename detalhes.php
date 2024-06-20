<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Veículo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="logo">LOGO</div>
        <nav>
            <a href="comprar.php">Comprar</a>
            <a href="vender.html">Vender</a>
            <a href="#">Serviços</a>
            <a href="#">Ajuda</a>
        </nav>
        <a href="login.html" class="login-link">Entrar</a>
    </header>

    <div class="container">
        <div class="content">
            <?php
            include 'db.php';

            $veiculo_id = $_GET['id'];
            $sql = "SELECT * FROM Veiculos WHERE id='$veiculo_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<h2>" . htmlspecialchars($row['marca']) . " " . htmlspecialchars($row['modelo']) . "</h2>";
                echo "<h3>" . htmlspecialchars($row['versao']) . "</h3>";
                echo "<p>Ano: " . htmlspecialchars($row['ano_modelo']) . "</p>";
                echo "<p>Quilometragem: " . htmlspecialchars($row['quilometragem']) . " km</p>";
                echo "<p>Cor: " . htmlspecialchars($row['cor']) . "</p>";
                echo "<p>Preço: R$ " . htmlspecialchars($row['valor']) . "</p>";
            } else {
                echo "<p>Veículo não encontrado.</p>";
            }

            $conn->close();
            ?>
        </div>
        <div class="form-container">
            <form action="mensagem.php" method="POST">
                <input type="hidden" name="anuncio_id" value="<?php echo htmlspecialchars($veiculo_id); ?>">
                <input type="text" name="nome_remetente" placeholder="Seu nome" required>
                <input type="email" name="email_remetente" placeholder="Seu e-mail" required>
                <input type="tel" name="telefone_remetente" placeholder="Seu telefone">
                <textarea name="mensagem" placeholder="Escreva sua mensagem" required></textarea>
                <button type="submit">Enviar Mensagem</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <
