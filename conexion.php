<?php
// ============================
// CONFIGURACIÓN DE LA BASE DE DATOS
// ============================
$host = "yamabiko.proxy.rlwy.net"; 
$user = "root"; 
$password = "fEKkWqIPqFnRrFjdzVAOuaQJxugewSWD"; 
$database = "railway";
$port = 33482;

// ============================
// CREAR CONEXIÓN
// ============================
$conexion = new mysqli($host, $user, $password, $database, $port);

// ============================
// COMPROBAR CONEXIÓN
// ============================
if ($conexion->connect_errno) {
    // Guardar error en un log
    if (!is_dir("logs")) {
        mkdir("logs", 0777, true);
    }
    error_log("[".date("Y-m-d H:i:s")."] Error de conexión MySQL: ".$conexion->connect_error.PHP_EOL, 3, "logs/errores.log");
    die("❌ Error de conexión. Intenta nuevamente más tarde.");
}

// ============================
// CONFIGURAR CHARSET UTF-8
// ============================
$conexion->set_charset("utf8mb4");

// ============================
// VERIFICAR CONEXIÓN
// ============================
if ($conexion->ping()) {
    echo "✅ Conexión exitosa con Railway";
} else {
    echo "❌ Error de conexión: " . $conexion->connect_error;
}
?>

