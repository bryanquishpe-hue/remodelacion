<?php
require_once "conexion.php"; // Asegúrate que el nombre del archivo sea correcto
$conexion->set_charset("utf8mb4");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar y capturar datos del formulario
    $cliente_id = isset($_POST['cliente_id']) ? intval($_POST['cliente_id']) : null;
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $correo = htmlspecialchars(trim($_POST['correo']));
    $telefono = htmlspecialchars(trim($_POST['telefono']));
    $asunto = htmlspecialchars(trim($_POST['asunto']));
    $mensaje = htmlspecialchars(trim($_POST['mensaje']));
    $fecha_envio = date("Y-m-d H:i:s");

    // Validar campos obligatorios
    if (empty($nombre) || empty($correo) || empty($mensaje)) {
        echo "⚠️ Faltan campos obligatorios.";
        exit;
    }

    // Preparar consulta segura
    $stmt = $conexion->prepare("INSERT INTO contactos (cliente_id, nombre, correo, telefono, asunto, mensaje, fecha_envio) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $cliente_id, $nombre, $correo, $telefono, $asunto, $mensaje, $fecha_envio);

    // Ejecutar y verificar resultado
    if ($stmt->execute()) {
        header("Location: ../gracias.html");
        exit;
    } else {
        echo "❌ Error al guardar el contacto: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "⚠️ Este script solo acepta solicitudes POST.";
}
?>

