<?php require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    $stmt = $conexion->prepare("SELECT id, contraseña FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();

        if (password_verify($contraseña, $hash)) {
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario'] = $usuario;
            header('Location: genero.php');
            exit;
        }
    }

    echo "Usuario o contraseña incorrectos.";
}
?>

<form method="post">
    Usuario: <input name="usuario" required><br>
    Contraseña: <input type="password" name="contraseña" required><br>
    <button type="submit">Iniciar sesión</button>
    <p>No tienes cuenta: </p>
    <a href="registro.php">Registrate</a>
</form>
