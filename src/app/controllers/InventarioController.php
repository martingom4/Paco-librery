<?php

require_once __DIR__ . "/../models/Inventario.php";

class InventarioController {
    private $inventarioModel;

    public function __construct($db) {
        $this->inventarioModel = new Inventario($db);
    }

    private function isGetRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    private function isPostRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    private function getPostData() {
        return [
            'isbn' => $_POST['isbn'],
            'nombre' => $_POST['nombre'],
            'titulo' => $_POST['titulo'],
            'edicion' => $_POST['edicion'],
            'precio' => $_POST['precio'],
            'fecha_publi' => $_POST['fecha_publi'],
            'id_edit' => $_POST['id_edit'],
            'id_autor' => $_POST['id_autor'],
            'imagen' => $_POST['imagen'],
            'cantidad' => $_POST['cantidad'],
            'id_libreria' => $_POST['id_libreria'],
            'id_genero' => $_POST['id_genero']
        ];
    }

    public function registrarLibro() {
        if ($this->isGetRequest()) {
            include __DIR__ . '/../views/empleado/RegistrarLibro.php';
        }

        if ($this->isPostRequest()) {
            $data = $this->getPostData();
            $this->inventarioModel->registrarLibroYInventario(
                $data['isbn'], $data['nombre'], $data['titulo'], $data['edicion'], $data['precio'], $data['fecha_publi'], $data['id_edit'], $data['id_autor'], $data['imagen'], $data['cantidad'], $data['id_libreria'], $data['id_genero']
            );
            $this->mostrarInventario();
        }
    }

    public function editarLibro() {
        if ($this->isGetRequest()) {
            include __DIR__ . '/../views/empleado/EditarLibro.php';
        }

        if ($this->isPostRequest()) {
            $data = $this->getPostData();
            $this->inventarioModel->editarLibro(
                $data['isbn'], $data['nombre'], $data['titulo'], $data['edicion'], $data['precio'], $data['fecha_publi'], $data['id_edit'], $data['id_autor'], $data['imagen'], $data['cantidad'], $data['id_libreria'], $data['id_genero']
            );
            $this->mostrarInventario();
        }
    }

    // Función para mostrar todo el inventario
    public function mostrarInventario() {
        // Obtiene todos los libros sin filtros
        $inventario = $this->inventarioModel->getInventario();

        // Carga la vista con los datos del inventario completo
        include __DIR__ . '/../views/empleado/Inventario.php';

    }

    // Función para mostrar inventario filtrado por ISBN o sucursal
    public function mostrarInventarioFiltrado() {
        // Revisa si la solicitud tiene filtros
        $isbn = $_GET['isbn'] ?? null;
        $sucursal = $_GET['Sucursal'] ?? null;

        // Si se tiene ISBN o Sucursal, se realiza el filtrado
        if ($isbn || $sucursal) {
            $inventario = $this->inventarioModel->getLibrosFiltrados($isbn, $sucursal);
        } else {
            $inventario = $this->inventarioModel->getInventario();
        }

        // Carga la vista con los datos filtrados
        include __DIR__ . '/../views/empleado/Inventario.php';
    }

    public function eliminarLibro() {
        // Verificar si la solicitud es POST (para eliminar)
        if ($this->isPostRequest()) {
            // Obtener el ISBN del formulario enviado
            $isbn = $_POST['isbn'];
            $ID_Libreria = $_POST['ID_Libreria'];
            try {
                // Llamar al modelo para eliminar el libro y su inventario
                $this->inventarioModel->eliminarLibro($isbn, $ID_Libreria);
                // Redirigir al inventario después de eliminar
                $this->mostrarInventario();
            } catch (Exception $e) {
                // Manejar errores y mostrar un mensaje
                echo "Error al eliminar el libro: " . $e->getMessage();
            }
        }
    }
}
