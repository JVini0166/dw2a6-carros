<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .carousel-item {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .carousel-inner {
            display: flex;
            flex-wrap: nowrap;
        }
        .carousel-inner .carousel-item {
            flex: 0 0 33.3333%;
            max-width: 33.3333%;
        }
        .card {
            margin: 15px;
        }
        @media (max-width: 767px) {
            .carousel-inner .carousel-item {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        .category-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .category {
            flex: 0 0 18%;
            box-sizing: border-box;
            margin-bottom: 20px;
        }
        .category-image img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <header class="header d-flex justify-content-between align-items-center p-3 bg-light">
        <div class="logo">LOGO</div>
        <nav>
            <a href="#" class="me-3">Comprar</a>
            <a href="#" class="me-3">Vender</a>
            <a href="#" class="me-3">Serviços</a>
            <a href="#">Ajuda</a>
        </nav>
        <a href="#" class="btn btn-outline-primary">Entrar</a>
    </header>

    <main class="content">
        <section class="search-bar p-3 bg-light" id="content-busca">
            <div class="search-options mb-3">
                <button class="btn btn-secondary me-2">Comprar carros</button>
                <button class="btn btn-secondary me-2">Comprar motos</button>
                <button class="btn btn-secondary me-2">Quero vender</button>
                <button class="btn btn-secondary">Quero financiar</button>
            </div>
            <div class="d-flex">
                <input type="text" class="form-control me-2" placeholder="Digite marca ou modelo do veículo">
                <button class="btn btn-primary">Pesquisar</button>
            </div>
        </section>


        <section class="carros my-4">
        <h2>Carros em Destaque</h2>
            <div class="container">
                
                <div id="carrosCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        include 'db.php';

                        $sql = "SELECT * FROM Veiculos";
                        $result = $conn->query($sql);
                        $active = 'active';

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $image = isset($row['image']) && !empty($row['image']) ? $row['image'] : './produto-sem-imagem.jpg';
                                echo "<div class='carousel-item $active'>";
                                echo "<div class='card mb-4' onclick=\"window.location.href='detalhes.php?id=" . htmlspecialchars($row['id']) . "'\">";
                                echo "<img src='public/$image' class='card-img-top' alt='Imagem do Veículo'>";
                                echo "<div class='card-body'>";
                                echo "<h5 class='card-title'>" . htmlspecialchars($row['marca']) . " " . htmlspecialchars($row['modelo']) . "</h5>";
                                echo "<p class='card-text'>";
                                echo "Versão: " . htmlspecialchars($row['versao']) . "<br>";
                                echo "Ano: " . htmlspecialchars($row['ano_modelo']) . "<br>";
                                echo "Quilometragem: " . htmlspecialchars($row['quilometragem']) . " km<br>";
                                echo "Cor: " . htmlspecialchars($row['cor']) . "<br>";
                                echo "Preço: R$ " . htmlspecialchars($row['valor']);
                                echo "</p>";
                                echo "<a href='detalhes.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-primary'>Ver Detalhes</a>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                $active = '';
                            }
                        } else {
                            echo "<p>Nenhum veículo encontrado.</p>";
                        }

                        $conn->close();
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carrosCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carrosCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Próximo</span>
                    </button>
                </div>
            </div>
        </section>

        <section class="contact py-4 bg-light">
            <h2 class="text-center">Canais de Atendimento</h2>
            <div class="contact-options d-flex justify-content-center">
                <a href="#" class="me-4 text-decoration-none">
                    <i class="fa-brands fa-telegram fa-2x"></i>
                    <p class="m-0">Telegram</p>
                </a>
                <a href="#" class="me-4 text-decoration-none">
                    <i class="fa-regular fa-envelope fa-2x"></i>
                    <p class="m-0">E-mail</p>
                </a>
                <a href="#" class="me-4 text-decoration-none">
                    <i class="fa-brands fa-facebook fa-2x"></i>
                    <p class="m-0">Facebook</p>
                </a>
                <a href="#" class="text-decoration-none">
                    <i class="fa-brands fa-instagram fa-2x"></i>
                    <p class="m-0">Instagram</p>
                </a>
            </div>
        </section>
    </main>

    <footer class="footer text-center py-3 bg-light">
        <p>@criador</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/js/bootstrap.min.js"></script>
</body>
</html>
