<?php

use FastRoute\RouteCollector;

function configurarRutas()
{
    return FastRoute\simpleDispatcher(function (RouteCollector $r) {
        // Rutas para el home
        $r->addRoute('GET', '/', [HomeController::class, 'index']);
        $r->addRoute('GET','/home.php', [HomeController::class,'index']);

        //rutas para el cliente
        $r->addRoute('GET', '/clientes/perfil', [ClientesController::class, 'mostrarLogin']);


        // rutas sobre la factura

        $r->addRoute('GET','/factura', [VentasController::class, 'verCompra']);
        $r->addRoute('GET','/factura/detalles', [VentasController::class,'detallesCompra']);

    });
}
