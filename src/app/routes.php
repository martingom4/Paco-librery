<?php

use FastRoute\RouteCollector;

function configurarRutas()
{
    return FastRoute\simpleDispatcher(function (RouteCollector $r) {
        // Rutas para el home
        $r->addRoute('GET', '/', [HomeController::class, 'index']);
        $r->addRoute('GET','/home.php', [HomeController::class,'index']);

        //rutas para el cliente
        $r->addRoute('GET', '/cliente/login', [ClientesController::class, 'mostrarLogin']);
    });
}
