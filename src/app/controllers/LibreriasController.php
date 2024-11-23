<?php

require_once __DIR__ . "/../models/Libreria.php";

class LibreriasController {
    private $libreriaModel;

    public function __construct($db) {
        $this->libreriaModel = new Libreria($db);
    }

    // Mostrar formulario para registrar una nueva librería
    public function FormularioRegistro() {
        include __DIR__ . '/../views/Registros/libreria/registrarLibrerias.php';
    }

    public function registrarLibreria() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_libreria = $_POST['id_libreria'] ?? ''; // Captura el ID manualmente
            $nom_lib = $_POST['nom_lib'] ?? '';
            $corregimiento = $_POST['corregimiento'] ?? '';
            $calle = $_POST['calle'] ?? '';
            $num_loc = $_POST['num_loc'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $correo = $_POST['correo'] ?? '';
    
            try {
                $pdo = new PDO("mysql:host=db;dbname=paco_librery_db;port=3306", "paco_user", "paco1234");
                $query = "INSERT INTO Libreria (ID_libreria, nom_lib, corregimiento, calle, num_loc, telefono, correo)
                          VALUES (:id_libreria, :nom_lib, :corregimiento, :calle, :num_loc, :telefono, :correo)";
                $stmt = $pdo->prepare($query);
    
                $stmt->execute([
                    ':id_libreria' => $id_libreria,
                    ':nom_lib' => $nom_lib,
                    ':corregimiento' => $corregimiento,
                    ':calle' => $calle,
                    ':num_loc' => $num_loc,
                    ':telefono' => $telefono,
                    ':correo' => $correo,
                ]);
    
                header('Location: /Librerias.php');
                exit;
            } catch (PDOException $e) {
                echo "Error al registrar la librería: " . $e->getMessage();
            }
        }
    }
    
    // Mostrar formulario para editar una librería
    public function mostrarFormularioEdicion($idLibreria) {
        $libreria = $this->libreriaModel->obtenerLibreriaPorID($idLibreria);
        if ($libreria) {
            include __DIR__ . '/../views/Registros/libreria/formularioActualizar.php';
        } else {
            echo "Librería no encontrada.";
        }
    }

    public function actualizarLibreria() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datosLibreria = [
                'id_libreria' => $_POST['id_libreria'],
                'nombre' => $_POST['nombre'],
                'corregimiento' => $_POST['corregimiento'],
                'calle' => $_POST['calle'],
                'num_loc' => $_POST['num_loc'],
                'telefono' => $_POST['telefono'] ?? null,
                'correo' => $_POST['correo'] ?? null
            ];
    
            if ($this->libreriaModel->actualizarLibreria($datosLibreria)) {
                header('Location: /Librerias.php');
                exit; 
            } else {
                echo "Error al actualizar la librería.";
            }
        }
    }
    
    // Mostrar detalles de una librería
    public function mostrarDetallesLibreria($idLibreria) {
        $libreria = $this->libreriaModel->obtenerLibreriaPorID($idLibreria);
        if ($libreria) {
            include __DIR__ . '/../views/Registros/libreria/detallesLibrerias.php';
        } else {
            echo "Librería no encontrada.";
        }
    }
    
    // Ver librerías creadas
    public function listarLibrerias() {
        $librerias = $this->libreriaModel->obtenerTodasLasLibrerias();
        include __DIR__ . '/../views/Registros/libreria/Librerias.php';
    }
}
