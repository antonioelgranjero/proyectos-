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
// Mostrar resultados , se crea un html para los estilos aqui por comodidad 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Citas de la mascota</title>
    <a href="pag1.html"><button type="submit" >volver a inicio</button> </a>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(img_doc/fondo3.jpg) ;
            padding: 40px;
            background-repeat: no-repeat;
            background-size: cover;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        h2, h3 {
            text-align: center;
             color :rgb(56, 107, 46) ;
        }
        button{
             transition: background-color 0.3s ease ; 
            border : 1px solid ; 
            border-color:rgb(124, 124, 124); 
            border-radius: 3px ;
            background-color: rgb(61, 171, 175);
            width: 150px ;
            height: 50px ;
            color:white; 
            cursor: pointer;
        }
        button:hover{
             background-color:rgb(68, 191, 196) ;
        }
    </style>
</head>
<body>

<?php
// Mostrar resultados
if ($result->num_rows > 0) {
    echo "<h2>Citas registradas para la mascota con ID: $Id_mascota</h2>";
    echo "<table>";
    echo "<tr><th>ID Cita</th><th>Fecha</th><th>Descripción</th><th>Veterinario</th></tr>";


    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['Id_cita']}</td>
                <td>{$row['Fecha']}</td>
                <td>{$row['Descripcion']}</td>
                <td>{$row['Id_veterinario']}</td>
              </tr>";

    }

    echo "</table>";
} else {
    echo "<h3>No se encontraron citas para la mascota con ID: $Id_mascota</h3>";
}

// Cerrar conexiones
$stmt->close();
$conn->close();
?>