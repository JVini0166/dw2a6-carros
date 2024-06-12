<?php
// Nome da classe css utilizada para estilizar mensagem de erro
$erroClass = "errorMsg";

if (isset($_POST["submit"]) and $_POST["submit"] == "cadastrar") {
    require_once "../libs/util.php";
    require_once "../models/auth/DbConnection.php";
    require_once "../models/auth/Cadastro.php";
    require_once "../controllers/auth/CadastroController.php";
    require_once "../models/auth/Login.php";

    $usuario = array();
    $usuario["nome"] = testarEntrada($_POST["nome"]);
    $usuario["email"] = testarEntrada($_POST["email"]);
    $usuario["senha"] = testarEntrada($_POST["senha"]);
    $usuario["cpf"] = testarEntrada($_POST["cpf"]);

    // Limpar e-mail
    $usuario["email"] = filter_var($usuario["email"], FILTER_SANITIZE_EMAIL);

    // Remove caracteres não-numéricos do CPF
    $usuario["cpf"] = preg_replace('/[^0-9]/', '', $usuario["cpf"]);

    $cadastro = new CadastroController($usuario);
    if ($cadastro->cadastrar()) {
        header('Location: /public/index.php');
    }
}
?>
<div>
    <form method="post" class="auth">
        <p class="auth">
            <label for="nome" class="auth">Nome:</label>
            <input type="text" name="nome" id="nome" maxlength="255" placeholder="Nome Completo" class="auth"
            <?php
            if (isset($_SESSION["old"]["cadastro"]["nome"])) {
                echo "value=\"" . $_SESSION["old"]["cadastro"]["nome"] . "\"";
            }
            ?>>
            <?php
            if (isset($_SESSION["erro"]["cadastro"]["nome"])) {
                foreach ($_SESSION["erro"]["cadastro"]["nome"] as $msg) {
                    echo "<span class=\"$erroClass\">" . $msg . "</span>";
                }
            }
            ?>
        </p>
        <p class="auth">
            <label for="email" class="auth">E-Mail:</label>
            <input type="email" name="email" id="email" maxlength="255" placeholder="E-Mail" class="auth"
            <?php
            if (isset($_SESSION["old"]["cadastro"]["email"])) {
                echo "value=\"" . $_SESSION["old"]["cadastro"]["email"] . "\"";
            }
            ?>>
            <?php
            if (isset($_SESSION["erro"]["cadastro"]["email"])) {
                foreach ($_SESSION["erro"]["cadastro"]["email"] as $msg) {
                    echo "<span class=\"$erroClass\">" . $msg . "</span>";
                }
            }
            ?>
        </p>
        <p class="auth">
            <label for="senha" class="auth">Senha:</label>
            <input type="password" name="senha" id="senha" maxlength="255" placeholder="Senha" class="auth">
            <?php
            if (isset($_SESSION["erro"]["cadastro"]["senha"])) {
                foreach ($_SESSION["erro"]["cadastro"]["senha"] as $msg) {
                    echo "<span class=\"$erroClass\">" . $msg . "</span>";
                }
            }
            ?>
        </p>
        <p class="auth">
            <label for="cpf" class="auth">CPF:</label>
            <input type="text" name="cpf" id="cpf" maxlength="14" placeholder="CPF" class="auth"
            <?php
            if (isset($_SESSION["old"]["cadastro"]["cpf"])) {
                echo "value=\"" . $_SESSION["old"]["cadastro"]["cpf"] . "\"";
            }
            ?>>
            <?php
            if (isset($_SESSION["erro"]["cadastro"]["cpf"])) {
                foreach ($_SESSION["erro"]["cadastro"]["cpf"] as $msg) {
                    echo "<span class=\"$erroClass\">" . $msg . "</span>";
                }
            }
            ?>
        </p>
        <?php
        if (isset($_SESSION["erro"]["cadastro"]["outro"])) {
            foreach ($_SESSION["erro"]["cadastro"]["outro"] as $msg) {
                echo "<span class=\"$erroClass\">" . $msg . "</span>";
            }
        }
        ?>
        <p class="auth">
            <button type="submit" name="submit" value="cadastrar">Cadastrar</button>
        </p>
    </form>
    <?php
    // Limpa os valores temporários da sessão
    if (isset($_SESSION["erro"]["cadastro"]))
        unset($_SESSION["erro"]["cadastro"]);
    if (isset($_SESSION["old"]["cadastro"]))
        unset($_SESSION["old"]["cadastro"]);
    ?>
</div>