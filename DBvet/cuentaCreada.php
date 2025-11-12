
<?php
$id = $_GET['id'] ?? 'Desconocido';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cuenta creada</title>
    <link rel="stylesheet" href="estilosPaginasFinales.css">
</head>
<body>
    <section id="encabezadoPagFinales">
        <a href="pag1.html"><button class="boton">Página principal</button></a>
    </section>

    <h1 class="titulo">Cuenta creada</h1>
    <p>El ID asignado a esta mascota es: <strong><?= htmlspecialchars($id) ?></strong></p>
</body>
</html>