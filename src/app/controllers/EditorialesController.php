<?php
require_once __DIR__ ."/../models/Editorial.php";
class EditorialesController {

    private $editorialModel;
    public function __construct($db) {
        $this->editorialModel = new Editorial($db);
    }
    public function verEditorial() {
        $editorial = $this -> editorialModel -> getEditorial();
        include __DIR__ ."/../views/editorial/editorial.php";

    }
    public function viewRegister() {
        include __DIR__ ."/../views/editorial/registro.php";
    }
    public function addEditorial() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? null;
            $corregimiento = $_POST['corregimiento'] ?? null;
            $calle = $_POST['calle'] ?? null;
            $num_loc = $_POST['num_loc'] ?? null;
            $telefono = $_POST['telefono'] ?? null;
            $correo = $_POST['correo'] ?? null;

            if ($nombre && $corregimiento && $calle && $num_loc && $telefono && $correo) {
                $this->editorialModel->addEditorial($nombre, $corregimiento, $calle, $num_loc, $telefono, $correo);
                header("Location: /editorial");
                exit();
            } else {
                echo "Todos los campos son obligatorios.";
            }
        } else {
            include __DIR__ ."/../views/editorial/registro.php";
        }
    }
    public function eliminarEditorial() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $this->editorialModel->eliminarEditorial($id);
                header("Location: /editorial");
                exit();
            } else {
                echo "ID no proporcionado.";
            }
        }
    }

}
