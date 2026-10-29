<?php
// CASO 2: Países de Sudamérica en un vector (sin colocar el índice),
// recorrido con foreach.

$paises[] = "Argentina";
$paises[] = "Bolivia";
$paises[] = "Brasil";
$paises[] = "Chile";
$paises[] = "Colombia";
$paises[] = "Ecuador";
$paises[] = "Guyana";
$paises[] = "Paraguay";
$paises[] = "Perú";
$paises[] = "Surinam";
$paises[] = "Uruguay";
$paises[] = "Venezuela";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Caso 2 - Países de Sudamérica</title>
</head>
<body>
    <h2>Países de Sudamérica</h2>
    <?php
    foreach ($paises as $valor) {
        echo $valor . "<br />";
    }
    ?>
</body>
</html>
