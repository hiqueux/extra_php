<?php

//1
function contarConsultas($agenda) {

    return count($agenda);
}

//2
function contarPacientesDiferentes($agenda) {

    $pacientes = [];

    foreach ($agenda as $consulta) {
        $pacientes[$consulta["paciente"]] = true;
    }

    return count($pacientes);
}

//3
function contarEspecialidades($agenda) {

    $especialidades = [];

    foreach ($agenda as $consulta) {
        $especialidade = $consulta["especialidade"];

        if (isset($especialidades[$especialidade])) {
            $especialidades[$especialidade]++;
        } else {
            $especialidades[$especialidade] = 1;
        }

    }
    return $especialidades;
}

//4
function ordernarAgenda($agenda) {

    for ($i = 0; $i < count($agenda); $i++) {
        for ($j = $i + 1; $j < count($agenda); $j++) {

            if ($agenda[$i]["horario"] > $agenda[$j]["horario"]) {
                $temp = $agenda[$i];
                $agenda[$i] = $agenda[$j];
                $agenda[$j] = $temp;
            }
        }
    }

    return $agenda;

}

//5
function pesquisarPaciente($agenda, $nome) {

    $resultado = [];

    foreach ($agenda as $consulta) {
        if (strtolower($consulta["paciente"]) === strtolower($nome)) {
            $resultado[] = $consulta;
        }
    }

    return $resultado;
}

//6
function verificarHorariosDuplicados($agenda) {

    $horarios = [];
    $duplicados = [];

    foreach ($agenda as $consulta) {
        $horario = $consulta["horario"];

        if (isset($horarios[$horario])) {
            $duplicados[] = $horario;
        } else {
            $horarios[$horario] = true;
        }
    }

    return $duplicados;
}

//7
function organizarAgenda($agenda, $pacientePesquisa) {

    $agendaOrdenada = ordernarAgenda($agenda);

    return [
        "Total de consultas" => contarConsultas($agenda),
        "Total de pacientes diferentes" => contarPacientesDiferentes($agenda),
        "Consultas por especialidade" => contarEspecialidades($agenda),
        "Primeiro atendimento" => $agendaOrdenada[0],
        "Último atendimento" => $agendaOrdenada[count($agendaOrdenada) - 1],
        "Agenda ordenada" => $agendaOrdenada,
        "Pesquisa de paciente" => pesquisarPaciente($agenda, $pacientePesquisa),
        "Horários duplicados" => verificarHorariosDuplicados($agenda)
    ];
}

//valor de exemplo
$agenda = [

    [
    "paciente" => "Henrique", 
    "especialidade" => "Cardiologia",
    "data" => "02/10/2026", 
    "horario" => "09:00"
    ],

    [
    "paciente" => "Antonio", 
    "especialidade" => "Dermatologia", 
    "data" => "02/10/2026", 
    "horario" => "10:30"
    ],

    [
    "paciente" => "Pietro", 
    "especialidade" => "Cardiologia", 
    "data" => "02/10/2026", 
    "horario" => "11:15"
    ],

    [
    "paciente" => "Julia", 
    "especialidade" => "Pediatria", 
    "data" => "02/10/2026", 
    "horario" => "14:00"
    ],

    [
    "paciente" => "Fermino", 
    "especialidade" => "Dermatologia", 
    "data" => "02/10/2026", 
    "horario" => "15:30"
    ],

    [
    "paciente" => "Henrique", 
    "especialidade" => "Cardiologia", 
    "data" => "02/10/2026", 
    "horario" => "16:45"
    ]
];

$pacientePesquisa = "Henrique";
$resultado = organizarAgenda($agenda, $pacientePesquisa);

//resultados

echo "Total de consultas: " .
     $resultado["Total de consultas"] . "<br>";

echo "Total de pacientes diferentes: " .
     $resultado["Total de pacientes diferentes"] . "<br>";


echo "<br><strong>Consultas por especialidade:</strong><br>";
foreach ($resultado["Consultas por especialidade"] as $especialidade => $quantidade) {
    echo $especialidade . ": " . $quantidade . "<br>";
}

//primeiro atendimento
echo "<br><strong>Primeiro atendimento:</strong><br>";
echo $resultado["Primeiro atendimento"]["paciente"] .
     " - " .
     $resultado["Primeiro atendimento"]["especialidade"] .
     " - " .
     $resultado["Primeiro atendimento"]["horario"] . "<br>";


//último atendimento
echo "<br><strong>Último atendimento:</strong><br>";
echo $resultado["Último atendimento"]["paciente"] .
     " - " .
     $resultado["Último atendimento"]["especialidade"] .
     " - " .
     $resultado["Último atendimento"]["horario"] . "<br>";

echo "<br><strong>Agenda ordenada:</strong><br>";
foreach ($resultado["Agenda ordenada"] as $consulta) {
    echo $consulta["horario"] . " - " .
         $consulta["paciente"] . " - " .
         $consulta["especialidade"] . "<br>";
}


echo "<br><strong>Pesquisa do paciente:</strong><br>";
foreach ($resultado["Pesquisa de paciente"] as $consulta) {
    echo $consulta["paciente"] . " - " .
         $consulta["especialidade"] . " - " .
         $consulta["horario"] . "<br>";
}

echo "<br><strong>Horários duplicados:</strong><br>";
if (count($resultado["Horários duplicados"]) > 0) {
    foreach ($resultado["Horários duplicados"] as $horario) {
        echo $horario . "<br>";
    }

} else {

    echo "Não existem horários duplicados.";
}

?>