<?php
require_once 'load_env.php';

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$banco = getenv('DB_NAME');
$porta = getenv('DB_PORT');

try {
    $conexao = new PDO("mysql:host=$host;port=$porta;dbname=$banco", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    die("Erro ao conectar.");
}
