<?php
session_start();

// Datos de conexión
$servername = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "dbvet";

// Conexión con la base de datos 
$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del formulario
$dni = $_POST['dni'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

if ($dni === '' || $contrasena === '') {
    die("Por favor, complete todos los campos.");
}

// Buscar usuario por DNI
$sql = "SELECT nombre, `contraseña`, dni FROM usuarios WHERE dni = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die(" Error al preparar la consulta SQL: " . $conn->error);
}
$stmt->bind_param("s", $dni);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No existe un usuario con ese DNI.";
    $stmt->close();
    $conn->close();
    exit;
}

$usuario = $result->fetch_assoc();
$stmt->close();

// Verificar contraseña (HASH)
$hashGuardado = $usuario['contraseña'] ?? '';

if (password_verify($contrasena, $hashGuardado)) {
    //Contraseña correcta
    $_SESSION['usuario_dni'] = $usuario['dni'];
    $_SESSION['usuario_nombre'] = $usuario['nombre'];

    header("Location: pag1.html");
    exit;
} else {
    echo "Contraseña incorrecta.";
}

$conn->close();
?>