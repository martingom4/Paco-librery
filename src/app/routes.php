<?php

use FastRoute\RouteCollector;

function configurarRutas()
{
    return FastRoute\simpleDispatcher(function (RouteCollector $r) {
        // Rutas para el home
        $r->addRoute('GET', '/', [HomeController::class, 'index']);
        $r->addRoute('GET','/home.php', [HomeController::class,'index']);

        //rutas para el cliente
<<<<<<< HEAD
        $r->addRoute('GET', '/cliente/login', [ClientesController::class, 'mostrarLogin']);//muestra log in cliente
        $r->addRoute('POST', '/cliente/login', [ClientesController::class, 'procesarLogin']);
=======
        $r->addRoute('GET', '/cliente/login', [ClientesController::class, 'mostrarLogin']);


        // rutas sobre la factura
        $r->addRoute('GET','/catalogo', [VentasController:: class,'mostrarCatalogo']);
        $r->addRoute('GET','/comprar/{isbn}', [VentasController::class, 'verCompra']);
        $r->addRoute('GET','/factura-detalles', [VentasController::class,'detallesCompra']);

>>>>>>> de1c1e7a99b47a40f2d822e0c9e91dde0c2d4c49
    });
}
