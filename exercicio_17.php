<?php

//1
function contarCaracteres($texto) {
    return strlen($texto);
}

//2
function contarPalavras($texto) {

    $texto = trim($texto);
    $palavras = explode(" ", $texto);
    return count($palavras);
}

//3
function contarFrases($texto) {

    $frases = 0;
    for ($i = 0; $i < strlen($texto); $i++) {

        if ($texto[$i] == "." || $texto[$i] == "!" || $texto[$i] == "?") {
            $frases++;
        }
    }

    return $frases;
}

//4
function encontrarMaiorMenor($texto) {

    $texto = preg_replace("/\s+/", " ", trim($texto));
    $texto = str_replace(
        [".", ",", "!", "?", ";", ":"],
        "",
        $texto
    );

    $palavras = explode(" ", $texto);
    $maior = $palavras[0];
    $menor = $palavras[0];

    foreach ($palavras as $palavra) {

        if (strlen($palavra) > strlen($maior)) {
            $maior = $palavra;
        }

        if (strlen($palavra) < strlen($menor)) {
            $menor = $palavra;
        }
    }

    return [
        "Maior" => $maior,
        "Menor" => $menor
    ];
}

//5
function contarRepetidas($texto) {

    $texto = strtolower($texto);
    $texto = str_replace(
        [".", ",", "!", "?", ";", ":"],
        "",
        $texto
    );

    $texto = preg_replace("/\s+/", " ", trim($texto));
    $palavras = explode(" ", $texto);
    $quantidades = array_count_values($palavras);
    $repetidas = 0;

    foreach ($quantidades as $quantidade) {

        if ($quantidade > 1) {
            $repetidas++;
        }
    }

    return $repetidas;
}

//6
function cincoMaisFrequentes($texto) {

    $texto = strtolower($texto);
    $texto = str_replace(
        [".", ",", "!", "?", ";", ":"],
        "",
        $texto
    );

    $texto = preg_replace("/\s+/", " ", trim($texto));
    $palavras = explode(" ", $texto);
    $quantidades = array_count_values($palavras);
    arsort($quantidades);
    return array_slice($quantidades, 0, 5, true);
}

//7
function removerEspacosDuplicados($texto) {

    return preg_replace("/\s+/", " ", trim($texto));
}

//8
function formatarTexto($texto) {

    $texto = removerEspacosDuplicados($texto);
    return ucwords(strtolower($texto));
}

//9
function processarTexto($texto) {

    $maiorMenor = encontrarMaiorMenor($texto);
    return [
        "Caracteres" => contarCaracteres($texto),
        "Palavras" => contarPalavras(removerEspacosDuplicados($texto)),
        "Frases" => contarFrases($texto),
        "Palavra mais longa" => $maiorMenor["Maior"],
        "Palavra mais curta" => $maiorMenor["Menor"],
        "Palavras repetidas" => contarRepetidas($texto),
        "Cinco mais frequentes" => cincoMaisFrequentes($texto),
        "Sem espaços duplicados" => removerEspacosDuplicados($texto),
        "Texto formatado" => formatarTexto($texto)
    ];
}

//valor de exemplo
$texto="terceirao esta   acabando e tem muitas coisas pra ver!"."Será que  vai dar tudo certo? espero  que sim!";
$resultado = processarTexto($texto);

echo "Quantidade de caracteres: " . $resultado["Caracteres"] . "<br>";
echo "Quantidade de palavras: " . $resultado["Palavras"] . "<br>";
echo "Quantidade de frases: " . $resultado["Frases"] . "<br>";
echo "Palavra mais longa: " . $resultado["Palavra mais longa"] . "<br>";
echo "Palavra mais curta: " . $resultado["Palavra mais curta"] . "<br>";
echo "Quantidade de palavras repetidas: " . $resultado["Palavras repetidas"] . "<br>";
echo "Cinco palavras mais frequentes:<br>";
foreach ($resultado["Cinco mais frequentes"] as $palavra => $quantidade) {
    echo $palavra . " - " . $quantidade . " vezes<br>";
}

echo "Texto sem espaços duplicados: " .
     $resultado["Sem espaços duplicados"] . "<br>";
echo "Texto formatado: " .
     $resultado["Texto formatado"];

?>