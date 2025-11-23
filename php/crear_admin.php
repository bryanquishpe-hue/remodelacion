<?php
require_once "conexion.php";

if (isset($_GET['crear']) && $_GET['crear'] === 'admin') {
    $usuario = "admin";
    $passwordPlano = "123456";
    $nombre = "Administrador Principal";
    $passwordHash = password_hash($passwordPlano, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO administradores (usuario, password, nombre) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $usuario, $passwordHash, $nombre);
    $stmt->execute();

    echo "✅ Usuario insertado correctamente.";
} else {
    echo "⚠️ No se ha solicitado la creación del administrador.";
}
?>


