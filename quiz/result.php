<?php
session_start();

$questions = [
    ['answer' => 'B'],
    ['answer' => 'A'],
    ['answer' => 'B']
];

$score = 0;
$answers = $_SESSION['answers'] ?? [];

foreach ($questions as $index => $q) {
    if (isset($answers[$index]) && $answers[$index] === $q['answer']) {
        $score++;
    }
}

// Limpiar sesión para volver a empezar
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="quiz-container">
    <h2>¡Has completado el quiz!</h2>
    <p>Tu puntaje es <?= $score ?> de <?= count($questions) ?></p>
    <a href="quiz.php">Volver a intentar</a>
</div>
</body>
</html>
