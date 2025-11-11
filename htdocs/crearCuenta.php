<?php
// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbvet";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['Ingresar_Nombre'];
$apellido = $_POST['Ingresar_apellido'];
$gmail = $_POST['Ingresar_gmail'];
$dni = $_POST['Ingresar_contacto'];
$Contraseña = $_POST['Ingresar_codigo_de_seguridad'];
$confirmacion = $_POST['confirmacion_codigo'];

// Validar contraseñas iguales
if ($Contraseña !== $confirmacion) {
    die("Las contraseñas no coinciden.");
}

// Encriptar la contraseña antes de guardar
$contrasena_encriptada = password_hash($Contraseña, PASSWORD_DEFAULT);

// Insertar en la base de datos
$sql = "INSERT INTO usuarios (nombre, apellido, gmail, dni, Contraseña)
        VALUES ('$nombre', '$apellido', '$gmail', '$dni', '$contrasena_encriptada')";

if ($conn->query($sql) === TRUE) {
    echo "Cuenta creada correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>