<?php

function contarMaiusculas($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {

        if ($senha[$i] >= 'A' && $senha[$i] <= 'Z') {
            $quantidade++;
        }
    }
    return $quantidade;
}

function contarMinusculas($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {

        if ($senha[$i] >= 'a' && $senha[$i] <= 'z') {
            $quantidade++;
        }
    }
    return $quantidade;
}

function contarNumeros($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {

        if ($senha[$i] >= '0' && $senha[$i] <= '9') {
            $quantidade++;
        }
    }
    return $quantidade;
}

function contarEspeciais($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {

        if (!(
            ($senha[$i] >= 'A' && $senha[$i] <= 'Z') ||
            ($senha[$i] >= 'a' && $senha[$i] <= 'z') ||
            ($senha[$i] >= '0' && $senha[$i] <= '9')
        )) {
            $quantidade++;
        }
    }
    return $quantidade;
}

function classificarSenha($senha) {

    $tamanho = strlen($senha);
    $maiusculas = contarMaiusculas($senha);
    $minusculas = contarMinusculas($senha);
    $numeros = contarNumeros($senha);
    $especiais = contarEspeciais($senha);

    if ($tamanho < 8) {
        return "Fraca";
    }

    if ($maiusculas > 0 && $minusculas > 0 && $numeros > 0 && $especiais > 0) {
        return "Muito Forte";
    }

    if ($maiusculas > 0 && $minusculas > 0 && $numeros > 0) {
        return "Forte";
    }

    if ($maiusculas > 0 && $minusculas > 0) {
        return "Média";
    }

    return "Fraca";
}

function analisarSenha($senha) {
    return [
        "Maiúsculas" => contarMaiusculas($senha),
        "Minúsculas" => contarMinusculas($senha),
        "Números" => contarNumeros($senha),
        "Caracteres especiais" => contarEspeciais($senha),
        "Tamanho" => strlen($senha),
        "Segurança" => classificarSenha($senha)
    ];
}

//valor de exemplo
$senha = "Issoehumasenha#130626";
$resultado = analisarSenha($senha);

echo "Senha: " . $senha . "<br>";
echo "Letras maiúsculas: " . $resultado["Maiúsculas"] . "<br>";
echo "Letras minúsculas: " . $resultado["Minúsculas"] . "<br>";
echo "Números: " . $resultado["Números"] . "<br>";
echo "Caracteres especiais: " . $resultado["Caracteres especiais"] . "<br>";
echo "Tamanho: " . $resultado["Tamanho"] . "<br>";
echo "Nível de segurança: " . $resultado["Segurança"];

?>