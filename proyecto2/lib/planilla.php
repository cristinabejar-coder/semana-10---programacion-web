<?php
// Funciones de procesamiento de sueldo

function obtenerEmpleados(): array
{
    return [
        ['legajo' => 4371, 'nombre' => 'Martínez Leandro', 'dni' => '27643742', 'sueldo_base' => 1429.54, 'profesion' => 'Arquitecto'],
        ['legajo' => 4372, 'nombre' => 'Torres Lucía',     'dni' => '30125478', 'sueldo_base' => 1800.00, 'profesion' => 'Ingeniero'],
        ['legajo' => 4373, 'nombre' => 'Ramos Pedro',      'dni' => '41236985', 'sueldo_base' => 1350.00, 'profesion' => 'Contador'],
        ['legajo' => 4374, 'nombre' => 'Quispe Rosa',      'dni' => '45879632', 'sueldo_base' => 1250.75, 'profesion' => 'Secretaria'],
        ['legajo' => 4375, 'nombre' => 'Vargas Carlos',    'dni' => '32698741', 'sueldo_base' => 2100.00, 'profesion' => 'Ingeniero'],
    ];
}

// Bonificación: 5 % del sueldo base si es Arquitecto u Ingeniero
function calcularBonificacion(array $empleado): float
{
    if (in_array($empleado['profesion'], PROFESIONES_BONIFICADAS, true)) {
        return $empleado['sueldo_base'] * PORCENTAJE_BONIFICACION;
    }
    return 0.0;
}

// Sueldo bruto = sueldo base + bonificación
function calcularSueldoBruto(array $empleado): float
{
    return $empleado['sueldo_base'] + calcularBonificacion($empleado);
}

// Aporte a la AFP: 10 % del sueldo bruto
function calcularAFP(array $empleado): float
{
    return calcularSueldoBruto($empleado) * PORCENTAJE_AFP;
}

// Sueldo neto = bruto - AFP
function calcularSueldoNeto(array $empleado): float
{
    return calcularSueldoBruto($empleado) - calcularAFP($empleado);
}

// Busca un empleado por legajo
function buscarEmpleado(array $empleados, int $legajo): ?array
{
    foreach ($empleados as $e) {
        if ($e['legajo'] === $legajo) {
            return $e;
        }
    }
    return null;
}
