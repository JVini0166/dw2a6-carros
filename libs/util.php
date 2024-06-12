<?php

// Imprime mensagem em elemento de parágrafo, permite passagem de estilo css através de
// array com nome do estilo para chave e valor como valor, ex: ["color"=>"red", "background-color"=>"black"]
function mostrarMensagem($mensagem, $estilos = []) {
    $addAttr = ">";
    if (count($estilos) > 0) {
        $addAttr = "\"" . $addAttr;                     // == ">
        foreach ($estilos as $k => $v) {
            $addAttr = $k . ":" . $v . ";" . $addAttr;  // == key:val;">
        }
        $addAttr = " style=\"" . $addAttr;              // == style="key2:val2;key:val;">
    }

    echo "<p" . $addAttr . $mensagem . "</p>";
}

// Sanitização de entrada de valores
function testarEntrada($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
