<?php

use FastRoute\RouteCollector;

function configurarRutas()
{
    return FastRoute\simpleDispatcher(function (RouteCollector $r) {
        // Rutas para el home
        $r->addRoute('GET', '/', [HomeController::class, 'index']);
        $r->addRoute('GET', '/home.php', [HomeController::class, 'index']);
        $r->addRoute('GET','/perfiles',[HomeController::class,'choosePerfil']);
        $r->addRoute('GET','/sobrenosotros',[HomeController::class,'sobreNosotros']);
        $r->addRoute('GET','/contacto',[HomeController::class,'sucursales']);

        // Rutas para el cliente
        $r->addGroup('/cliente', function (RouteCollector $r) {
            $r->addRoute('GET', '/registro', [ClientesController::class, 'mostrarRegistro']);
            $r->addRoute('POST', '/registro', [ClientesController::class, 'crearCliente']);
            $r->addRoute('GET', '/login', [ClientesController::class, 'mostrarLogin']);
            $r->addRoute('POST', '/login', [ClientesController::class, 'procesarLogin']);
            $r->addRoute('GET','/loginExitoso', [ClientesController::class,'loginExitoso']);
            $r->addRoute('GET','/registroFallido', [ClientesController::class,'registroFallido']);
            $r->addRoute('GET', '/perfil', [ClientesController::class, 'mostrarPerfil']);
            $r->addRoute('GET', '/actualizar', [ClientesController::class, 'mostrarUpdate']);
            $r->addRoute('POST', '/actualizar', [ClientesController::class, 'actualizarPerfil']);
            $r->addRoute('POST', '/eliminar', [ClientesController::class, 'eliminarCliente']);
            $r->addRoute('POST', '/logout', [ClientesController::class, 'logout']);
        });

        // Rutas para el administrador
        $r->addGroup('/admin', function (RouteCollector $r) {
            $r->addRoute('GET', '/login', [AdministradorController::class, 'mostrarLogin']);
            $r->addRoute('POST', '/login', [AdministradorController::class, 'procesarLogin']);
            $r->addRoute('GET', '/logout', [AdministradorController::class, 'cerrarSesion']);
            $r->addRoute('GET', '/perfil', [AdministradorController::class, 'mostrarPerfil']);
            $r->addRoute('GET', '/cerrarSesion', [AdministradorController::class, 'cerrarSesion']);
        });

        // Rutas para editorial
        $r->addGroup('/editorial', function (RouteCollector $r) {
            $r->addRoute('GET', '', [EditorialesController::class, 'verEditorial']);
            $r->addRoute('GET', '/agregar', [EditorialesController::class, 'viewRegister']);
            $r->addRoute('POST', '/registrar', [EditorialesController::class, 'addEditorial']);
            $r->addRoute('POST', '/eliminar', [EditorialesController::class, 'eliminarEditorial']);
        });

        // Rutas para las compras y ventas
        $r->addGroup('/catalogo', function (RouteCollector $r) {
            $r->addRoute('GET', '', [VentasController::class, 'mostrarCatalogo']);
            $r->addRoute('POST', '', [VentasController::class, 'mostrarCatalogo']);
        });
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

        // Rutas para librería
        $r->addGroup('/libreria', function (RouteCollector $r) {
            $r->addRoute('GET', '/registrar', [LibreriasController::class, 'formularioRegistro']);
            $r->addRoute('POST', '/registrar', [LibreriasController::class, 'registrarLibreria']);
            $r->addRoute('GET', '/actualizar/{id:\d+}', [LibreriasController::class, 'mostrarFormularioEdicion']);
            $r->addRoute('POST', '/actualizar', [LibreriasController::class, 'actualizarLibreria']);
            $r->addRoute('GET', '/detalles/{id:\d+}', [LibreriasController::class, 'mostrarDetallesLibreria']);
            $r->addRoute('GET', '', [LibreriasController::class, 'listarLibrerias']);
            $r->addRoute('POST', '/eliminar', [LibreriasController::class, 'eliminarLibreria']);
        });

        // Rutas de inventario
        $r->addGroup('/inventario', function (RouteCollector $r) {
            $r->addRoute(['GET', 'POST'], '', [InventarioController::class, 'mostrarInventario']);
            $r->addRoute(['GET', 'POST'], '/filtro', [InventarioController::class, 'mostrarInventarioFiltrado']);
            $r->addRoute(['GET', 'POST'], '/registrarLibro', [InventarioController:: class, 'registrarLibro']);
            $r->addRoute(['GET', 'POST'], '/editarLibro', [InventarioController:: class, 'editarLibro']);
            $r->addRoute(['GET', 'POST'], '/eliminarLibro', [InventarioController:: class, 'eliminarLibro']);
            $r->addRoute('GET', '/api', [InventarioApiController::class, 'obtenerInventario']);
        });

        // Rutas para empleados
        $r->addGroup('/empleados', function (RouteCollector $r) {
            $r->addRoute('GET', '', [EmpleadoController::class, 'listarEmpleados']);
            $r->addRoute('GET', '/actualizar/{id:\d+}', [EmpleadoController::class, 'mostrarFormularioActualizar']);
            $r->addRoute('POST', '/actualizar', [EmpleadoController::class, 'actualizarEmpleado']);
            $r->addRoute('POST', '/eliminar', [EmpleadoController::class, 'eliminarEmpleado']);
            $r->addRoute('GET', '/registrar', [EmpleadoController::class, 'mostrarFormularioRegistro']);
            $r->addRoute('POST', '/registrar', [EmpleadoController::class, 'registrarEmpleado']);
            $r->addRoute('GET', '/infoClientes', [ClientesController::class, 'mostrarInfoClientes']);
            $r->addRoute('GET', '/cliente-actualizar/{id}', [ClientesController::class, 'mostrarFormsActualizar']);
            $r->addRoute('POST', '/cliente-actualizar', [ClientesController::class, 'actualizarClientAdmin']);
        });
    });
}
