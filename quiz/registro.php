<?php require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO usuarios (usuario, contraseña) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $contraseña);

    if ($stmt->execute()) {
        //echo "¡Registro exitoso! <a href='login.php'>Iniciar sesión</a>";
        header('Location: login.php');
    } else {
        echo "Error: " . $conexion->error;
    }
}
?>

<form method="post">
    Usuario: <input name="usuario" required><br>
    Contraseña: <input type="password" name="contraseña" required><br>
    <button type="submit">Registrarse</button>
</form>
