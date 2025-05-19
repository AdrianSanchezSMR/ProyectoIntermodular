<?php require 'config.php';
$nombre = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MadQuiZote</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div>
            <img src="imagenes/logo.png" alt="">
            <h1>MadQuiZote</h1>
            
        </div>
        <div>
            <a href="Animales/quiz.php">Animales</a>
            <a href="">Prueba</a>
            <a href="">Prueba4</a>
        </div>
        <div>
            <img src="imagenes/inicio-sesion.png" alt="">
            <form action="">
                <p><?= htmlspecialchars($nombre) ?></p>
                <a href="cerrar_sesion.php">Cerrar Sesión</a>
            </form>
            
        </div>
    </main>
</body>
</html>