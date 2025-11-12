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

// Obtener el ID desde el formulario
$Id_mascota = $_POST['id_Mascota'];

// Verificar si se envió algo
if (empty($Id_mascota)) {
    die("Por favor, ingresa un ID de mascota.");
}

// Consulta segura
$sql = "SELECT Id_cita, Fecha, Descripcion, Id_veterinario
        FROM citas
        WHERE Id_mascota = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $Id_mascota);
$stmt->execute();
$result = $stmt->get_result();

// Mostrar resultados
if ($result->num_rows > 0) {
    echo "<h2> Citas registradas para la mascota con ID: $Id_mascota</h2>";
    echo "<table border='1' cellpadding='6' cellspacing='0'>";
    echo "<tr><th>ID Cita</th><th>Fecha</th><th>Descripción</th><th>Veterinario</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['Id_cita']}</td>
                <td>{$row['Fecha']}</td>
                <td>{$row['Descripcion']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<h3> No se encontraron citas para la mascota con ID: $Id_mascota</h3>";
}

// Cerrar conexiones
$stmt->close();
$conn->close();
?>