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

// se valida que los campos esten llenados correctamente 
if (empty($Nombre) || empty($Especie) || empty($Raza) || empty($Edad) || empty($Dueno) || empty($Contacto)) {
    die("Por favor, complete todos los campos.");
}
// Insertar en la base de datos
$sql = "INSERT INTO mascotas (Nombre, Especie, Raza, Edad, Dueno, Contacto)
        VALUES ('$Nombre', '$Especie', '$Raza', '$Edad', '$Dueno', '$Contacto')";
//si todo el proceso fue correcto , se muestra una pagina html
//tambien se muestra la id asignada 
if ($conn->query($sql) === TRUE) {
    $idNuevo = $conn->insert_id;
    header("Location: cuentaCreada.php?id=$idNuevo");
    exit();
}
else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>