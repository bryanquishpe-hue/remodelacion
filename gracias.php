<?php
session_start();
$nombre = $_SESSION['nombre'] ?? 'Usuario';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gracias por registrarte</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      text-align: center;
      padding: 50px;
    }
    .container {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
      color: #3498db;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>¡Gracias por registrarte, <?php echo htmlspecialchars($nombre); ?>!</h1>
    <p>Tu cuenta ha sido creada correctamente. Puedes iniciar sesión cuando lo desees.</p>
    <a href="../index.html">Volver al inicio</a>
  </div>
</body>
</html>

