<?php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/lib/inventario.php';

$inventario = obtenerInventario();
$categorias = obtenerCategorias($inventario);

$texto = trim($_GET['texto'] ?? '');
$categoria = $_GET['categoria'] ?? '';

$filtrados = filtrarProductos($inventario, $texto, $categoria);

$totalGeneral = totalArticulos($inventario);
$totalFiltrado = totalArticulos($filtrados);
$valorFiltrado = valorTotalInventario($filtrados);
$valorGeneral = valorTotalInventario($inventario);

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
    <!-- Indicadores -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card text-bg-primary h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total de artículos (catálogo)</h6>
                    <p class="display-6 mb-0"><?= $totalGeneral ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-success h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Valor total del inventario</h6>
                    <p class="display-6 mb-0"><?= dinero($valorGeneral) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-secondary h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Resultado del filtro</h6>
                    <p class="display-6 mb-0"><?= $totalFiltrado ?> <small class="fs-6">artículos</small></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario de filtro -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="get" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="texto" class="form-label">Nombre del producto</label>
                    <input type="text" id="texto" name="texto" class="form-control"
                           value="<?= htmlspecialchars($texto) ?>" placeholder="Ej: lápiz">
                </div>
                <div class="col-md-4">
                    <label for="categoria" class="form-label">Categoría</label>
                    <select id="categoria" name="categoria" class="form-select">
                        <option value="">Todas</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?= htmlspecialchars($cat) ?>" <?= $cat === $categoria ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    <a href="index.php" class="btn btn-outline-secondary w-100">Limpiar</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de productos -->
    <div class="card mb-5">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-dark">
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th class="text-end">Precio</th>
                    <th class="text-end">Stock</th>
                    <th class="text-end">Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($totalFiltrado === 0): ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">No se encontraron productos.</td></tr>
                <?php else: ?>
                    <?php foreach ($filtrados as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['codigo']) ?></td>
                            <td><?= htmlspecialchars($p['nombre']) ?></td>
                            <td><span class="badge text-bg-info"><?= htmlspecialchars($p['categoria']) ?></span></td>
                            <td class="text-end"><?= dinero($p['precio']) ?></td>
                            <td class="text-end"><?= $p['stock'] ?></td>
                            <td class="text-end"><?= dinero($p['precio'] * $p['stock']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
                <tfoot class="table-light">
                <tr>
                    <th colspan="5" class="text-end">Valor total (según filtro):</th>
                    <th class="text-end"><?= dinero($valorFiltrado) ?></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</body>
</html>
