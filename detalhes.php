<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar</title>
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
        .carousel-inner {
            display: flex;
        }
        .carousel-item img {
            width: 100%;
            height: auto;
        }
        .content {
            background-color: #100E75;
            color: white;
            padding: 20px;
        }
        .content h2, .content h3 {
            margin-top: 0;
        }
        .info-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .info-item {
            flex: 1 1 calc(33.333% - 20px);
            min-width: 200px;
        }
        .price {
            background-color: #E37611;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .message-form {
            background-color: #E37611;
            padding: 20px;
            color: white;
        }
        .footer {
            background-color: #ff7f00;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .main-content {
            display: flex;
            flex-direction: row;
            margin-top: 20px;
        }
        .main-content > div {
            flex: 1;
        }
        .right-section {
            background-color: #E37611;
            color: white;
            padding: 20px;
        }
    </style>
</head>
<body>
    <header class="header py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">LOGO</div>
            <nav>
                <a class="nav-link d-inline-block mx-2" href="#">Comprar</a>
                <a class="nav-link d-inline-block mx-2" href="#">Vender</a>
                <a class="nav-link d-inline-block mx-2" href="#">Serviços</a>
                <a class="nav-link d-inline-block mx-2" href="#">Ajuda</a>
            </nav>
            <a class="nav-link d-inline-block" href="#">Entrar</a>
        </div>
    </header>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/imagens/suv.jpg" class="d-block" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/imagens/Hatches.jpg" class="d-block" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/imagens/picape.jpg" class="d-block" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/imagens/sedan.jpeg" class="d-block" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/imagens/eletrico.jpg" class="d-block" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container main-content">
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
                echo "<div class='info-grid'>";
                echo "<div class='info-item'><strong>Cidade</strong><p id='cidade'>" . htmlspecialchars($row['cidade']) . "</p></div>";
                echo "<div class='info-item'><strong>Ano</strong><p id='ano'>" . htmlspecialchars($row['ano_modelo']) . "</p></div>";
                echo "<div class='info-item'><strong>Km</strong><p id='km'>" . htmlspecialchars($row['quilometragem']) . " km</p></div>";
                echo "<div class='info-item'><strong>Câmbio</strong><p id='cambio'>" . htmlspecialchars($row['cambio']) . "</p></div>";
                echo "<div class='info-item'><strong>Carroceria</strong><p id='carroceria'>" . htmlspecialchars($row['carroceria']) . "</p></div>";
                echo "<div class='info-item'><strong>Combustível</strong><p id='combustivel'>" . htmlspecialchars($row['combustivel']) . "</p></div>";
                echo "<div class='info-item'><strong>Final da placa</strong><p id='finalPlaca'>" . htmlspecialchars($row['final_placa']) . "</p></div>";
                echo "<div class='info-item'><strong>Cor</strong><p id='cor'>" . htmlspecialchars($row['cor']) . "</p></div>";
                echo "<div class='info-item'><strong>Aceita troca</strong><p id='aceitaTroca'>" . htmlspecialchars($row['aceita_troca']) . "</p></div>";
                echo "<div class='info-item'><strong>IPVA pago</strong><p id='ipvaPago'>" . htmlspecialchars($row['ipva_pago']) . "</p></div>";
                echo "<div class='info-item'><strong>Licenciado</strong><p id='licenciado'>" . htmlspecialchars($row['licenciado']) . "</p></div>";
                echo "</div>";
                echo "<h4>Itens do veículo:</h4>";
                echo "<ul id='itensVeiculo'>";
                $itens = explode(',', $row['itens']);
                foreach ($itens as $item) {
                    echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                }
                echo "</ul>";
                echo "<h4>Sobre o vendedor:</h4>";
                echo "<p><strong>Nome do vendedor</strong>: <span id='nomeVendedor'>" . htmlspecialchars($row['nome_vendedor']) . "</span></p>";
                echo "<p><strong>Telefone</strong>: <span id='telefoneVendedor'>" . htmlspecialchars($row['telefone_vendedor']) . "</span></p>";
            } else {
                echo "<p>Veículo não encontrado.</p>";
            }

            $conn->close();
            ?>
        </div>
        <div class="right-section">
            <div class="price">
                <p>R$ <?php echo htmlspecialchars($row['valor']); ?></p>
                <button class="btn btn-primary">Ver parcelas</button>
            </div>
            <div class="price">
                <p>Valor FIPE: R$00000,00</p>
            </div>
            <div class="message-form mt-3">
                <h3>Mandar mensagem ao vendedor</h3>
                <form action="mensagem.php" method="POST">
                    <input type="hidden" name="anuncio_id" value="<?php echo htmlspecialchars($veiculo_id); ?>">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome_remetente" placeholder="Seu nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email_remetente" placeholder="Seu e-mail" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone_remetente" placeholder="Seu telefone">
                    </div>
                    <div class="form-group">
                        <label for="mensagem">Mensagem</label>
                        <textarea class="form-control" id="mensagem" name="mensagem" rows="3" placeholder="Escreva sua mensagem" required></textarea>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="autorizacaoBox">
                        <label class="form-check-label" for="autorizacaoBox">Quero receber contato por e-mail e por WhatsApp</label>
                    </div>
                    <button type="submit" class="btn btn-light">Enviar Mensagem</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer mt-5">
        <p>@criador</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let items = document.querySelectorAll('.carousel .carousel-item');

            items.forEach((el) => {
                const minPerSlide = 3;
                let next = el.nextElementSibling;
                for (let i=1; i<minPerSlide; i++) {
                    if (!next) {
                        next = items[0];
                    }
                    let cloneChild = next.cloneNode(true);
                    el.appendChild(cloneChild.children[0]);
                    next = next.nextElementSibling;
                }
            });
        });
    </script>
</body>
</html>
