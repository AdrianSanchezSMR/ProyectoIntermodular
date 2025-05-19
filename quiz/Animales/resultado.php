<?php require '../config.php';


// Lista con las respuestas correctas
$respuestas_correctas = [
    ['respuesta_correcta' => 'B'],
    ['respuesta_correcta' => 'A'],
    ['respuesta_correcta' => 'B'],
    ['respuesta_correcta' => 'C']
];

$puntaje = 0;
$respuestas_usuario = $_SESSION['respuestas'] ?? [];

foreach ($respuestas_correctas as $indice => $pregunta) {
    if (isset($respuestas_usuario[$indice]) && $respuestas_usuario[$indice] === $pregunta['respuesta_correcta']) {
        $puntaje++;
    }
}

// Guardar resultado en la base de datos si el usuario ha iniciado sesión
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];

    $stmt = $conexion->prepare("INSERT INTO resultados (usuario_id, puntaje) VALUES (?, ?)");
    $stmt->bind_param("ii", $usuario_id, $puntaje);
    $stmt->execute();
}

// Limpiar respuestas pero mantener usuario
unset($_SESSION['respuestas']);
unset($_SESSION['pregunta_actual']);
$nombre = $_SESSION['usuario']; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <h2>¡Has completado el quiz, <?= htmlspecialchars($nombre) ?>!</h2>
    <p>Tu puntaje es <?= $puntaje ?> de <?= count($respuestas_correctas) ?></p>
    <a href="quiz.php">Volver a intentar</a>
    <br><br>
    <a href="../genero.php">Volver al inicio</a>
</div>
</body>
</html>
