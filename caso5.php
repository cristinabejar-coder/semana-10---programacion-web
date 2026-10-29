<?php
// CASO 5: Datos personales de un empleado en un vector (array asociativo)
// y visualización en pantalla.

$empleado = array(
    "Legajo"    => 4371,
    "Nombre"    => "Martínez Leandro",
    "D.N.I"     => "27643742",
    "Sueldo"    => 1429.54,
    "Profesión" => "Arquitecto"
);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Caso 5 - Datos del empleado</title>
</head>
<body>
    <h2>--Datos del empleado--</h2>
    <?php
    foreach ($empleado as $clave => $valor) {
        echo $clave . " = " . $valor . "<br />";
    }
    ?>
</body>
</html>
