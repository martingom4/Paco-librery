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
        $r->addRoute('GET','/catalogo', [VentasController:: class,'mostrarCatalogo']);
        $r->addRoute('GET','/comprar/{isbn}', [VentasController::class, 'verCompra']);
        $r->addRoute('GET','/factura-detalles', [VentasController::class,'detallesCompra']);

        // rutas para libreria
        $r->addRoute('GET', '/registrarLibrerias', [LibreriasController::class, 'formularioRegistro']);
        $r->addRoute('POST', '/registrarLibrerias', [LibreriasController::class, 'registrarLibreria']);
        $r->addRoute('GET', '/formularioActualizar/{id:\d+}', [LibreriasController::class, 'mostrarFormularioEdicion']);
        $r->addRoute('POST', '/formularioActualizar', [LibreriasController::class, 'actualizarLibreria']);
        $r->addRoute('GET', '/detallesLibrerias/{id:\d+}', [LibreriasController::class, 'mostrarDetallesLibreria']);
        $r->addRoute('GET', '/Librerias.php', [LibreriasController::class, 'listarLibrerias']);
     
    });
}
