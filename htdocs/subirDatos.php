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
$Id_mascota     = $_POST['id_Mascota'];
$Id_veterinario = $_POST['idVeterinario'];
$Fecha          = $_POST['fechaCita'];
$Descripcion    = $_POST['descripcionCita'];

// --- 1️⃣ Verificar si la mascota existe ---
$sql_check = "SELECT * FROM mascotas WHERE id_mascota = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $Id_mascota);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    // --- 2️⃣ Si existe, insertar los datos de la cita ---
    $sql_insert = "INSERT INTO citas (Id_mascota, Id_veterinario, Fecha, Descripcion)
                   VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("iiss", $Id_mascota, $Id_veterinario, $Fecha, $Descripcion);

    if ($stmt_insert->execute()) {
        echo "<h3>✅ Cita registrada correctamente.</h3>";
    } else {
        echo "<h3>❌ Error al registrar la cita: " . $stmt_insert->error . "</h3>";
    }

    $stmt_insert->close();
} else {
    // --- 3️⃣ Si no existe, mostrar mensaje ---
    echo "<h3>❌ No existe ninguna mascota con el ID: $Id_mascota</h3>";
}

// Cerrar conexiones
$stmt_check->close();
$conn->close();
?>