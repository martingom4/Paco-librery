<?php

require_once __DIR__ . '/../models/Administrador.php';

class AdministradorController {
    private $adminModel;

    public function __construct($db) {
        $this->adminModel = new Administrador($db);
    }

    public function mostrarLogin() {
        include __DIR__ . '/../views/admin/loginAdministrador.php';
    }

    public function procesarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = trim($_POST['correo'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // Validación de campos vacíos
            if (empty($correo) || empty($password)) {
                $error = 'Por favor, complete todos los campos.';
                include __DIR__ . '/../views/admin/loginAdministrador.php';
                return;
            }

            // Verificar si el administrador existe en la base de datos
            $adminExistente = $this->adminModel->verificarCredenciales($correo, $password);

            if ($adminExistente) {
                // Si las credenciales son correctas, iniciar sesión
                session_start();  // Iniciar la sesión
                $_SESSION['admin_id'] = $adminExistente['ID_admin'];  // Almacenar ID del administrador en la sesión
                $_SESSION['correo'] = $adminExistente['correo'];

                //cookie de ultimo acceso
                $ultimoAcceso = date("Y-m-d H:i:s"); // La fecha y hora actual
                setcookie('ultimo_acceso', $ultimoAcceso, time() + 30*24*60*60, "/");  // La cookie durará 30 días


                 // Redirigir al catálogo o a cualquier página deseada
                 include __DIR__ . "/../views/admin/loginExitoso.php";
                exit();
            } else {
                // Si las credenciales no son correctas
                $error = 'Correo o contraseña incorrectos.';
                include __DIR__ . '/../views/admin/loginAdministrador.php';
            }
        }
    }

    public function mostrarPerfil() {
        session_start();
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /admin/login');
            exit();
        }

        $admin = $this->adminModel->obtenerAdminPorId($_SESSION['admin_id']);
        include __DIR__ . '/../views/admin/PerfilAdmin.php';
    }

    public function cerrarSesion() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /admin/login');
        exit();
    }

    public function verificarSesion() {
        session_start();
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /admin/login');
            exit();
        }
    }
}
