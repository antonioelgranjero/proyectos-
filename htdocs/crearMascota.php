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
$Nombre = $_POST['nombreMascota'];
$Especie = $_POST['especieMascota'];
$Raza = $_POST['razaMascota'];
$Edad = $_POST['edadMascota'];
$Dueno = $_POST['duenoMascota'];
$Contacto = $_POST['contactoMascota'];

// Insertar en la base de datos
$sql = "INSERT INTO mascotas (Nombre, Especie, Raza, Edad, Dueno, Contacto)
        VALUES ('$Nombre', '$Especie', '$Raza', '$Edad', '$Dueno', '$Contacto')";

if ($conn->query($sql) === TRUE) {
    echo "Cuenta creada correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>