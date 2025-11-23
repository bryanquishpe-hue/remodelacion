<?php
session_start();
require_once 'conexion.php';

$conexion->set_charset("utf8mb4");
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = htmlspecialchars(trim($_POST['usuario']));
    $password = trim($_POST['password']);

    if (empty($usuario) || empty($password)) {
        $error = "⚠️ Todos los campos son obligatorios.";
    } else {
        $stmt = $conexion->prepare("SELECT id, usuario, password, nombre FROM administradores WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $row = $resultado->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['id_admin'] = $row['id'];
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['nombre'] = $row['nombre'];
                header("Location: ../dashboard.php");
                exit;
            } else {
                $error = "❌ Usuario o contraseña incorrectos.";
            }
        } else {
            $error = "❌ Usuario o contraseña incorrectos.";
        }

        $stmt->close();
    }

    $conexion->close();
}
?>

<!-- HTML para mostrar el formulario y errores -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef2f3;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-container {
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }
    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 30px;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    input[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #2980b9;
    }
    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Iniciar sesión</h2>
    <form method="POST" action="">
      <input type="text" name="usuario" placeholder="Nombre de usuario" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <input type="submit" value="Entrar">
    </form>
    <?php if (!empty($error)): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
  </div>
</body>
</html>
