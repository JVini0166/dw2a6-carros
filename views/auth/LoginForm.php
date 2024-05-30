<?php
// Nome da classe css utilizada para estilizar mensagem de erro
$erroClass = "errorMsg";

if (isset($_POST["submit"]) and $_POST["submit"] == "login") {
    require_once "../libs/util.php";
    require_once "../models/auth/DbConnection.php";
    require_once "../models/auth/Login.php";
    require_once "../controllers/auth/LoginController.php";

    $login = array();
    $login["email"] = testarEntrada($_POST["email"]);
    $login["senha"] = testarEntrada($_POST["senha"]);

    // Limpar e-mail
    $login["email"] = filter_var($login["email"], FILTER_SANITIZE_EMAIL);

    $login = new LoginController($login);
    if ($login->logar()) {
        header('Location: /public/index.php');
    }
}
?>
<div>
    <form method="post" class="auth">
        <p class="auth">
            <label for="email" class="auth">E-Mail:</label>
            <input type="email" name="email" id="email" maxlength="255" placeholder="E-Mail" class="auth">
        </p>
        <p class="auth">
            <label for="senha" class="auth">Senha:</label>
            <input type="password" name="senha" id="senha" maxlength="255" placeholder="Senha" class="auth">
        </p>
        <?php
        if (isset($_SESSION["erro"]["login"]["credenciais"])) {
            foreach ($_SESSION["erro"]["login"]["credenciais"] as $msg) {
                echo "<p class=\"$erroClass\">" . $msg . "</span>";
            }
        }
        if (isset($_SESSION["erro"]["login"]["outro"])) {
            foreach ($_SESSION["erro"]["login"]["outro"] as $msg) {
                echo "<p class=\"$erroClass\">" . $msg . "</span>";
            }
        }
        ?>
        <p class="auth">
            <button type="submit" name="submit" value="login">Login</button>
        </p>
        <?php
        // Limpa os valores temporários da sessão
        if (isset($_SESSION["erro"]["login"]))
            unset($_SESSION["erro"]["login"]);
        ?>
    </form>
</div>