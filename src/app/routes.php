<?php

use FastRoute\RouteCollector;

function configurarRutas()
{
    return FastRoute\simpleDispatcher(function (RouteCollector $r) {
        // Rutas para el home
        $r->addRoute('GET', '/', [HomeController::class, 'index']);
        $r->addRoute('GET', '/home.php', [HomeController::class, 'index']);


        // Rutas para el cliente
        $r->addRoute('GET', '/clientes/perfil', [ClientesController::class, 'mostrarLogin']);

        // Rutas sobre la factura
        $r->addRoute('GET', '/catalogo', [VentasController::class, 'mostrarCatalogo']);
        $r->addRoute('GET', '/factura-detalles', [VentasController::class, 'detallesCompra']);
        $r->addRoute('GET', '/carrito', [CarritoController::class, 'mostrarCarrito']);
        $r->addRoute('POST', '/carrito/agregar', [CarritoController::class, 'agregarAlCarrito']);
        $r->addRoute('POST', '/carrito/eliminar', [CarritoController::class, 'eliminarDelCarrito']);
        $r->addRoute('POST','/carrito/agregar-cantidad', [CarritoController::class, 'actualizarCantidad']);

        //rutas para el cliente
        $r->addRoute('GET','/cliente/registro',[ClientesController::class,'mostrarRegistro']);
        $r->addRoute('POST','/cliente/registro',[ClientesController::class,'crearCliente']);
        
        $r->addRoute('GET', '/cliente/login', [ClientesController::class, 'mostrarLogin']);//muestra log in cliente
        $r->addRoute('POST', '/cliente/login', [ClientesController::class, 'procesarLogin']);       

        //rutas de inventario
        $r->addRoute('GET', '/inventario', [InventarioController:: class, 'mostrarInventario']);
        $r->addRoute('POST', '/inventario/filtrar', [InventarioController:: class, 'filtrarInventario']);
        $r->addRoute('POST', '/inventario/registrarlibro', [InventarioController:: class, 'mostrarInventario']);
        $r->addRoute('POST', '/inventario/editarlibro', [InventarioController:: class, 'mostrarInventario']);
    });
}
