<?php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/lib/planilla.php';

$empleados = obtenerEmpleados();

$legajo = isset($_GET['legajo']) ? (int)$_GET['legajo'] : 0;
$boleta = $legajo > 0 ? buscarEmpleado($empleados, $legajo) : null;

function dinero(float $monto): string
{
    return MONEDA . ' ' . number_format($monto, 2);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars(NOMBRE_SISTEMA) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand mb-0 h1"><?= htmlspecialchars(NOMBRE_SISTEMA) ?></span>
    </div>
</nav>

<div class="container">

    <?php if ($boleta !== null): ?>
        <!-- Boleta de pago -->
        <div class="card mb-4 border-primary">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <strong>Boleta de pago</strong>
                <a href="index.php" class="btn btn-sm btn-light">Cerrar</a>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Legajo:</strong> <?= $boleta['legajo'] ?></div>
                    <div class="col-md-4"><strong>Nombre:</strong> <?= htmlspecialchars($boleta['nombre']) ?></div>
                    <div class="col-md-2"><strong>DNI:</strong> <?= htmlspecialchars($boleta['dni']) ?></div>
                    <div class="col-md-3"><strong>Profesión:</strong> <?= htmlspecialchars($boleta['profesion']) ?></div>
                </div>
                <table class="table table-sm w-auto">
                    <tr>
                        <td>Sueldo base</td>
                        <td class="text-end"><?= dinero($boleta['sueldo_base']) ?></td>
                    </tr>
                    <tr class="text-success">
                        <td>Bonificación por profesión (<?= PORCENTAJE_BONIFICACION * 100 ?>%)</td>
                        <td class="text-end">+ <?= dinero(calcularBonificacion($boleta)) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Sueldo bruto</strong></td>
                        <td class="text-end"><strong><?= dinero(calcularSueldoBruto($boleta)) ?></strong></td>
                    </tr>
                    <tr class="text-danger">
                        <td>Aporte AFP (<?= PORCENTAJE_AFP * 100 ?>%)</td>
                        <td class="text-end">- <?= dinero(calcularAFP($boleta)) ?></td>
                    </tr>
                    <tr class="table-success">
                        <td><strong>Sueldo neto a pagar</strong></td>
                        <td class="text-end"><strong><?= dinero(calcularSueldoNeto($boleta)) ?></strong></td>
                    </tr>
                </table>
            </div>
        </div>
    <?php elseif ($legajo > 0): ?>
        <div class="alert alert-warning">No se encontró el empleado con legajo <?= $legajo ?>.</div>
    <?php endif; ?>

    <!-- Planilla -->
    <div class="card mb-5">
        <div class="card-header"><strong>Planilla de empleados</strong> (<?= count($empleados) ?> registros)</div>
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-dark">
                <tr>
                    <th>Legajo</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Profesión</th>
                    <th class="text-end">Sueldo base</th>
                    <th class="text-end">Bonificación</th>
                    <th class="text-end">AFP</th>
                    <th class="text-end">Neto</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($empleados as $e): ?>
                    <tr>
                        <td><?= $e['legajo'] ?></td>
                        <td><?= htmlspecialchars($e['nombre']) ?></td>
                        <td><?= htmlspecialchars($e['dni']) ?></td>
                        <td><?= htmlspecialchars($e['profesion']) ?></td>
                        <td class="text-end"><?= dinero($e['sueldo_base']) ?></td>
                        <td class="text-end"><?= dinero(calcularBonificacion($e)) ?></td>
                        <td class="text-end"><?= dinero(calcularAFP($e)) ?></td>
                        <td class="text-end"><strong><?= dinero(calcularSueldoNeto($e)) ?></strong></td>
                        <td class="text-end">
                            <a href="index.php?legajo=<?= $e['legajo'] ?>" class="btn btn-sm btn-primary">Ver boleta</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
