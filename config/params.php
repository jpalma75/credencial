<?php

return [
    'adminEmail'         => 'admin@example.com',
    'senderEmail'        => 'noreply@example.com',
    'senderName'         => 'Example.com mailer',

    // NOMBRE LARGO DEL SISTEMA
    // 'SistemaNombre'   => 'Sistema Integral de Control de Gestión',
    // 'SistemaNombre'   => 'Sistema de Punto de Venta',
    // 'SistemaNombre'   => 'Sistema de Control de Inventario Punto de Venta',
    'SistemaNombre'      => 'Sistema de Impresión de Credenciales',
    'SistemaSiglas'      => 'CREDENCIAL',
    'SistemaDescripcion' => 'Sistema que permite dar de alta responsables, departamentos y empleados de los cuales se generará credencial',
    'TipoContrato'       => 'CONFIANZA',

    //Rutas para los archivos
    'FirmasEncargados'   => 'archivos/firmas/encargados/',
    'FirmasEmpleados'    => 'archivos/firmas/empleados/',
    'FotosEmpleados'     => 'archivos/fotos/',
    'Credenciales'       => 'archivos/credenciales/',
    'RutaPlantillas'     => '\\web\\img\\plantillas\\',
    'RutaFuentes'        => '\\web\\fonts\\',
    'Fuente1'            => 'Futura Medium.ttf',
    'Fuente2'            => 'Futura Condensed Bold.ttf',

    // Tamaños de fuentes para los textos de las credenciales
    'TamExtraChico'      => '14',
    'TamChico'           => '18',
    'TamMediano'         => '20',
    'TamGrande'          => '22',
    'TamExtraGrande'     => '25',
];
