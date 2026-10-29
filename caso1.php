<?php
// CASO 1: Días de la semana en un vector (índice desde 0),
// recorrido con for y la función count.

$dias = array();
$dias[0] = "Lunes";
$dias[1] = "Martes";
$dias[2] = "Miércoles";
$dias[3] = "Jueves";
$dias[4] = "Viernes";
$dias[5] = "Sábado";
$dias[6] = "Domingo";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Caso 1 - Días de la semana</title>
</head>
<body>
    <h2>Días de la semana</h2>
    <?php
    for ($i = 0; $i < count($dias); $i++) {
        echo $dias[$i] . "<br />";
    }
    ?>
</body>
</html>
