<?php
    $host = "br424.hostgator.com.br";
    $user = "alsoac40_dw2a6";
    $pass = "MaçãComPaçoca2024";
    $banco = "alsoac40_vrum";
    $porta = 3306;

    try {
      $conexao = new PDO("mysql:host=$host;port=$porta;dbname=$banco", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (Exception $ex) {
      die ("Erro ao conectar.");
  }
