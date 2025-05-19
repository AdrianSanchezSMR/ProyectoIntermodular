<?php 
session_start();

// Lista de preguntas y respuestas
$preguntas = [
    [
        "texto" => "¿Cuál es el mamífero más grande del mundo?",
        "opciones" => ["A" => "Elefante africano", "B" => "Ballena azul", "C" => "Hipopótamo"],
        "respuesta_correcta" => "B"
    ],
    [
        "texto" => "¿Qué animal es conocido por cambiar de color para camuflarse?",
        "opciones" => ["A" => "Camaleón", "B" => "Rana", "C" => "Lagarto"],
        "respuesta_correcta" => "A"
    ],
    [
        "texto" => "¿Qué animal ladra?",
        "opciones" => ["A" => "Gato", "B" => "Perro", "C" => "Pato"],
        "respuesta_correcta" => "B"
    ],
    [
        "texto" => "¿Cuál de estos animales pone huevos?",
        "opciones" => ["A" => "Gato", "B" => "Perro", "C" => "Ornitorrinco"],
        "respuesta_correcta" => "C"
    ]
];

// Obtener número de pregunta actual
$indice_actual = isset($_SESSION['pregunta_actual']) ? $_SESSION['pregunta_actual'] : 0;

// Guardar respuesta anterior si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seleccionada = $_POST['opcion'] ?? '';
    $_SESSION['respuestas'][] = $seleccionada;
    $_SESSION['pregunta_actual'] = ++$indice_actual;
}

// Si ya se respondieron todas, mostrar el resultado
if ($indice_actual >= count($preguntas)) {
    header('Location: resultado.php');
    exit;
}

// Obtener la pregunta que toca mostrar
$pregunta = $preguntas[$indice_actual];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MadQuiZote</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <h2>Pregunta <?= $indice_actual + 1 ?>:</h2>
    <p><?= $pregunta['texto'] ?></p>
    <form method="post">
        <?php foreach ($pregunta['opciones'] as $letra => $opcion): ?>
            <label>
                <input type="radio" name="opcion" value="<?= $letra ?>" required> <?= $opcion ?>
            </label><br>
        <?php endforeach; ?>
        <br>
        <button type="submit">Siguiente</button>
    </form>
</div>
</body>
</html>
