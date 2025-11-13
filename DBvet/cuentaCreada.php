
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
<!--volver a pagina principal  -->
    <section id="encabezadoPagFinales">
        <a href="pag1.html"><button class="boton">Página principal</button></a>
    </section>
<!--mensaje de confirmacion y muestra del id asignado a la mascota  -->
    <h1 class="titulo">Cuenta creada</h1>
    <p>El ID asignado a esta mascota es: <strong><?= htmlspecialchars($id) ?></strong></p>
</body>
</html>