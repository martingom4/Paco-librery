<?php

#en este archivos se van a poner las rutas que vamos a usar en el sistemas, es decir como queremos que el usuarios navegue por nuestra pagina web


use FastRoute\RouteCollector;

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    // Rutas para Clientes
    $r->addRoute('GET', '/clientes', [ClientesController::class, 'index']);
    $r->addRoute('GET', '/clientes/crear', [ClientesController::class, 'mostrarFormularioRegistro']);
    $r->addRoute('POST', '/clientes', [ClientesController::class, 'crearCliente']);
    $r->addRoute('GET', '/clientes/perfil', [ClientesController::class, 'mostrarPerfilCliente']);

    // Rutas para Empleados
    $r->addRoute('GET', '/empleados', [EmpleadoController::class, 'index']);
    $r->addRoute('GET', '/empleados/crear', [EmpleadoController::class, 'mostrarFormularioRegistro']);
    $r->addRoute('POST', '/empleados', [EmpleadoController::class, 'crearEmpleado']);

    // Rutas para Inventario
    $r->addRoute('GET', '/inventario', [InventarioController::class, 'index']);
    $r->addRoute('POST', '/inventario', [InventarioController::class, 'agregarInventario']);


});

