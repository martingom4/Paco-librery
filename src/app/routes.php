<?php

use FastRoute\RouteCollector;

function configurarRutas()
{
    return FastRoute\simpleDispatcher(function (RouteCollector $r) {
        // Rutas para el home
        $r->addRoute('GET', '/', [HomeController::class, 'index']);
        $r->addRoute('GET', '/home.php', [HomeController::class, 'index']);
        $r->addRoute('GET','/perfiles',[HomeController::class,'choosePerfil']);//ruta para escoger perfiles entre admin y cliente
        $r->addRoute('GET','/sobrenosotros',[HomeController::class,'sobreNosotros']);
        $r->addRoute('GET','/contacto',[HomeController::class,'sucursales']);

        //rutas para el cliente
        $r->addRoute('GET','/cliente/registro',[ClientesController::class,'mostrarRegistro']);
        $r->addRoute('POST','/cliente/registro',[ClientesController::class,'crearCliente']);

        $r->addRoute('GET', '/cliente/login', [ClientesController::class, 'mostrarLogin']);//muestra log in cliente
        $r->addRoute('POST', '/cliente/login', [ClientesController::class, 'procesarLogin']);

        $r->addRoute('GET','/cliente/perfil',[ClientesController::class,'mostrarPerfil']);//mostrar perfil cliente
        $r->addRoute('GET','/cliente/actualizar', [ClientesController::class,'mostrarUpdate']);
        $r->addRoute('POST','/cliente/actualizar', [ClientesController::class,'actualizarPerfil']);
        $r->addRoute('POST','/cliente/eliminar', [ClientesController::class,'eliminarCliente']);
        $r->addRoute('GET','/logout',[ClientesController::class,'logout']);//LOGOUT

        //(solo admins)
        $r->addRoute('GET','/registros/clientes', [ClientesController::class,'listarClientes']);
        // Mostrar formulario de actualización de cliente (solo administradores)
        $r->addRoute('GET', '/actualizar/{id}', [ClientesController::class, 'mostrarFormsActualizar']);
        // Actualizar los datos del cliente
        $r->addRoute('POST', '/actualizar', [ClientesController::class, 'actualizarClientAdmin']);


        //rutas para editorial
        $r->addRoute('GET','/editorial', [EditorialesController::class,'verEditorial']);
        $r->addRoute('GET', '/editorial/agregar',[EditorialesController::class,'viewRegister']);
        $r->addRoute('POST','/editorial/registrar', [EditorialesController::class,'addEditorial']);
        $r->addRoute('POST','/editorial/eliminar', [EditorialesController::class,'eliminarEditorial']);

        // Rutas para las comras y ventas
        $r->addRoute('GET', '/catalogo', [VentasController::class, 'mostrarCatalogo']);
        $r->addRoute('POST', '/catalogo', [VentasController::class, 'mostrarCatalogo']);
        $r->addRoute('GET', '/comprar/{isbn}', [VentasController::class, 'verCompra']); 
        $r->addRoute('GET', '/factura-detalles', [VentasController::class, 'detallesCompra']);
        $r->addRoute('GET', '/carrito', [CarritoController::class, 'mostrarCarrito']);
        $r->addRoute('POST', '/carrito/agregar', [CarritoController::class, 'agregarAlCarrito']);
        $r->addRoute('POST', '/carrito/eliminar', [CarritoController::class, 'eliminarDelCarrito']);
        $r->addRoute('POST','/carrito/actualizar-cantidad', [CarritoController::class, 'actualizarCantidad']);

        // Ruta para la factura
        $r->addRoute('GET','/carrito/factura', [CarritoController::class, 'comprar']);
        $r->addRoute('POST', '/procesar_pago', [PagoController::class, 'procesarPago']);
        $r->addRoute('GET', '/factura', [FacturaController::class, 'mostrarFactura']);


        // rutas para libreria
        $r->addRoute('GET', '/registrarLibrerias', [LibreriasController::class, 'formularioRegistro']);
        $r->addRoute('POST', '/registrarLibrerias', [LibreriasController::class, 'registrarLibreria']);
        $r->addRoute('GET', '/formularioActualizar/{id:\d+}', [LibreriasController::class, 'mostrarFormularioEdicion']);
        $r->addRoute('POST', '/formularioActualizar', [LibreriasController::class, 'actualizarLibreria']);
        $r->addRoute('GET', '/detallesLibrerias/{id:\d+}', [LibreriasController::class, 'mostrarDetallesLibreria']);
        $r->addRoute('GET', '/Librerias.php', [LibreriasController::class, 'listarLibrerias']);

    });
}
