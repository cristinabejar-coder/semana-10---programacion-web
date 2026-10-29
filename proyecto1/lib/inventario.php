<?php
// Arreglo asociativo multidimensional y funciones de cálculo del inventario

function obtenerInventario(): array
{
    return [
        ['codigo' => 'P001', 'nombre' => 'Lápiz HB',          'categoria' => 'Escritura',  'precio' => 1.50,  'stock' => 200],
        ['codigo' => 'P002', 'nombre' => 'Lapicero azul',     'categoria' => 'Escritura',  'precio' => 2.00,  'stock' => 150],
        ['codigo' => 'P003', 'nombre' => 'Goma de borrar',    'categoria' => 'Útiles',     'precio' => 1.00,  'stock' => 120],
        ['codigo' => 'P004', 'nombre' => 'Cuaderno A4',       'categoria' => 'Papelería',  'precio' => 8.50,  'stock' => 80],
        ['codigo' => 'P005', 'nombre' => 'Resma de hojas A4', 'categoria' => 'Papelería',  'precio' => 22.00, 'stock' => 40],
        ['codigo' => 'P006', 'nombre' => 'Tinta para impresora', 'categoria' => 'Insumos', 'precio' => 35.00, 'stock' => 25],
        ['codigo' => 'P007', 'nombre' => 'Regla 30 cm',       'categoria' => 'Útiles',     'precio' => 2.50,  'stock' => 90],
        ['codigo' => 'P008', 'nombre' => 'Plumón acrílico',   'categoria' => 'Escritura',  'precio' => 3.50,  'stock' => 60],
    ];
}

// Total de artículos (registros) usando count()
function totalArticulos(array $productos): int
{
    return count($productos);
}

// Valor total del inventario = suma de precio * stock
function valorTotalInventario(array $productos): float
{
    $total = 0.0;
    foreach ($productos as $p) {
        $total += $p['precio'] * $p['stock'];
    }
    return $total;
}

// Lista de categorías disponibles (para el filtro)
function obtenerCategorias(array $productos): array
{
    $categorias = array_unique(array_column($productos, 'categoria'));
    sort($categorias);
    return $categorias;
}

// Filtra por nombre (texto parcial) y/o categoría
function filtrarProductos(array $productos, string $texto = '', string $categoria = ''): array
{
    $resultado = [];
    foreach ($productos as $p) {
        $coincideTexto = $texto === '' || stripos($p['nombre'], $texto) !== false;
        $coincideCategoria = $categoria === '' || $p['categoria'] === $categoria;
        if ($coincideTexto && $coincideCategoria) {
            $resultado[] = $p;
        }
    }
    return $resultado;
}
