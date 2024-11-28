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

            $error = $this->validarCampos($correo, $password);
            if ($error) {
                include __DIR__ . '/../views/admin/loginAdministrador.php';
                return;
            }

            $this->autenticarAdmin($correo, $password);
        }
    }

    private function validarCampos($correo, $password) {
        if (empty($correo) || empty($password)) {
            return 'Por favor, complete todos los campos.';
        }
        return null;
    }

    private function autenticarAdmin($correo, $password) {
        $adminExistente = $this->adminModel->verificarCredenciales($correo, $password);

        if ($adminExistente) {
            session_start();
            $_SESSION['admin_id'] = $adminExistente['ID_admin'];
            $_SESSION['correo'] = $adminExistente['correo'];

            $ultimoAcceso = date("Y-m-d H:i:s");
            setcookie('ultimo_acceso', $ultimoAcceso, time() + 30*24*60*60, "/");

            include __DIR__ . "/../views/admin/loginExitoso.php";
            exit();
        } else {
            $error = 'Correo o contraseña incorrectos.';
            include __DIR__ . '/../views/admin/loginAdministrador.php';
        }
    }

    public function mostrarPerfil() {
        $this->verificarSesion();

        $admin = $this->adminModel->obtenerAdminPorId($_SESSION['admin_id']);
        include __DIR__ . '/../views/admin/PerfilAdmin.php';
    }

    public function cerrarSesion() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /home.php');
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
