<?php
session_save_path('C:/Apache24/htdocs/seu_projeto/sessions');
if (!file_exists('C:/Apache24/htdocs/seu_projeto/sessions')) {
    mkdir('C:/Apache24/htdocs/seu_projeto/sessions', 0777, true);
}

session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano_modelo = $_POST['ano_modelo'];
    $ano_fabricacao = $_POST['ano_fabricacao'];
    $versao = $_POST['versao'];
    $cor = $_POST['cor'];
    $quilometragem = $_POST['quilometragem'];
    $valor = $_POST['valor'];
    $airbag = isset($_POST['airbag']) ? 1 : 0;
    $alarme = isset($_POST['alarme']) ? 1 : 0;
    $ar_condicionado = isset($_POST['ar_condicionado']) ? 1 : 0;

    $sql = "INSERT INTO Veiculos (marca, modelo, ano_modelo, ano_fabricacao, versao, cor, quilometragem, valor, airbag, alarme, ar_condicionado) 
            VALUES ('$marca', '$modelo', '$ano_modelo', '$ano_fabricacao', '$versao', '$cor', '$quilometragem', '$valor', '$airbag', '$alarme', '$ar_condicionado')";

    if ($conn->query($sql) === TRUE) {
        echo "Veículo cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
