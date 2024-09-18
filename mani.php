<?php

session_start();

// Conexión a la base de datos
$host = "127.0.0.1";
$usuario = "tu_usuario"; // Cambia por tu usuario de base de datos
$contraseña = "tu_contraseña"; // Cambia por tu contraseña
$baseDatos = "nombre_de_tu_base_de_datos"; // Cambia por el nombre de tu base de datos

$conn = new mysqli($host, $usuario, $contraseña, $baseDatos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para obtener el usuario
    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($password, $row['password'])) {
            // Credenciales correctas: iniciar sesión
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Redirigir al dashboard u otra página
            exit();
        } else {
            // Contraseña incorrecta
            $error = "Nombre de usuario o contraseña incorrectos.";
        }
    } else {
        // Usuario no encontrado
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
    
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>

    <?php
    // Mostrar error si existe
    if (isset($error)) {
        echo "<p style='color:red'>" . $error . "</p>";
    }
    ?>
</body>
</html>