<?php
session_start();

// Preguntas y respuestas
$questions = [
    [
        "text" => "¿Cuál es la capital de Francia?",
        "options" => ["A" => "Madrid", "B" => "París", "C" => "Roma"],
        "answer" => "B"
    ],
    [
        "text" => "¿Cuánto es 9 x 3?",
        "options" => ["A" => "27", "B" => "18", "C" => "36"],
        "answer" => "A"
    ],
    [
        "text" => "¿Qué animal ladra?",
        "options" => ["A" => "Gato", "B" => "Perro", "C" => "Pato"],
        "answer" => "B"
    ]
];

// Obtener pregunta actual
$current = isset($_SESSION['current']) ? $_SESSION['current'] : 0;

// Guardar respuesta anterior si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected = $_POST['option'] ?? '';
    $_SESSION['answers'][] = $selected;
    $_SESSION['current'] = ++$current;
}

// Si terminamos las preguntas, ir al resultado
if ($current >= count($questions)) {
    header('Location: result.php');
    exit;
}

// Obtener la pregunta actual
$q = $questions[$current];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Quiz Paso a Paso</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="quiz-container">
    <h2>Pregunta <?= $current + 1 ?>:</h2>
    <p><?= $q['text'] ?></p>
    <form method="post">
        <?php foreach ($q['options'] as $key => $value): ?>
            <label>
                <input type="radio" name="option" value="<?= $key ?>" required> <?= $value ?>
            </label><br>
        <?php endforeach; ?>
        <br>
        <button type="submit">Siguiente</button>
    </form>
</div>
</body>
</html>
