<?php
session_start();
require_once 'conexion.php';
$conexion->set_charset("utf8mb4");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $correo = htmlspecialchars(trim($_POST['correo']));
    $usuario = htmlspecialchars(trim($_POST['usuario']));
    $passwordPlano = trim($_POST['password']);

    if (empty($nombre) || empty($correo) || empty($usuario) || empty($passwordPlano)) {
        echo "⚠️ Todos los campos son obligatorios.";
        exit;
    }

    $stmtCheck = $conexion->prepare("SELECT id FROM administradores WHERE usuario = ? OR correo = ?");
    $stmtCheck->bind_param("ss", $usuario, $correo);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        echo "❌ El usuario o correo ya están registrados.";
        $stmtCheck->close();
        exit;
    }
    $stmtCheck->close();

    $passwordHash = password_hash($passwordPlano, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO administradores (usuario, password, nombre, correo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $usuario, $passwordHash, $nombre, $correo);

    if ($stmt->execute()) {
        $_SESSION['nombre'] = $nombre;
        header("Location: ../gracias.php");
        exit;
    } else {
        echo "❌ Error al registrar: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Acceso no permitido.";
}
?>
