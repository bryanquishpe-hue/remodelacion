<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['id_admin'])) {
    header("Location: php/login.php");
    exit;
}

// Datos del usuario desde la sesión
$nombre = $_SESSION['nombre'] ?? 'Administrador';
$usuario = $_SESSION['usuario'] ?? 'usuario';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administrador</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f4f8;
      padding: 50px;
      text-align: center;
    }
    .dashboard {
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      display: inline-block;
    }
    h1 {
      color: #2c3e50;
    }
    p {
      font-size: 18px;
      color: #555;
    }
    a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #e74c3c;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <h1>Bienvenido, <?php echo htmlspecialchars($nombre); ?> 👋</h1>
    <p>Has iniciado sesión como <strong><?php echo htmlspecialchars($usuario); ?></strong>.</p>
    <a href="php/logout.php">Cerrar sesión</a>
  </div>
</body>
</html>

