<?php
// CASO 3: Vector con los meses del año inicializado con el constructor array,
// recorrido con foreach.

$meses = array(
    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Caso 3 - Meses del año</title>
</head>
<body>
    <h2>Meses del año</h2>
    <?php
    foreach ($meses as $valor) {
        echo $valor . "<br />";
    }
    ?>
</body>
</html>
