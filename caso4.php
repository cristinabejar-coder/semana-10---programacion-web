<?php
// CASO 4: Artículos de librería en un vector (constructor array)
// y cantidad de elementos con count.

$articulos = array("Lápiz", "Goma", "Hoja", "Tinta");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Caso 4 - Artículos de librería</title>
</head>
<body>
    <h2>Artículos de librería</h2>
    <?php
    echo "Cantidad de artículos: " . count($articulos);
    ?>
</body>
</html>
